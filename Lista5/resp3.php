<?php
session_start();

if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

function aplicarDesconto($preco) {
    if ($preco > 100) {
        return $preco * 0.90;
    }
    return $preco;
}


function verificaDuplicata($codigo, $produtos) {
    foreach ($produtos as $produto) {
        if ($produto['codigo'] === $codigo) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = intval($_POST['codigo']);
    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $precoComDesconto = aplicarDesconto($preco);

    if (!verificaDuplicata($codigo, $_SESSION['produtos'])) {
        $_SESSION['produtos'][$codigo] = [
            'nome' => $nome,
            'preco' => $precoComDesconto
        ];
        echo "Produto adicionado com sucesso!<br>";
    } else {
        echo "Erro: Código de produto duplicado!<br>";
    }
}

ksort($_SESSION['produtos']);  
usort($_SESSION['produtos'], function ($a, $b) {
    return strcmp($a['nome'], $b['nome']);
});

echo "<h2>Lista de Produtos Ordenada por Nome</h2>";
echo "<table border='1'>";
echo "<tr><th>Código</th><th>Nome</th><th>Preço (R$)</th></tr>";
foreach ($_SESSION['produtos'] as $codigo => $produto) {
    echo "<tr><td>{$codigo}</td><td>{$produto['nome']}</td><td>" . number_format($produto['preco'], 2, ',', '.') . "</td></tr>";
}
echo "</table>";

?>
