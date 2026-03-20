<?php

namespace Controller;

use Database\Conexao;
use Controller\SessaoController;

class AlunoController extends BaseController
{
    public function __construct()
    {

        $this->verificarAutenticacao(2);
    }

    public function index()
    {

        $this->casosDisponiveis();
    }

    // não mexer pois já está funcionando!
    public function casosDisponiveis()
    {


        if (isset($_SESSION['user_id'])) {

            $iduser = $_SESSION['user_id'];

            try {

                $pdo = Conexao::getConnection();

                $sql = "SELECT solicitacoes_atendimento.id_solicitacao, usuario.nome_user, solicitacoes_atendimento.especialidade, solicitacoes_atendimento.horario_desejado, solicitacoes_atendimento.observacao_inicial, solicitacoes_atendimento.solicitacoes_status FROM  solicitacoes_atendimento
                        INNER JOIN paciente ON solicitacoes_atendimento.id_paciente = paciente.id_paciente
                        INNER JOIN usuario ON usuario.id_user = paciente.id_usuario 
                        WHERE solicitacoes_atendimento.solicitacoes_status = 'APROVADA' AND solicitacoes_atendimento.id_aluno IS NULL OR solicitacoes_atendimento.id_aluno = (select aluno.id_aluno from aluno where aluno.id_usuario = ? ) ; ";

                $result = $pdo->prepare($sql);

                $result->execute([$iduser]);

                $Minhassolicitacoes = $result->fetchAll(\PDO::FETCH_ASSOC);

                $casosDisponiveis = [];
                $casosAssumidos = [];

                foreach ($Minhassolicitacoes as $Caso) {

                    switch ($Caso['solicitacoes_status']) {
                        case 'EM_ATENDIMENTO':
                            $casosAssumidos[] = $Caso;
                            break;

                        default:
                            $casosDisponiveis[] = $Caso;
                            break;
                    }
                }

                require dirname(__DIR__, 2). '/App/Views/Aluno/AreaAluno.php';

            } catch (\Exception $e) {

                echo "Deu erro ao listar casos disponíveis! ".$e->getMessage();

            }
        }
    }

    // não está sendo utilizado!
    public function MeusCasos($id_aluno)
    {


        $pdo = Conexao::getConnection();

        try {

            $sql = "SELECT solicitacoes_atendimento.id_paciente, solicitacoes_atendimento.id_solicitacao, usuario.nome_user, solicitacoes_atendimento.especialidade,solicitacoes_atendimento.horario_desejado, solicitacoes_atendimento.observacao_inicial, solicitacoes_atendimento.solicitacoes_status
                    FROM solicitacoes_atendimento
                    INNER JOIN paciente ON paciente.id_paciente = solicitacoes_atendimento.id_paciente
                    INNER JOIN usuario ON usuario.id_user = paciente.id_usuario
                    WHERE solicitacoes_atendimento.id_aluno = ? and solicitacoes_atendimento.solicitacoes_status = 'APROVADA'
                    ;";


            $meuscasos = $pdo->prepare($sql);

            $meuscasos->execute([$id_aluno]);

            $solicitacoes = $meuscasos->fetchAll(\PDO::FETCH_ASSOC);

            if (count($solicitacoes) > 0) {

                $_SESSION['id_solicitacao'] = $solicitacoes['id_solicitacao'];

            }

            require dirname(__DIR__, 2). '/App/Views/Aluno/AreaAluno.php';

            exit;


        } catch (\Exception $e) {

            error_log("Erro ao listar paciente: ".$e->getMessage());

            echo "Erro ao listar paciente: ".$e->getMessage();

            exit;

        }

    }

    public function assumir()
    {


        if (!isset($_SESSION['user_id'])) {
            echo "Aluno não autenticado!";
            return;
        }

        $idSolicitacao = $_POST['id_solicitacao'];
        $_SESSION['id_solicitacao'] = $idSolicitacao;
        $iduser = $_SESSION['user_id'];

        $pdo = Conexao::getConnection();

        $sql = "UPDATE solicitacoes_atendimento 
        SET solicitacoes_status = 'ASSUMIDA',
        id_aluno = (SELECT aluno.id_aluno FROM aluno WHERE id_usuario = ?) 
        WHERE id_solicitacao = ?;";

        $alterar = $pdo->prepare($sql);
        $alterar->execute([$iduser, $idSolicitacao]);

        $sessao = new SessaoController();
        $sessao->create();

    }

}
