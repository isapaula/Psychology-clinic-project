<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/materialize.css">
    <style>
        .formulario {
      min-height: 560px;
      padding: 30px;
      max-width: 500px;
  }
    </style>
    <title>Login</title>
</head>
<body>

    <div class="col s12 m6 l4">
        <div class="formulario white black-text">
            <section>
                <h3>Tela de Login</h3>
                    <form action="/Psychology-clinic-project/public/usuario/store" method="post">

                        <input type="text" name="user" id="user" placeholder="Digite seu e-mail" required>
                        <br><br>
                        <input type="password" name="pass" id="pass" placeholder="*********" required>
                        <br><br>
                        <button class="btn waves-effect waves-light" type="submit">Logar</button>
                    </form>
                    <h3>Não tem cadastro?</h3> 
                    <a class="waves-effect waves-light btn" href="Cadastro.php">Click aqui</a>
            </section>
        </div>
    </div>
</body>
</html>