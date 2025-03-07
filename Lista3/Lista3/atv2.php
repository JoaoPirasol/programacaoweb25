<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atividade 2 - Soma de Valores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <main class="container">
    <h2 class="text-center">Digite 2 números</h2>
    <form action="resp2.php" method="POST">
        <div class="form-group">
            <label for="numero1">Número 1:</label>
            <input type="number" class="form-control" id="numero1" name="numero1" required>
        </div>
        <div class="form-group">
            <label for="numero2">Número 2:</label>
            <input type="number" class="form-control" id="numero2" name="numero2" required>
        </div>
        <button type="submit" class="btn btn-primary">Calcular</button>
    </form>
</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>