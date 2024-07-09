<?php
class Admin
{
    private $conn;
    private $table_name = "administradores";

    public $username;
    public $password;
    public $cpf;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function validarLogin($username, $password)
    {
        $query = "SELECT username, senha FROM " . $this->table_name . " WHERE username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Verifica se a senha fornecida corresponde ao hash armazenado no banco de dados
            if (password_verify($password, $row['senha'])) {
                return true;
            }
        }

        return false;
    }
}
?>