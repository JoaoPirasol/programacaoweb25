<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Sistema Transportadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .card-icon {
            font-size: 3.5rem;
            color: var(--bs-primary);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .card {
            transition: transform .2s, box-shadow .2s;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        
        <header class="p-5 mb-4 bg-light rounded-3 text-center">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold"><i class="bi bi-truck-front-fill"></i> Sistema de Gestão de Transportadora</h1>
                <p class="fs-4">Selecione um dos módulos abaixo para começar a gerenciar os dados.</p>
            </div>
        </header>

        <main>
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm text-center">
                        <div class="card-body py-5">
                            <div class="card-icon mb-3"><i class="bi bi-person-vcard-fill"></i></div>
                            <h4 class="card-title">Gerenciar Clientes</h4>
                            <p class="card-text">Cadastre, edite e visualize os clientes da transportadora.</p>
                            <a href="clientes/listar.php" class="btn btn-primary stretched-link mt-2">Acessar Clientes</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm text-center">
                        <div class="card-body py-5">
                            <div class="card-icon mb-3"><i class="bi bi-people-fill"></i></div>
                            <h4 class="card-title">Gerenciar Motoristas</h4>
                            <p class="card-text">Adicione novos motoristas, atualize dados e controle a disponibilidade.</p>
                            <a href="motoristas/listar.php" class="btn btn-primary stretched-link mt-2">Acessar Motoristas</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm text-center">
                        <div class="card-body py-5">
                            <div class="card-icon mb-3"><i class="bi bi-box-seam-fill"></i></div>
                            <h4 class="card-title">Gerenciar Cargas</h4>
                            <p class="card-text">Controle as cargas, seus status, pesos, volumes e destinos.</p>
                            <a href="cargas/listar.php" class="btn btn-primary stretched-link mt-2">Acessar Cargas</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm text-center">
                        <div class="card-body py-5">
                            <div class="card-icon mb-3"><i class="bi bi-truck"></i></div>
                            <h4 class="card-title">Gerenciar Entregas</h4>
                            <p class="card-text">Registre novas entregas e acompanhe o andamento de cada uma.</p>
                            <a href="entregas/listar.php" class="btn btn-primary stretched-link mt-2">Acessar Entregas</a>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="text-center text-muted mt-5 py-3">
            <p>&copy; <?php echo date('Y'); ?> Sistema Transportadora. Todos os direitos reservados.</p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>