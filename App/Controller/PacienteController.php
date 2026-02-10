<?php 

namespace Controller; 

class PacienteController {

    public function index(){

        echo "Estou no PacienteController index!!";
    }

    public function create(){
  
        require dirname(__DIR__, 2) . '/App/Views/paciente/PacienteForm.php';
    }

    public function store(){

        try {
            
            $pdo = new \PDO("mysql:host=localhost;dbname=clinica", "root", "root");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            
            $pdo->beginTransaction();

            
            $nome  = $_POST['nome'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            $dataNascimento = $_POST['data_nasc'] ?? null;
            $telefone = $_POST['telefone'] ?? null;
            
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user)
                VALUES (?, ?, ?)
            ");

            $stmtUser->execute([$nome, $email, $senhaHash]);

            $idUsuario = $pdo->lastInsertId();

            $stmtPaciente = $pdo->prepare("
                INSERT INTO paciente (id_usuario, data_nascimento, telefone)
                VALUES (?, ?, ?)
            ");

            $stmtPaciente->execute([$idUsuario, $dataNascimento, $telefone]);

            $pdo->commit();

            echo "Paciente cadastrado com sucesso!";
            
        } catch (\Exception $e) {

            if (isset($pdo) && $pdo->inTransaction()) {
                $pdo->rollBack();
            }

            echo "Erro ao cadastrar paciente: " . $e->getMessage();
        }
    }

    
}