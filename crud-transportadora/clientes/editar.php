<?php
$mensagem_erro = "";
$cliente = null;

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
    if (empty($_POST['nome']) || empty($_POST['documento'])) {
        $mensagem_erro = "Nome e Documento são campos obrigatórios.";
    } else {
        $sql = "UPDATE clientes SET Nome = ?, Documento = ?, Telefone = ?, Endereco = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql);
        
        if ($stmt_update) {
            $stmt_update->bind_param(
                "ssssi",
                $_POST['nome'],
                $_POST['documento'],
                $_POST['telefone'],
                $_POST['endereco'],
                $id
            );
            
            if ($stmt_update->execute()) {
                header('Location: listar.php?status=editado');
                exit;
            } else {
                $mensagem_erro = "Erro ao atualizar o cliente: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            $mensagem_erro = "Erro ao preparar a consulta de atualização: " . $conn->error;
        }
    }
}

$stmt_select = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$cliente = $result->fetch_assoc();
$stmt_select->close();

if (!$cliente) {
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
    <title>Editar Cliente - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Cliente</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="editar.php?id=<?php echo $cliente['id']; ?>">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome / Razão Social</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['Nome']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="documento" class="form-label">CPF / CNPJ</label>
                                <input type="text" class="form-control" id="documento" name="documento" value="<?php echo htmlspecialchars($cliente['Documento']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($cliente['Telefone']); ?>" placeholder="(XX) XXXXX-XXXX">
                            </div>
                            <div class="mb-4">
                                <label for="endereco" class="form-label">Endereço Completo</label>
                                <textarea class="form-control" id="endereco" name="endereco" rows="3"><?php echo htmlspecialchars($cliente['Endereco']); ?></textarea>
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