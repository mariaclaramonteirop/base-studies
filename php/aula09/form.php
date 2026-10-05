<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compromisso</title>
</head>
<body>
    <h1>Compromisso</h1>
    <form action='' method='post'>

        <input type="hidden" name="id" value="">

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao"
        minlenght="3" maxlenght="50" id="descricao" required>
        <label for="data">Data:</label>
        <input type="datetime-local" name="data"
        id='data' required>
        <label for="hora">hora:</label>
        <input type="time" name="hora"
        id='time' required>
        <label for="status">Status:</label>
        <select name="status" id="status"></select>
            <option value="A" selected>AGENDADO</option>
            <option value="R">REALIZADO</option>
            <option value="C">CANCELADO</option>
    </form>

    <button type="submit">Salvar</button>
</body>
</html>