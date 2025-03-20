<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Itens</title>
</head>
<body>
    <h1>Adicionar Itens</h1>
    <form action="resp4.php" method="POST">
        <label for="nome">Nome do Item:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="preco">Preço do Item:</label>
        <input type="number" step="0.01" id="preco" name="preco" required><br><br>

        <input type="submit" value="Adicionar Item">
    </form>
</body>
</html>
