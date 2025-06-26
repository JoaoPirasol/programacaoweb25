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
    $sql = "UPDATE entregas SET Cliente_ID = ?, Motorista_ID = ?, Carga_ID = ?, Data = ?, Status = ? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $_POST['cliente_id'], $_POST['motorista_id'], $_POST['carga_id'], $_POST['data'], $_POST['status'], $id);
    $stmt->execute();
    header('Location: listar.php');
    exit;
}
$result = $conn->query("SELECT * FROM entregas WHERE id=$id")->fetch_assoc();
?>
<form method="post">
Cliente_ID: <input type="text" name="cliente_id" value="<?php echo isset($result["Cliente_ID"])?$result["Cliente_ID"]:""; ?>"><br>
Motorista_ID: <input type="text" name="motorista_id" value="<?php echo isset($result["Motorista_ID"])?$result["Motorista_ID"]:""; ?>"><br>
Carga_ID: <input type="text" name="carga_id" value="<?php echo isset($result["Carga_ID"])?$result["Carga_ID"]:""; ?>"><br>
Data: <input type="text" name="data" value="<?php echo isset($result["Data"])?$result["Data"]:""; ?>"><br>
Status: <input type="text" name="status" value="<?php echo isset($result["Status"])?$result["Status"]:""; ?>"><br>
<input type="submit" value="Salvar">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
