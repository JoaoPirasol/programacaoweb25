<?php
function converterMaiusculoMinusculo($palavra) {
    return [
        'maiusculo' => strtoupper($palavra),
        'minusculo' => strtolower($palavra)
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $palavra = $_POST['palavra2'];
    $resultados = converterMaiusculoMinusculo($palavra);
    echo "Maiúsculo: " . $resultados['maiusculo'] . "<br>";
    echo "Minúsculo: " . $resultados['minusculo'];
}
?>
