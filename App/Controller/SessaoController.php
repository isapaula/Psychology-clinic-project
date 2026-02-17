<?php

namespace Controller;

use Database\Conexao;

class SessaoController {

    public function index(){

        if (isset($_SESSION['id_aluno'])) {

            $idAluno = $_SESSION['id_aluno']; 
            
            try {

            $pdo = Conexao::getConnection(); 

            $sql = "SELECT sessao.id_sessao, usuario.nome_user, solicitacoes_atendimento.solicitacoes_status, sessao.data_sessao, sessao.hora_inicio , sessao.hora_fim from solicitacoes_atendimento
                    inner join sessao on solicitacoes_atendimento.id_solicitacao = sessao.id_solicitacao
                    inner join paciente on solicitacoes_atendimento.id_paciente = paciente.id_paciente
                    inner join usuario on paciente.id_usuario = usuario.id_user
                    where sessao.id_aluno = :id_aluno ;";

            $select =  $pdo->prepare($sql);

            $select->execute(['id_aluno' => $idAluno]); 

            $result = $select->fetchAll(\PDO::FETCH_ASSOC);

            require dirname(__DIR__, 2 ). '/App/Views/Aluno/Sessoes.php';

                
            } catch (\PDOException $e) {
                
                error_log("Não foi possível mostrar suas sessões!". $e->getMessage());
                echo "Não foi possível mostrar suas sessões!". $e->getMessage();

            }
        }

    }

    public function create(){

        require dirname(__DIR__, 2). '/App/Views/Aluno/CriarSessao.php';

    }

    public function store(){

        $pdo = Conexao::getConnection();

        if (isset($_SESSION['id_solicitacao'])  && isset($_SESSION['id_aluno'])) {

            try {

                $pdo->beginTransaction();

                $sql = "INSERT INTO sessao (id_solicitacao, id_aluno, data_sessao, hora_inicio, hora_fim) VALUES (?, ?, ?, ?, ?);";

                $idSolic = $_SESSION['id_solicitacao'];
                $idAluno = $_SESSION['id_aluno'];
                $datasessao = $_POST['data_sessao'];
                $horainicio = $_POST['hora_inicio'];
                $horafinal = $_POST['hora_final']; 
                

                $insert = $pdo->prepare($sql);

                $insert->execute([$idSolic, $idAluno, $datasessao, $horainicio, $horafinal]);

                $pdo->commit();

                $this->index();
            

            } catch (\PDOException $e) {

                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }

                error_log("Não foi possível inserir a sessão! ". $e->getMessage());

                echo "Não foi possível inserir a sessão!". $e->getMessage();
                
            }

        }

    }

    public function updateStatus() {

        if (!isset($_POST['id_sessao'], $_POST['status'])) {
            echo "Dados inválidos.";
            return;
        }

        try {

            $pdo = Conexao::getConnection();

            $sql = "UPDATE sessao 
                    SET status_sessao = :status 
                    WHERE id_sessao = :id_sessao";

            $update = $pdo->prepare($sql);

            $update->execute([
                'status' => $_POST['status'],
                'id_sessao' => $_POST['id_sessao']
            ]);


            header("Location: /Psychology-clinic-project/public/sessao/index");
            exit;

        } catch (\PDOException $e) {
            error_log("Erro ao atualizar status da sessão: " . $e->getMessage());
            echo "Não foi possível atualizar o status da sessão.";
        }
    }

}