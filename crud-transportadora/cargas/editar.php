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
    $sql = "UPDATE cargas SET Descricao = ?, Peso = ?, Volume = ?, Destino = ?, Status = ? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $_POST['descricao'], $_POST['peso'], $_POST['volume'], $_POST['destino'], $_POST['status'], $id);
    $stmt->execute();
    header('Location: listar.php');
    exit;
}
$result = $conn->query("SELECT * FROM cargas WHERE id=$id")->fetch_assoc();
?>
<form method="post">
Descricao: <input type="text" name="descricao" value="<?php echo isset($result["Descricao"])?$result["Descricao"]:""; ?>"><br>
Peso: <input type="text" name="peso" value="<?php echo isset($result["Peso"])?$result["Peso"]:""; ?>"><br>
Volume: <input type="text" name="volume" value="<?php echo isset($result["Volume"])?$result["Volume"]:""; ?>"><br>
Destino: <input type="text" name="destino" value="<?php echo isset($result["Destino"])?$result["Destino"]:""; ?>"><br>
Status: <input type="text" name="status" value="<?php echo isset($result["Status"])?$result["Status"]:""; ?>"><br>
<input type="submit" value="Salvar">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
