<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h1>Tela de Login</h1>

<form action="/Psychology-clinic-project/public/usuario/store" method="post">

    <input type="text" name="user" id="user" placeholder="Digite seu e-mail" required>
    <br><br>
    <input type="password" name="pass" id="pass" placeholder="*********" required>
    <br><br>
    <button type="submit">Logar</button>
</form>
</body>
</html>