<?php
session_start();
session_unset();
session_destroy();

header("Location: ../VIEW/paginas-iniciais/landing_page.php");
exit();
?>