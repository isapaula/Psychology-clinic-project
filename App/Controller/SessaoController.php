<?php

namespace Controller;

use Database\Conexao;

class SessaoController
{
    public function index()
    {

        if (isset($_SESSION['user_id'])) {

            $iduser = $_SESSION['user_id'];

            try {

                $pdo = Conexao::getConnection();

                $sql = "SELECT sessao.id_sessao, paciente.nome_paciente,  solicitacoes_atendimento.solicitacoes_status, sessao.data_sessao, sessao.hora_inicio , sessao.hora_fim, status_sessao FROM solicitacoes_atendimento
                INNER JOIN aluno ON solicitacoes_atendimento.id_aluno = aluno.id_aluno
                INNER JOIN paciente ON paciente.id_paciente = solicitacoes_atendimento.id_paciente
                INNER JOIN sessao ON sessao.id_solicitacao = solicitacoes_atendimento.id_solicitacao
                WHERE aluno.id_usuario = ?;";

                $select =  $pdo->prepare($sql);

                $select->execute([$iduser]);

                $result = $select->fetchAll(\PDO::FETCH_ASSOC);

                require dirname(__DIR__, 2). '/App/Views/Aluno/Sessoes.php';


            } catch (\PDOException $e) {

                error_log("Não foi possível mostrar suas sessões!". $e->getMessage());
                echo "Não foi possível mostrar suas sessões!". $e->getMessage();

            }
        }
    }

    public function create()
    {

        require dirname(__DIR__, 2). '/App/Views/Aluno/CriarSessao.php';
    }

    public function store()
    {

        $pdo = Conexao::getConnection();

        if (isset($_SESSION['id_solicitacao'])  && isset($_SESSION['user_id'])) {

            try {

                $pdo->beginTransaction();

                $sql = "INSERT INTO sessao (id_solicitacao, id_aluno, data_sessao, hora_inicio, hora_fim) VALUES (?, (SELECT aluno.id_aluno FROM aluno WHERE aluno.id_usuario = ? ), ?, ?, ?);";

                $idSolic = $_SESSION['id_solicitacao'];
                $iduser = $_SESSION['user_id'];
                $datasessao = $_POST['data_sessao'];
                $horainicio = $_POST['hora_inicio'];
                $horafinal = $_POST['hora_final'];


                $insert = $pdo->prepare($sql);

                $insert->execute([$idSolic, $iduser, $datasessao, $horainicio, $horafinal]);

                $stmtUpdate = $pdo->prepare("
                            UPDATE solicitacoes_atendimento
                            SET solicitacoes_status = 'EM_ATENDIMENTO'
                            WHERE id_solicitacao = ?
                        ");

                $stmtUpdate->execute([$idSolic]);

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

    public function updateStatus()
    {

        if (!isset($_POST['id_sessao'], $_POST['status'])) {
            echo "Dados inválidos.";
        }

        $status = $_POST['status'];
        $idSessao = $_POST['id_sessao'];

        try {

            $pdo = Conexao::getConnection();

            $sql = "UPDATE sessao 
                    SET status_sessao = ? 
                    WHERE id_sessao = ? ";

            $update = $pdo->prepare($sql);

            $update->execute([$status, $idSessao]);

            header("Location: /Psychology-clinic-project/public/sessao/index");
            exit;

        } catch (\Exception $e) {
            error_log("Erro ao atualizar status da sessão: " . $e->getMessage());
            echo "Não foi possível atualizar o status da sessão." . $e->getMessage();
        }
    }

}
