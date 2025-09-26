<?php
require_once "../../INCLUDE/verificarLogin.php";
include "../../INCLUDE/vlibras.php";
include "../../INCLUDE/alertas.php";
include "../../INCLUDE/Menu_adm.php";
require_once '../../CONTROLLER/AjustesController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new AjustesController();
$controller->handleRequest();
?>