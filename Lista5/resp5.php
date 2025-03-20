<?php
session_start();

if (!isset($_SESSION['livros'])) {
    $_SESSION['livros'] = [];
}
function verificaBaixaQuantidade($quantidade) {
    return $quantidade < 5;
}

function verificaDuplicata($titulo, $livros) {
    foreach ($livros as $livro) {
        if ($livro['titulo'] === $titulo) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $quantidade = intval($_POST['quantidade']);

    if (!verificaDuplicata($titulo, $_SESSION['livros'])) {
        $_SESSION['livros'][$titulo] = $quantidade;
        echo "Livro adicionado com sucesso!<br>";
    } else {
        echo "Erro: Título de livro duplicado!<br>";
    }
}

ksort($_SESSION['livros']);  

echo "<h2>Lista de Livros Ordenada pelo Título</h2>";
echo "<table border='1'>";
echo "<tr><th>Título</th><th>Quantidade em Estoque</th></tr>";

foreach ($_SESSION['livros'] as $titulo => $quantidade) {
    if (verificaBaixaQuantidade($quantidade)) {
        echo "<tr><td><strong>{$titulo}</strong></td><td style='color: red;'><strong>{$quantidade}</strong> - Baixa Quantidade!</td></tr>";
    } else {
        echo "<tr><td>{$titulo}</td><td>{$quantidade}</td></tr>";
    }
}

echo "</table>";
?>
