<?php

require_once '../DB/Database.php';


class VendedorCreate {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function CREATE($nome, $email,$senha,$telefone,$CPF,$endereco,$cidade,$estado,$data_nasc) {
        $sql = "INSERT INTO usuario (nome, email,senha,tipo,telefone,CPF,endereco,cidade,estado,data_nasc) VALUES (".$nome.", ".$email.",".$senha.",'vendedor',".$telefone.",".$CPF.",".$endereco.",".$cidade.",".$estado.",".$data_nasc.")"; 
        
        $result = mysqli_query($con, $sql);        
    }
}


?>