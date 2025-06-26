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
$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE clientes SET Nome = ?, Documento = ?, Telefone = ?, Endereco = ? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $_POST['nome'], $_POST['documento'], $_POST['telefone'], $_POST['endereco'], $id);
    $stmt->execute();
    header('Location: listar.php');
    exit;
}
$result = $conn->query("SELECT * FROM clientes WHERE id=$id")->fetch_assoc();
?>
<form method="post">
Nome: <input type="text" name="nome" value="<?php echo isset($result["Nome"])?$result["Nome"]:""; ?>"><br>
Documento: <input type="text" name="documento" value="<?php echo isset($result["Documento"])?$result["Documento"]:""; ?>"><br>
Telefone: <input type="text" name="telefone" value="<?php echo isset($result["Telefone"])?$result["Telefone"]:""; ?>"><br>
Endereco: <input type="text" name="endereco" value="<?php echo isset($result["Endereco"])?$result["Endereco"]:""; ?>"><br>
<input type="submit" value="Salvar">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
