<?php

include '../../controlador/gestionContratosControlador/gestionContratosControlador.php';
include_once '../../controlador/utilidades/utilidades.php';

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarObservacion'){

    $gestionControl = new gestionContratosControlador();
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];

    $resulConsulta = $gestionControl->consultarObservacion($empInt, $req, $idUser);

    if ($resulConsulta != null) {

        echo json_encode($resulConsulta[0]['OBS_ERVA']);
        
    }else{
        
        echo("-1");
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarCartaInformativa'){

    $gestionControl = new gestionContratosControlador();
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $accion = $_POST['accion'];

    $usuariosxReq = $gestionControl->consultarUsuariosxReq($empInt, $req, $idUser, $att = '', $cita = '', $direccion = '', $accion);

    if ($usuariosxReq != null){
        
        echo json_encode($usuariosxReq);
              
    } else{
        
        echo("-1");
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarcartaPresentacion') {

    $gestionControl = new gestionContratosControlador();
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $att = $_POST['att'];
    $cita = $_POST['cita'];
    $direccion = $_POST['direccion'];
    $accion = $_POST['accion'];

    $usuariosxReq = $gestionControl->consultarUsuariosxReq($empInt, $req, $idUser, $att, $cita, $direccion, $accion);

    if ($usuariosxReq != null) {
        
        echo ($usuariosxReq);
        
    } else{
        
        echo("-1");
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarCertificadoInduccion') {

    $gestionControl = new gestionContratosControlador();
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $accion = $_POST['accion'];

    $usuariosxReq = $gestionControl->consultarUsuariosxReq($empInt, $req, $idUser, $att = '', $cita = '', $direccion = '', $accion);

    if ($usuariosxReq != null) {
        
        echo json_encode($usuariosxReq);
              
    } else {
        
        echo("-1");
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarClausulaAdicional') {

    $gestionControl = new gestionContratosControlador();
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $accion = $_POST['accion'];

    $usuariosxReq = $gestionControl->consultarUsuariosxReq($empInt, $req, $idUser, $att = '', $cita = '', $direccion = '', $accion);

     if ($usuariosxReq != null) {
        
        echo json_encode($usuariosxReq);
              
    }else{
        
        echo("-1");
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarDecreto3377') {

    $gestionControl = new gestionContratosControlador();
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $accion = $_POST['accion'];

    $usuariosxReq = $gestionControl->consultarUsuariosxReq($empInt, $req, $idUser, $att = '', $cita = '', $direccion = '', $accion);

     if ($usuariosxReq != null) {
        
        echo json_encode($usuariosxReq);
              
    }else{
        
        echo("-1");
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarContrato') {

    $gestionControl = new gestionContratosControlador();
    $utilidades = new utilidades();

    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $logo = $_POST['logo'];
  //$perSal = $_POST['perSal'];
    $tipContra = $_POST['tipContra'];
    $fechaFin = $_POST['fechaFin'];
    $accion = $_POST['accion'];
    $adicionales = $_POST['adicionales'];

    $resulBegin = $utilidades->iniciarTransaccion();

    if ($resulBegin != null) {

        $usuariosxReq = $gestionControl->generarContrato($empInt, $req, $idUser, $logo,$tipContra, $fechaFin, $accion,$adicionales);

        if ($usuariosxReq != null) {

            $utilidades->commitTransaccion();
            echo($usuariosxReq);
        } else {

            $utilidades->rollbackTransaccion();
            echo("-1");
        }
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'generarPaqueteContrato') {
    
    $gestionControl = new gestionContratosControlador();
    $utilidades = new utilidades();
    
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $logo = $_POST['logo'];
    $perSal = $_POST['perSal'];
    $tipContra = $_POST['tipContra'];
    $fechaFin = $_POST['fechaFin'];
    $accion = $_POST['accion'];

    $resulBegin = $utilidades->iniciarTransaccion();

    if ($resulBegin != null) {

        $usuariosxReq = $gestionControl->paqueteContrato($empInt, $req, $idUser, $logo, $perSal, $tipContra, $fechaFin, $accion);

        if ($usuariosxReq != null) {

            $utilidades->commitTransaccion();
            echo(json_encode($usuariosxReq));
            
        } else {

            $utilidades->rollbackTransaccion();
            echo("-1");
        }
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarUsuariosxReq'){
    
    $gestionControl = new gestionContratosControlador();
    
    $empInt = $_POST['idEmpInt'];
    $req = $_POST['req']; 
    $accion = $_POST['accion'];
    
    $reporte = $gestionControl->consultarUsuariosxReq2($empInt, $req);
      
    foreach ($reporte as $fila) {

        $json[$fila['cod_empl']] = utf8_encode($fila['nom_empl']).utf8_encode($fila['ape_empl']);
    }

    echo json_encode($json);
    
}

?>