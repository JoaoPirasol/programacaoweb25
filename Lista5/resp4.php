<?php
session_start();

if (!isset($_SESSION['itens'])) {
    $_SESSION['itens'] = [];
}


function aplicarImposto($preco) {
    return $preco * 1.15; 
}
function verificaDuplicata($nome, $itens) {
    foreach ($itens as $item) {
        if ($item['nome'] === $nome) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);

    $precoComImposto = aplicarImposto($preco);

    if (!verificaDuplicata($nome, $_SESSION['itens'])) {
        $_SESSION['itens'][$nome] = $precoComImposto;
        echo "Item adicionado com sucesso!<br>";
    } else {
        echo "Erro: Nome de item duplicado!<br>";
    }
}
asort($_SESSION['itens']); 
echo "<h2>Lista de Itens Ordenada pelo Preço Após Imposto</h2>";
echo "<table border='1'>";
echo "<tr><th>Nome</th><th>Preço com Imposto (R$)</th></tr>";
foreach ($_SESSION['itens'] as $nome => $precoComImposto) {
    echo "<tr><td>{$nome}</td><td>" . number_format($precoComImposto, 2, ',', '.') . "</td></tr>";
}
echo "</table>";

?>
