<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário do Professor</title>
</head>
<body>
    <h2>Cadastro do Professor</h2>
    <form action="/Psychology-clinic-project/public/usuario/store" method="post">
         <input type="text" name="nome" id="nome" placeholder="Digite o nome">
        <br><br>
        <input type="email" name="email" id="email" placeholder="Digite o e-mail">
        <br><br>
        <label for="">Digite uma senha:</label><br>
        <input type="password" name="senha" id="senha">
        <br><br>
        <label for="">Digite seu registro profissional:</label><br>
        <input type="number" name="rp" id="rp" maxlength="5">
        <br><br>
        <button type="submit">Enviar</button>

    </form>
    
</body>
</html>