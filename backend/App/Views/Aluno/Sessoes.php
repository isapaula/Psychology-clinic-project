<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas sessões</title>
</head>
<body>
    <h3>Bem vindo! Minhas sessões</h3>

    <table border="1">
        <tr>
            <th>Nome Paciente</th>
            <th>Status da solicitação</th>
            <th>Data da sessão</th>
            <th>Horário da sessão</th>
            <th>Termino da sessão</th>
            <th>Status da Sessão</th>
        </tr>
        <?php foreach ($result as $key): ?>
        <tr>
              <td><?= $key['nome_paciente']  ?></td>
              <td><?= $key['solicitacoes_status']  ?></td>
              <td><?= $key['data_sessao']  ?></td>
              <td><?= $key['hora_inicio']  ?></td>
              <td><?= $key['hora_fim']  ?></td>
              <td><?= $key['status_sessao'] ?></td>
              <td>
                <form action="/Psychology-clinic-project/public/sessao/updateStatus" method="post">
                    <input type="hidden" id="id_sessao" name="id_sessao" value="<?= $key['id_sessao'] ?>">
                    <button type="submit" name="status" id="status" value="Realizada">Realizada</button>
                    <button type="submit" name="status" id="status" value="Cancelada">Cancelada</button>
                </form>
              </td>  
        </tr>
        <?php endforeach; ?>

    </table>
    
</body>
</html>