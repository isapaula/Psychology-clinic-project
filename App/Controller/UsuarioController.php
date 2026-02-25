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
        
        $login = isset($_POST['user']) ? $_POST['user'] : "Usuário/e-mail inválido!";
        $pass = isset($_POST['pass']) ? $_POST['pass'] : "Senha inválida!";
        $senhaHash = password_hash($pass, PASSWORD_DEFAULT);

        $smtp = $pdo->prepare("SELECT usuario.email_user, usuario.senha_user  FROM usuario WHERE email_user = ? OR senha_user = ?");

        $smtp->execute([$login, $senhaHash]); 

        $row = $smtp->fetchAll(\PDO::FETCH_ASSOC); 

        if (count($row) > 0) {
            $_SESSION['usuario'] = $login;
            $_SESSION['senha'] = $senhaHash;

            echo "usuario logado";
        }else if(count($row) == 0){
            echo "Não foi possível logar usuário!";
        }
            
        } catch (\Exception $e) {

            echo "Erro ao logar:  ". $e->getMessage();
            
        }

    }

    public function deslogar(){

    }

    public function selecaoPerfil(){

    }



}                                                                                 