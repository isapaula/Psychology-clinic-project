<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação Atendimento</title>
</head>
<body>
    <form action="/Psychology-clinic-project/public/solicitacao/store" method="post">
        <input type="text" name="especialidade" id="especialidade" placeholder="Informe a especialidade">
        <br><br>
        <label for="">Informe o horário desejado:</label>
        <br>
        <select name="selectHora" id="selectHora" >
            <option value="Selecione" selected>Selecione</option>
            <option value="09:00">09:00</option>
            <option value="10:00">10:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
        </select>
        <br><br>
        <label for="">Informe a queixa principal</label>
        <br>
        <textarea name="observacao" id="observacao"></textarea>
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>