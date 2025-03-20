<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Livros</title>
</head>
<body>
    <h1>Adicionar Livros</h1>
    <form action="tresp5.php" method="POST">
        <label for="titulo">Título do Livro:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="quantidade">Quantidade em Estoque:</label>
        <input type="number" id="quantidade" name="quantidade" required><br><br>

        <input type="submit" value="Adicionar Livro">
    </form>
</body>
</html>
