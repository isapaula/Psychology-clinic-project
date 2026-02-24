<?php 

namespace Controller;

use Database\Conexao;

class ProfessorController {

    public function create(){

        require dirname(__DIR__, 2 ). '/App/Views/professor/formProfessor.php';

    }

    public function store() {

         $pdo = Conexao::getConnection();

        try {
            
            $pdo->beginTransaction();

            $nome  = $_POST['nome'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            $rp = $_POST['rp'] ?? null;
            
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user)
                VALUES (?, ?, ?)
            ");

            $stmtUser->execute([$nome, $email, $senhaHash]);

            $idUsuario = $pdo->lastInsertId();

            $stmtProfessor = $pdo->prepare("
                INSERT INTO professor (id_usuario, registro_profissional)
                VALUES (?, ?);
            ");

            $stmtProfessor->execute([$idUsuario, $rp]);

            $idprofessor = $pdo->lastInsertId(); 
            
            $pdo->commit();

            $_SESSION['professor_id'] = $idprofessor;
            $_SESSION['professor_nome'] = $nome;

            $this->listarSolicitacoes();


        } catch (\Exception $e) {

            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            error_log("Erro ao cadastrar professor/usuário".$e->getMessage());


            $_SESSION['error'] = "Não foi possível concluir o cadastro.";


            // header('Location: /paciente/create'); 
            exit;
        }

    }

    public function index(){

        require dirname(__DIR__, 2). '/App/Views/professor/AreaProfessor.php';

    }

    public function updateEmTriagem(){


    }

    public function aprovada() {

    $id = $_POST['id_solicitacao'] ?? null;

    if (!$id) {
        header("Location: /Psychology-clinic-project/public/professor/listarSolicitacoes");
        exit;
    }

    $pdo = Conexao::getConnection();

    try {

        $pdo->beginTransaction();

        // 1️⃣ Buscar status atual
        $stmt = $pdo->prepare("
            SELECT solicitacoes_status 
            FROM solicitacoes_atendimento 
            WHERE id_solicitacao = ?
        ");

        $stmt->execute([$id]);
        $solicitacao = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$solicitacao) {
            throw new \Exception("Solicitação não encontrada.");
        }

        if ($solicitacao['solicitacoes_status'] !== 'AGUARDANDO_TRIAGEM') {
            throw new \Exception("Solicitação não pode ser aprovada.");
        }

        // 2️⃣ Atualizar status
        $update = $pdo->prepare("
            UPDATE solicitacoes_atendimento
            SET solicitacoes_status = 'APROVADA'
            WHERE id_solicitacao = ?
        ");

        $update->execute([$id]);

        $pdo->commit();

        header("Location: /Psychology-clinic-project/public/professor/listarSolicitacoes");
        exit;

    } catch (\Exception $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        error_log($e->getMessage());

        header("Location: /Psychology-clinic-project/public/professor/listarSolicitacoes");
        exit;
    }
}

    public function recusada() 
    {

        $id = $_POST['id_solicitacao'] ?? null;

        if (!$id) {
            header("Location: /Psychology-clinic-project/public/professor/listarSolicitacoes");
            exit;
        }

        $pdo = Conexao::getConnection();

        try {

            $pdo->beginTransaction();

            
            $stmt = $pdo->prepare("
                SELECT solicitacoes_status 
                FROM solicitacoes_atendimento 
                WHERE id_solicitacao = ?
            ");

            $stmt->execute([$id]);
            $solicitacao = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$solicitacao) {
                throw new \Exception("Solicitação não encontrada.");
            }

            if ($solicitacao['solicitacoes_status'] !== 'AGUARDANDO_TRIAGEM') {
                throw new \Exception("Solicitação não pode ser recusada.");
            }

            
            $update = $pdo->prepare("
                UPDATE solicitacoes_atendimento
                SET solicitacoes_status = 'RECUSADA'
                WHERE id_solicitacao = ?
            ");

            $update->execute([$id]);

            $pdo->commit();

            header("Location: /Psychology-clinic-project/public/professor/listarSolicitacoes");
            exit;

        } catch (\Exception $e) {

            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            error_log($e->getMessage());

            header("Location: /Psychology-clinic-project/public/professor/listarSolicitacoes");
            exit;
        }
    }

    public function listarSolicitacoes(){

        try {

            $pdo = Conexao::getConnection(); 

            $sql = "SELECT solicitacoes_atendimento.id_solicitacao, usuario.nome_user, solicitacoes_atendimento.especialidade, solicitacoes_atendimento.horario_desejado, solicitacoes_atendimento.observacao_inicial, solicitacoes_atendimento.solicitacoes_status FROM  solicitacoes_atendimento
                    INNER JOIN paciente ON solicitacoes_atendimento.id_paciente = paciente.id_paciente
                    INNER JOIN usuario ON usuario.id_user = paciente.id_usuario 
                    WHERE solicitacoes_atendimento.solicitacoes_status = 'AGUARDANDO_TRIAGEM';";

            $result = $pdo->prepare($sql);

            $result->execute();

            $arraySolicitacoes = $result->fetchAll(\PDO::FETCH_ASSOC);

            require dirname(__DIR__, 2). '/App/Views/professor/AreaProfessor.php';


        } catch (\Exception $e) {

            error_log("Erro ao carregar as solicitações na tela do professor! ". $e->getMessage());
            echo "Erro ao carregar as solicitações na tela do professor! ". $e->getMessage();
            
        }

    }

}