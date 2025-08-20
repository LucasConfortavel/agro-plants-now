<?php
session_start();
session_unset();
session_destroy();

header("Location: ../VIEW/paginas-iniciais/pagina-de-login.php");
exit();
?>