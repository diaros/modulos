<?php
session_start();
//session_unset();
session_destroy();
header("Location: ../../vista/logueoVista/logueoVista.php");
?>
