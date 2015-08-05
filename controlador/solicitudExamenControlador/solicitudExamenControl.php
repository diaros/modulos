<?php

include '../../datos/solicitudExamenDatos/solicitudExamenDatos.php';
include_once '../../controlador/utilidades/utilidades.php';
include '../../libs/fpdf17/fpdf.php';

//**\brief Clase control Solicitud examen  */ 
class solicitudExamenControl{
    
    function __construct() {}   
   
    public function consultarCargoByLetra($nomCarg,$empInt){
       //**\details \param nomcarg \param empInt funcion para consultar Cargo por caracter ingresado  */ 
       $solicitudExamen = new solicitudExamendatos();       
       $resulConsulta = $solicitudExamen->consultarCargoByLetra($nomCarg, $empInt);
       return $resulConsulta;
        
    }
    
    public function consultarCargoByEmpInt($idEmpInt){
        
       $solicitudExamen = new solicitudExamendatos();       
       $resulConsulta = $solicitudExamen->consultarCargoByEmpInt($idEmpInt);
       return $resulConsulta;
        
    }
    
    public function consultarLabByCiudad($idCiudad){
        
       $solicitudExamen = new solicitudExamendatos();       
       $resulConsulta = $solicitudExamen->consultarLabByCiudad($idCiudad);
       return $resulConsulta;
    }
    
    public function consultTipoFacCliente($idEmpInt, $idEmpCli) {
        
       $solicitudExamen = new solicitudExamendatos();       
       $resulConsulta = $solicitudExamen->consultTipoFacCliente($idEmpInt, $idEmpCli);
       return $resulConsulta;
        
    }
    
    public function consultarCentroCosto($idEmpInt, $idEmpCli){
        
       $solicitudExamen = new solicitudExamendatos();       
       $resulConsulta = $solicitudExamen->consultarCentroCosto($idEmpInt, $idEmpCli);
       
       if($resulConsulta == null){
           
           $resulConsulta = $solicitudExamen;
           
       }
       
       return $resulConsulta;        
    }
    
    public function consultarNivel($idEmpInt,$idEmpCli,$tipoFac,$arbClie,$idCliKac){
        
        $solicitudExamen = new solicitudExamendatos();
        $resulConsulta = $solicitudExamen->consultarNivel($idEmpInt,$idEmpCli,$tipoFac,$arbClie,$idCliKac);      
        return $resulConsulta;
    }
    
    public function registrarSolicitud($empInt,$empUsu,$centroCosto,$nivel,$ciudad,$lab,$idUser,$nomUser,$cargo,$idUserLog,$observ){
        
         $solicitudExamen = new solicitudExamendatos();
         
         $fechaP = date('Y-m-d');
         $consultarSeq = $solicitudExamen->consultarSeq();
         $seq = $consultarSeq[0]['seq']+1;
         
         $resulInsert = $solicitudExamen->registrarSolicitud($empInt, $empUsu, $centroCosto, $nivel, $ciudad, $lab,$idUserLog,$fechaP,$observ);
         
         if($resulInsert != false){           
             
             $resulInsertUser  =  $solicitudExamen->resgistrarUser($idUser,$nomUser,$cargo);
             
             if($resulInsertUser == false){
                 
                 return $resulInsertUser;
                 
             }else{
                 
                 return $seq;
             }
                     
         }else{
             
             return $resulInsert;
         }
        
    }
    
    public function consultarUsuarios($idOrden){
        
        $solicitudExamen = new solicitudExamendatos();
        $resulConsulta = $solicitudExamen->consultarUsuarios($idOrden);
        return $resulConsulta;      
        
    }
    
    public function registrarUsuario($idUser, $nomUser, $cargo, $idOrden){
         
       $solicitudExamen = new solicitudExamendatos();
       $resulInsert = $solicitudExamen->registrarUsuario($idUser, $nomUser, $cargo, $idOrden);
       return $resulInsert;
        
    }
    
    public function consultarUserOrden($idUser,$idOrden){
        
       $solicitudExamen = new solicitudExamendatos();
       $resulInsert = $solicitudExamen->consultarUserOrden($idUser,$idOrden);
       return $resulInsert;        
        
    }
    
    public function eliminarUser($idReg){
        
        $solicitudExamen = new solicitudExamendatos();
        $resulDelete = $solicitudExamen->eliminarUser($idReg);
        return $resulDelete;
        
    }
    
    public function eliminarExamen($idItem) {
        
        $solicitudExamen = new solicitudExamendatos();
        $resulDelete = $solicitudExamen->eliminarExamen($idItem);
        return $resulDelete;
        
    }
    
    public  function consultaExamenes($catego, $nit, $idEmpInt) {
     
         $solicitudExamen = new solicitudExamendatos();
         $resulConsulta = $solicitudExamen->consultaExamenes($catego, $nit, $idEmpInt);
         return $resulConsulta;      
        
    }  
    
    public function registrarExamen($idOrden,$idExam){
        
        $solicitudExamen = new solicitudExamendatos();
        $resulInsert = $solicitudExamen->registrarExamen($idOrden,$idExam);
        return $resulInsert;        
        
    }    
    
    public function consultarExamenesOrden($idOrden){
        
         $solicitudExamen = new solicitudExamendatos();
         $resulConsulta = $solicitudExamen->consultarExamenesOrden($idOrden);
         return $resulConsulta;      
        
    }
    
    public function consulExistenciaOrdenExam($idOrden,$idExam){
        
        $solicitudExamen = new solicitudExamendatos();
        $resulConsulta = $solicitudExamen->consulExistenciaOrdenExam($idOrden,$idExam);
        return $resulConsulta;        
        
    }
    
    public function finalizarSol($idOrden){
        
         $solicitudExamen = new solicitudExamendatos();
         $resulUpdate = $solicitudExamen->finalizarSol($idOrden);
         
         if($resulUpdate != false){
             
             $resulGenerarPFD = $this->generarPDF($idOrden);
             
             return $resulGenerarPFD;
                     
         }
         
         return $resulUpdate;
        
    }
    
    public function generarPDF($idOrden){
        
        $solicitudExamen = new solicitudExamendatos();
        $utilidades = new utilidades();
        
        $datosSolicitud = $solicitudExamen->consultarDatosSolicitud($idOrden);
        $consultaUsurios = $solicitudExamen->consultarUsuarios($idOrden);
        $consultaExamenes = $solicitudExamen->consultarExamenesOrden($idOrden);
        
        $fechaSolicitud = $datosSolicitud[0]['fecha_proceso'];
        $empresaCliente = $datosSolicitud[0]['nombre'];
        $idEmpInt = $datosSolicitud[0]['empresa'];
        $centroCosto = $datosSolicitud[0]['nom_clie'];
        $observacion = $datosSolicitud[0]['observacion'];
        $labDir = $datosSolicitud[0]['direccion'];
        $labTel = $datosSolicitud[0]['telefono'];
        $labNombre = $datosSolicitud[0]['nombre_lab'];
        $usuAprobo = $datosSolicitud[0]['usu_nombre'];
        $destinatario = $datosSolicitud[0]['mail'];
        
        
        switch ($idEmpInt){
            
            case 1:
                
                $rutaLogo = "../../libs/imagenes/logos/logo_listos.jpg";
                break;
            
            case 2:
                
                $rutaLogo = "../../libs/imagenes/logos/logo_tercerizar.jpg";
                break;
            
            case 3:
                
                $rutaLogo = "../../libs/imagenes/logos/logo_vision.jpg";
                break;
            
        }       
        
        //inicio creacion PDF
        
        $pdf = new FPDF();
        $pdf->AddPage();
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(1,85,$pdf->Image($rutaLogo,10,8,33),0,0,'C');
        $pdf->Cell(200,12,"DEPARTAMENTO DE SALUD OCUPACIONAL",0,0,'C');
        $pdf->Ln(5);
        $pdf->Cell(200,12,"SOLICITUD DE EXAMENES NO: ".$idOrden."",0,0,'C');
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(200,12,"DATOS EMPRESARIALES",0,0,'C');
        $pdf->Ln(10);
        $pdf->Cell(50,12,"Fecha solicitud: ".$fechaSolicitud."  ",0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(50,12,"Empresa usuaria: ".$empresaCliente." ",0,0,'L');
        $pdf->Ln(5);
        $pdf->Cell(50,12,"Centro costo: ".$centroCosto." ",0,0,'L');
        $pdf->Ln(10);
        $pdf->Cell(200,12,"USUARIOS RELACIONADOS",0,0,'C');
        $pdf->Ln(10);       
        $pdf->Cell(70, 6, 'NOMBRE', 1,0,'C');
        $pdf->Cell(50, 6, 'CEDULA',1,0,'C');
        $pdf->Cell(70, 6, 'CARGO',1,0,'C');
        $pdf->Ln();
       
        foreach ($consultaUsurios as $valor){
           
            $pdf->Cell(70, 6, $valor['nombre'], 1,0,'C');
            $pdf->Cell(50, 6, $valor['cedula'], 1,0,'C');
            $pdf->Cell(70, 6, $valor['nom_carg'], 1,0,'C');
            $pdf->Ln();
            
        }
        $pdf->Ln(10);
        $pdf->Cell(200,12,"DATOS DONDE SE REALIZARA EL EXAMEN Y/O PRUEBAS DE LABORATORIO",0,0,'C');
        $pdf->Ln(10);
        
        $pdf->Cell(70, 6, 'NOMBRE', 1,0,'C');
        $pdf->Cell(50, 6, 'DIRECCION',1,0,'C');
        $pdf->Cell(70, 6, 'TELEFONO',1,0,'C');
        $pdf->Ln();
        $pdf->Cell(70, 6, $labNombre, 1,0,'C');
        $pdf->Cell(50, 6, $labDir,1,0,'C');
        $pdf->Cell(70, 6, $labTel,1,0,'C');
        
        $pdf->Ln(10);
        $pdf->Cell(200,12,"PARACLINICOS Y/O EXAMENES CLINICOS",0,0,'C');
        $pdf->Ln(10);
        
        $pdf->Cell(95, 6, 'CATEGORIA', 1,0,'C');
        $pdf->Cell(95, 6, 'EXAMEN',1,0,'C');
        $pdf->Ln();
        $i = 0;
        
        foreach ($consultaExamenes as $valor){
            
            $pdf->Cell(95, 6, $valor['nombre_catego'], 1,0,'C');
            $pdf->Cell(95, 6, $valor['nombre'], 1,0,'C');
            $pdf->Ln();
            $i++;
        }
        
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);  
        $pdf->Cell(200,12,"AUTORIZADO POR:",0,0,'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);       
        $pdf->Cell(200,12,$usuAprobo,0,0,'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);  
        $pdf->Cell(200,12,"CANTIDAD DE EXAMENES POR USUARIO:",0,0,'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8); 
        $pdf->Cell(200,12,$i,0,0,'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);  
        $pdf->Cell(200,12,"OBSERVACIONES:",0,0,'L');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Write(5,$observacion); 
        
        $rutaArchivo = '../../temporales/reportesPDF/reporte'.$idOrden.'.pdf';
        
        $pdf->Output($rutaArchivo);       
        
        //fin creacion PDF
        
        //parametros del correo electronico
        $asunto = "Solicitud de examenes medicos LISTOS S.A";
        $body = "Cordial saludo. <br> Adjuntamos reporte de la solicitud de examenes No: ".$idOrden." . <br> Gracias por su atención";
        
        //provisionaal para pruebas
        $destinatario = 'linamarcela.obando@visionymarketing.com.co';
        $utilidades->envioMail($asunto, $body, $destinatario, $rutaArchivo);
        
        return true;
        
        
    }
    
    public function regUserExamen($idOrden,$idUser,$idExamen,$idEmpInt){
        
        $solicitudExamen = new solicitudExamendatos();
        $resulInsert = $solicitudExamen->regUserExamen($idOrden,$idUser,$idExamen,$idEmpInt);
        return $resulInsert;
        
        
    }
    
    public function consultarCatExam($idCliInt,$idEmpInt){
       
        $solicitudExamen = new solicitudExamendatos();
        $resulConsulta = $solicitudExamen->consultarCatExam($idCliInt,$idEmpInt);
        return $resulConsulta;
        
    }
}

?>

