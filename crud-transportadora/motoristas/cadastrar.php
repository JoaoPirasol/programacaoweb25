<?php
$mensagem_erro = "";
$mensagem_sucesso = "";

if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['nome']) || empty($_POST['cnh'])) {
        $mensagem_erro = "Nome e CNH são campos obrigatórios.";
    } else {
        $sql = "INSERT INTO motoristas (Nome, CNH, Telefone, Disponibilidade) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param(
                "ssss",
                $_POST['nome'],
                $_POST['cnh'],
                $_POST['telefone'],
                $_POST['disponibilidade']
            );
            
            if ($stmt->execute()) {
                header('Location: listar.php?status=sucesso');
                exit;
            } else {
                $mensagem_erro = "Erro ao cadastrar o motorista: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensagem_erro = "Erro ao preparar a consulta: " . $conn->error;
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Motorista - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Cadastro de Novo Motorista</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensagem_erro; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="cadastrar.php">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="cnh" class="form-label">CNH</label>
                                <input type="text" class="form-control" id="cnh" name="cnh" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
                            </div>
                            <div class="mb-4">
                                <label for="disponibilidade" class="form-label">Disponibilidade</label>
                                <select class="form-select" id="disponibilidade" name="disponibilidade">
                                    <option value="Disponível" selected>Disponível</option>
                                    <option value="Em viagem">Em viagem</option>
                                    <option value="Indisponível">Indisponível</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Cadastrar Motorista</button>
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