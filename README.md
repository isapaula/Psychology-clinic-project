<p align="center"><img width="64" height="64" alt="icons864" src="https://github.com/user-attachments/assets/b57d0693-5a56-4531-a807-90565f8a2bb0" /></p>
<p align="center" bold>Sistema para universidades com curso de psicologia</p>


# 
O objetivo desse sistema é proporcionar à comunidade a oportunidade de se consultar gratuitamente com estudantes do curso de psicologia.  A comunidade realiza o cadastro e solicita um atendimento informando o horário desejado, queixa (ansiedade, depressão, autoconhecimento e outros) e observação. Após, um professor da universidade analisará a solicitação e, se aprovada, os alunos mais adequados poderão assumir o caso e marcar a consulta com esse paciente.  Dessa forma, pessoas de baixa renda poderão se consultar gratuitamente e ter um acompanhamento.

#
##### ***Tecnologias:***

* PHP
* Composer
* MySQL

# 
##### ***Papeis do sistema:***
* Paciente
* Professor
* Aluno

# 
##### ***Estrutura de pastas:***
```
/App
 ├── Controller/
   ├── AlunoController                  # Define ações do aluno, valida papel e redireciona para as telas
   ├── AuthController                   # Responsável por logar os usuários 
   ├── BaseController                   # Responsável por redirecionar se o papel não estiver correto
   ├── PacienteController               # Define ações do paciente, valida papel e redireciona para as telas
   ├── HomeController                   # Redireciona para a Home
   ├── ProfessorController              # Define ações do professor, valida papel e redireciona
   ├── SessaoController                 # Permite adicionar, cancelar, ou realizar uma sessão
   ├── SolicitacaoController            # Responsavel por permitir o cadastro de uma solicitação, listar e redirecionar
   └── UsuarioController                # Responsavel por fazer o login do usuário no sistema 
 ├── Database/
   └── Conexao                          # Conexao com  banco de dados
 ├── Enums/
   ├── TipoUsuario                      
   ├── ModalidadeAtendimento            
   ├── StatusSolicitacao
   └── Especialidade
 ├── Models/
   ├── Usuario
   ├── Aluno
   ├── Paciente
   ├── Professor
   └── SolicitacaoAtendimento
 ├── Router/
   └── Router
 ├── Services
 ├── Views/
   └── Aluno/
       ├── AreaAluno
       ├── FormAluno
       ├── Sessao
       ├── CriarSessao
       └── ListaPacientes
   └── Paciente
       ├── AreaPaciente
       ├── PacienteForm
       └── SolicitacaoAtendimentoForm
   └── Professor
       ├── AreaProfessor
       └── FormProfessor
   └── Login
   └── Cadastro
```










