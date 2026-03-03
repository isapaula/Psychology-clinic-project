<p align="center"><img width="64" height="64" alt="icons864" src="https://github.com/user-attachments/assets/b57d0693-5a56-4531-a807-90565f8a2bb0" /></p>
<h2 align="center">Sistema para universidades com curso de psicologia</h2>
<p align="center">Versão atual: 1.0</p>
<br>

# Por quê?
O objetivo desse sistema é proporcionar à comunidade a oportunidade de se consultar gratuitamente com estudantes do curso de psicologia.  A comunidade realiza o cadastro e solicita um atendimento informando o horário desejado, queixa (ansiedade, depressão, autoconhecimento etc.) e observação. Após, um professor da universidade analisará a solicitação e, se aprovada, os alunos mais adequados poderão assumir o caso e marcar a consulta com esse paciente. Dessa forma, pessoas de baixa renda poderão se consultar gratuitamente e ter um acompanhamento.
<br>

# O que é? 
Sistema de gerenciamento de atendimentos com controle de acesso por perfil (Aluno, Professor, Paciente).
<br>

# Problema
Instituições que realizam atendimentos educacionais ou clínicos precisam organizar solicitações, controle de sessões e permissões por perfil de usuário.
<br>

# Solução
O sistema permite:
- Autenticação com controle de acesso por papel
- Cadastro de usuários
- Criação de solicitações de atendimento
- Marcação de sessões como realizadas ou canceladas
- Proteção de rotas baseada em perfil
<br>

# Arquitetura

Arquitetura MVC simplificada

A V1 foi construída com foco em:

- Separação por Controllers
- Controle de acesso centralizado (BaseController)
- Front Controller para roteamento
- Fluxo funcional completo
- Estrutura preparada para evolução para camada de Service e Repository na V2

# Tecnologias

* PHP
* Composer
* MySQL
* HTML 5
* CSS 3
* Materialize CSS
* JavaScript

# 🔄 Roadmap (Próximos Passos)

Versão 2:
- Implementação de camada Service
- Padrão Repository
- Testes automatizados
- Refatoração para melhoria de coesão

  











