<?php

session_start();

if(!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    
    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

require_once '../../vista/general/componentesGenerales.php';

$smarty->display('../../web/paginaPrincipalWeb/paginaPrincipal.html.tpl');

?>


