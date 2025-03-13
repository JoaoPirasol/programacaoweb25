<?php
function verificarDataValida($dia, $mes, $ano) {
    return checkdate($mes, $dia, $ano);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    if (verificarDataValida($dia, $mes, $ano)) {
        echo "A data informada é válida: " . sprintf('%02d/%02d/%04d', $dia, $mes, $ano);
    } else {
        echo "A data informada é inválida.";
    }
}
?>
