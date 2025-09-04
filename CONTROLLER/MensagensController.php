<?php
require_once __DIR__ . '/../DB/Database.php';

$mensagem = new Mensagem();

$data = [
    'id'        => 1,
    'nome'      => 'João Silva',
    'email'     => 'joao@email.com',
    'mensagem'  => 'Olá! Gostaria de me tornar um colaborador. :)'
];

$mensagem->nome = $data['nome'] ?? '';
$mensagem->email = $data['email'] ?? '';
$mensagem->mensagem = $data['mensagem'] ?? '';

print_r($mensagem->readOne());
