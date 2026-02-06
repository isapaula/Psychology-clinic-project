<?php 

namespace Enums;

enum TipoUsuario: int {
  
    case PACIENTE = 1;
    case ALUNO = 2;
    case PROFESSOR = 3;
    case GESTAO = 4;
    
}