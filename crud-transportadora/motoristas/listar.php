<?php
if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

$status_mensagem = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso') {
        $status_mensagem = "Motorista cadastrado com sucesso!";
    } elseif ($_GET['status'] == 'editado') {
        $status_mensagem = "Motorista atualizado com sucesso!";
    } elseif ($_GET['status'] == 'excluido') {
        $status_mensagem = "Motorista excluído com sucesso!";
    }
}

$result = $conn->query("SELECT * FROM motoristas ORDER BY Nome ASC");
$motoristas = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Motoristas - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-people-fill"></i> Lista de Motoristas</h1>
            <a href="cadastrar.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Motorista</a>
        </div>

        <?php if ($status_mensagem): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $status_mensagem; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CNH</th>
                        <th>Telefone</th>
                        <th>Disponibilidade</th>
                        <th>Status</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($motoristas)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhum motorista cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($motoristas as $motorista): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($motorista['id']); ?></td>
                                <td><?php echo htmlspecialchars($motorista['Nome']); ?></td>
                                <td><?php echo htmlspecialchars($motorista['CNH']); ?></td>
                                <td><?php echo htmlspecialchars($motorista['Telefone']); ?></td>
                                <td><?php echo htmlspecialchars($motorista['Disponibilidade']); ?></td>
                                <td>
                                    <?php if ($motorista['ativa']): ?>
                                        <span class="badge bg-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="editar.php?id=<?php echo $motorista['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <a href="excluir.php?id=<?php echo $motorista['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este motorista?');"><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>