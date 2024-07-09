<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once 'Database.php';
    include_once 'Admin.php';

    $database = new Database();
    $db = $database->getConnection();

    $admin = new Admin($db);

    // Recebe os dados do formulário de login
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Verifica se as credenciais são válidas
    if ($admin->validarLogin($username, $password)) {

        $_SESSION['administradores'] = $username;

        header("Location: /class/CadastrarItem.php");
        exit;
    } else {
        // Credenciais inválidas: exibe mensagem de erro
        $erro = "Credenciais inválidas! Verifique seu usuário e senha.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Validação de Login</h1>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger mt-4" role="alert">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>