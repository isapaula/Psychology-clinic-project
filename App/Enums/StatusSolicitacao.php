<?php

namespace Enums;

enum StatusSolicitacao: string
{
    case AGUARDANDO_TRIAGEM = 'Aguardando triagem';
    case ASSUMIDA = 'ASSUMIDA';
    case APROVADA = 'APROVADA';
    case RECUSADA = 'RECUSADA';
    case EM_ATENDIMENTO = 'Em atendimento';
    case FINALIZADA = 'Finalizada';
    case CANCELADA = 'CANCELADA (se você mantiver)';

}
