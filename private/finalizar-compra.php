<?php
session_start();
include_once '../config/Conexao.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cliente_id'])) {
    $cliente_id = $data['cliente_id'];

    $database = new Database();
    $conn = $database->getConnection();

    // Adicionar a lógica para processar a compra!
    // Mover os itens do carrinho para uma tabela de pedidos, gerar uma fatura, etc.

    // Limpa o carrinho do cliente após a finalização da compra
    $sql = "DELETE FROM carrinho WHERE cliente_id = :cliente_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
}
?>