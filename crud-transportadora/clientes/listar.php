<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<?php
include('../conexao.php');
$result = $conn->query("SELECT * FROM clientes");
echo "<h1>Lista de Clientes</h1>";
echo "<a href='cadastrar.php'>Novo Cliente</a><br><br>";
while($row = $result->fetch_assoc()) {
    echo implode(' | ', $row) . " | <a href='editar.php?id=".$row['id']."'>Editar</a> | <a href='excluir.php?id=".$row['id']."'>Excluir</a><br>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
