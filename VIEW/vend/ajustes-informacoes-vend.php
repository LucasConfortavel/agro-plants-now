<?php
require_once "../../INCLUDE/verificarLogin.php";
include "../../INCLUDE/vlibras.php";
include "../../INCLUDE/alertas.php";
include "../../INCLUDE/Menu_vend.php";
require_once '../../CONTROLLER/AjustesVendedorController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new AjustesVendedorController();
$controller->handleRequest();
?>