<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Sessão</title>
</head>
<body>

<form action="/Psychology-clinic-project/public/sessao/store" method="post">
    <input type="hidden" name="id_solicitacao" value="<?= $_SESSION['id_solicitacao'] ?>">
    <input type="hidden" name="aluno_id" value="<?= $_SESSION['aluno_id'] ?>">
    <br>
    <label for="">Data da sessão:</label>
    <br>
    <input type="date" name="data_sessao" id="data_sessao">
    <br><br>
    <label for="">Horário da sessão:</label>
    <br>
    <select name="hora_inicio" id="hora_inicio" required>
        <option value="" disabled selected>Selecione...</option>
        <option value="10:00">10:00</option>
        <option value="11:00">11:00</option>
        <option value="20:00">20:00</option>
        <option value="20:30">20:30</option>
    </select>
    <br><br>
    <label for="">Termino da sessão:</label>
    <br>
    <select name="hora_final" id="hora_final" required>
        <option value="" disabled selected>Selecione...</option>
        <option value="10:00">10:00</option>
        <option value="11:00">11:00</option>
        <option value="20:00">20:00</option>
        <option value="20:30">20:30</option>
    </select>
    <br><br>
    <button type="submit">Salvar sessão</button>
</form>
    
</body>
</html>