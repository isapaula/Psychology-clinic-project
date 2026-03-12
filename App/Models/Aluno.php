<?php

namespace Models;

class Aluno
{
    private Usuario $idUser;
    private $especialidades;
    private $limiteAtendimentos;
    private $ativo;

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function getLimiteAtendimentos()
    {
        return $this->limiteAtendimentos;
    }

    public function setLimiteAtendimentos($limiteAtendimentos)
    {
        $this->limiteAtendimentos = $limiteAtendimentos;

        return $this;
    }

    public function getEspecialidades()
    {
        return $this->especialidades;
    }


    public function setEspecialidades($especialidades)
    {
        $this->especialidades = $especialidades;

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
}
