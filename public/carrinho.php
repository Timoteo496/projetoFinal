<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrinho de Compras - 4Charmes</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a href="/index.php">
                <h1 class="fonte" style="color: #e5d335;">4Charmes</h1>
            </a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/index.php#portfolio">Manager</a></li>
                    <li class="nav-item"><a class="nav-link" href="/index.php#about">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="/index.php#team">Equipe</a></li>
                    <li class="nav-item"><a class="nav-link" href="/index.php#contact">Contato</a></li>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="nav-item"><a class="btn btn-primary text-uppercase" href="/public/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="btn btn-primary text-uppercase"
                                href="/public/cadastro.html">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carrinho de Compras -->
    <section class="page-section" id="carrinho">
        <div class="container mb-5">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Carrinho de Compras</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Exemplo de um item no carrinho -->
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Relógio Prata</td>
                                    <td>R$ 320,00</td>
                                    <td>1</td>
                                    <td><a href="#" class="btn btn-danger btn-sm">Remover</a></td>
                                </tr>
                                <!-- Outros itens do carrinho seriam adicionados aqui -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>