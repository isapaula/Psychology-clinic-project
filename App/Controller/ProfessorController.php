<?php 

namespace Controller;

use Database\Conexao;

class ProfessorController extends BaseController {

    public function __construct()
    {
        $this->verificarAutenticacao(3);
    }

    public function index(){

        $this->listarSolicitacoes();

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

    public function recusada() {
    

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
                    INNER JOIN usuario ON usuario.id_user = paciente.id_usuario;";

            $result = $pdo->query($sql);

            $dados = $result->fetchAll(\PDO::FETCH_ASSOC);

            $SolicitacoesPendentes = [];
            $solicitacoesAnalisadas = [];

            foreach ($dados as $dado) {

                switch ($dado['solicitacoes_status']) {
                    case 'AGUARDANDO_TRIAGEM':
                        $SolicitacoesPendentes[] = $dado;
                        break;
                    
                    default:
                        $solicitacoesAnalisadas[] = $dado;
                        break;
                }
                
            }
            require dirname(__DIR__, 2). '/App/Views/professor/AreaProfessor.php';

        } catch (\Exception $e) {

            error_log("Erro ao carregar as solicitações na tela do professor! ". $e->getMessage());
            echo "Erro ao carregar as solicitações na tela do professor! ". $e->getMessage();
            
        }

    }

    




}