<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Aluno</title>
</head>
<body>

    <h2>Cadastro do Aluno</h2>
    <form action="/Psychology-clinic-project/public/aluno/store" method="post">
        <input type="text" name="nome" id="nome" placeholder="Digite o nome">
        <br><br>
        <input type="email" name="email" id="email" placeholder="Digite o e-mail">
        <br><br>
        <input type="password" name="senha" id="senha">
        <br><br>
        <input type="number" name="matricula" id="matricula" placeholder="digite sua matricula">
        <br><br>
        <input type="number" name="semestre" id="semestre" maxlength="1" placeholder="Qual semestre?">
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>