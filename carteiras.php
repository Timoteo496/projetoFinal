<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Acessorios - 4Charmes</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
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
      Menu
      <i class="fas fa-bars ms-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
          <!-- Opção de Login para administradores da página! -->
          <li class="nav-item"><a class="nav-link" href="/private/login-manager.html">Manager</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="#team">Equipe</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contato</a></li>
          <!-- Verifica se existe uma sessão de usuário ativa -->
          <?php if (isset($_SESSION['usuario_id'])): ?>
            <!-- Habilita a opção de Logout se a sessão estiver ativa -->
            <li class="nav-item"><a class="btn btn-primary text-uppercase" href="/public/logout.php">Logout</a>
            </li>
            <!-- Senão, habilita a opção para Login -->
          <?php else: ?>
            <li class="nav-item"><a class="btn btn-primary text-uppercase" href="/public/cadastro.html">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Masthead-->
  <header class="masthead">
    <div class="container">
    </div>
  </header>

  <section class="page-section" id="services">
    <div class="container mb-5">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Relógios</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
      </div>

      <div class="row text-center">
        <div class="col-md-4 pb-5">
          <img src="/imagens/Carteira/Carteira Marrom.jfif" alt="">
          <h4 class="my-3">Carteira Preta</h4>
          <h4>
            <p class="text-muted"><strong>R$ 320,00</strong></p>
          </h4>
          <a class="btn btn-primary btn-x0.5 text-uppercase comprar-btn" href="#services">Comprar</a>
        </div>
        <div class="col-md-4 pb-5">
          <img src="/imagens/Carteira/Carteira Marrom2.jfif" alt="">
          <h4 class="my-3">Carteira Marrom</h4>
          <h4>
            <p class="text-muted"><strong>R$ 320,00</strong></p>
          </h4><a class="btn btn-primary btn-x0.5 text-uppercase comprar-btn" href="#services">Comprar</a>
        </div>
        <div class="col-md-4 pb-5">
          <img src="/imagens/Carteira/Carteira Marrom3.jfif" alt="">
          <h4 class="my-3">Carteira Branca</h4>
          <h4>
            <p class="text-muted"><strong>R$ 320,00</strong></p>
          </h4><a class="btn btn-primary btn-x0.5 text-uppercase comprar-btn" href="#services">Comprar</a>
        </div>
        <div class="col-md-4 pb-5">
          <img src="/imagens/Carteira/Carteira Preta.jfif" alt="">
          <h4 class="my-3">Carteira Preta</h4>
          <h4>
            <p class="text-muted"><strong>R$ 320,00</strong></p>
          </h4>
          <a class="btn btn-primary btn-x0.5 text-uppercase comprar-btn" href="#services">Comprar</a>
        </div>
        <div class="col-md-4 pb-5">
          <img src="/imagens/Carteira/Carteira Preta2.jfif" alt="">
          <h4 class="my-3">Carteira Marrom</h4>
          <h4>
            <p class="text-muted"><strong>R$ 320,00</strong></p>
          </h4>
          <a class="btn btn-primary btn-x0.5 text-uppercase comprar-btn" href="#services">Comprar</a>
        </div>
        <div class="col-md-4 pb-5">
          <img src="/imagens/Carteira/Carteira Preta3.jfif" alt="">
          <h4 class="my-3">Carteira Branca</h4>
          <h4>
            <p class="text-muted"><strong>R$ 320,00</strong></p>
          </h4>
          <a class="btn btn-primary btn-x0.5 text-uppercase comprar-btn" href="#services">Comprar</a>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.querySelectorAll('.comprar-btn').forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault();

        console.log('Botão "Comprar" clicado.');

        fetch('/public/verificar-sessao.php')
          .then(response => response.json())
          .then(data => {
            console.log('Resposta recebida:', data);

            if (data.status === 'success') {
              alert(data.message);
              window.location.href = '/public/carrinho.php'; // Sessão ativa; redireciona para o carrinho
            } else if (data.status === 'redirect') {
              alert(data.message);
              window.location.href = '/public/cadastro.html'; // Sessão inativa; redireciona para a página de cadastro
            }
          })
          .catch(error => console.error('Erro:', error));
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>