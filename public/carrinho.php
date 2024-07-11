<?php
session_start();

include_once '../class/Database.php';
include_once '../class/Carrinho.php';

// Cria a conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Instancia a classe Carrinho
$carrinho = new Carrinho($conn);

// Lógica para atualizar a quantidade de itens no carrinho
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'update') {
        $id = intval($_POST['id']);
        $quantidade = intval($_POST['quantidade']);
        $carrinho->atualizarItem($id, $quantidade);
    } elseif ($_POST['action'] == 'finalize') {
        $cliente_id = $_SESSION['usuario_id']; // Supondo que o ID do cliente está na sessão
        $carrinho->finalizarCompra($cliente_id);
    } elseif ($_POST['action'] == 'remove') {
        $id = intval($_POST['id']);
        $carrinho->removerItem($id);
    }
}

// Recupera os itens do carrinho
$itens = $carrinho->listarItens($_SESSION['usuario_id']);
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
                    <li class="nav-item"><a class="nav-link" href="/index.php#about">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="/index.php#team">Equipe</a></li>
                    <li class="nav-item"><a class="nav-link" href="/index.php#contact">Contato</a></li>
                    <li class="nav-item"><a class="btn btn-primary text-uppercase" href="/public/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
        </div>
    </header>

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
                                <?php foreach ($itens as $item): ?>
                                    <tr>
                                        <th scope="row"><?php echo $item['id']; ?></th>
                                        <td><?php echo $item['produto_nome']; ?></td>
                                        <td><?php echo 'R$ ' . number_format($item['produto_valor'], 2, ',', '.'); ?></td>
                                        <td>
                                            <form action="atualizar-carrinho.php" method="post"
                                                style="display: inline-block;">
                                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                <input type="number" name="quantidade"
                                                    value="<?php echo $item['quantidade']; ?>" min="1">
                                                <button type="submit" name="action" value="update"
                                                    class="btn btn-success btn-sm">Atualizar</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="remover-item-carrinho.php" method="post"
                                                style="display: inline-block;">
                                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                                <button type="submit" name="action" value="remove"
                                                    class="btn btn-danger btn-sm">Remover</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="/index.php#services" class="btn btn-primary">Continuar comprando</a>
                        <form action="../private/finalizar-compra.php" method="post" style="display: inline-block;">
                            <button type="submit" name="action" value="finalize" class="btn btn-success">Finalizar
                                compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="/js/scripts.js"></script>
</body>

</html>