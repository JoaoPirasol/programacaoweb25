<?php
session_start();

if (!isset($_SESSION['contatos'])) {
    $_SESSION['contatos'] = [];
}
function verificaDuplicata($nome, $telefone, $contatos) {
    foreach ($contatos as $contato) {
        if ($contato['nome'] === $nome || $contato['telefone'] === $telefone) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);

    if (!verificaDuplicata($nome, $telefone, $_SESSION['contatos'])) {
        $_SESSION['contatos'][] = ['nome' => $nome, 'telefone' => $telefone];
        echo "Contato adicionado com sucesso!<br>";
    } else {
        echo "Erro: Nome ou telefone duplicado!<br>";
    }
}
usort($_SESSION['contatos'], function ($a, $b) {
    return strcmp($a['nome'], $b['nome']);
});

echo "<h2>Lista de Contatos</h2>";
echo "<table border='1'>";
echo "<tr><th>Nome</th><th>Telefone</th></tr>";
foreach ($_SESSION['contatos'] as $contato) {
    echo "<tr><td>{$contato['nome']}</td><td>{$contato['telefone']}</td></tr>";
}
echo "</table>";

?>
