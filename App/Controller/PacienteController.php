<?php 

namespace Controller;

use Database\Conexao;

class PacienteController extends BaseController {
    
    public function index(){

        // $this->verificaAutorizacao();
        

        require dirname(__DIR__, 2) .'/App/Views/paciente/AreaPaciente.php'; 
    }

    public function create(){
  
        require dirname(__DIR__, 2) . '/App/Views/paciente/PacienteForm.php';
    }

    public function SolicitarAtendimento(){

        require dirname(__DIR__, 2). '/App/Views/paciente/SolicitarAtendimentoForm.php';
    }

    public function store(){

        $pdo = Conexao::getConnection();

        try {
            
            $pdo->beginTransaction();

            $nome  = $_POST['nome'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            $dataNascimento = $_POST['data_nasc'] ?? null;
            $telefone = $_POST['telefone'] ?? null;
            
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                VALUES (?, ?, ?, 1)
            ");

            $stmtUser->execute([$nome, $email, $senhaHash]);

            $idUsuario = $pdo->lastInsertId();

            $stmtPaciente = $pdo->prepare("
                INSERT INTO paciente (id_usuario, data_nascimento, telefone)
                VALUES (?, ?, ?)
            ");

            $stmtPaciente->execute([$idUsuario, $dataNascimento, $telefone]);

            $idPaciente = $pdo->lastInsertId(); 
            
            $pdo->commit();

            $_SESSION['paciente_id'] = $idPaciente;
            $_SESSION['nome_user'] = $nome;

            $this->SolicitarAtendimento();

            exit;

        } catch (\Exception $e) {

            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            error_log("Erro ao cadastrar paciente/usuário".$e->getMessage());


            $_SESSION['error'] = "Não foi possível concluir o cadastro.";

            exit;

        }
    }

    public function MinhaSolicitacao($id_paciente){

        try {
            
            
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    
}