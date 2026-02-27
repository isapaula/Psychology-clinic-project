<?php 

namespace Controller;

use Database\Conexao;

class PacienteController extends BaseController {

    public function __construct()
    {
        $this->verificarAutenticacao(1);
    }
    
    public function index(){

        $this->MinhaSolicitacao($_SESSION['user_id']); 
    }

    public function SolicitarAtendimento(){

        require dirname(__DIR__, 2). '/App/Views/paciente/SolicitarAtendimentoForm.php';
    }

    public function MinhaSolicitacao($id_user){

        try {

            $pdo = Conexao::getConnection();

            $sql = "SELECT solicitacoes_atendimento.solicitacoes_status  FROM solicitacoes_atendimento
                    INNER JOIN paciente ON  solicitacoes_atendimento.id_paciente = paciente.id_paciente
                    INNER JOIN usuario  ON paciente.id_usuario = usuario.id_user
                    WHERE usuario.id_user = ?;";
            
            $query = $pdo->prepare($sql); 

            $query->execute([$id_user]);

            $dados = $query->fetch(\PDO::FETCH_ASSOC); 

            if (is_array($dados)) {

                $statusSolicitacao = $dados['solicitacoes_status'];
                
                $_SESSION['status_solicitacao'] = $statusSolicitacao;

                require dirname(__DIR__, 2) .'/App/Views/paciente/AreaPaciente.php';


            }else{

             $this->SolicitarAtendimento();

            }

        } catch (\Exception $e) {
            echo "Não foi possível pegar as solicitações do paciente: ". $e->getMessage();
        }

    }
    
}