<?php

namespace Controller;
use Database\Conexao;

class SolicitacaoController {

    public function create(){

        require dirname(__DIR__, 2) . '/App/Views/paciente/SolicitarAtendimentoForm.php';

    }

    public function areaPaciente(){

        require dirname(__DIR__, 2). '/App/Views/paciente/AreaPaciente.php';
    }

    public function store(){

        $pdo = Conexao::getConnection();

        if (isset($_SESSION['paciente_id']) && isset($_SESSION['paciente_nome']) ) {

            try {

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

                $this->areaPaciente();

        
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

        $pdo = Conexao::getConnection();

        try {

            $consulta = $pdo->prepare("SELECT solicitacoes_atendimento.solicitacoes_status  AS status_solicitacao FROM paciente
            INNER JOIN usuario ON usuario.id_user = paciente.id_usuario
            INNER JOIN solicitacoes_atendimento ON paciente.id_paciente = solicitacoes_atendimento.id_paciente
            WHERE solicitacoes_atendimento.id_paciente = :id_paciente
            ;");

            $consulta->execute([ 'id_paciente' => $idpaciente]);

            // dessa forma o sistema pega apenas uma solicitação atendimento do paciente, para pegar todas é necessário o fetchAll. 
            $result  = $consulta->fetch(\PDO::FETCH_ASSOC);

            return $result;

            
        } catch (\Exception $e) {

            error_log("Erro ao consultar o status da solicitação: ".$e);
            echo "Erro ao consultar o status da solicitação: ".$e; 
            
        }

    }


}