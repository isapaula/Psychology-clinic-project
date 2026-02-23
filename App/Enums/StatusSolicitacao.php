<?php

namespace Enums;

enum StatusSolicitacao: string {

    case AGUARDANDO_TRIAGEM = 'Aguardando triagem';
    case EM_TRIAGEM = 'Em triagem';
    case APROVADA = 'APROVADA';
    case RECUSADA = 'RECUSADA';
    case EM_ATENDIMENTO = 'Em atendimento';
    case FINALIZADA = 'Finalizada';
    case CANCELADA = 'CANCELADA (se você mantiver)';

}


?>