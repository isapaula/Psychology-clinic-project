<?php 

namespace Controller;

use Database\Conexao;
use Controller\SessaoController;


class AlunoController {


    public function index(){

        require dirname(__DIR__, 2). '/App/Views/Aluno/AreaAluno.php';

    }

    public function create(){

        require dirname(__DIR__, 2) . '/App/Views/Aluno/FormAluno.php'; 
    }

    public function store() {

         $pdo = Conexao::getConnection();

        try {
            
            $pdo->beginTransaction();

            $nome  = $_POST['nome'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            $matricula = $_POST['matricula'] ?? null;
            $semestre = $_POST['semestre'] ?? null;
            
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                VALUES (?, ?, ?, 2)
            ");

            $stmtUser->execute([$nome, $email, $senhaHash]);

            $idUsuario = $pdo->lastInsertId();

            $stmtAluno = $pdo->prepare("
                INSERT INTO aluno (id_usuario, matricula , semestre )
                VALUES (?, ?, ?);
            ");

            $stmtAluno->execute([$idUsuario, $matricula, $semestre]);

            $idAluno = $pdo->lastInsertId(); 
            
            $pdo->commit();

            $_SESSION['aluno_id'] = $idAluno;
            $_SESSION['aluno_nome'] = $nome;

            $this->MeusCasos($idAluno);


        } catch (\Exception $e) {

            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            error_log("Erro ao cadastrar aluno/usuário".$e->getMessage());


            $_SESSION['error'] = "Não foi possível concluir o cadastro.";


            // header('Location: /paciente/create'); 
            exit;
        }

    }

    public function MeusCasos($id_aluno){

        $pdo = Conexao::getConnection();  

        try {
            
            $sql = "SELECT solicitacoes_atendimento.id_paciente, solicitacoes_atendimento.id_solicitacao, usuario.nome_user, solicitacoes_atendimento.especialidade,solicitacoes_atendimento.horario_desejado, solicitacoes_atendimento.observacao_inicial, solicitacoes_atendimento.solicitacoes_status
                    FROM solicitacoes_atendimento
                    INNER JOIN paciente ON paciente.id_paciente = solicitacoes_atendimento.id_paciente
                    INNER JOIN usuario ON usuario.id_user = paciente.id_usuario
                    WHERE solicitacoes_atendimento.id_aluno = ? and solicitacoes_atendimento.solicitacoes_status = 'APROVADA'
                    ;"; 

            
            $meuscasos = $pdo->prepare($sql);
             
            $meuscasos->execute([$id_aluno]);

            $solicitacoes = $meuscasos->fetchAll(\PDO::FETCH_ASSOC); 

            if (count($solicitacoes) > 0) {

                $_SESSION['id_solicitacao'] = $solicitacoes['id_solicitacao'];
                
            }

            require dirname(__DIR__, 2 ). '/App/Views/Aluno/AreaAluno.php';
            

        } catch (\Exception $e) {

            error_log("Erro ao listar paciente: ".$e->getMessage()); 

            echo "Erro ao listar paciente: ".$e->getMessage();
            
        }


    }

    public function assumir(){

        if(!isset($_SESSION['id_aluno'])){
            echo "Aluno não autenticado!"; 
            return;
        }

        $idSolicitacao = $_POST['id_solicitacao'];
        $_SESSION['id_solicitacao'] = $idSolicitacao;
        $idAluno = $_SESSION['id_aluno']; 

        $pdo = Conexao::getConnection(); 

        $sql = "UPDATE solicitacoes_atendimento SET solicitacoes_status = 'EM_TRIAGEM', id_aluno = ? WHERE id_solicitacao = ? ";
        
        $alterar = $pdo->prepare($sql);
        $alterar->execute([$idAluno, $idSolicitacao]);

        $sessao = new SessaoController();
        $sessao->create();

    }

}