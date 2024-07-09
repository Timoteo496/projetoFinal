<?php
session_start();

$_SESSION = array();

if (session_id() != "" || isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 2592000, '/');
}

session_destroy();

$message = "Sua conta foi desconectada!";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <script>
        alert("<?php echo $message; ?>");
        window.location.href = "/index.php";
    </script>
</body>
</html>