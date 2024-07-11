<?php
session_start();
include_once '../config/Conexao.php';
include_once '../class/Produto.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['carrinho_id']) && isset($data['quantidade'])) {
    $carrinho_id = $data['carrinho_id'];
    $quantidade = $data['quantidade'];

    $database = new Database();
    $conn = $database->getConnection();

    $sql = "UPDATE carrinho SET quantidade = :quantidade WHERE id = :carrinho_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->bindParam(':carrinho_id', $carrinho_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
}
?>