<?php

namespace Controller;

use Database\Conexao;

class AuthController {

    public function paciente(){

        try {

            $pdo = Conexao::getConnection();

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

            $_SESSION['paciente_id'] = $idPaciente;
            
            $pdo->commit();

            header('Location: /Psychology-clinic-project/public/usuario/login');
            exit;

        } catch (\Exception $e) {

           if ($pdo->inTransaction()) {

                $pdo->rollBack();
            }

            error_log("Erro ao cadastrar paciente/usuário".$e->getMessage());

            echo "Erro ao cadastrar paciente/usuário".$e->getMessage();

            exit;

        }

    }

    public function professor(){
        try {

            $pdo = Conexao::getConnection();

            $pdo->beginTransaction();

            $nome  = $_POST['nome'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            $rp = $_POST['rp'] ?? null;
            
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                VALUES (?, ?, ?, 3)
            ");

            $stmtUser->execute([$nome, $email, $senhaHash]);

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

            error_log("Erro ao cadastrar professor/usuário".$e->getMessage());

            echo "Erro ao cadastrar professor/usuário".$e->getMessage();

            exit;

        }

    }

    public function aluno(){

        $pdo = Conexao::getConnection();

        try {
            
            $pdo->beginTransaction();

            $nome  = $_POST['nome'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            $matricula = $_POST['matricula'] ?? null;
            $semestre = $_POST['semestre'] ?? null;
            
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmtUser = $pdo->prepare("
                INSERT INTO usuario (nome_user, email_user, senha_user, id_papel)
                VALUES (?, ?, ?, 2)
            ");

            $stmtUser->execute([$nome, $email, $senhaHash]);

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