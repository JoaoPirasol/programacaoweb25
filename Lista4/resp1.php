<?php
function contarCaracteres($palavra) {
    return strlen($palavra);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $palavra = $_POST['palavra1'];
    echo "A palavra '$palavra' tem " . contarCaracteres($palavra) . " caracteres.";
}
?>
