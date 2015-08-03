<?php

include '../../datos/consultaNomina/consultaNominaDatos.php';
include '../../datos/reporteNominaPlanoDatos/reporteNominaPlanoDatos.php';
include '../../controlador/utilidades/utilidades.php';
require_once '../../libs/Classes/PHPExcel.php';
require_once '../../libs/Classes/PHPExcel/Writer/Excel2007.php';


session_start();

class consultaNominaControl {

    function generarExcel($id) {

        $consulRegNomina = new reporteNominaPlanoDatos();
        $reporteUsuarios = $consulRegNomina->consultarDatosRegByIdPlanilla($id);

        //inicio creacion de excel
        $objPHPExcel = new PHPExcel();

        // datos sobre autoría
        $objPHPExcel->getProperties()->setCreator("Modulos Administrativos");
        $objPHPExcel->getProperties()->setLastModifiedBy("Modulos Administrativos");
        $objPHPExcel->getProperties()->setTitle("Nomina");
        $objPHPExcel->getProperties()->setSubject("Nomina");
        $objPHPExcel->getProperties()->setDescription("Nomina");

        //Trabajamos con la hoja activa principal
        $objPHPExcel->setActiveSheetIndex(0);

        //iteramos los resultados de la consulta que genera el reporte
        $cont = 1;

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);


        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $cont, 'Centro Costo');
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $cont, 'Ciudad');
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $cont, 'Cedula');
        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, 'Nombre');
        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $cont, 'Horas Ordinarias ');
        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $cont, '# Horas Festivas');
        $objPHPExcel->getActiveSheet()->SetCellValue("G" . $cont, '# Horas DominicSinComp');

        foreach ($reporteUsuarios as $fila) {

            $posColumna = "H";

            $idUsuario = $fila['id_usuario'];
            $reporteAdicionales = $consulRegNomina->consultarConceptosByUsuario($id, $idUsuario);

            if ($cont == 1) {

                foreach ($reporteAdicionales as $valor2) {

                    $objPHPExcel->getActiveSheet()->getColumnDimension($posColumna)->setWidth(40);
                    $objPHPExcel->getActiveSheet()->SetCellValue($posColumna++ . $cont, $valor2['nombre']);
                }
            }
        }

        foreach ($reporteUsuarios as $fila) {

            $cont++;
            $posColumna = "H";

            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $cont, $fila['centro_costo']);
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $cont, $fila['ciudad']);
            $objPHPExcel->getActiveSheet()->SetCellValue("C" . $cont, $fila['id_usuario']);
            $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, trim($fila['nom_empl']) . " " . trim($fila['ape_empl']));
            $objPHPExcel->getActiveSheet()->SetCellValue("E" . $cont, $fila['horas_habiles']);
            $objPHPExcel->getActiveSheet()->SetCellValue("F" . $cont, $fila['horas_festivos']);
            $objPHPExcel->getActiveSheet()->SetCellValue("G" . $cont, $fila['horas_dominicales']);

            $idUsuario = $fila['id_usuario'];
            $reporteAdicionales = $consulRegNomina->consultarConceptosByUsuario($id, $idUsuario);

            foreach ($reporteAdicionales as $valor2) {

                $objPHPExcel->getActiveSheet()->SetCellValue($posColumna++ . $cont, $valor2['valor']);
            }
        }

        $objPHPExcel->getActiveSheet()->setTitle('Reporte Nomina');
        $objPHPExcel->getSecurity()->setLockWindows(true);
        $objPHPExcel->getSecurity()->setLockStructure(true);

        $fecha = date('Y-m-d-H-i-s');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('../../temporales/nominasExcel/nomina' . $fecha . '.xls');
        $archivo = '../../temporales/nominasExcel/nomina' . $fecha . '.xls';

        return $archivo;
    }

    function generarPlano($id) {

        $consulRegNomina = new consultaNominaDatos();
        $utilidades = new utilidades();
        
        $reporteUsuarios = $consulRegNomina->consultarDatosRegByIdPlanilla($id);
        $fecha = date('Y-m-d-H-i-s');

        foreach ($reporteUsuarios as $fila) {

            $archivo = fopen("../../temporales/planosNomina/planoNomina" . $fecha . ".txt", "a");

            //se completa los 10 espacios a la cedula
            if (strlen($fila['id_usuario']) < 10) {

                $fila['id_usuario'] = str_pad($fila['id_usuario'], 10);
            }

            //validar tipo de concepto
            $tipoConcepto = $consulRegNomina->tipoConcepto($fila['concepto'], $fila['id_emp_int']);

            if ($tipoConcepto['0']['cap_como'] == 'C') {

                if (strlen($fila['concepto']) < 6) {
                    $fila['concepto'] = str_pad($fila['concepto'], 6);
                }
                
                if($fila['vlr_concepto'] > 10){
                    
                    $vlr = number_format($fila['vlr_concepto'], 1, ',', '');  
                    
                }else{
                    
                     $vlr = number_format($fila['vlr_concepto'], 2, ',', '');  
                    
                }                              
                
                if (strlen($vlr) < 5) {
                    
                    $vlr = str_pad($vlr, 5);
                    
                }
                
                if (strlen($fila['centro_costo']) < 5) {
                    $fila['centro_costo'] = str_pad($fila['centro_costo'], 5);
                }
                

                $linea = $fila['id_usuario'] . " " . $fila['concepto'] . " " . $vlr . "  0,000 " . $fila['centro_costo'] . " " . $fila['nro_cont'];
                fputs($archivo, $linea . "\r\n");
                
            } else if ($tipoConcepto['0']['cap_como'] == 'V') {

                if (strlen($fila['concepto']) < 6) {
                    $fila['concepto'] = str_pad($fila['concepto'], 6);
                }
                
                    if (strlen($fila['centro_costo']) < 5) {
                    $fila['centro_costo'] = str_pad($fila['centro_costo'], 5);
                }

                $vlr = number_format($fila['vlr_concepto'], 3, ',', '');
                $linea = $fila['id_usuario'] . " " . $fila['concepto'] . " 0,00 " . $vlr . " " . $fila['centro_costo'] . " " . $fila['nro_cont'];
                fputs($archivo, $linea . "\r\n");
            }
        }
        
        if($archivo != false){
            
            $rutaArchivo = "../../temporales/planosNomina/planoNomina" . $fecha . ".txt";    
            
            $nombreArchivo = "planoNomina".$fecha.".txt";
            $carpeta = "planosNomina";
            $nombreComprimido = "planoNomina".$fecha;
            
            $resComprimir = $utilidades->comprimirArchivo($nombreArchivo,$carpeta,$nombreComprimido);
            
            //return $rutaArchivo;
            return $resComprimir;
            
        }else{
            
             return false;
            
        }
       
    }

}
?>

