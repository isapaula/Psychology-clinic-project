<?php

namespace Service;

use Database\Conexao;

class ProfessorService
{
    public function criar($dados)
    {

        try {

            $pdo = Conexao::getConnection();

            $sql = "INSERT INTO professor (id_usuario, registro_profissional)
                VALUES (:id_usuario, :registro_profissional)";

            $stmtprofessor = $pdo->prepare($sql);

            $stmtprofessor->bindValue(':id_usuario', $dados['id_usuario'], \PDO::PARAM_STR);
            $stmtprofessor->bindValue(':registro_profissional', $dados['registro_profissional'], \PDO::PARAM_STR);

            $stmtprofessor->execute();

            $idprofessor = $pdo->lastInsertId();

            $_SESSION['professor_id'] = $idprofessor;


        } catch (\Exception $e) {

            echo "Não foi possível cadastrar o professor! ".$e->getMessage();

        }

    }
}
