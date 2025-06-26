<?php
if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

$status_mensagem = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sucesso') {
        $status_mensagem = "Carga cadastrada com sucesso!";
    } elseif ($_GET['status'] == 'editado') {
        $status_mensagem = "Carga atualizada com sucesso!";
    } elseif ($_GET['status'] == 'excluido') {
        $status_mensagem = "Carga excluída com sucesso!";
    }
}

$result = $conn->query("SELECT * FROM cargas ORDER BY id DESC");
$cargas = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cargas - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-box-seam-fill"></i> Lista de Cargas</h1>
            <a href="cadastrar.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nova Carga</a>
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
                        <th>Descrição</th>
                        <th>Peso (kg)</th>
                        <th>Volume (m³)</th>
                        <th>Destino</th>
                        <th>Status</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($cargas)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhuma carga cadastrada.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($cargas as $carga): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($carga['id']); ?></td>
                                <td style="max-width: 300px;"><?php echo htmlspecialchars($carga['Descricao']); ?></td>
                                <td><?php echo htmlspecialchars($carga['Peso']); ?></td>
                                <td><?php echo htmlspecialchars($carga['Volume']); ?></td>
                                <td><?php echo htmlspecialchars($carga['Destino']); ?></td>
                                <td>
                                     <span class="badge 
                                        <?php 
                                            switch ($carga['Status']) {
                                                case 'Disponível': echo 'bg-success'; break;
                                                case 'Alocada': echo 'bg-primary'; break;
                                                case 'Em Trânsito': echo 'bg-info text-dark'; break;
                                                case 'Entregue': echo 'bg-secondary'; break;
                                                default: echo 'bg-light text-dark';
                                            }
                                        ?>">
                                        <?php echo htmlspecialchars($carga['Status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="editar.php?id=<?php echo $carga['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <a href="excluir.php?id=<?php echo $carga['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta carga?');"><i class="bi bi-trash-fill"></i></a>
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