<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 3 de PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeros = $_POST['numeros'];

    if (count($numeros) == 7) {
        $menor_valor = $numeros[0];
        $posicao_menor = 0;
        for ($i = 1; $i < 7; $i++) {
            if ($numeros[$i] < $menor_valor) {
                $menor_valor = $numeros[$i];
                $posicao_menor = $i;
            }
        }
        echo "<p>O menor valor é: <strong>$menor_valor</strong></p>";
        echo "<p>A posição do menor valor é:" . ($posicao_menor + 1) . "</p>";
    } else {
    echo "<p>Método de requisição inválido.</p>";
        }
    }
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>