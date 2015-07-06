<?php

include "../../controlador/listaChequeoControlador/listaChequeoContralador.php";
include "../../controlador/consultaRequisicionesControlador/consultaRequisicionesControlador.php";

$listaChequeoControl = new listaChequeoControlador();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarReq'){
    
    $consultaReqControl = new consultaRequisicionesControlador();
    
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    
    $reporte=$consultaReqControl->consultarDocumentos($empInt, $req, $idUser);
    
    if($reporte != null){
     
        echo(json_encode($reporte));
        
    }else{
        
        echo("-1");
    }    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarPdf') {

    $chequeoControl = new listaChequeoControlador();

    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];

    $resul = $chequeoControl->generarPdf($empInt, $req, $idUser);

    if ($resul != null) {
        
        echo (json_encode($resul));
        
    } else {

        echo '-1';
    }
}


?>
