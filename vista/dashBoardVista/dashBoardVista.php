<?php
session_start();

if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    
    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

include '../../vista/general/componentesGenerales.php';

$smarty->display('../../web/dashboardWeb/dashboardWeb.html.tpl');    

?>
