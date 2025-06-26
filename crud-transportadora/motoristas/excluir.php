<?php
// Ativa a exibição de erros para depuração (opcional, bom durante o desenvolvimento)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclui a conexão
include('../conexao.php');

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    // Converte o ID para inteiro para segurança (evita injeção de SQL)
    $id = intval($_GET['id']);

    // Prepara e executa a query de forma segura com Prepared Statements
    // Esta é uma melhoria de segurança em relação ao seu código original
    $stmt = $conn->prepare("DELETE FROM motoristas WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" significa que a variável é um inteiro
    $stmt->execute();
    
    // Redireciona para a página de listagem
    header('Location: listar.php');
    exit; // Termina o script

} else {
    // Se nenhum ID for fornecido, redireciona ou mostra um erro
    echo "Erro: ID do motorista não fornecido.";
    exit;
}
?>