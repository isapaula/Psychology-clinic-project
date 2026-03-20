<?php

namespace Service;

use Database\Conexao;

class AlunoService
{
    public function criar($dados)
    {

        try {

            $pdo = Conexao::getConnection();

            $sql = "INSERT INTO aluno (id_usuario, matricula , semestre )
                VALUES(:id_usuario, :matricula,  :semestre";

            $stmtAluno = $pdo->prepare($sql);

            $stmtAluno->bindValue(':id_usuario', $dados['id_usuario'], \PDO::PARAM_STR);
            $stmtAluno->bindValue(':matricula', $dados['matricula'], \PDO::PARAM_STR);
            $stmtAluno->bindValue(':semestre', $dados['semestre'], \PDO::PARAM_STR);

            $stmtAluno->execute();

            $idAluno = $pdo->lastInsertId();

            $_SESSION['Aluno_id'] = $idAluno;


        } catch (\Exception $e) {

            echo "Não foi possível cadastrar o Aluno! ".$e->getMessage();

        }

    }

}
