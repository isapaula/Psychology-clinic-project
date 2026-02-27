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




}