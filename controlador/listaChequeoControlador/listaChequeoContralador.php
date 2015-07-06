<?php

include_once '../../datos/listaChequeoDatos/listaChequeoDatos.php';
include_once '../../datos/gestionContratosDatos/gestionContratosDatos.php';
include_once '../../controlador/utilidades/utilidades.php';
include_once '../../libs/fpdf17/fpdf.php';

class listaChequeoControlador {

    function __construct(){}

    function consultarDocumentos($empInt, $req, $idUser){

        $consultarDocDatos = new listaChequeoDatos();
        $gestionContratos = new gestionContratosDatos();

        $resExistenciaUser = $gestionContratos->consultarUsuariosxReq($empInt, $req, $idUser);

        if ($resExistenciaUser != null) {
            
            $reqAux = $this->consultarLogReq($empInt, $req, $idUser);
            
            if($reqAux[0]['id_estado'] != 4 && $reqAux[0]['id_estado'] != 5 && $reqAux != null){

                $reporte = $consultarDocDatos->consultarDocumentos($empInt, $req, $idUser);
                return $reporte;           
            
            }else if($reqAux[0]['id_estado'] == 4 || $reqAux[0]['id_estado'] == 5){
                
                return "-2";
                
            }else if($reqAux == null){
                
                $reporte = $consultarDocDatos->consultarDocumentos($empInt, $req, $idUser);
                return $reporte;      
                
            }
                    
        }else{
            
            return "-1";
            
        }
    }

    function actLogDoc($empInt, $req, $idUser,$idLogDoc, $estadoDoc, $idUserReg,$fechaReg) {

        $listaDocDatos = new listaChequeoDatos();
        $gestionContratos = new gestionContratosDatos();
        
        $resExistenciaUser = $gestionContratos->consultarUsuariosxReq($empInt, $req, $idUser);
        
        if($resExistenciaUser != null){
            
            $ressulExist = $listaDocDatos->consultarLogDocumento($idLogDoc);
            
            if($estadoDoc != $ressulExist[0]['id_estado']){
                
                $resUpdate = $listaDocDatos->actLogDoc($idLogDoc, $estadoDoc, $idUserReg,$fechaReg);
                return $resUpdate;
                
            }else{
                
                return true;
            }          
            
        }else{
            
            return false;
        }    
    }

    function insertLogDoc($empInt, $req, $idUser, $estadoDoc, $idDoc, $idUserReg,$fechaReg) {

        $listaDocDatos = new listaChequeoDatos();
        $gestionContratos = new gestionContratosDatos();
        
        $resExistenciaUser = $gestionContratos->consultarUsuariosxReq($empInt, $req, $idUser);
        
         if($resExistenciaUser != null){
             
            $resInsert = $listaDocDatos->insertLogDoc($empInt, $req, $idUser, $estadoDoc, $idDoc, $idUserReg,$fechaReg);
            return $resInsert;
             
         }else{
             
             return false;
             
         }
        
        
    }
    
    function generarPdf($empInt, $req, $idUser) {

        session_start();
        $pdf = new FPDF();
        $utilidades = new utilidades();
        
        $listaDocDatos = new listaChequeoDatos();
        $gestionContratosDatos = new gestionContratosDatos();

//      $arregloNombre = explode("-", $_SESSION['usuNombres']);
//      $nombre = $arregloNombre[0];
        $consultaLogReq = $this->consultarLogReq($empInt, $req, $idUser);
        $idUserReg = $consultaLogReq[0]['id_user_reg'];
        
        $consultaUserAut = $utilidades->consultarUserAutById($idUserReg);
        $nombreUser = $consultaUserAut['0']['USU_NOMBRES']." ".$consultaUserAut['0']['USU_APELLIDOS'] ;
              

        $usuarios = $gestionContratosDatos->consultarUsuariosxReq($empInt, $req, $idUser);
        $listaChequeo = $listaDocDatos->consultarDocumentos($empInt, $req, $idUser);

        if ($listaChequeo != null && $usuarios != null) {

            $pdf->AddPage();
            $pdf->SetFont('Times', 'B', 8);

            $pdf->Cell(180, 10, 'PROCESO', 0, 0, 'C');
            $pdf->Cell(5, 10, 'Codigo:FO-CON-01', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(180, 10, 'CONTRATACION', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(180, 10, 'LISTA CHEQUEO DOCUMENTOS', 0, 0, 'C');
            $pdf->Ln(2);
            //$pdf->Image($imgsrc, 10, 8, 33);
            $pdf->Ln(10);
            $pdf->Cell(50, 10, 'NOMBRE EMPLEADO:', 0, 0, 'L');
            $pdf->Cell(50, 10, ' ' . trim($usuarios[0]['nom_empl']) . ' ' . trim($usuarios[0]['ape_empl']) . ' ', 0, 1, 'L');
            $pdf->Cell(10, 4, 'C.C:', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 1, 0, 'L');
            $pdf->Cell(10, 4, 'T.I:', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 1, 0, 'L');
            $pdf->Cell(20, 4, 'NO:', 0, 0, 'C');
            $pdf->Cell(10, 4, ' ' . $usuarios[0]["COD_EMPL"] . ' ', 0, 1, 'L');
            $pdf->Ln(5);

            if ($empInt == 1) {

                $pdf->Cell(15, 4, 'LISTOS:', 0, 0, 'L');
                $pdf->Cell(5, 4, 'X', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
                $pdf->Cell(35, 4, 'VISION Y MARKETING:', 0, 0, 'L');
                $pdf->Cell(5, 4, '', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
                $pdf->Cell(25, 4, 'TERCERIZAR:', 0, 0, 'L');
                $pdf->Cell(5, 4, '', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
            }

            if ($empInt == 2) {

                $pdf->Cell(15, 4, 'LISTOS:', 0, 0, 'L');
                $pdf->Cell(5, 4, '', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
                $pdf->Cell(35, 4, 'VISION Y MARKETING:', 0, 0, 'L');
                $pdf->Cell(5, 4, 'X', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
                $pdf->Cell(25, 4, 'TERCERIZAR:', 0, 0, 'L');
                $pdf->Cell(5, 4, '', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
            }

            if ($empInt == 3) {

                $pdf->Cell(15, 4, 'LISTOS:', 0, 0, 'L');
                $pdf->Cell(5, 4, '', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
                $pdf->Cell(35, 4, 'VISION Y MARKETING:', 0, 0, 'L');
                $pdf->Cell(5, 4, '', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
                $pdf->Cell(25, 4, 'TERCERIZAR:', 0, 0, 'L');
                $pdf->Cell(5, 4, 'X', 1, 0, 'L');
                $pdf->Cell(5, 4, '', 0, 0, 'L');
            }

            $pdf->Ln(10);

            $pdf->Cell(5, 4, 'SI', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(5, 4, 'NO', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(5, 4, 'N/A', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(5, 4, 'DR', 0, 1, 'L');

            $i = 1;

            foreach ($listaChequeo as $valor) {

                $linea = utf8_decode($valor['descripcion']);

                if ($valor['estado'] == 1) {

                    $pdf->Cell(6, 4, 'X', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(10, 4, '', 0, 0, 'L');
                    $pdf->Cell(35, 4, '' . $linea . ' ', 0, 1, 'L');
                    $pdf->Ln(2);
                }

                if ($valor['estado'] == 2) {

                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, 'X', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(10, 4, '', 0, 0, 'L');
                    $pdf->Cell(35, 4, '' . $linea . ' ', 0, 1, 'L');
                    $pdf->Ln(2);
                }

                if ($valor['estado'] == 3) {

                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, 'X', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(10, 4, '', 0, 0, 'L');
                    $pdf->Cell(35, 4, '' . $linea . ' ', 0, 1, 'L');
                    $pdf->Ln(2);
                }
                
                if ($valor['estado'] == 4) {

                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, 'X', 1, 0, 'L');
                    $pdf->Cell(10, 4, '', 0, 0, 'L');
                    $pdf->Cell(35, 4, '' . $linea . ' ', 0, 1, 'L');
                    $pdf->Ln(2);
                }

                if ($valor['estado'] == '') {

                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(5, 4, '', 0, 0, 'L');
                    $pdf->Cell(6, 4, '', 1, 0, 'L');
                    $pdf->Cell(10, 4, '', 0, 0, 'L');
                    $pdf->Cell(35, 4, '' . $linea . ' ', 0, 1, 'L');
                    $pdf->Ln(2);
                }

                $i++;
            }

            $pdf->Ln(2);
            $pdf->Cell(6, 4, '', 1, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(6, 4, '', 1, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(6, 4, '', 1, 0, 'L');
            $pdf->Cell(10, 4, '', 0, 0, 'L');
            $pdf->Cell(15, 4, 'OTROS', 0, 0, 'L');
            $pdf->Cell(35, 4, '__________________________________________________________________________________', 0, 0, 'L');

            $pdf->Ln(5);
            $pdf->Cell(6, 4, '', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(6, 4, '', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(6, 4, '', 0, 0, 'L');
            $pdf->Cell(10, 4, '', 0, 0, 'L');
            $pdf->Cell(15, 4, '', 0, 0, 'L');
            $pdf->Cell(35, 4, '__________________________________________________________________________________', 0, 0, 'L');

            $pdf->Ln(5);
            $pdf->Cell(6, 4, '', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(6, 4, '', 0, 0, 'L');
            $pdf->Cell(5, 4, '', 0, 0, 'L');
            $pdf->Cell(6, 4, '', 0, 0, 'L');
            $pdf->Cell(10, 4, '', 0, 0, 'L');
            $pdf->Cell(15, 4, '', 0, 0, 'L');
            $pdf->Cell(35, 4, '__________________________________________________________________________________', 0, 0, 'L');

            $pdf->Ln(5);
//            $pdf->Cell(0, 20, '(*)Opcionales dependiendo del Cliente o Cargo', 0, 0, 'L');

            $pdf->Ln(10);
            $pdf->Cell(25, 20, 'REVISADO POR:', 0, 0, 'L');
            $pdf->Cell(90, 20, $nombreUser, 0, 0, 'L');

            $pdf->Cell(15, 20, 'FECHA:', 0, 0, 'r');
            $pdf->Cell(50, 20, date('d-m-Y'), 0, 0, 'L');

            $fechaDoc = date('d-m-Y_H-i-s');
            $ruta = "../../temporales/listaChequeo/listaChequeo" . $fechaDoc . ".pdf";
            $pdf->Output($ruta);
            return($ruta);
        }
    }

    function consultarPsicologo($psico) {

        $utilidades = new utilidades();
        $resulConsulta = $utilidades->consultarPsicologoByLetra($psico);
        return $resulConsulta;
    }

    function consultarPsicologos() {

        $utilidades = new utilidades();
        $resulConsulta = $utilidades->consultarPsicologos();
        return $resulConsulta;
    }

    function registrarLogReq($empInt, $req, $idUser, $idPsicologo = '', $fechareg, $estado,$idUserReg,$rutaArchivo = ''){

        $listaDocDatos = new listaChequeoDatos();
        
        $resInsert = $listaDocDatos->registrarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado,$idUserReg,$rutaArchivo);
        return $resInsert;

//        if ($estado == 2) {
//
//            $resInsert = $listaDocDatos->registrarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado);
//            return $resInsert;
//        }
//
//        if ($estado == 3) {
//
//            $resInsert = $listaDocDatos->registrarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado);
//            return $resInsert;
//        }
    }

    function actualizarLogReq($empInt, $req, $idUser,$idPsicologo, $fechareg, $estado,$idUserReg,$rutaArchivo = ''){

        $listaDocDatos = new listaChequeoDatos();  
        
        if($rutaArchivo == ''){           
            
            $consultaLogReq = $this->consultarLogReq($empInt, $req, $idUser);
            $rutaArchivo = $consultaLogReq[0]['soporteDerogados'];
            
        }
        
        $resulExist = $this->consultarLogReq($empInt, $req, $idUser);
        
        if($resulExist[0]['id_estado'] != $estado || trim($resulExist[0]['soporteDerogados']) != $rutaArchivo){
            
            $resInsert = $listaDocDatos->actualizarLogReq($empInt, $req, $idUser, $idPsicologo, $fechareg, $estado,$idUserReg,$rutaArchivo);
            return $resInsert;
            
        }else{
            
            return true;
        }
        
       

    }

    function consultarLogReq($empInt, $req, $idUser) {

        $listaDocDatos = new listaChequeoDatos();
        $consulta = $listaDocDatos->consultarLogReq($empInt, $req, $idUser);
        return $consulta;
    }

    function enviarNotificacion($mailPsicologo, $listaDocumentos, $idUser, $req) {

        $utilidades = new utilidades();
        $asunto = "Notificacion documentos faltantes";
        $body = "Coridal saludo <br>Se adjunta listado de documentos faltantes para el usuario con numero de identificacion " . $idUser . " asociado a la requisición numero " . $req . " ";
        $resulEnvioMail = $utilidades->envioMail($asunto, $body, $mailPsicologo, $listaDocumentos);
        return $resulEnvioMail;
    }

    function consultarMailUsuario($idUser) {

        $utilidades = new utilidades();
        $resulConsulta = $utilidades->consultarMailByIdAUT($idUser);
        return $resulConsulta;
    }

}
?>

