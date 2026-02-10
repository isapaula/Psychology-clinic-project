<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Paciente</title>
</head>
<body>
    <form action="/Psychology-clinic-project/public/paciente/store" method="post">
        <input type="text" name="nome" id="nome" placeholder="Digite o nome">
        <br><br>
        <input type="email" name="email" id="email" placeholder="Digite o e-mail">
        <br><br>
        <input type="password" name="senha" id="senha">
        <br><br>
        <input type="date" name="data_nasc" id="data_nasc" placeholder="Data Nascimento">
        <br><br>
        <input type="text" name="telefone" id="telefone" maxlength="11" placeholder="(00) 00000-0000">
        <br><br>
        <button type="submit">Enviar</button>
        
    </form>
    
</body>
</html>