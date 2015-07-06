<?php

session_start();

if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {

    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/listaChequeoControlador/listaChequeoContralador.php';
include_once '../../controlador/utilidades/utilidades.php';

$utilidades = new utilidades();
$chequeoControl = new listaChequeoControlador();

$reporte = "";
$number = 0;
$mostrarGuardar = 'none';

$mostrarMsj = "none";
$tipoMsj = "";
$msj = "";
$mostrarTabla = "none";

$psicologos = $chequeoControl->consultarPsicologos();

if (isset($_GET['empInt']) && isset($_GET['req']) && isset($_GET['id']) && $_POST['accion'] == ''){

    $empInt = $_GET['empInt'];
    $req = $_GET['req'];
    $idUser = $_GET['id'];

    $reporte = $chequeoControl->consultarDocumentos($empInt, $req, $idUser);
    
     if ($reporte != null && $reporte != "-1" && $reporte != "-2") {
        
        $mostrarGuardar = 'in-line';
        $mostrarTabla = "block";
        
        $logReq = $chequeoControl->consultarLogReq($empInt, $req, $idUser);        
        $documentoSoporte = $logReq['soporteDerogados'];
        
    }else if ($reporte == "-1"){
        
         $mostrarMsj = "block";
         $tipoMsj = "Advertencia: ";
         $msj = " No se ecncuentran registros asociados con los datos ingresados.";
        
    }else if($reporte == "-2"){
        
         $mostrarMsj = "block";
         $tipoMsj = "Información: ";
         $msj = "Esta requisición ya se encuentra archivada.Por lo tanto no se pueden realizar modificaciones.";
        
    }
}

if ($_POST['accion'] == 'Guardar' || $_POST['accion'] == 'Finalizar') {

    $i = 1;
    $idUserReg = $_SESSION['usuCodigo'];
    $req = $_POST['requisicion'];
    $empInt = $_POST['empresaInt'];
    $idUser = $_POST['idUser'];
    $rutaArchivo = $_POST['rutaArchivoOculto'];
    $flgError = false;
    $flgPresentados = true;
    $resulUpdate = true;
    $resulInsert = true;
    $existeSoporteDerogado = $_POST['existeSoporteDerogadoOculto'];
    $flgderogados = false;    
    
    if($existeSoporteDerogado == '1' && $rutaArchivo == ''){
        
        $consultaLog = $chequeoControl->consultarLogReq($empInt, $req, $idUser);
        $rutaArchivo = $consultaLog[0]['soporteDerogados'];
        
    }    

    $inicioTranSac = $utilidades->iniciarTransaccion();    

    foreach ($_POST as $pos => $valor) {

        $estadoDoc = '';

        if (isset($_POST['idLogDoc' . $i]) && $_POST['idLogDoc' . $i] != ''){

            $idLogDoc = $_POST['idLogDoc' . $i];

            if (isset($_POST['presentado' . $i]) && $_POST['presentado' . $i] == 'on') {

                $estadoDoc = 1;
            }

            if (isset($_POST['noPresentado' . $i]) && $_POST['noPresentado' . $i] == 'on') {

                $estadoDoc = 2;
                $flgPresentados = false;
            }

            if (isset($_POST['noAplica' . $i]) && $_POST['noAplica' . $i] == 'on') {

                $estadoDoc = 3;
                
            }
            
            if (isset($_POST['derogado' . $i]) && $_POST['derogado' . $i] == 'on') {

                $estadoDoc = 4;
                
            }
            
            $fechaReg = date('Y-m-d H:i:s');
            $resulUpdate = $chequeoControl->actLogDoc($empInt, $req, $idUser,$idLogDoc, $estadoDoc, $idUserReg,$fechaReg);

            if ($resulUpdate == false) {

                $flgError = true;
            }
            
        } else {

            $idDoc = $_POST['idDoc' . $i];

            if (isset($_POST['presentado' . $i]) && $_POST['presentado' . $i] == 'on') {

                $estadoDoc = 1;
            }

            if (isset($_POST['noPresentado' . $i]) && $_POST['noPresentado' . $i] == 'on') {

                $estadoDoc = 2;
                $flgPresentados = false;
            }

            if (isset($_POST['noAplica' . $i]) && $_POST['noAplica' . $i] == 'on') {

                $estadoDoc = 3;
            }
            
            if (isset($_POST['derogado' . $i]) && $_POST['derogado' . $i] == 'on') {

                $estadoDoc = 4;
                $flgDerogados = true;
            }

            if ($estadoDoc != '') {             
                
                $fechaReg = date('Y-m-d H:i:s');                
                $resulInsert = $chequeoControl->insertLogDoc($empInt, $req, $idUser, $estadoDoc, $idDoc, $idUserReg,$fechaReg);
            }

            if ($resulInsert == false) {

                $flgError = true;
            }
        }

        $i++;
    }

    if ($flgError == false) {
        
        if ($rutaArchivo == '' && $flgDerogados == true) {

            $flgPresentados = false;
        }
        
        if($_POST['accion'] == 'Guardar'){
            
            $estado = 1;
        }
        
        if($_POST['accion'] == 'Finalizar' && $flgPresentados == false){
            
            $estado = 2;
            $idPsicologo = $_POST['idPsico'];
        }
        
        if($_POST['accion'] == 'Finalizar' && $flgPresentados == true){
            
            $estado = 3;
            $idPsicologo = $_POST['idPsico'];
        }
        
        $fechareg = date('Y-m-d H:i:s');
            
        $consulLogReq = $chequeoControl->consultarLogReq($empInt, $req, $idUser);
        
        if(count($consulLogReq) > 0){
            
            $fechareg = date('Y-m-d H:i:s');            
            $resulLogReq = $chequeoControl->actualizarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado,$idUserReg,trim($rutaArchivo));
                        
        }else{
            
            $fechareg = date('Y-m-d H:i:s');            
            $resulLogReq = $chequeoControl->registrarLogReq($empInt, $req, $idUser, $idPsicologo = '', $fechareg, $estado,$idUserReg,trim($rutaArchivo));
        }        

        if ($resulLogReq != null) {

            $utilidades->commitTransaccion();
            header("Location: http://192.168.1.203/Proyectos/ExamenesMedicos/vista/listaChequeoVista/listaChequeoVista.php?empInt=$empInt&req=$req&id=$idUser");           
                    
        }else{
            
           $utilidades->rollbackTransaccion();
           $mostrarMsj = "block";
           $tipoMsj = "Advertencia";
           $msj = "Ha ocurrido un error en el registro del log, por favor intentelo nuevamente. Si el error persiste por favor comuniquese con el departamento de desarrollo.";
           
        }
        
    } else {

        $utilidades->rollbackTransaccion();
        
        $mostrarMsj = "block";
        $tipoMsj = "Advertencia";
        $msj = "Ha ocurrido un error en el registro, por favor intentelo nuevamente. Si el error persiste por favor comuniquese con el departamento de desarrollo.";
        
    }
}

if ($_POST['accion'] == 'Consultar') {

    $empInt = $_POST['empresaInt'];
    $req = $_POST['requisicion'];
    $idUser = $_POST['idUser'];   

    $reporte = $chequeoControl->consultarDocumentos($empInt, $req, $idUser);

    if ($reporte != null && $reporte != "-1" && $reporte != "-2") {
        
        $mostrarGuardar = 'in-line';
        $mostrarTabla = "block";
        
    }else if ($reporte == "-1"){
        
         $mostrarMsj = "block";
         $tipoMsj = "Advertencia: ";
         $msj = " No se ecncuentran registros asociados con los datos ingresados.";
        
    }else if($reporte == "-2"){
        
         $mostrarMsj = "block";
         $tipoMsj = "Información: ";
         $msj = "Esta requisición ya se encuentra archivada.Por lo tanto no se pueden realizar modificaciones.";
        
    }
}

$consutaEmpInt = $utilidades->consultarEmpInterna();

$smarty->assign("mostrarMsj", $mostrarMsj, true);
$smarty->assign("tipoMsj", $tipoMsj, true);
$smarty->assign("msj", $msj, true);
$smarty->assign("mostrarTabla",$mostrarTabla,true);

$smarty->assign("number", $number, true);
$smarty->assign("empresaInterna", $consutaEmpInt, true);
$smarty->assign("idEmpInt", $empInt, true);
$smarty->assign("req", $req, true);
$smarty->assign("idUser", $idUser, true);
$smarty->assign("reporte", $reporte, true);
$smarty->assign("psicologos", $psicologos, true);
$smarty->assign("mostrarGuardar", $mostrarGuardar, true);

$smarty->display('../../web/listaChequeoWeb/listaChequeoWeb.html.tpl');
?>

