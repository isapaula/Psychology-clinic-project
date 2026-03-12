<?php

namespace Controller;

use Database\Conexao;
use PDO;

class AuthController
{
    public function paciente()
    {

        $nome  = !empty($_POST['nome']) ? $_POST['nome'] : null;
        $email = !empty($_POST['email']) ? $_POST['email'] : null;
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;
        $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);
        $dataNascimento = !empty($_POST['data_nasc']) ? $_POST['data_nasc'] : null ;
        $telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : null;
        $telefoneLimpo = str_replace(array('.', '-', '(', ')'), '', $telefone);
        $telefoneValido = filter_var($telefoneLimpo, FILTER_VALIDATE_INT);

        if (empty($senha)) {
            $senhaNova = null;
        } else {
            $senhaNova = password_hash($senha, PASSWORD_DEFAULT);
        }

        try {

            $pdo = Conexao::getConnection();

            $pdo->beginTransaction();

            $stmtUser = $pdo->prepare("
                        INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                        VALUES (:nome, :email, :senha, 1)
                    ");

            $stmtUser->bindValue(':nome', $nome, PDO::PARAM_STR);
            $stmtUser->bindValue(':email', $emailValido, PDO::PARAM_STR);
            $stmtUser->bindValue(':senha', $senhaNova, PDO::PARAM_STR);

            $stmtUser->execute();

            $idUsuario = $pdo->lastInsertId();

            $stmtPaciente = $pdo->prepare("
                        INSERT INTO paciente (id_usuario, data_nascimento, telefone)
                        VALUES (?, ?, ?)
                    ");

            $stmtPaciente->execute([$idUsuario, $dataNascimento, $telefoneValido]);

            $idPaciente = $pdo->lastInsertId();

            $_SESSION['paciente_id'] = $idPaciente;

            $pdo->commit();

            header('Location: /Psychology-clinic-project/public/usuario/login');
            exit;

        } catch (\Exception $e) {

            if ($pdo->inTransaction()) {

                $pdo->rollBack();
            }

            error_log("Erro ao cadastrar paciente/usuário: ".$e->getMessage());

            echo "Erro ao cadastrar paciente/usuário: ".$e->getMessage();

            exit;

        }



    }

    public function professor()
    {

        $nome  = !empty($_POST['nome']) ? $_POST['nome'] : null;
        $email = !empty($_POST['email']) ? $_POST['email'] : null;
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;
        $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);
        $rp = !empty($_POST['rp']) ? $_POST['rp'] : null;



        if (empty($senha)) {
            $senhaNova = null;
        } else {
            $senhaNova = password_hash($senha, PASSWORD_DEFAULT);
        }

        try {

            $pdo = Conexao::getConnection();

            $pdo->beginTransaction();

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                        VALUES (:nome, :email, :senha, 3)
            ");

            $stmtUser->bindValue(':nome', $nome, PDO::PARAM_STR);
            $stmtUser->bindValue(':email', $emailValido, PDO::PARAM_STR);
            $stmtUser->bindValue(':senha', $senhaNova, PDO::PARAM_STR);

            $stmtUser->execute();

            $idUsuario = $pdo->lastInsertId();

            $stmtProfessor = $pdo->prepare("
                INSERT INTO professor (id_usuario, registro_profissional)
                VALUES (?, ?);
            ");

            $stmtProfessor->execute([$idUsuario, $rp]);

            $idprofessor = $pdo->lastInsertId();

            $_SESSION['professor_id'] = $idprofessor;

            $pdo->commit();

            header('Location: /Psychology-clinic-project/public/usuario/login');
            exit;

        } catch (\Exception $e) {

            if ($pdo->inTransaction()) {

                $pdo->rollBack();
            }

            error_log("Erro ao cadastrar professor/usuário: ".$e->getMessage());

            echo "Erro ao cadastrar professor/usuário: ".$e->getMessage();

            exit;

        }

    }

    public function aluno()
    {


        $nome  = !empty($_POST['nome']) ? $_POST['nome'] : null;
        $email = !empty($_POST['email']) ? $_POST['email'] : null;
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;
        $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);
        $matricula = !empty($_POST['matricula']) ? $_POST['matricula'] : null;
        $semestre = $_POST['semestre'] ?? null;

        if (empty($senha)) {
            $senhaNova = null;
        } else {
            $senhaNova = password_hash($senha, PASSWORD_DEFAULT);
        }

        try {

            $pdo = Conexao::getConnection();

            $pdo->beginTransaction();

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                        VALUES (:nome, :email, :senha, 2)
            ");

            $stmtUser->bindValue(':nome', $nome, PDO::PARAM_STR);
            $stmtUser->bindValue(':email', $emailValido, PDO::PARAM_STR);
            $stmtUser->bindValue(':senha', $senhaNova, PDO::PARAM_STR);

            $stmtUser->execute();

            $idUsuario = $pdo->lastInsertId();

            $stmtAluno = $pdo->prepare("
                INSERT INTO aluno (id_usuario, matricula , semestre )
                VALUES (?, ?, ?);
            ");

            $stmtAluno->execute([$idUsuario, $matricula, $semestre]);

            $idAluno = $pdo->lastInsertId();

            $_SESSION['aluno_id'] = $idAluno;

            $pdo->commit();

            header('Location: /Psychology-clinic-project/public/usuario/login');
            exit;

        } catch (\Exception $e) {

            if ($pdo->inTransaction()) {

                $pdo->rollBack();
            }

            error_log("Erro ao cadastrar aluno/usuário".$e->getMessage());

            echo "Erro ao cadastrar aluno/usuário".$e->getMessage();

            exit;

        }

    }

}
