<?php
if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

$status_mensagem = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso') {
        $status_mensagem = "Cliente cadastrado com sucesso!";
    } elseif ($_GET['status'] == 'editado') {
        $status_mensagem = "Cliente atualizado com sucesso!";
    } elseif ($_GET['status'] == 'excluido') {
        $status_mensagem = "Cliente excluído com sucesso!";
    }
}

$result = $conn->query("SELECT * FROM clientes ORDER BY Nome ASC");
$clientes = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-person-vcard-fill"></i> Lista de Clientes</h1>
            <a href="cadastrar.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Cliente</a>
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
                        <th>Documento</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clientes)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum cliente cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cliente['id']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['Nome']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['Documento']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['Telefone']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['Endereco']); ?></td>
                                <td>
                                    <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <a href="excluir.php?id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?');"><i class="bi bi-trash-fill"></i></a>
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