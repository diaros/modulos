<?php

include_once '../../controlador/logueoControlador/logueoControl.php';

$controLog = new controlLog();

if (isset($_POST['logueo']) && $_POST['logueo'] == 'S'){

    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];

    //$resLogueo = $controLog->logueo($usuario, $pass);
    $resLogueo = $controLog->logueo1($usuario, $pass);

    if ($resLogueo == false) {

        echo '-1';
        
    } else {

        echo '1';
    }
}

if (isset($_POST['recordarPass']) && $_POST['recordarPass'] == 'S'){

    $usuario = $_POST['nombreUsuario'];

    $resRecordarPass = $controLog->recordarPass($usuario);

    if ($resRecordarPass['return'] == '1') {

        echo '1';
        
    } else {

        echo '0';
    }
}

if (isset($_POST['logModulo']) && $_POST['logModulo'] == 'S') {
    
    $app = $_POST['app'];
    
    $resLogModulo = $controLog->logModulo($app);
    
    echo $resLogModulo;
    
}
?>