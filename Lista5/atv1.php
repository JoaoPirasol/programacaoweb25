<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contatos</title>
</head>
<body>
    <h1>Adicionar Contatos</h1>
    <form action="resp1.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="telefone">Número de telefone:</label>
        <input type="tel" id="telefone" name="telefone" required><br><br>
        <input type="submit" value="Adicionar Contato">
    </form>
</body>
</html>
