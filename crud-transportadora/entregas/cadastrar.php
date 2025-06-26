<?php
$mensagem_erro = "";
$clientes = [];
$motoristas = [];
$cargas = []; 

if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

$clientes_result = $conn->query("SELECT id, nome FROM clientes ORDER BY nome ASC");
if ($clientes_result) {
    $clientes = $clientes_result->fetch_all(MYSQLI_ASSOC);
}

$motoristas_result = $conn->query("SELECT id, Nome FROM motoristas WHERE ativa = 1 ORDER BY Nome ASC");
if ($motoristas_result) {
    $motoristas = $motoristas_result->fetch_all(MYSQLI_ASSOC);
}

$cargas_result = $conn->query("SELECT id, descricao FROM cargas WHERE status = 'Disponível' ORDER BY id ASC");
if ($cargas_result) {
    $cargas = $cargas_result->fetch_all(MYSQLI_ASSOC);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['cliente_id']) || empty($_POST['motorista_id']) || empty($_POST['carga_id']) || empty($_POST['data'])) {
        $mensagem_erro = "Todos os campos, exceto o status, são obrigatórios.";
    } else {
        $sql = "INSERT INTO entregas (Cliente_ID, Motorista_ID, Carga_ID, Data, Status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param(
                "iiiss",
                $_POST['cliente_id'],
                $_POST['motorista_id'],
                $_POST['carga_id'],
                $_POST['data'],
                $_POST['status']
            );
            
            if ($stmt->execute()) {
                header('Location: listar.php?status=sucesso');
                exit;
            } else {
                $mensagem_erro = "Erro ao registrar a entrega: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensagem_erro = "Erro ao preparar a consulta: " . $conn->error;
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Entrega - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Registrar Nova Entrega</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="cadastrar.php">
                            <div class="mb-3">
                                <label for="cliente_id" class="form-label">Cliente</label>
                                <select class="form-select" id="cliente_id" name="cliente_id" required>
                                    <option value="" disabled selected>Selecione um cliente...</option>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?php echo htmlspecialchars($cliente['id']); ?>">
                                            <?php echo htmlspecialchars($cliente['nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="motorista_id" class="form-label">Motorista Responsável</label>
                                <select class="form-select" id="motorista_id" name="motorista_id" required>
                                    <option value="" disabled selected>Selecione um motorista...</option>
                                    <?php foreach ($motoristas as $motorista): ?>
                                        <option value="<?php echo htmlspecialchars($motorista['id']); ?>">
                                            <?php echo htmlspecialchars($motorista['Nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="carga_id" class="form-label">Carga</label>
                                <select class="form-select" id="carga_id" name="carga_id" required>
                                    <option value="" disabled selected>Selecione uma carga disponível...</option>
                                    <?php foreach ($cargas as $carga): ?>
                                        <option value="<?php echo htmlspecialchars($carga['id']); ?>">
                                            <?php echo htmlspecialchars($carga['descricao']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="data" class="form-label">Data da Entrega</label>
                                    <input type="date" class="form-control" id="data" name="data" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="status" class="form-label">Status Inicial</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="Pendente" selected>Pendente</option>
                                        <option value="Em Trânsito">Em Trânsito</option>
                                        <option value="Entregue">Entregue</option>
                                        <option value="Cancelada">Cancelada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Registrar Entrega</button>
                                <a href="listar.php" class="btn btn-secondary">Voltar