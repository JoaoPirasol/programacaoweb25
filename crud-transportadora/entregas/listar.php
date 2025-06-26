<?php
if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

$status_mensagem = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso') {
        $status_mensagem = "Entrega registrada com sucesso!";
    } elseif ($_GET['status'] == 'editado') {
        $status_mensagem = "Entrega atualizada com sucesso!";
    } elseif ($_GET['status'] == 'excluido') {
        $status_mensagem = "Entrega excluída com sucesso!";
    }
}

$sql = "
    SELECT 
        e.id,
        c.Nome AS nome_cliente,
        m.Nome AS nome_motorista,
        cr.Descricao AS descricao_carga,
        e.Data,
        e.Status
    FROM entregas AS e
    JOIN clientes AS c ON e.Cliente_ID = c.id
    JOIN motoristas AS m ON e.Motorista_ID = m.id
    JOIN cargas AS cr ON e.Carga_ID = cr.id
    ORDER BY e.id DESC
";
$result = $conn->query($sql);
$entregas = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Entregas - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-truck"></i> Lista de Entregas</h1>
            <a href="cadastrar.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nova Entrega</a>
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
                        <th>Cliente</th>
                        <th>Motorista</th>
                        <th>Carga</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($entregas)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhuma entrega registrada.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($entregas as $entrega): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($entrega['id']); ?></td>
                                <td><?php echo htmlspecialchars($entrega['nome_cliente']); ?></td>
                                <td><?php echo htmlspecialchars($entrega['nome_motorista']); ?></td>
                                <td><?php echo htmlspecialchars($entrega['descricao_carga']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($entrega['Data'])); ?></td>
                                <td>
                                    <span class="badge 
                                        <?php 
                                            switch ($entrega['Status']) {
                                                case 'Pendente': echo 'bg-warning text-dark'; break;
                                                case 'Em Trânsito': echo 'bg-info text-dark'; break;
                                                case 'Entregue': echo 'bg-success'; break;
                                                case 'Cancelada': echo 'bg-danger'; break;
                                                default: echo 'bg-secondary';
                                            }
                                        ?>">
                                        <?php echo htmlspecialchars($entrega['Status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="editar.php?id=<?php echo $entrega['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <a href="excluir.php?id=<?php echo $entrega['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta entrega?');"><i class="bi bi-trash-fill"></i></a>
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