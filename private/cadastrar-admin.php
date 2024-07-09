<?php
// Script para inserir administrador com senha hasheada
include_once '../class/Database.php';
include_once '../class/Admin.php';

$database = new Database();
$db = $database->getConnection();

$username = 'admin';
$password = 'Estacio@123';
$cpf = '99999999999';

// Hash da senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO administradores (username, senha, cpf) VALUES (:username, :senha, :cpf)";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':senha', $hashed_password);
$stmt->bindParam(':cpf', $cpf);

if ($stmt->execute()) {
    echo "Administrador inserido com sucesso.";
} else {
    echo "Erro ao inserir administrador.";
}
?>