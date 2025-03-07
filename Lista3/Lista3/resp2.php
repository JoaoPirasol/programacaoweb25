<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atividade 2 Soma de Valores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $soma = $numero1 + $numero2;
    if ($numero1 == $numero2) {
        $resultado = 3 * $soma;
        $mensagem = "<p>Os números são iguais. O triplo é:$resultado</p>";
    } else {
        $resultado = $soma;
        $mensagem = "<p>-Os números são diferentes. A soma é:$resultado</p>";
    }

    echo "<p>$mensagem</p>";
} else {
    echo "<p>Método inválido.</p>";
}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>