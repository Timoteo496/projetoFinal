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

    public function atualizar($id, $nome, $tipo, $cor, $quantidade, $valor)
    {
        $sql = "UPDATE produtos SET nome = :nome, tipo = :tipo, cor = :cor, quantidade = :quantidade, valor = :valor WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':cor', $cor);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);

        return $stmt->execute();
    }
}

// Cria a conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

$produto = new Produto($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nome = htmlspecialchars($_POST['nome']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $cor = htmlspecialchars($_POST['cor']);
    $quantidade = intval($_POST['quantidade']);
    $valor = floatval($_POST['valor']);

    if ($produto->atualizar($id, $nome, $tipo, $cor, $quantidade, $valor)) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o produto.";
    }
}
?>