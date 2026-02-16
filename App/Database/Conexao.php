<?php 

namespace Database;

class Conexao {

    private static $instance = null;

    public static function getConnection() {

        if (self::$instance === null) {

            try {

                self::$instance = new \PDO("mysql:host=localhost;dbname=clinica", 'root', 'root');

                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            } catch (\PDOException $e) {

                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}


