<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefa 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>