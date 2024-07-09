<?php
session_start();

header('Content-Type: application/json');

$response = [];

if (isset($_SESSION['usuario'])) {
    $response['status'] = 'success';
    $response['message'] = 'Você está logado!';
} else {
    $response['status'] = 'redirect';
    $response['message'] = 'Por favor, faça login para comprar!';
}

echo json_encode($response);
?>