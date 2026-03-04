<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>
</head>
<body>

    <h1>Área do Aluno!</h1>
    <h1><?php  echo  $_SESSION['user_nome']; ?></h1>

    <h3>Confira os casos disponíveis: </h3>

    <table border="1">
        <tr>
            <th>Paciente</th>
            <th>Especialidade</th>
            <th>Horário desejado</th>
            <th>Observação</th>
            <th>Status</th>
        </tr>

        <?php foreach ($casosDisponiveis as $key): ?>
        <tr>
            <td><?=  $key['nome_user']  ?></td>
            <td><?=  $key['especialidade'] ?></td>
            <td><?=  $key['horario_desejado'] ?></td>
            <td><?=  $key['observacao_inicial'] ?></td>
            <td><?=  $key['solicitacoes_status'] ?></td>
            <td>
                <form action="/Psychology-clinic-project/public/aluno/assumir" method="post">
                    <input type="hidden" name="id_solicitacao" id="id_solicitacao" value="<?= $key['id_solicitacao'] ?>">
                    <input type="hidden" name="id_solicitacao" id="id_solicitacao" value="<?= $_SESSION['id_solicitacao'] = $key['id_solicitacao'] ?>" >
                    <input type="hidden" name="nome_paciente" id="nome_paciente" value="<?= $_SESSION['nome_paciente'] = $value['nome_user'] ?>">
                    <button type="submit">Assumir caso</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <h3>Confira os casos que você assumiu e pode marcar uma sessão!</h3>

    <table border="1">
        <tr>
            <th>Paciente</th>
            <th>Especialidade</th>
            <th>Horário desejado</th>
            <th>Observação</th>
            <th>Status</th>
        </tr>

        <?php foreach ($casosAssumidos as $value): ?>
        <tr>
            <td><?=  $value['nome_user'] ?></td>
            <td><?=  $value['especialidade'] ?></td>
            <td><?=  $value['horario_desejado'] ?></td>
            <td><?=  $value['observacao_inicial'] ?></td>
            <td><?=  $value['solicitacoes_status'] ?></td>
            <td>
                <form action="/Psychology-clinic-project/public/sessao/create" method="post">
                    <input type="hidden" name="id_solicitacao" id="id_solicitacao" value="<?= $value['id_solicitacao'] ?>" >
                    <input type="hidden" name="id_solicitacao" id="id_solicitacao" value="<?= $_SESSION['id_solicitacao'] = $value['id_solicitacao'] ?>" >
                    <input type="hidden" name="nome_paciente" id="nome_paciente" value="<?= $_SESSION['nome_paciente'] = $value['nome_user'] ?>">
                    <button type="submit">Marcar sessão</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    
</body>
</html>
