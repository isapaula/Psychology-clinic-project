<?php

namespace Enums;

enum StatusSolicitacao: string {

    case EM_ANALISE = 'em análise';
    case AGUARDANDO_PAREAMENTO = 'Aguardando triagem';
    case NAO_ELEGIVEL = 'tem iregularidade';
    case CANCELADA =   'CANCELADO';

}