<?php

namespace App\Service;

use App\Database\Conexao;

class UsuarioService
{
    private $pdo; 

    public function __construct($pdo)
    {
        $this->pdo = $pdo; 
        
    }
    public function criarUsuario($dadosUsuario, $id_perfil)
    {

        try {

            $this->pdo->beginTransaction();

            $dadosUsuario['senha'] = password_hash($dadosUsuario['senha'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                        VALUES (:nome, :email, :senha, :perfil);";

            $stmtUser = $this->pdo->prepare($sql);

            $stmtUser->bindValue(':nome', $dadosUsuario['nome'], \PDO::PARAM_STR);
            $stmtUser->bindValue(':email', $dadosUsuario['email'], \PDO::PARAM_STR);
            $stmtUser->bindValue(':senha', $dadosUsuario['senha'], \PDO::PARAM_STR);
            $stmtUser->bindValue(':perfil', $id_perfil, \PDO::PARAM_INT);

            $stmtUser->execute();

            $idUsuario = $this->pdo->lastInsertId();

            return $idUsuario;

        } catch (\Exception $e) {

            echo "Não foi possível cadastrar o usuário! ".$e->getMessage();

        }

    }
}
