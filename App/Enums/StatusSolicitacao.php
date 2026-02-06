<?php

namespace Enums;

enum StatusSolicitacao: string {

    case AGUARDANDO_TRIAGEM = 'Aguardando triagem';
    case EM_TRIAGEM = 'Em triagem';
    case APROVADA = 'APROVADA';
    case RECUSADA = 'RECUSADA/ Tem irregularidade';

}