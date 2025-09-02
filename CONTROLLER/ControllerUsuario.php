<?php
    require_once __DIR__ . '/../DB/Database.php';
    require_once __DIR__ . '/../MODEL/ModelUSuario.php';
    
    $usuario = new User();

    $data = [
        'id'        => 17,
        'nome'      => 'João Silva',
        'email'     => 'joao@email.com',
        'senha'     => '123456',
        'tipo'      => 'admin',
        'telefone'  => '(11) 99999-9999',
        'CPF'       => '01010101',
        'endereco'  => 'Rua das Flores, 123',
        'cidade'    => 'São Paulo',
        'estado'    => 'SP',
        'data_nasc' => '1990-01-01',
        'foto'      => 'foto.jpg'
    ];

    $usuario->nome = $data['nome'] ?? '';
    $usuario->email = $data['email'] ?? '';
    $usuario->senha = $data['senha'] ?? '';
    $usuario->tipo = $data['tipo'] ?? '';
    $usuario->telefone   = $data['telefone'] ?? '';
    $usuario->CPF = $data['CPF'] ?? '';
    $usuario->endereco = $data['endereco'] ?? '';
    $usuario->cidade = $data['cidade'] ?? '';
    $usuario->estado = $data['estado'] ?? '';
    $usuario->data_nasc = $data['data_nasc'] ?? '';
    $usuario->foto = $data['foto'] ?? '';

    print_r($usuario->readOne());

?>