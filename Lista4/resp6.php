<?php
function arredondarNumero($numero) {
    return round($numero);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['numero'];
    echo "O número arredondado é " . arredondarNumero($numero);
}
?>
