<?php
session_start();

header('Content-Type: application/json');

$response = [];

if (isset($_SESSION['usuario_id'])) {
    $response['status'] = 'success';
    $response['message'] = 'Você será redirecionado para o Carrinho de Compras!';
} else {
    $response['status'] = 'redirect';
    $response['message'] = 'Por favor, faça login para comprar!';
}

echo json_encode($response);
?>