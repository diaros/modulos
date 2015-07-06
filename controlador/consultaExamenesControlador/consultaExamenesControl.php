<?php

include_once '../../controlador/utilidades/utilidades.php';
require '../../datos/consultaExamenesDatos/consultaExamenesDatos.php';
require_once '../../libs/Classes/PHPExcel.php';
require_once '../../libs/Classes/PHPExcel/Writer/Excel2007.php';

class consultaExamenesControl {

    function __construct() {
        
    }

    function consultarCantidadExamenes($condicionDinamica) {

        $consultaExamenesDatos = new consulltaExamenesDatos();
        $resConsultaExamenes = $consultaExamenesDatos->totalRegistros($condicionDinamica);
        return $resConsultaExamenes;
    }

    public function consultarExamenes($condicionDinamica, $inicio, $limite) {

        $aprobacionExamsDatos = new consulltaExamenesDatos();
        $consulta = $aprobacionExamsDatos->consultarExamenes($condicionDinamica, $inicio, $limite);
        return $consulta;
    }
    
    public function consultarClientes(){
        
        $utilidades = new utilidades();
        $resConsulta = $utilidades->consultarClientes();
        return $resConsulta;
        
    }
    
    public function consultarEmpInterna(){
        
        $utilidades = new utilidades();
        $resConsulta = $utilidades->consultarEmpInterna();
        return $resConsulta;
        
    }
    
    public function reporteTotal($condicionDinamica, $inicio, $registrosxPag){
        
        $aprobacionExamsDatos = new consulltaExamenesDatos();
        $consulta = $aprobacionExamsDatos->reporteTotal($condicionDinamica);
        return $consulta;
        
    }
    
    public function generarExcel($reporte){        
        
        //inicio creacion de excel
        $objPHPExcel = new PHPExcel();
        
         // datos sobre autoría
         $objPHPExcel->getProperties()->setCreator("Examenes medicos");
         $objPHPExcel->getProperties()->setLastModifiedBy("Examenes medicos");
         $objPHPExcel->getProperties()->setTitle("Reporte Examenes medicos");
         $objPHPExcel->getProperties()->setSubject("Reporte Examenes medicos");
         $objPHPExcel->getProperties()->setDescription("Reporte Examenes medicos");
         
         //Trabajamos con la hoja activa principal
         $objPHPExcel->setActiveSheetIndex(0);
        
         //iteramos los resultados de la consulta que genera el reporte
         $cont = 1;
         
         $objPHPExcel->getActiveSheet()->SetCellValue("A" . $cont, 'Id Solicitud');
         $objPHPExcel->getActiveSheet()->SetCellValue("B" . $cont, 'Fecha solicitud');
         $objPHPExcel->getActiveSheet()->SetCellValue("C" . $cont, 'Empresa interna');
         $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, 'Cliente');
         $objPHPExcel->getActiveSheet()->SetCellValue("E" . $cont, 'Ciudad');
         $objPHPExcel->getActiveSheet()->SetCellValue("F" . $cont, 'Empleado');
         $objPHPExcel->getActiveSheet()->SetCellValue("G" . $cont, 'Cedula');
         $objPHPExcel->getActiveSheet()->SetCellValue("H" . $cont, 'Cargo');
         $objPHPExcel->getActiveSheet()->SetCellValue("I" . $cont, 'Examen');
         $objPHPExcel->getActiveSheet()->SetCellValue("J" . $cont, 'Valor');
         $objPHPExcel->getActiveSheet()->SetCellValue("K" . $cont, 'Centro costo');
         $objPHPExcel->getActiveSheet()->SetCellValue("L" . $cont, 'Nivel');
         $objPHPExcel->getActiveSheet()->SetCellValue("M" . $cont, 'Estado');
         $objPHPExcel->getActiveSheet()->SetCellValue("N" . $cont, 'OVS');
         
          foreach ($reporte as $fila) {
              
                $cont = $cont + 1;
                $objPHPExcel->getActiveSheet()->SetCellValue("A" . $cont, $fila['id_solicitud_examen']);
                $objPHPExcel->getActiveSheet()->SetCellValue("B" . $cont, $fila['fecha_solicitud']);
                $objPHPExcel->getActiveSheet()->SetCellValue("C" . $cont, $fila['nom_empr']);
                $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, $fila['cliente']);
                $objPHPExcel->getActiveSheet()->SetCellValue("E" . $cont, $fila['suc_nombre']);
                $objPHPExcel->getActiveSheet()->SetCellValue("F" . $cont, $fila['nombre']);
                $objPHPExcel->getActiveSheet()->SetCellValue("G" . $cont, $fila['cedula']);
                $objPHPExcel->getActiveSheet()->SetCellValue("H" . $cont, $fila['cargo']);
                $objPHPExcel->getActiveSheet()->SetCellValue("I" . $cont, $fila['nombre_examen']);
                $objPHPExcel->getActiveSheet()->SetCellValue("J" . $cont, $fila['vlr_examen']);
                $objPHPExcel->getActiveSheet()->SetCellValue("K" . $cont, $fila['centro_costo']);
                $objPHPExcel->getActiveSheet()->SetCellValue("L" . $cont, $fila['nivel']);
                $objPHPExcel->getActiveSheet()->SetCellValue("M" . $cont, $fila['estado']);
                $objPHPExcel->getActiveSheet()->SetCellValue("N" . $cont, $fila['ovs']);
          }
          
          $objPHPExcel->getActiveSheet()->setTitle('Reporte Examenes medicos');
          $objPHPExcel->getSecurity()->setLockWindows(true);
          $objPHPExcel->getSecurity()->setLockStructure(true);
          
          $fecha = date('Y-m-d-H-i-s');           
          
          //Titulo del libro y seguridad /
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
          $objWriter->save('../../temporales/reportes/reporteExmed' . $fecha . '.xls');
          $archivo = '../../temporales/reportes/reporteExmed' . $fecha . '.xls';
          
          return $archivo;
        
    }
    
    
}
