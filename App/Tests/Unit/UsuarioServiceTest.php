<?php

use PHPUnit\Framework\TestCase;
use App\Service\UsuarioService; 

class UsuarioServiceTest extends TestCase{
    
    private $pdo; 

    protected function setUp(): void
    {
        // banco em memória (não afeta seu sistema real)
        $this->pdo = new PDO('sqlite::memory:');

        // cria tabela fake
        $this->pdo->exec("
            CREATE TABLE usuario (
                id_user INTEGER PRIMARY KEY AUTOINCREMENT,
                nome_user TEXT,
                email_user TEXT,
                senha_user TEXT,
                id_papel INTEGER
            )
        ");
    }

    public function testDeveCriarUsuarioComSucesso()
    {
        $service = new UsuarioService($this->pdo);

        $dados = [
            'nome' => 'Teste',
            'email' => 'teste@email.com',
            'senha' => '123456'
        ];

        $id = $service->criarUsuario($dados, 1);

        $this->assertNotNull($id);

        // verifica se salvou mesmo
        $stmt = $this->pdo->query("SELECT * FROM usuario");
        $usuarios = $stmt->fetchAll();

        $this->assertCount(1, $usuarios);
        $this->assertEquals('Teste', $usuarios[0]['nome_user']);
    }

    /*
    public function testDadosEmBranco(){

        $service = new UsuarioService($this->pdo); 
        
        $dados =  [
            'nome' => '',
            'email' => '',
            'senha' => '' 
        ];

        $id  = $service->criarUsuario($dados, 1);
        
        

    }*/

}