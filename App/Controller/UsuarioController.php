<?php 

namespace Controller;

use Database\Conexao;

class UsuarioController {

    public function login(){

        require dirname(__DIR__, 2 ). '/App/Views/Login.php';
    }

    public function store(){

        try {

            $pdo = Conexao::getConnection(); 

            $login = $_POST['user'] ?? null;
            $pass = $_POST['pass'] ?? null; 

            $sql = "SELECT id_user, nome_user, email_user, senha_user, id_papel FROM usuario WHERE email_user = ? ;";

            $stmt = $pdo->prepare($sql); 

            $stmt->execute([$login]);

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($usuario && password_verify($pass, $usuario['senha_user'])) {
                
                session_start(); 

                $_SESSION['user_id']    = $usuario['id_user'];
                $_SESSION['user_nome']  = $usuario['nome_user'];
                $_SESSION['user_papel'] = $usuario['id_papel'];

                switch ($usuario['id_papel']) {

                    case 1:
                        require dirname(__DIR__, 2) .'/App/Views/paciente/AreaPaciente.php';
                        break;

                    case 2:
                        require dirname(__DIR__, 2) .'/App/Views/Aluno/AreaAluno.php';
                        break;

                    case 3:
                        require dirname(__DIR__, 2) . '/App/Views/professor/AreaProfessor.php';
                        break;
                    
                    default:
                        header('Location: /Psychology-clinic-project/public/usuario/login');
                        break;
                }

            }else{
                echo "E-mail inválido!";
            }

        } catch (\Exception $e) {
            error_log("Erro ao logar no sistema: ". $e->getMessage());
            echo "Erro ao logar no sistema: ".$e->getMessage();
            
        }
        
    }

}                                                                                