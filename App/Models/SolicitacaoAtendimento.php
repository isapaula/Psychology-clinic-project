<?php 

use Models\Paciente;
use Enums\StatusSolicitacao;




class SolicitacaoAtendimento {


    private int $idSolicitacao; 
    private Paciente $paciente;
    private StatusSolicitacao  $status;
    private $dataCriacao;
    private $queixaPrincipal; 
    private array $disponibilidade;
    private $observacaoInicial;

    
    public function getStatus()
    {
        return $this->status;
    }

    // métodos setters devem ser feitos com métodos de intenção
    // como por exemplo, marcarComoEmAnalise() e marcarComoNaoElegivel()

    public function getPaciente()
    {
        return $this->paciente;
    }


    public function getIdSolicitacao()
    {
        return $this->idSolicitacao;
    }


    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }


    public function getDisponibilidade()
    {
        return $this->disponibilidade;
    }


    public function setDisponibilidade($disponibilidade)
    {
        $this->disponibilidade = $disponibilidade;

        return $this;
    }


    public function getObservacaoInicial()
    {
        return $this->observacaoInicial;
    }


    public function setObservacaoInicial($observacaoInicial)
    {
        $this->observacaoInicial = $observacaoInicial;

        return $this;
    }
}