<?php
$host= "192.168.22.9";
$usuario = "turma143p2";
$senha = "sucesso@143";
$bd = "143p2";


$con = new mysqli($host, $usuario, $senha, $bd);


if ($con -> connect_errno){
echo "Falha na Conexão: (".$con->connect_errno.")".$con-> connect_error;
}


else{
echo "Conectado:" . $con->host_info . "\n";
}

?>