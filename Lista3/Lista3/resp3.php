<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atividade 3 - Valores A e B</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valorA = $_POST['valorA'];
        $valorB = $_POST['valorB'];

        if ($valorA == $valorB) {
            echo "<p>Os valores são iguais:$valorA</p>";
        } else {
            if ($valorA < $valorB) {
                $menor = $valorA;
                $maior = $valorB;
            } else {
                $menor = $valorB;
                $maior = $valorA;
            }
            echo "<p>Valores em ordem crescente:$menor,$maior</p>";
    }
            } else {
                echo "<p>Erro, insira valores naturais e inteiros.</p>";
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>