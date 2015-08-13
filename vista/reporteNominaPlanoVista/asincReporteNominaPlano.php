<?php

include '../../controlador/reporteNominaPlanoControlador/reporteNominaPlanoControl.php';
include_once '../../controlador/utilidades/utilidades.php';

session_start();

$reporteNomimaPlanoControl = new reporteNominaPlanoControl();
$utilidades = new utilidades();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaClientes'){

    $idEmpInt = $_POST['idEmpInt'];
    $idUser = $_SESSION['usuCodigo'];

    $resulConsultaCliente = $reporteNomimaPlanoControl->consultarClietneBySupervisor($idUser, $idEmpInt);

    if ($resulConsultaCliente != false) {

        foreach ($resulConsultaCliente as $fila) {

            $json[$fila['nit']] = trim(utf8_encode($fila['nombre']));
        }
        
        echo json_encode($json);
        
    } else {
        
        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaCC') {

    $idEmpInt = $_POST['idEmpInt'];
    $idEmpCli = $_POST['idEmpUsu'];

    $resulConsultaCC = $reporteNomimaPlanoControl->cosultarCentroCostos($idEmpInt, $idEmpCli);

    if ($resulConsultaCC != false) {

//        foreach ($resulConsultaCC as $fila) {
//
//            $json[trim($fila['act_econ'])] = trim(trim(utf8_encode($fila['nom_clie'])));
//        }

        echo json_encode($resulConsultaCC);
    } else {

        echo '-1';
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 'generarPlantilla'){
    
    $empresaInt = $_POST['empInt'];
    $empUsu = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $mes = $_POST['mes'];
    $periocidad = $_POST['periocidad'];
    
    $consultaUsuarios = $reporteNomimaPlanoControl->consultarUsuarios($empresaInt, $centroCosto, $ciudad);   
    $consultarConceptos = $reporteNomimaPlanoControl->consultaConceptos($empresaInt,$empUsu);
    $resulgenerarPlantilla = $reporteNomimaPlanoControl->generarPlantilla($consultaUsuarios,$periocidad,$consultarConceptos);
    
    if($resulgenerarPlantilla != null){        
        
        echo json_encode($resulgenerarPlantilla);
        
        
    }else{
        
        echo("-1");
        
    }
    
}

if ($_FILES['planillaNomina']['name'] != '') {
    
    $empresaInt = trim($_POST['empIntOculto']);
    $empUsu = trim($_POST['empCliOculto']);
    $centroCosto = trim ($_POST['centroCostoOculto']);
    $ciudad = trim($_POST['ciudadOculto']);
    $mes = trim($_POST['mesOculto']);
    $periocidad = trim($_POST['periocidadOculto']);
    
    $idUser = $_SESSION['usuCodigo'];
    $fechaReg =  date('Y-m-d-H-i-s');
    
    $rutaArchivosTemporales = '../../temporales/planillasNomina/';
    $nombreArchivo =  $empresaInt."_".$empUsu."_".$centroCosto."_".$idUser."_".$fechaReg."_".$_FILES['planillaNomina']['name'];
    $rutaArchivo = $rutaArchivosTemporales.$nombreArchivo;
    $resultaSubirArchivo = move_uploaded_file($_FILES['planillaNomina']['tmp_name'], $rutaArchivosTemporales . $nombreArchivo);
    
    if($resultaSubirArchivo == true){
        
        $utilidades->iniciarTransaccion();
        
        $resulRegDatos = $reporteNomimaPlanoControl->abrirArchivo($rutaArchivo,$empresaInt,$empUsu ,$centroCosto,$ciudad,$mes,$periocidad);
        
        if($resulRegDatos === true){            
             
            $resulIdPlanilla = $reporteNomimaPlanoControl->getIdentityPlanilla();
            $utilidades->commitTransaccion(); 
            $_SESSION['nomSoporteNomina'] = $nombreArchivo;
            
            echo json_encode($resulIdPlanilla);            
            
        } else {

            $utilidades->rollbackTransaccion();
            echo json_encode($resulRegDatos);
        }
        
    }else{
        
       echo("-1");
        
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarRegistro'){
    
    
    $idReg = $_POST['idReg'];    
    $resulConsulta = $reporteNomimaPlanoControl->consultarDatosRegByIdPlanilla($idReg);
    
    if($resulConsulta != null){        
        
        echo json_encode($resulConsulta);
        
        
    }else if($resulConsulta === null){
       
        echo '0';
        
    }else if($resulConsulta === false){
        
        echo '-1';
    }
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consulTarDias'){    
    
    $idPlanilla = $_POST['idPlanilla'];
    $idUser = $_POST['idUsuario'];
    
    $resulConsulta = $reporteNomimaPlanoControl->consultarDiasByUsuario($idPlanilla,$idUser);
    
    if($resulConsulta != null){
        
        echo json_encode($resulConsulta);
        
    }else{
        
        echo("-1");
        
    }
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarConceptos'){
    
    $idPlanilla = $_POST['idPlanilla'];
    $idUser = $_POST['idUsuario'];
    
    $resulConsulta = $reporteNomimaPlanoControl->consultarConceptosByUsuario($idPlanilla,$idUser);
    
    if($resulConsulta != null){
        
        echo json_encode($resulConsulta);
        
    }else{
        
        echo("-1");
        
    } 
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarTotalConceptos'){
   
    $idPlanilla = $_POST['idPlanilla'];
    
    $resulConsulta = $reporteNomimaPlanoControl->consultarTotalConceptos($idPlanilla);
    
    if($resulConsulta != null){
        
        echo json_encode($resulConsulta);
        
    }else {
        
        echo "-1";
    }
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultartotalDomFest'){
    
    $idPlanilla = $_POST['idPlanilla'];
    
    $resulConsulta = $reporteNomimaPlanoControl->consultarTotalDomFest($idPlanilla);
    
    if($resulConsulta != null){
        
        echo json_encode($resulConsulta);
        
    }else {
        
        echo "-1";
    }   
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarDetalleConceptos'){
    
    $idPlanilla = $_POST['idPlanilla'];    
    $resulConsulta = $reporteNomimaPlanoControl->consultarDetConceptos($idPlanilla);
    
    if($resulConsulta != null){        
        echo json_encode($resulConsulta);        
    }else {        
        echo "-1";
    }
    
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'finalizarPlanilla'){
    
    $idPlanilla = $_POST['idPlanilla'];    
    $resulConsulta = $reporteNomimaPlanoControl->finalizarPlanilla($idPlanilla);
    
    if($resulConsulta != null){  
        
        $rutaOrg = $_SESSION['archivoNomina'];
        
        $resulCopy = copy("../../temporales/planillasNomina/".$_SESSION['nomSoporteNomina']."", "../../temporales/soportesNomina/".$_SESSION['nomSoporteNomina']."");
        
        if($resulCopy == true){
            
            unlink("../../temporales/planillasNomina/".$_SESSION['nomSoporteNomina']."");
            echo "1";        
            
        }else{            
            echo "-1"; 
        }       
        
    }else {        
       
    }
    
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'eliinarPlanilla'){
    
    $idPlanilla = $_POST['idPlanilla'];    
    $resulConsulta = $reporteNomimaPlanoControl->eliminarPlanilla($idPlanilla);
    
    if($resulConsulta != null){        
        unlink("../../temporales/planillasNomina/".$_SESSION['nomSoporteNomina']."");
        unlink("../../temporales/soportesNomina/".$_SESSION['nomSoporteNomina']."");
        echo "1";        
    }else {        
        echo "-1";
    } 
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'cantUserSinReg'){
    
    $idPlanilla = $_POST['idPlanilla'];  
    $empInt = $_POST['idEmpInt'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
     
    $resulConsulta = $reporteNomimaPlanoControl->cantUsuariosSinRegistrar($idPlanilla,$empInt, $centroCosto, $ciudad);
    
    if($resulConsulta != null){        
        
        echo json_encode($resulConsulta[0]['cantidad']);        
        
    }else if($resulConsulta === null){        
        
        echo "0";
        
    }else if($resulConsulta === false){
        
        echo "-1";
    }
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'valUserSinReg'){
    
    $idPlanilla = $_POST['idPlanilla'];  
    $empInt = $_POST['idEmpInt'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
     
    $resulConsulta = $reporteNomimaPlanoControl->valUsuariosSinRegistrar($idPlanilla,$empInt, $centroCosto, $ciudad);
    
    if($resulConsulta != null){        
        
        echo json_encode($resulConsulta);        
        
    }else if($resulConsulta === null){        
        
        echo "0";
        
    }else if($resulConsulta === false){
        
        echo "-1";
    }
    
}

?>

