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

            $query = $pdo->prepare($sql); 

            $usuario = $pdo->execute([$login]);

            if ($usuario && password_hash($pass, $usuario['senha_user'])) {
                
                session_start(); 

                
            }
            
            



        } catch (\Exception $e) {
            
        }
        
    }

}                                                                                