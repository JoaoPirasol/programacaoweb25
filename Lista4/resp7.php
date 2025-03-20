<?php
function calcularDiferencaDias($data1, $data2) {
    $d1 = DateTime::createFromFormat('d/m/Y', $data1);
    $d2 = DateTime::createFromFormat('d/m/Y', $data2);
    return $d1->diff($d2)->days;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];
    echo "A diferença entre as datas é de " . calcularDiferencaDias($data1, $data2) . " dias.";
}
?>
