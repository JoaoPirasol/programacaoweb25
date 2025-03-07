<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atividade 10 tabuada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['numero'];

    echo "<h2 class='text-center'>Tabuada de $numero</h2>";

    for ($i = 1; $i <= 10; $i++) {
        $resultado = $numero * $i;
        echo "<li>$numero x $i = $resultado</li>";
    }

} else {
    echo "<p>Erro, valores incorretos.</p>";
}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<!doctype html>