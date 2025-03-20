<?php
function verificarPalavraContida($palavra1, $palavra2) {
    return strpos($palavra1, $palavra2) !== false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $palavra1 = $_POST['palavra1'];
    $palavra2 = $_POST['palavra2'];
    if (verificarPalavraContida($palavra1, $palavra2)) {
        echo "A palavra '$palavra2' está contida em '$palavra1'.";
    } else {
        echo "A palavra '$palavra2' NÃO está contida em '$palavra1'.";
    }
}
?>
