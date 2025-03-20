<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Produtos</title>
</head>
<body>
    <h1>Adicionar Produtos</h1>
    <form action="resp3.php" method="POST">
        <label for="codigo">Código do Produto:</label>
        <input type="number" id="codigo" name="codigo" required><br><br>

        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="preco">Preço do Produto:</label>
        <input type="number" step="0.01" id="preco" name="preco" required><br><br>

        <input type="submit" value="Adicionar Produto">
    </form>
</body>
</html>
