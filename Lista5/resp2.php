<?php
session_start();

if (!isset($_SESSION['alunos'])) {
    $_SESSION['alunos'] = [];
}

function verificaDuplicata($nome, $alunos) {
    foreach ($alunos as $aluno) {
        if ($aluno['nome'] === $nome) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $nota1 = floatval($_POST['nota1']);
    $nota2 = floatval($_POST['nota2']);
    $nota3 = floatval($_POST['nota3']);

    $media = ($nota1 + $nota2 + $nota3) / 3;

    if (!verificaDuplicata($nome, $_SESSION['alunos'])) {
        $_SESSION['alunos'][] = ['nome' => $nome, 'media' => $media];
        echo "Aluno adicionado com sucesso!<br>";
    } else {
        echo "Erro: Nome de aluno duplicado!<br>";
    }
}

usort($_SESSION['alunos'], function ($a, $b) {
    return $b['media'] <=> $a['media'];
});

echo "<h2>Lista de Alunos Ordenada por Média</h2>";
echo "<table border='1'>";
echo "<tr><th>Nome</th><th>Média</th></tr>";
foreach ($_SESSION['alunos'] as $aluno) {
    echo "<tr><td>{$aluno['nome']}</td><td>{$aluno['media']}</td></tr>";
}
echo "</table>";

?>
