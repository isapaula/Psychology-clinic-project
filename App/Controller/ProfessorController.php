<?php 

namespace Controller;

use Database\Conexao;

class ProfessorController {

    public function index(){

        require dirname(__DIR__, 2). '/App/Views/professor/AreaProfessor.php';

    }

    public function updateEmTriagem(){


    }

    public function aprovada(){

    }

    public function recusada(){
        
    }

    public function listarSolicitacoes(){

        try {

            $pdo = Conexao::getConnection(); 

            $sql = "SELECT solicitacoes_atendimento.id_solicitacao, usuario.nome_user, solicitacoes_atendimento.especialidade, solicitacoes_atendimento.horario_desejado, solicitacoes_atendimento.observacao_inicial, solicitacoes_atendimento.solicitacoes_status FROM  solicitacoes_atendimento
                    INNER JOIN paciente ON solicitacoes_atendimento.id_paciente = paciente.id_paciente
                    INNER JOIN usuario ON usuario.id_user = paciente.id_usuario 
                    WHERE solicitacoes_atendimento.solicitacoes_status = 'AGUARDANDO_TRIAGEM' and id_aluno is null;";

            $result = $pdo->query($sql);

            $array = $result->fetchAll(\PDO::FETCH_ASSOC);

            $this->index();


        } catch (\PDOException $e) {

            error_log("Erro ao carregar as solicitações na tela do professor! ". $e->getMessage());
            echo "Erro ao carregar as solicitações na tela do professor! ". $e->getMessage();
            
        }

    }

}