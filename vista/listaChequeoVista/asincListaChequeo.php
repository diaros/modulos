<?php

include '../../controlador/listaChequeoControlador/listaChequeoContralador.php';
include_once '../../controlador/utilidades/utilidades.php';

if (isset($_POST['accion']) && $_POST['accion'] == 'generarPdf'){

    $chequeoControl = new listaChequeoControlador();

    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];

    $resul = $chequeoControl->generarPdf($empInt, $req, $idUser);

    if ($resul != null) {

        echo (json_encode($resul));
        
    }else{

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarSico') {

    $chequeoControl = new listaChequeoControlador();
    $psico = $_POST['texto'];

    $resulConsulta = $chequeoControl->consultarPsicologo($psico);

    if ($resulConsulta != false) {

        echo json_encode($resulConsulta);
    } else {

        echo("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'notificacion') {

    session_start();
    $chequeoControl = new listaChequeoControlador();
    $utilidades = new utilidades();
    $idUserReg = $_SESSION['usuCodigo'];

    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    $fechareg = date('Y-m-d');
    $rutaArchivo = $_POST['rutaArchivo'];

    if ($_POST['estado'] == '-1') {

        $idPsicologo = $_POST['idPsicologo'];
        $estado = 2;

        $resulBegin = $utilidades->iniciarTransaccion();

        if ($resulBegin != false) {

            $consultaExistencia = $chequeoControl->consultarLogReq($empInt, $req, $idUser);

            if (count($consultaExistencia) > 0) {

                $resultUpdate = $chequeoControl->actualizarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado, $idUserReg,$rutaArchivo);

                if ($resultUpdate != null) {

                    $mailPsicologo = $chequeoControl->consultarMailUsuario($idPsicologo);
                    //$listaDocumentos = $chequeoControl->generarPdf($empInt, $req, $idUser);
                    //$resulEnvioMail = $chequeoControl->enviarNotificacion($mailPsicologo[0]['USU_MAIL'], $listaDocumentos, $idUser, $req);

                    $resulEnvioMail = '1';

                    if ($resulEnvioMail != '-1') {

                        $utilidades->commitTransaccion();
                        echo("1");
                    } else {

                        $utilidades->rollbackTransaccion();
                        echo("-2");
                    }
                } else {
                    $utilidades->rollbackTransaccion();
                    echo ("-1");
                }
            } else if (count($consultaExistencia) == 0) {

                $resulInsert = $chequeoControl->registrarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado, $idUserReg,$rutaArchivo);

                if ($resulInsert != null) {

                    $mailPsicologo = $chequeoControl->consultarMailUsuario($idPsicologo);
                    //$listaDocumentos = $chequeoControl->generarPdf($empInt, $req, $idUser);
                    //$resulEnvioMail = $chequeoControl->enviarNotificacion($mailPsicologo[0]['sn_correo'], $listaDocumentos, $idUser, $req);
                    $resulEnvioMail = '1';

                    if ($resulEnvioMail != '-1') {

                        $utilidades->commitTransaccion();
                        echo("1");
                    } else {

                        $utilidades->rollbackTransaccion();
                        echo("-2");
                    }
                } else {
                    $utilidades->rollbackTransaccion();
                    echo ("-1");
                }
            }
        } else {
            echo ("-1");
        }
    }

    if ($_POST['estado'] == '1') {

        $idPsicologo = $_POST['idPsicologo'];
        $resulBegin = $utilidades->iniciarTransaccion();
        $estado = 3;

        if ($resulBegin != false) {

            $consultaExistencia = $chequeoControl->consultarLogReq($empInt, $req, $idUser);

            if (count($consultaExistencia) > 0) {

                $resultUpdate = $chequeoControl->actualizarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado, $idUserReg,$rutaArchivo);

                if ($resultUpdate != null) {

                    $mailPsicologo = $chequeoControl->consultarMailUsuario($idPsicologo);
                    //$listaDocumentos = $chequeoControl->generarPdf($empInt, $req, $idUser);
                    //$resulEnvioMail = $chequeoControl->enviarNotificacion($mailPsicologo[0]['sn_correo'], $listaDocumentos, $idUser, $req);



                    $resulEnvioMail = '1'; // provisional por pruebas

                    if ($resulEnvioMail != '-1') {

                        $utilidades->commitTransaccion();
                        echo("1");
                    } else {

                        $utilidades->rollbackTransaccion();
                        echo("-2");
                    }
                } else {

                    $utilidades->rollbackTransaccion();
                    echo ("-1");
                }
            } else {

                $resulInsert = $chequeoControl->registrarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado, $idUserReg,$rutaArchivo);

                if ($resulInsert != null) {

                    $utilidades->commitTransaccion();
                    echo("2");
                } else {

                    $utilidades->rollbackTransaccion();
                    echo ("-1");
                }
            }
        }
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarPsico'){
    
    $chequeoControl = new listaChequeoControlador();
    
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];
    
    $estadoReq = $chequeoControl->consultarLogReq($empInt, $req, $idUser);    
    $psicoAsociado = $estadoReq[0]['id_psicologo'];
    
    if($psicoAsociado != ''){
        
        echo (json_encode($psicoAsociado));
        
    }else{
        
        echo '-1';
        
    }
    
        
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarSoporte'){
    
    $chequeoControl = new listaChequeoControlador();
    
    $empInt = $_POST['empInt'];
    $req = $_POST['req'];
    $idUser = $_POST['idUser'];  
    
    $estadoReq = $chequeoControl->consultarLogReq($empInt, $req, $idUser);    
    $soporteDerogado = $estadoReq[0]['soporteDerogados'];
    
    if($soporteDerogado != ''){
        
        echo (json_encode($soporteDerogado));
        
    }else{
        
        echo '-1';
        
    }   
    
}

if ($_FILES['soporteDerogado']['name'] != ''){
    
    $empInt = $_POST['empresaInt'];
    $req = $_POST['reqOculto'];
    $idUser = $_POST['idUser'];
    
    $rutaArchivosTemporales = '../../temporales/soporteDerogados/';
    $nombreArchivo =  $empInt."_".$req."_".$idUser."_".$_FILES['soporteDerogado']['name'];
    $rutaArchivo = $rutaArchivosTemporales.$nombreArchivo;
    $resultaSubirArchivo = move_uploaded_file($_FILES['soporteDerogado']['tmp_name'], $rutaArchivosTemporales . $nombreArchivo);
    
    if($resultaSubirArchivo == true){
        
        echo($rutaArchivo);
        
    }elseif ($resultaSubirArchivo == false) {
        
        echo '-1';
        
    }
    
}

?>

