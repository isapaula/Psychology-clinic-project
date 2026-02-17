<?php 

namespace Controller;

use Database\Conexao;
use Controller\SessaoController;

use PDO;

class AlunoController {

    public function create(){

    }

    public function store(){

    }

    public function AreaAluno(){

    }

    public function ListaPacientes(){

        $pdo = Conexao::getConnection();  

        try {
            // ajustar essa consulta para pegar o id do usuário correto. 
            $sql = "SELECT DISTINCT solicitacoes_atendimento.id_paciente, solicitacoes_atendimento.id_solicitacao, usuario.nome_user, solicitacoes_atendimento.especialidade,solicitacoes_atendimento.horario_desejado, solicitacoes_atendimento.observacao_inicial, solicitacoes_atendimento.solicitacoes_status
                    FROM solicitacoes_atendimento
                    INNER JOIN paciente ON paciente.id_paciente = solicitacoes_atendimento.id_paciente
                    INNER JOIN usuario ON usuario.id_user = paciente.id_usuario;"; 

            
            $dados = $pdo->query($sql);
            
            $solicitacoes = $dados->fetchAll(\PDO::FETCH_ASSOC); 

            /*$array = array(
                'id' => $result[0],
                'Paciente' => $result[1],
                'Especialidade' => $result[2],
                'Horário desejado' => $result[3],
                'Observação' => $result[4],
                'Status da solicitação' => $result[5] 
            );*/

            $_SESSION['id_aluno'] = 1;

            require dirname(__DIR__, 2). '/App/Views/Aluno/AreaAluno.php';
            

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