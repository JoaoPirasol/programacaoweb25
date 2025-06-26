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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO motoristas (Nome, CNH, Telefone, Disponibilidade) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $_POST['nome'], $_POST['cnh'], $_POST['telefone'], $_POST['disponibilidade']);
    $stmt->execute();
    header('Location: listar.php');
    exit;
}
?>
<form method="post">
Nome: <input type="text" name="nome" value="<?php echo isset($result["Nome"])?$result["Nome"]:""; ?>"><br>
CNH: <input type="text" name="cnh" value="<?php echo isset($result["CNH"])?$result["CNH"]:""; ?>"><br>
Telefone: <input type="text" name="telefone" value="<?php echo isset($result["Telefone"])?$result["Telefone"]:""; ?>"><br>
Disponibilidade: <input type="text" name="disponibilidade" value="<?php echo isset($result["Disponibilidade"])?$result["Disponibilidade"]:""; ?>"><br>
<input type="submit" value="Cadastrar">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
