<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Paciente</title>
</head>
<body>
    <h1>Bem vindo, Paciente!</h1>
    <h1><?php  echo  $_SESSION['user_nome']; ?></h1>
    <h3>Sua solicitação está:</h3>
    <h3><?php echo $_SESSION['status_solicitacao']; ?></h3>
</body>
</html>