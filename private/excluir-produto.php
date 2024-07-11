<?php

include_once '../class/Admin.php';
include_once '../config/Conexao.php';

// Classe para manipulação de produtos
class Produto
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

// Cria a conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

$produto = new Produto($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);

    if ($produto->excluir($id)) {
        echo "Produto excluído com sucesso!";
    } else {
        echo "Erro ao excluir o produto.";
    }
}
?>