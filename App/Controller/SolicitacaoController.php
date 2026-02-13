<?php

namespace Controller;

class SolicitacaoController {

    public function create(){

        require dirname(__DIR__, 2) . '/App/Views/paciente/SolicitarAtendimentoForm.php';

    }

    public function store(){

        if (isset($_SESSION['paciente_id']) && isset($_SESSION['paciente_nome']) ) {

            try {

            $pdo = new \PDO("mysql:host=localhost;dbname=clinica", "root", "root");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);


                $pdo->beginTransaction();

                $id_paciente = $_SESSION['paciente_id']; 
                $especialidade = $_POST['especialidade'];
                $horario_desejado = $_POST['selectHora'];
                $observacao = $_POST['observacao']; 

                $stmpSolicitacao = $pdo->prepare(
                    "INSERT INTO solicitacoes_atendimento (id_paciente, especialidade, horario_desejado, observacao_inicial) VALUES (?, ?, ?, ? );"
                );

                $stmpSolicitacao->execute([$id_paciente, $especialidade, $horario_desejado, $observacao]);

                $pdo->commit();

                $status  = $this->statusSolicitação($id_paciente);

                $_SESSION['status_solicitacao'] = $status['status_solicitacao'];

                
                header('Location: http://localhost/Psychology-clinic-project/App/Views/paciente/AreaPaciente.php');

        
            } catch (\Exception $e) {

                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }

                error_log("Erro ao cadastrar solicitação de atendimento");

                echo "Erro ao cadastrar solicitação de atendimento:{$e->getMessage()}";
                
            }

        }else{
            echo "Não foi possível criar a solicitação de atendimento!";
        }

    }

    public function statusSolicitação($idpaciente){

        $pdo = new \PDO("mysql:host=localhost;dbname=clinica", "root", "root");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        try {

            $consulta = $pdo->prepare("SELECT solicitacoes_atendimento.solicitacoes_status  AS status_solicitacao FROM paciente
            INNER JOIN usuario ON usuario.id_user = paciente.id_usuario
            INNER JOIN solicitacoes_atendimento ON paciente.id_paciente = solicitacoes_atendimento.id_paciente
            WHERE solicitacoes_atendimento.id_paciente = :id_paciente
            ;");

            $consulta->execute([ 'id_paciente' => $idpaciente]);

            $result  = $consulta->fetch(\PDO::FETCH_ASSOC);

            return $result;

            
        } catch (\Exception $e) {

            error_log("Erro ao consultar o status da solicitação: ".$e);
            echo "Erro ao consultar o status da solicitação: ".$e; 
            
        }

    }

}