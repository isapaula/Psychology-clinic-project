<?php

namespace App\Models;

use App\Enums\TipoUsuario;

class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private TipoUsuario $tipo;
}
