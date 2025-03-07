<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atividade 5 mês</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mes = $_POST['mes'];

    switch ($mes) {
        case 1:
            $nome_mes = "Janeiro";
            break;
        case 2:
            $nome_mes = "Fevereiro";
            break;
        case 3:
            $nome_mes = "Março";
            break;
        case 4:
            $nome_mes = "Abril";
            break;
        case 5:
            $nome_mes = "Maio";
            break;
        case 6:
            $nome_mes = "Junho";
            break;
        case 7:
            $nome_mes = "Julho";
            break;
        case 8:
            $nome_mes = "Agosto";
            break;
        case 9:
            $nome_mes = "Setembro";
            break;
        case 10:
            $nome_mes = "Outubro";
            break;
        case 11:
            $nome_mes = "Novembro";
            break;
        case 12:
            $nome_mes = "Dezembro";
            break;
        default:
            $nome_mes = "Número inválido. Por favor, insira um número entre 1 e 12.";
    }

    echo "<p>Mês:$nome_mes</p>";
}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>