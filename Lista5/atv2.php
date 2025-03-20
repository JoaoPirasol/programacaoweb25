<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Alunos</title>
</head>
<body>
    <h1>Adicionar Alunos e Notas</h1>
    <form action="resp2.php" method="POST">
        <label for="nome">Nome do Aluno:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="nota1">Nota 1:</label>
        <input type="number" step="0.01" id="nota1" name="nota1" required><br><br>

        <label for="nota2">Nota 2:</label>
        <input type="number" step="0.01" id="nota2" name="nota2" required><br><br>

        <label for="nota3">Nota 3:</label>
        <input type="number" step="0.01" id="nota3" name="nota3" required><br><br>

        <input type="submit" value="Adicionar Aluno">
    </form>
</body>
</html>