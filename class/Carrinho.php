<?php

include_once '../class/Database.php';

class Carrinho
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Adicionar item ao carrinho
    public function adicionarItem($clienteId, $produtoId, $quantidade)
    {
        $sql = "INSERT INTO carrinho (cliente_id, produto_id, quantidade) VALUES (:cliente_id, :produto_id, :quantidade)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cliente_id', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Atualizar quantidade de um item no carrinho
    public function atualizarItem($id, $quantidade)
    {
        $sql = "UPDATE carrinho SET quantidade = :quantidade WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Remover item do carrinho
    public function removerItem($id)
    {
        $sql = "DELETE FROM carrinho WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Listar itens do carrinho
    public function listarItens($clienteId)
    {
        $sql = "SELECT c.id, p.nome, p.valor, c.quantidade 
                FROM carrinho c 
                JOIN produtos p ON c.produto_id = p.id 
                WHERE c.cliente_id = :cliente_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cliente_id', $clienteId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Finalizar compra
    public function finalizarCompra($clienteId)
    {
        $sql = "DELETE FROM carrinho WHERE cliente_id = :cliente_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cliente_id', $clienteId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}

?>