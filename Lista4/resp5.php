<?php
function calcularRaizQuadrada($valor) {
    return sqrt($valor);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor = $_POST['valor'];
    echo "A raiz quadrada de $valor é " . calcularRaizQuadrada($valor);
}
?>
