<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>
</head>
<body>

    <h1>Área do Aluno!</h1>

    <table border="1">
        <tr>
            <th>Paciente</th>
            <th>Especialidade</th>
            <th>Horário desejado</th>
            <th>Observação</th>
            <th>Status</th>
        </tr>

        <?php foreach ($solicitacoes as $key): ?>
        <tr>
            <td><?=  $key['user_nome'] ?></td>
            <td><?=  $key['especialidade'] ?></td>
            <td><?=  $key['horario_desejado'] ?></td>
            <td><?=  $key['observacao_inicial'] ?></td>
            <td><?=  $key['solicitacoes_status'] ?></td>
            <td>
                <form action="/Psychology-clinic-project/public/aluno/assumir" method="post">
                    <input type="hidden" name="id_solicitacao" value="<?= $key['id_solicitacao'] ?>">
                    <button type="submit">Assumir caso</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
    
</body>
</html>
