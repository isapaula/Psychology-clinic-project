<?php 

namespace Models; 

class Aluno  {

    private Usuario $idUser;
    private $especialidades; 
    private $limiteAtendimentos;
    private $ativo;

    /**
     * Get the value of ativo
     *
     * @return  mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set the value of ativo
     *
     * @param   mixed  $ativo  
     *
     * @return  self
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get the value of limiteAtendimentos
     *
     * @return  mixed
     */
    public function getLimiteAtendimentos()
    {
        return $this->limiteAtendimentos;
    }

    /**
     * Set the value of limiteAtendimentos
     *
     * @param   mixed  $limiteAtendimentos  
     *
     * @return  self
     */
    public function setLimiteAtendimentos($limiteAtendimentos)
    {
        $this->limiteAtendimentos = $limiteAtendimentos;

        return $this;
    }

    /**
     * Get the value of especialidades
     *
     * @return  mixed
     */
    public function getEspecialidades()
    {
        return $this->especialidades;
    }

    /**
     * Set the value of especialidades
     *
     * @param   mixed  $especialidades  
     *
     * @return  self
     */
    public function setEspecialidades($especialidades)
    {
        $this->especialidades = $especialidades;

        return $this;
    }

    /**
     * Get the value of idUser
     *
     * @return  mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @param   mixed  $idUser  
     *
     * @return  self
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}

