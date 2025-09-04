<?php
require_once __DIR__ . '/../DB/Database.php';

class MensagensModel {
    private $conn;
    private $table_name = "mensagens";

    public $id;
    public $nome;
    public $email;
    public $mensagem;
};