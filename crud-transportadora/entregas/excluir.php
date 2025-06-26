<?php
if (file_exists('../conexao.php')) {
    include('../conexao.php');
} else {
    die("Erro: O arquivo de conexão não foi encontrado.");
}

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM entregas WHERE id = ?");
    
    if ($stmt === false) {
        header('Location: listar.php?status=erro_preparar');
        exit;
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: listar.php?status=excluido');
    } else {
        header('Location: listar.php?status=erro_excluir');
    }

    $stmt->close();
    $conn->close();
    exit;

} else {
    header('Location: listar.php');
    exit;
}
?>