<?php 

namespace Models;
use Models\Paciente;
use Enums\StatusSolicitacao;

class SolicitacaoAtendimento {


    private int $idSolicitacao; 
    private Paciente $paciente;
    private StatusSolicitacao  $status;
    private $dataCriacao;
    private $especialidade; 
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