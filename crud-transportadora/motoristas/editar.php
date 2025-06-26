<?php
$mensagem_erro = "";
$motorista = null;

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
    if (empty($_POST['nome']) || empty($_POST['cnh'])) {
        $mensagem_erro = "Nome e CNH são campos obrigatórios.";
    } else {
        $sql = "UPDATE motoristas SET Nome = ?, CNH = ?, Telefone = ?, Disponibilidade = ?, ativa = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $ativo = isset($_POST['ativa']) ? 1 : 0;
            $stmt->bind_param(
                "ssssii",
                $_POST['nome'],
                $_POST['cnh'],
                $_POST['telefone'],
                $_POST['disponibilidade'],
                $ativo,
                $id
            );
            
            if ($stmt->execute()) {
                header('Location: listar.php?status=editado');
                exit;
            } else {
                $mensagem_erro = "Erro ao atualizar o motorista: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensagem_erro = "Erro ao preparar a consulta: " . $conn->error;
        }
    }
}

$stmt_select = $conn->prepare("SELECT * FROM motoristas WHERE id = ?");
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$motorista = $result->fetch_assoc();
$stmt_select->close();

if (!$motorista) {
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
    <title>Editar Motorista - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Motorista</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="editar.php?id=<?php echo $motorista['id']; ?>">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($motorista['Nome']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cnh" class="form-label">CNH</label>
                                <input type="text" class="form-control" id="cnh" name="cnh" value="<?php echo htmlspecialchars($motorista['CNH']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($motorista['Telefone']); ?>" placeholder="(XX) XXXXX-XXXX">
                            </div>
                            <div class="mb-3">
                                <label for="disponibilidade" class="form-label">Disponibilidade</label>
                                <select class="form-select" id="disponibilidade" name="disponibilidade">
                                    <option value="Disponível" <?php if($motorista['Disponibilidade'] == 'Disponível') echo 'selected'; ?>>Disponível</option>
                                    <option value="Em viagem" <?php if($motorista['Disponibilidade'] == 'Em viagem') echo 'selected'; ?>>Em viagem</option>
                                    <option value="Indisponível" <?php if($motorista['Disponibilidade'] == 'Indisponível') echo 'selected'; ?>>Indisponível</option>
                                </select>
                            </div>
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="ativa" name="ativa" <?php if($motorista['ativa']) echo 'checked'; ?>>
                                <label class="form-check-label" for="ativa">Motorista Ativo</label>
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