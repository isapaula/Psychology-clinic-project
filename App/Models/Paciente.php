<?php 

namespace Models;
use Enums\Especialidade;

class Paciente  {

    
    private Usuario $idUser;
    private Especialidade $especialidade; 
    private $dataNascimento; 


    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

   
    public function getIdUser()
    {
        return $this->idUser;
    }

    
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    
    public function getespecialidade()
    {
        return $this->especialidade;
    }

    
    public function setespecialidade($especialidade)
    {
        $this->especialidade = $especialidade;

        return $this;
    }
}