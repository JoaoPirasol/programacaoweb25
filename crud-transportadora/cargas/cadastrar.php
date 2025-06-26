<?php
$mensagem_erro = "";

if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['descricao']) || empty($_POST['peso']) || empty($_POST['volume']) || empty($_POST['destino'])) {
        $mensagem_erro = "Todos os campos, exceto o status, são obrigatórios.";
    } else {
        $sql = "INSERT INTO cargas (Descricao, Peso, Volume, Destino, Status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param(
                "sddss",
                $_POST['descricao'],
                $_POST['peso'],
                $_POST['volume'],
                $_POST['destino'],
                $_POST['status']
            );
            
            if ($stmt->execute()) {
                header('Location: listar.php?status=sucesso');
                exit;
            } else {
                $mensagem_erro = "Erro ao cadastrar a carga: " . $stmt->error;
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
    <title>Cadastro de Carga - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Cadastro de Nova Carga</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="cadastrar.php">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição da Carga</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="peso" class="form-label">Peso (kg)</label>
                                    <input type="number" step="0.01" class="form-control" id="peso" name="peso" placeholder="Ex: 50.75" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="volume" class="form-label">Volume (m³)</label>
                                    <input type="number" step="0.01" class="form-control" id="volume" name="volume" placeholder="Ex: 1.5" required>
                                </div>
                            </div>
                             <div class="mb-3">
                                <label for="destino" class="form-label">Endereço de Destino</label>
                                <input type="text" class="form-control" id="destino" name="destino" required>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">Status Inicial</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Disponível" selected>Disponível</option>
                                    <option value="Alocada">Alocada</option>
                                    <option value="Em Trânsito">Em Trânsito</t_option>
                                    <option value="Entregue">Entregue</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Cadastrar Carga</button>
                                <a href="listar.php" class="btn btn-secondary">Voltar para a Lista</a>
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