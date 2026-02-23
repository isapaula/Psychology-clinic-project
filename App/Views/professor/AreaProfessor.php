<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Professor</title>
</head>
<body>

    <h3>Bem vindo, Professor! </h3>

    <h4>Segue as solicitações recentes para a sua análise!</h4>

    <table border="1">
        <tr>
            <th>Nome do paciente</th>
            <th>Especialidade</th>
            <th>Horário desejado</th>
            <th>Observação</th>
            <th>Status da solicitação</th>
        </tr>
        <?php foreach ($array as $value): ?>
        <tr>
            <td><?= $value['nome_user'] ?></td>
            <td><?= $value['especialidade'] ?></td>
            <td><?= $value['horario_desejado'] ?></td>
            <td><?= $value['observacao_inicial'] ?></td>
            <td><?= $value['solicitacoes_status'] ?></td>
            <td>
                <form action="/Psychology-clinic-project/public/professor/aprovada" method="post">
                    <input type="hidden" name="id_solicitacao" value="<?= $key['id_solicitacao'] ?>">
                    <button type="submit">Aceitar</button>
                </form>
            </td>
            <td>
                <form action="/Psychology-clinic-project/public/professor/recusada" method="post">
                    <input type="hidden" name="id_solicitacao" value="<?= $key['id_solicitacao'] ?>">
                    <button type="submit">Recusar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
    
</body>
</html>