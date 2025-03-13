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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
