CREATE DATABASE clinica;
USE clinica;

DROP TABLE IF EXISTS usuario; 

CREATE TABLE usuario (
  id_user INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_user VARCHAR(200) NOT NULL,
  email_user VARCHAR(100) NOT NULL UNIQUE KEY,
  senha_user VARCHAR(255) NOT NULL,
  ativo BOOLEAN NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

DROP TABLE IF EXISTS papeis;

CREATE TABLE papeis (
  id_papel INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_papel ENUM('PACIENTE','ALUNO','PROFESSOR','GESTAO') NOT NULL UNIQUE KEY
);

DROP TABLE IF EXISTS usuario_papel;

CREATE TABLE usuario_papel (
  id_usuario INT NOT NULL,
  id_papel INT NOT NULL,
  PRIMARY KEY (id_usuario, id_papel),
  CONSTRAINT fk_up_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_user),
  CONSTRAINT fk_up_papel FOREIGN KEY (id_papel) REFERENCES papeis(id_papel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS paciente;

CREATE TABLE paciente (
  id_paciente INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  data_nascimento DATE NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  observacoes_iniciais VARCHAR(200) NULL,
  ativo BOOLEAN NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_paciente),
  UNIQUE KEY uk_paciente_usuario (id_usuario),
  CONSTRAINT fk_paciente_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS aluno;

CREATE TABLE aluno (
  id_aluno INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  matricula INT NOT NULL,
  semestre INT NOT NULL,
  ativo BOOLEAN NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_aluno),
  UNIQUE KEY uk_aluno_usuario (id_usuario),
  CONSTRAINT fk_aluno_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS professor;

CREATE TABLE professor (
  id_professor INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  registro_profissional VARCHAR(200) NOT NULL,
  ativo BOOLEAN NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_professor),
  UNIQUE KEY uk_professor_usuario (id_usuario),
  CONSTRAINT fk_professor_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS solicitacoes_atendimento;

CREATE TABLE solicitacoes_atendimento (
  id_solicitacao INT NOT NULL AUTO_INCREMENT,
  id_paciente INT NOT NULL,
  especialidade VARCHAR(100) NOT NULL,
  observacao_inicial TEXT NULL,
  solicitacoes_status ENUM('AGUARDANDO_TRIAGEM','EM_TRIAGEM','APROVADA','RECUSADA') NOT NULL DEFAULT 'AGUARDANDO_TRIAGEM',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_solicitacao),
  CONSTRAINT fk_solicitacao_paciente FOREIGN KEY (id_paciente) REFERENCES paciente(id_paciente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS acompanhamentos;

CREATE TABLE acompanhamentos (
  id_acompanhamento INT NOT NULL AUTO_INCREMENT,
  id_solicitacao INT NOT NULL,
  id_paciente INT NOT NULL,
  id_aluno INT NOT NULL,
  id_professor INT NULL,
  data_inicio DATE NOT NULL,
  status ENUM('ATIVO','ENCERRADO','INTERROMPIDO') NOT NULL DEFAULT 'ATIVO',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_acompanhamento),
  CONSTRAINT fk_acomp_solicitacao FOREIGN KEY (id_solicitacao) REFERENCES solicitacoes_atendimento(id_solicitacao),
  CONSTRAINT fk_acomp_paciente FOREIGN KEY (id_paciente) REFERENCES paciente(id_paciente),
  CONSTRAINT fk_acomp_aluno FOREIGN KEY (id_aluno) REFERENCES aluno(id_aluno),
  CONSTRAINT fk_acomp_professor FOREIGN KEY (id_professor) REFERENCES professor(id_professor)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS sessoes;

CREATE TABLE sessoes (
  id_sessao INT NOT NULL AUTO_INCREMENT,
  id_acompanhamento INT NOT NULL,
  data_sessao DATE NOT NULL,
  horario TIME NOT NULL,
  observacoes TEXT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_sessao),
  CONSTRAINT fk_sessao_acomp FOREIGN KEY (id_acompanhamento) REFERENCES acompanhamentos(id_acompanhamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

