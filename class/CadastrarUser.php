<?php
session_start();

class Database
{
    private $host = "localhost";
    private $db_name = "ecommerce";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

class Cliente
{
    private $conn;
    private $table_name = "clientes";

    public $nome;
    public $cpf;
    public $telefone;
    public $email;
    public $senha;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function cadastrar()
    {
        $query = "INSERT INTO " . $this->table_name . " (nome, cpf, telefone, email, senha) VALUES (:nome, :cpf, :telefone, :email, :senha)";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $cliente = new Cliente($db);

    $cliente->nome = $_POST['nome'];
    $cliente->cpf = $_POST['cpf'];
    $cliente->telefone = $_POST['telefone'];
    $cliente->email = $_POST['email'];
    $cliente->senha = $_POST['senha'];

    if ($cliente->cadastrar()) {
        $_SESSION['usuario_id'] = $cliente->email;
        $message = "Sua conta foi criada com sucesso!";
        $message_type = "success";
    } else {
        $message = "Erro ao tentar realizar o cadastro!";
        $message_type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .card {
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card text-center">
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <a href="/index.php" class="btn btn-primary btn-block">Continue!</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>