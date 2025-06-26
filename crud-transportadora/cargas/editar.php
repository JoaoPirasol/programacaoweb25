<?php
$mensagem_erro = "";
$carga = null;

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
    if (empty($_POST['descricao']) || empty($_POST['peso']) || empty($_POST['volume']) || empty($_POST['destino'])) {
        $mensagem_erro = "Todos os campos, exceto o status, são obrigatórios.";
    } else {
        $sql = "UPDATE cargas SET Descricao = ?, Peso = ?, Volume = ?, Destino = ?, Status = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql);
        
        if ($stmt_update) {
            $stmt_update->bind_param(
                "sddssi",
                $_POST['descricao'],
                $_POST['peso'],
                $_POST['volume'],
                $_POST['destino'],
                $_POST['status'],
                $id
            );
            
            if ($stmt_update->execute()) {
                header('Location: listar.php?status=editado');
                exit;
            } else {
                $mensagem_erro = "Erro ao atualizar a carga: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            $mensagem_erro = "Erro ao preparar a consulta de atualização: " . $conn->error;
        }
    }
}

$stmt_select = $conn->prepare("SELECT * FROM cargas WHERE id = ?");
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$carga = $result->fetch_assoc();
$stmt_select->close();

if (!$carga) {
    header("Location: listar.php?status=nao_encontrado");
    exit;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carga - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Carga</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="editar.php?id=<?php echo $carga['id']; ?>">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição da Carga</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?php echo htmlspecialchars($carga['Descricao']); ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="peso" class="form-label">Peso (kg)</label>
                                    <input type="number" step="0.01" class="form-control" id="peso" name="peso" value="<?php echo htmlspecialchars($carga['Peso']); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="volume" class="form-label">Volume (m³)</label>
                                    <input type="number" step="0.01" class="form-control" id="volume" name="volume" value="<?php echo htmlspecialchars($carga['Volume']); ?>" required>
                                </div>
                            </div>
                             <div class="mb-3">
                                <label for="destino" class="form-label">Endereço de Destino</label>
                                <input type="text" class="form-control" id="destino" name="destino" value="<?php echo htmlspecialchars($carga['Destino']); ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Disponível" <?php if($carga['Status'] == 'Disponível') echo 'selected'; ?>>Disponível</option>
                                    <option value="Alocada" <?php if($carga['Status'] == 'Alocada') echo 'selected'; ?>>Alocada</option>
                                    <option value="Em Trânsito" <?php if($carga['Status'] == 'Em Trânsito') echo 'selected'; ?>>Em Trânsito</option>
                                    <option value="Entregue" <?php if($carga['Status'] == 'Entregue') echo 'selected'; ?>>Entregue</option>
                                </select>
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