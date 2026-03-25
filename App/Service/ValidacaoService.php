<?php

namespace App\Service; 

class ValidacaoService {

    public function validacaoDados($dados){

        if (empty($dados['email'])) {

            throw new \Exception("Email não informado! ");
            
        } /*else {
            filter_var($dados['email'], FILTER_SANITIZE_EMAIL);
        }*/

        if (empty($dados['nome'])) {

            throw new \Exception("Nome não informado! ");
            
        }

        if (empty($dados['senha'])) {
            
            throw new \Exception("Senha não informada! ");
            
        }

        return $dados;

    }
}