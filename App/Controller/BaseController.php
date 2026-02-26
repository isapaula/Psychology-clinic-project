<?php 

namespace Controller; 

class BaseController {

    protected function verificarAutenticacao($papelPermitido){

        if (session_status() === PHP_SESSION_NONE) {
            // session_start();
            echo "Os dados da sessão UsuarioController foi perdida!"; 
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /Psychology-clinic-project/public/usuario/login");
            exit;
        }

        if ($_SESSION['user_papel'] != $papelPermitido) {
            echo "Acesso negado";
            exit;
        }

    }

    protected function redirecionar($rota){
        header("Location: $rota"); 
        exit;
    }
}