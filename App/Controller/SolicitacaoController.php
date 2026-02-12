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
                
                require dirname(__DIR__, 2) . '/App/Views/paciente/AreaPaciente.php';

        
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

}