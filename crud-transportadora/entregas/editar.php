<?php
$mensagem_erro = "";
$entrega = null;
$clientes = [];
$motoristas = [];
$cargas = [];

if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: listar.php");
    exit;
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['cliente_id']) || empty($_POST['motorista_id']) || empty($_POST['carga_id']) || empty($_POST['data'])) {
        $mensagem_erro = "Todos os campos, exceto o status, são obrigatórios.";
    } else {
        $sql = "UPDATE entregas SET Cliente_ID = ?, Motorista_ID = ?, Carga_ID = ?, Data = ?, Status = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql);
        
        if ($stmt_update) {
            $stmt_update->bind_param(
                "iiissi",
                $_POST['cliente_id'],
                $_POST['motorista_id'],
                $_POST['carga_id'],
                $_POST['data'],
                $_POST['status'],
                $id
            );
            
            if ($stmt_update->execute()) {
                header('Location: listar.php?status=editado');
                exit;
            } else {
                $mensagem_erro = "Erro ao atualizar a entrega: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            $mensagem_erro = "Erro ao preparar a consulta de atualização: " . $conn->error;
        }
    }
}

$stmt_select = $conn->prepare("SELECT * FROM entregas WHERE id = ?");
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$entrega = $result->fetch_assoc();
$stmt_select->close();

if (!$entrega) {
    header("Location: listar.php?status=nao_encontrado");
    exit;
}

$clientes_result = $conn->query("SELECT id, nome FROM clientes ORDER BY nome ASC");
if ($clientes_result) {
    $clientes = $clientes_result->fetch_all(MYSQLI_ASSOC);
}

$motoristas_result = $conn->query("SELECT id, Nome FROM motoristas ORDER BY Nome ASC");
if ($motoristas_result) {
    $motoristas = $motoristas_result->fetch_all(MYSQLI_ASSOC);
}

$carga_atual_id = $entrega['Carga_ID'];
$cargas_result = $conn->query("SELECT id, descricao FROM cargas WHERE status = 'Disponível' OR id = $carga_atual_id ORDER BY id ASC");
if ($cargas_result) {
    $cargas = $cargas_result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrega - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Entrega #<?php echo htmlspecialchars($entrega['id']); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="editar.php?id=<?php echo $entrega['id']; ?>">
                            <div class="mb-3">
                                <label for="cliente_id" class="form-label">Cliente</label>
                                <select class="form-select" id="cliente_id" name="cliente_id" required>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente['id']; ?>" <?php if($cliente['id'] == $entrega['Cliente_ID']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($cliente['nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="motorista_id" class="form-label">Motorista Responsável</label>
                                <select class="form-select" id="motorista_id" name="motorista_id" required>
                                    <?php foreach ($motoristas as $motorista): ?>
                                        <option value="<?php echo $motorista['id']; ?>" <?php if($motorista['id'] == $entrega['Motorista_ID']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($motorista['Nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="carga_id" class="form-label">Carga</label>
                                <select class="form-select" id="carga_id" name="carga_id" required>
                                    <?php foreach ($cargas as $carga): ?>
                                        <option value="<?php echo $carga['id']; ?>" <?php if($carga['id'] == $entrega['Carga_ID']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($carga['descricao']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="data" class="form-label">Data da Entrega</label>
                                    <input type="date" class="form-control" id="data" name="data" value="<?php echo htmlspecialchars($entrega['Data']); ?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="Pendente" <?php if($entrega['Status'] == 'Pendente') echo 'selected'; ?>>Pendente</option>
                                        <option value="Em Trânsito" <?php if($entrega['Status'] == 'Em Trânsito') echo 'selected'; ?>>Em Trânsito</option>
                                        <option value="Entregue" <?php if($entrega['Status'] == 'Entregue') echo 'selected'; ?>>Entregue</option>
                                        <option value="Cancelada" <?php if($entrega['Status'] == 'Cancelada') echo 'selected'; ?>>Cancelada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Salvar Alterações</button>
                                <a href="listar.php" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>