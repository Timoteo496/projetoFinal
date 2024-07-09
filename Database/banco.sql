CREATE DATABASE ecommerce;
USE ecommerce;

CREATE TABLE `clientes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `cpf` VARCHAR(11) NOT NULL,
    `telefone` VARCHAR(15) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `senha` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`cpf`),
    UNIQUE (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `clientes` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE `produtos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `tipo` VARCHAR(50) NOT NULL,
    `cor` VARCHAR(30),
    `quantidade` INT NOT NULL,
    `valor` DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO produtos (nome, tipo, cor, quantidade, valor) 
VALUES 
    ('relógio', 'social', 'prata', 12, 320.00),
    ('relógio', 'social', 'prata', 12, 320.00),
    ('relógio', 'couro', 'marrom', 12, 320.00),
    ('relógio', 'couro', 'marrom', 12, 320.00),
    ('relógio', 'couro', 'marrom', 12, 320.00),
    ('relógio', 'couro', 'marrom', 12, 320.00),
    ('relógio', 'esporte', 'preto', 12, 320.00),
    ('relógio', 'esporte', 'preto', 12, 320.00),
    ('relógio', 'esporte', 'preto', 12, 320.00),
    ('relógio', 'esporte', 'preto', 12, 320.00);

INSERT INTO produtos (nome, tipo, cor, quantidade, valor) 
VALUES 
    ('carteira', 'couro', 'marrom', 12, 320.00),
    ('carteira', 'couro', 'marrom', 12, 320.00),
    ('carteira', 'couro', 'marrom', 12, 320.00),
    ('carteira', 'couro', 'preto', 12, 320.00),
    ('carteira', 'couro', 'preto', 12, 320.00),
    ('carteira', 'couro', 'preto', 12, 320.00);