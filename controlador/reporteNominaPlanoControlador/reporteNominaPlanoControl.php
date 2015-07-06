<?php

include '../../datos/reporteNominaPlanoDatos/reporteNominaPlanoDatos.php';
include_once '../../controlador/utilidades/utilidades.php';
require_once '../../libs/Classes/PHPExcel.php';
require_once '../../libs/Classes/PHPExcel/Writer/Excel2007.php';

session_start();

class reporteNominaPlanoControl {

    function __construct(){}

    function consultarClietneBySupervisor($idUser, $idEmpInt) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->consultarClietneBySupervisor($idUser, $idEmpInt);
        return $resulConsulta;
    }

    function cosultarCentroCostos($idEmpInt, $idEmpCli) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->cosultarCentroCostos(trim($idEmpInt), trim($idEmpCli));
        return $resulConsulta;
    }

    function consultarUsuarios($empInt, $centroCosto, $ciudad) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->consultarUsuarios($empInt, $centroCosto, $ciudad);
        return $resulConsulta;
    }

    function generarPlantilla($consultaUsuarios, $periocidad) {

        //inicio creacion de excel
        $objPHPExcel = new PHPExcel();

        // datos sobre autoría
        $objPHPExcel->getProperties()->setCreator("Modulos Administrativos");
        $objPHPExcel->getProperties()->setLastModifiedBy("Modulos Administrativos");
        $objPHPExcel->getProperties()->setTitle("Pre nomina");
        $objPHPExcel->getProperties()->setSubject("Pre nomina");
        $objPHPExcel->getProperties()->setDescription("Pre nomina");

        //Trabajamos con la hoja activa principal
        $objPHPExcel->setActiveSheetIndex(0);

        //iteramos los resultados de la consulta que genera el reporte
        $cont = 1;
        
        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '1006A3')
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FF3333'),
            ),
            'font' => array(
                'bold' => true,
            )
        );
        
       
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($style_header);        
       
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);      

        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $cont, 'Cedula');
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $cont, 'Nombre');
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $cont, 'Horas');
        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, '# Dias Lab');
        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $cont, 'Ordinarios periodo Anterior');
        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $cont, 'Festivos periodo Anterior');
        $objPHPExcel->getActiveSheet()->SetCellValue("G" . $cont, 'Dominicales periodo Anterior');
        $objPHPExcel->getActiveSheet()->SetCellValue("H" . $cont, 'Mes PA');
        $objPHPExcel->getActiveSheet()->SetCellValue("I" . $cont, '# Horas Festivas');
        $objPHPExcel->getActiveSheet()->SetCellValue("J" . $cont, 'Dias Festivos');
        $objPHPExcel->getActiveSheet()->SetCellValue("K" . $cont, '# Horas DominicSinComp');
        $objPHPExcel->getActiveSheet()->SetCellValue("L" . $cont, 'Dias DominicSinComp');
        $objPHPExcel->getActiveSheet()->SetCellValue("M" . $cont, 'Observaciones');

        foreach ($consultaUsuarios as $fila) {

            $cont = $cont + 1;
            $j = 16;
            $objPHPExcel->getActiveSheet()->SetCellValue("A" . $cont, $fila['cod_empl']);
            $objPHPExcel->getActiveSheet()->SetCellValue("B" . $cont, trim($fila['nom_empl']) . " " . trim($fila['ape_empl']));

            if ($periocidad == 1 || $periocidad == 2) {

                $objPHPExcel->getActiveSheet()->SetCellValue("C" . $cont, '120');

                if ($periocidad == 1) {

                    $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15');
                }

                if ($periocidad == 2) {

                    $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, '16,17,18,19,20,21,22,23,24,25,26,27,28,29,30');
                }
            } else if ($periocidad = 3) {

                $objPHPExcel->getActiveSheet()->SetCellValue("C" . $cont, '240');
                $objPHPExcel->getActiveSheet()->SetCellValue("D" . $cont, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30');
            }
        }

        $objPHPExcel->getActiveSheet()->setTitle('Reporte Examenes medicos');
        $objPHPExcel->getSecurity()->setLockWindows(true);
        $objPHPExcel->getSecurity()->setLockStructure(true);

        $fecha = date('Y-m-d-H-i-s');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('../../temporales/plantillas/plantilla' . $fecha . '.xls');
        $archivo = '../../temporales/plantillas/plantilla' . $fecha . '.xls';

        return $archivo;
    }

    function abrirArchivo($rutaArchivo, $empresaInt, $empUsu, $centroCosto, $ciudad, $mes, $periocidad) {

        $encabezados = Array();
        $regError = Array();

        //cargamos el archivo que deseamos leer
        $objPHPExcel = PHPExcel_IOFactory::load($rutaArchivo);
        $objHoja = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

        $longRegistros = count($objHoja);
        $encabezados = $this->obtenerEncabezados($objHoja[1]);

        //validar encabezados
        $valEncabezados = $this->valEncabezados($encabezados, $empresaInt);
        
        if ($valEncabezados === true) {

            //validacion encabezados adicionales
            $valEncabezadosAdicionales = $this->valEncabezadosAdicionales($encabezados, $empresaInt);
            if ($valEncabezadosAdicionales === true) {

                //validacion de campos obligatorios y tipo de datos            
                $arregloErrores = $this->valCamposObligatorios($objHoja, $empresaInt, $centroCosto, $ciudad, $mes, $periocidad);
                if (count($arregloErrores) > 0) {
                    
                    $tipoError = array("errores en datos");
                    array_unshift($arregloErrores,$tipoError);    
                    //$arregloErrores[] = $tipoError;
                    return $arregloErrores;
                    
                } else {

                    $resultInserEncabezado = $this->insertEncabezadoPlanilla($empresaInt, $empUsu, $centroCosto, $ciudad, $mes, $periocidad);

                    if ($resultInserEncabezado != null) {

                        $resulInsertPlanillaUsuario = $this->datosUsuario($objHoja, $encabezados, $mes);

                        if ($resulInsertPlanillaUsuario == false) {
                            
                            $tipoError = Array();
                            $tipoError[] = array("Error insertando detalle");
                            return $tipoError;
                            
                        } else {

                            return true;
                        }
                        
                    }else{
                        
                        $tipoError = Array();
                        $tipoError[] = array("Error insertando encabezado");
                        return $tipoError;
                    }
                }
                //fin validacion de campos obligatorios
            } else {
                
               $tipoError = Array();
               $tipoError = array("adicionales incorrectos");
               array_unshift($valEncabezadosAdicionales,$tipoError);
               return $valEncabezadosAdicionales;
            }
        } else {
            $tipoError = Array();
            $tipoError = array("orden encabezados");
            array_unshift($valEncabezados,$tipoError);
            return $valEncabezados;
        }
    }

    function valCamposObligatorios($objHoja, $empresaInt, $centroCosto, $ciudad, $mes, $periocidad) {

        $arregloErrores = Array();
        $arregloCedulas = Array();
        $i = 0;

        foreach ($objHoja as $pos => $valor) {
            $auxCed = '';
            foreach ($valor as $pos2 => $valor2) {

                if ($i > 0) {

                    //validacion Cedula
                    if ($pos2 == 'A') {

                        if ($valor2 == null || $valor2 == '') {

                            $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Campo vacio";
                        } else {

                            if (!is_numeric($valor2)) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {

                                // validacion pertenencia cedula al centro de costo
                                $resulValExisCedCentroCosto = $this->valExistCedCentroCosto($valor2, $empresaInt, $centroCosto, $ciudad);
                                if ($resulValExisCedCentroCosto[0]['cantidad'] == 0) {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": La cedula ".$valor2." no pertenece al Centro costos";
                                    
                                } else {
                                    
                                    $valor2 = (string)$valor2;
                                    $resBusqueda = array_search(trim($valor2), $arregloCedulas);

                                    if ($resBusqueda !== false) {

                                        $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Cedula ".$valor2." repetida";
                                        
                                    } else {

                                        $arregloCedulas[] = trim($valor2);
                                        $auxCed = $valor2;
                                    }
                                }
                            }
                        }
                    }

                    //validacion Nombre
                    if ($pos2 == 'B') {

                        if ($valor2 == null || $valor2 == '') {

                            $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Campo vacio";
                        } else {

                            if (!is_string($valor2)) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            }
                        }
                    }

                    //validacion horas habiles
                    if ($pos2 == 'C') {

                        $auxHorasH = '';

                        if ($valor2 == null || $valor2 == '') {

                            $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Campo vacio";
                        } else {

                            if (!is_numeric($valor2)) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                                
                            } else {

                                $auxHorasH = $valor2;
                            }
                        }
                    }

                    //Validacion dias habiles
                    if ($pos2 == 'D') {

                        if ($valor2 == null || $valor2 == '') {

                            $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Campo vacio";
                        } else {

                            //convertir a arreglo                            
                            $arregloTemDiasH = explode(",", $valor2);

                            //validar tipo datos dias 
                            $resulProduc = array_product($arregloTemDiasH);

                            if ($resulProduc == null) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {

                                $tipoDia = 'H';
                                $diasHreportados = '';
                                $diasNoPeriocidad = '';
                                $cantDiasH = 0;

                                foreach ($arregloTemDiasH as $dia) {

                                    $resValDiaH = $this->valDiaReportado($auxCed, $mes, $tipoDia, $dia);

                                    if ($resValDiaH[0]['cantidad'] > 0) {

                                        $diasHreportados = $diasHreportados . "-" . $dia;
                                    }

                                    if ($periocidad == 1 && $dia > 15) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }

                                    if ($periocidad == 2 && $dia < 16 || $dia > 31) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }
                                    if ($periocidad == 3 && $dia > 31) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }

                                    $cantDiasH++;
                                }

                                if ($diasHreportados != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias habiles ya reportados: " . $diasHreportados;
                                }

                                if ($diasNoPeriocidad != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias habiles no pertenecen a la periodicidad seleccionada: " . $diasNoPeriocidad;
                                }

                                if ($auxHorasH > ($cantDiasH * 8)) {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias habiles reportados no coinciden con las horas habiles reportadas";
                                }
                            }
                        }
                    }

                    //validacion dias Ordinarios per anterior  
                    if ($pos2 == 'E') {

                        if ($valor2 != null || $valor2 != '') {

                            //convertir a arreglo                            
                            $arregloTemDiasAntH = explode(",", $valor2);

                            //validar tipo datos dias 
                            $resulProducAnt = $this->valDiaIsNum($arregloTemDiasAntH);

                            if ($resulProducAnt == null) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            }
                        }
                    }

                    //validacion dias Festivos per anterior  
                    if ($pos2 == 'F') {

                        if ($valor2 != null || $valor2 != '') {

                            //convertir a arreglo                            
                            $arregloTemDiasAntF = explode(",", $valor2);

                            //validar tipo datos dias 
                            $resulProducAnt = $this->valDiaIsNum($arregloTemDiasAntF);

                            if ($resulProducAnt == null) {
                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {
                                
                            }
                        }
                    }

                    //validacion dias Dominicales per anterior  
                    if ($pos2 == 'G') {

                        if ($valor2 != null || $valor2 != '') {

                            //convertir a arreglo                            
                            $arregloTemDiasAntD = explode(",", $valor2);

                            //validar tipo datos dias 
                            $resulProducAnt = $this->valDiaIsNum($arregloTemDiasAntD);

                            if ($resulProducAnt == null) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            }
                        }
                    }

                    //validacion mes PA
                    if ($pos2 == 'H') {

                        if ($valor2 != null || $valor2 != '') {

                            if (!is_numeric($valor2)) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {

                                //validar que el mes PA sea un mes anterior al actual
                                $arregloPer = explode("-", $mes);
                                $mesAct = $arregloPer[0];

                                if ($mesAct == 1 && ($valor2 != '12' || $valor2 != '11')) {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Mes periodo anterior invalido invalido";
                                } else {

                                    if ($valor2 != ($mesAct - 1)) {

                                        $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Mes periodo anterior invalido invalido";
                                    } else {

                                        if (count($arregloTemDiasAntH) > 0) {

                                            $tipoDia = 'H';
                                            $diasAntHreportados = '';

                                            if ($mesAct == 1 && ($valor2 == '12' || $valor2 == '11')) {

                                                $yearAct = date('Y');
                                                $yearAnt = $yearAct - 1;
                                                $mesAnt = $valor2 . "-" . $yearAnt;
                                                
                                            } else {

                                                $yearAct = date('Y');
                                                $mesAnt = $valor2 . "-" . $yearAct;
                                            }

                                            foreach ($arregloTemDiasAntH as $dia) {

                                                $resValDiaH = $this->valDiaReportado($auxCed, $mesAnt, $tipoDia, $dia);
                                                
                                                if ($resValDiaH[0]['cantidad'] > 0) {

                                                    $diasAntHreportados = $diasAntHreportados . "-" . $dia;
                                                }
                                            }

                                            if ($diasAntHreportados != '') {

                                                $arregloErrores[$i][] = "Dias anteriores habiles ya reportados: " . $diasAntHreportados;
                                            }
                                        }

                                        if (count($arregloTemDiasAntF) > 0) {

                                            $tipoDia = 'F';
                                            $diasNofestivos = '';

                                            if ($mesAct == 1 && ($valor2 == '12' || $valor2 == '11')) {

                                                $yearAct = date('Y');
                                                $yearAnt = $yearAct - 1;
                                                $mesAnt = $valor2 . "-" . $yearAnt;
                                                
                                            } else {

                                                $yearAct = date('Y');
                                                $mesAnt = $valor2 . "-" . $yearAct;
                                            }

                                            foreach ($arregloTemDiasAntF as $dia) {

                                                $resValFestivo = $this->valDiafestivo($mesAnt, $dia);

                                                if ($resValFestivo[0]['festivo'] == 0) {

                                                    $diasNofestivos = $diasNofestivos . "-" . $dia;
                                                }
                                            }

                                            if ($diasNofestivos != '') {

                                                $arregloErrores[$i][] = "Dias anteriores No festivos: " . $diasNofestivos;
                                            }
                                        }

                                        if (count($arregloTemDiasAntD) > 0) {

                                            $tipoDia = 'D';
                                            $diasNoDominical = '';
                                            
                                            if ($mesAct == 1 && ($valor2 == '12' || $valor2 == '11')) {

                                                $yearAct = date('Y');
                                                $yearAnt = $yearAct - 1;
                                                $mesAnt = $valor2 . "-" . $yearAnt;
                                                
                                            } else {

                                                $yearAct = date('Y');
                                                $mesAnt = $valor2 . "-" . $yearAct;
                                            }

                                            foreach ($arregloTemDiasAntD as $dia) {

                                                $resValDomical = $this->valDominical($mesAnt, $dia);

                                                if ($resValDomical == false) {

                                                    $diasNoDominical = $diasNoDominical . "-" . $dia;
                                                }
                                            }

                                            if ($diasNoDominical != '') {

                                                $arregloErrores[$i][] = "Dias anteriores No Dominicales: " . $diasNoDominical;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    //validacion horas festivas
                    if ($pos2 == 'I') {

                        $auxHfest = 0;

                        if ($valor2 != null || $valor2 != '') {

                            if (!is_numeric($valor2)) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {

                                $auxHfest = $valor2;
                            }
                        }
                    }

                    //validacion dias festivos
                    if ($pos2 == 'J') {

                        if ($valor2 != null || $valor2 != '') {
                            //convertir a arreglo                            
                            $arregloTemDiasFest = explode(",", $valor2);

                            //validar tipo datos dias 
                            $resulProduc = $this->valDiaIsNum($arregloTemDiasFest);

                            if ($resulProduc == null) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {

                                $tipoDia = 'F';
                                $diasFreportados = '';
                                $diasNoPeriocidad = '';
                                $cantDiasF = 0;
                                $diasNofestivos = '';

                                foreach ($arregloTemDiasFest as $dia) {

                                    $resValDiaF = $this->valDiaReportado($auxCed, $mes, $tipoDia, $dia);

                                    if ($resValDiaF[0]['cantidad'] > 0) {

                                        $diasFreportados = $diasFreportados . "-" . $dia;
                                    }

                                    if ($periocidad == 1 && $dia > 15) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }

                                    if ($periocidad == 2 && $dia < 16 || $dia > 31) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }
                                    if ($periocidad == 3 && $dia > 31) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }

                                    $resValFestivo = $this->valDiafestivo($mes, $dia);

                                    if ($resValFestivo[0]['festivo'] == 0) {

                                        $diasNofestivos = $diasNofestivos . "-" . $dia;
                                    }

                                    $cantDiasF++;
                                }

                                if ($diasFreportados != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias festivos ya reportados: " . $diasFreportados;
                                }

                                if ($diasNoPeriocidad != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias festivos no pertenecen a la periodicidad seleccionada: " . $diasNoPeriocidad;
                                }

                                if ($auxHfest > ($cantDiasF * 8 )) {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias festivos reportados no coinciden con las horas festivas reportadas";
                                }

                                if ($diasNofestivos != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias No festivos: " . $diasNofestivos;
                                }
                            }
                        }
                    }

                    //validacion horas dominicales
                    if ($pos2 == 'K') {

                        $auxHorasD = 0;

                        if ($valor2 != null || $valor2 != '') {

                            if (!is_numeric($valor2)) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {

                                $auxHorasD = $valor2;
                            }
                        }
                    }

                    //validacion dias domincales
                    if ($pos2 == 'L') {

                        if ($valor2 != null || $valor2 != '') {
                            //convertir a arreglo                            
                            $arregloTemDiasDom = explode(",", $valor2);

                            //validar tipo datos dias 
                            $resulProduc = $this->valDiaIsNum($arregloTemDiasDom);

                            if ($resulProduc == null) {

                                $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Tipo dato invalido";
                            } else {

                                $tipoDia = 'D';
                                $diasDreportados = '';
                                $diasNoPeriocidad = '';
                                $cantDiasd = 0;
                                $diasNoDominical = '';

                                foreach ($arregloTemDiasDom as $dia) {

                                    $resValDiaD = $this->valDiaReportado($auxCed, $mes, $tipoDia, $dia);

                                    if ($resValDiaD[0]['cantidad'] > 0) {

                                        $diasDreportados = $diasDreportados . "-" . $dia;
                                    }

                                    if ($periocidad == 1 && $dia > 15) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }

                                    if ($periocidad == 2 && $dia < 16 || $dia > 31) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }
                                    if ($periocidad == 3 && $dia > 31) {

                                        $diasNoPeriocidad = $diasNoPeriocidad . '-' . $dia;
                                    }

                                    $resValDomical = $this->valDominical($mes, $dia);

                                    if ($resValDomical == false) {

                                        $diasNoDominical = $diasNoDominical . "-" . $dia;
                                    }

                                    $cantDiasd++;
                                }

                                if ($diasDreportados != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias dominicales ya reportados: " . $diasDreportados;
                                }

                                if ($diasNoPeriocidad != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias dominicales no pertenecen a la periodicidad seleccionada: " . $diasNoPeriocidad;
                                }

                                if ($auxHorasD > ($cantDiasd * 8)) {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias dominicales reportados no coinciden con las horas dominicales reportadas";
                                }

                                if ($diasNoDominical != '') {

                                    $arregloErrores[$i][] = "Fila ".($i+1)." Columna " . $pos2 . ": Dias No Dominicales: " . $diasNoDominical;
                                }
                            }
                        }
                    }
                }
            }

            $i++;
        }

        return $arregloErrores;
    }

    function valDominical($mesAnt, $dia) {

        $utilidades = new utilidades();
        $perFecha = $dia . "-" . $mesAnt;
        $periodoFecha = date("Y-m-d", strtotime($perFecha));
        $nom = $utilidades->convertFechaNomDia($periodoFecha);

        if ($nom == 'Domingo') {

            return true;
        } else {

            return false;
        }
    }

    function valDiaFestivo($mesAnt, $dia) {

        $utilidades = new utilidades();
        $fecha = $dia . "-" . $mesAnt;
        $fecha = date("d/m/Y", strtotime($fecha));
        $resulConsulta = $utilidades->consultarDiaFestivo($fecha);
        return $resulConsulta;
    }

    function valDiaReportado($auxCed, $mes, $tipoDia, $dia) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $fecha = $dia . "-" . $mes;
        $fecha = date("Y-m-d", strtotime($fecha));
        $resulConsulta = $reporteNominaDatos->valDiaReportado($auxCed, $fecha, $tipoDia);
        return $resulConsulta;
    }

    //funcion validar eistencia de cedula en centro de costo
    function valExistCedCentroCosto($ced, $empresaInt, $centroCosto, $ciudad) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->valCedCentroCosto($ced, $empresaInt, $centroCosto, $ciudad);
        return $resulConsulta;
    }

    function datosUsuario($objHoja, $encabezados, $mes) {

        $longRegistros = count($objHoja);
        $k = 1;
        $flgError = true;

        for ($i = 2; $i <= $longRegistros; $i++) {

            $arregloDiasHabiles = $this->obtenerDias($objHoja[$i]['D']);
            $arregloDiasDominicales = $this->obtenerDias($objHoja[$i]['L']);
            $arregloDiasFestivos = $this->obtenerDias($objHoja[$i]['J']);
            $arregloDiasAnterioresH = $this->obtenerDias($objHoja[$i]['E']);
            $arregloDiasAnterioresF = $this->obtenerDias($objHoja[$i]['F']);
            $arregloDiasAnterioresD = $this->obtenerDias($objHoja[$i]['G']);
            $mesDiasAnteriores = $objHoja[$i]['H'];

            $conceptos = $this->construirConceptos($objHoja, $encabezados, $i, $k);

            $hrsHabiles = $objHoja[$i]['C'];
            $hrsFestivas = $objHoja[$i]['I'];
            $horasDominicales = $objHoja[$i]['K'];
            $observaciones = $objHoja[$i]['M'];
            $cedula = $objHoja[$i]['A'];

            $resulInsertDetPlanillaUsuario = $this->insertDetPlanillaUsuario($cedula, $hrsHabiles, $hrsFestivas, $horasDominicales, $observaciones);

            if ($resulInsertDetPlanillaUsuario != null) {

                $resulInsertDias = $this->insertDias($mes, $mesDiasAnteriores, $arregloDiasHabiles, $arregloDiasDominicales, $arregloDiasFestivos, $arregloDiasAnterioresH, $arregloDiasAnterioresF, $arregloDiasAnterioresD);

                if ($resulInsertDias != null) {

                    $resulInsertConceptos = $this->insertConceptos($conceptos);

                    if ($resulInsertConceptos != false) {

                        $flgError = true;
                        
                    } else {

                        $flgError = false;
                    }
                } else {

                    $flgError = false;
                }
            } else {

                $flgError = false;
            }

            $k++;
        }

        return $flgError;
    }

    function insertConceptos($conceptos) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $flgError = true;
        $i = 0;
        foreach ($conceptos as $valor) {

            foreach ($valor as $pos => $valor2) {

                $nombre = $pos;
                $vlr = $valor2;

                $resulInsert = $reporteNominaDatos->insertConceptos($nombre, $vlr);

                if ($resulInsert == null) {

                    $flgError = false;
                }
            }
        }

        return $flgError;
    }

    function insertDias($mes, $mesDiasAnt, $arregloDiasHabiles, $arregloDiasDominicales, $arregloDiasFestivos, $arregloDiasAnterioresH, $arregloDiasAnterioresF, $arregloDiasAnterioresD) {

//        $reporteNominaDatos = new reporteNominaPlanoDatos();
//        $utilidades = new utilidades();
        $flgError = true;
//
//        $arregloPer = explode("-", $mes);
//        $mesAct = $arregloPer[0];

        if (count($arregloDiasAnterioresH) > 0) {
            $tipo = 'H';
            $resDiasAntOrdi = $this->insertDiasAnteriores($arregloDiasAnterioresH, $mesDiasAnt, $tipo, $mes);
            
            if($resDiasAntOrdi == false){
                
                $flgError = false;
                
            }

//            foreach ($arregloDiasAnterioresH as $valor) {
//
//                $mesDiasAntF = '';
//
//                if ($valor < 10) {
//
//                    $numDia = "0" . $valor;
//                } else {
//
//                    $numDia = $valor;
//                }
//
//                if ($mesAct == 1 && ($mesDiasAnt == '12' || $mesDiasAnt == '11')) {
//
//                    $yearAct = date('Y');
//                    $yearAnt = $yearAct - 1;
//                    $mesDiasAnt = $mesDiasAnt . "-" . $yearAnt;
//                } else {
//                    $yearAct = date('Y');
//                    $mesDiasAntF = $mesDiasAnt . "-" . $yearAct;
//                }
//
//                $perFecha = $numDia . "-" . $mesDiasAntF;
//                $periodoFecha = date("Y-m-d", strtotime($perFecha));
//                $nom = $utilidades->convertFechaNomDia($periodoFecha);
//                $tipo = "H";
//
//                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);
//
//                if ($resulInsertDia == null) {
//
//                    $flgError = false;
//                }
//            }
        }

        if (count($arregloDiasAnterioresF) > 0) {
            $tipo = 'F';
            $resDiasAntFesti = $this->insertDiasAnteriores($arregloDiasAnterioresH, $mesDiasAnt, $tipo, $mes);
            
            if($resDiasAntFesti == false){
                
                $flgError = false;
                
            }
            
//            foreach ($arregloDiasAnterioresF as $valor) {
//
//                $mesDiasAntF = '';
//
//                if ($valor < 10) {
//
//                    $numDia = "0" . $valor;
//                } else {
//
//                    $numDia = $valor;
//                }
//
//                if ($mesAct == 1 && ($mesDiasAnt == '12' || $mesDiasAnt == '11')) {
//
//                    $yearAct = date('Y');
//                    $yearAnt = $yearAct - 1;
//                    $mesDiasAnt = $mesDiasAnt . "-" . $yearAnt;
//                } else {
//                    $yearAct = date('Y');
//                    $mesDiasAntF = $mesDiasAnt . "-" . $yearAct;
//                }
//
//                $perFecha = $numDia . "-" . $mesDiasAntF;
//                $periodoFecha = date("Y-m-d", strtotime($perFecha));
//                $nom = $utilidades->convertFechaNomDia($periodoFecha);
//                $tipo = "F";
//
//                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);
//
//                if ($resulInsertDia == null) {
//
//                    $flgError = false;
//                }
//            }
        }

        if (count($arregloDiasAnterioresD) > 0) {
            
            $tipo = 'D';
            $resDiasAntDom = $this->insertDiasAnteriores($arregloDiasAnterioresH, $mesDiasAnt, $tipo, $mes);
            
            if($resDiasAntDom == false){
                
                $flgError = false;
                
            }
            
            
//            foreach ($arregloDiasAnterioresD as $valor) {
//
//                $mesDiasAntF = '';
//
//                if ($valor < 10) {
//
//                    $numDia = "0" . $valor;
//                } else {
//
//                    $numDia = $valor;
//                }
//
//                if ($mesAct == 1 && ($mesDiasAnt == '12' || $mesDiasAnt == '11')) {
//
//                    $yearAct = date('Y');
//                    $yearAnt = $yearAct - 1;
//                    $mesDiasAnt = $mesDiasAnt . "-" . $yearAnt;
//                } else {
//                    $yearAct = date('Y');
//                    $mesDiasAntF = $mesDiasAnt . "-" . $yearAct;
//                }
//
//                $perFecha = $numDia . "-" . $mesDiasAntF;
//                $periodoFecha = date("Y-m-d", strtotime($perFecha));
//                $nom = $utilidades->convertFechaNomDia($periodoFecha);
//                $tipo = "D";
//
//                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);
//
//                if ($resulInsertDia == null) {
//
//                    $flgError = false;
//                }
//            }
        }

        if (count($arregloDiasHabiles) > 0) {
            
            $tipo = 'H';
            $resDiasOrd = $this->insertDiasAct($arregloDiasHabiles, $mes, $tipo);
            
            if($resDiasOrd == false){
                
                $flgError = false;
                
            }
            
//            foreach ($arregloDiasHabiles as $valor) {
//
//                if ($valor < 10) {
//
//                    $numDia = "0" . $valor;
//                    
//                } else {
//
//                    $numDia = $valor;
//                }
//
//                $perFecha = $numDia . "-" . $mes;
//                $periodoFecha = date("Y-m-d", strtotime($perFecha));
//                $nom = $utilidades->convertFechaNomDia($periodoFecha);
//                $tipo = "H";
//
//                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);
//
//                if ($resulInsertDia == null) {
//
//                    $flgError = false;
//                }
//            }
        }

        if (count($arregloDiasDominicales) > 0) {
            
            $tipo = 'D';
            $resDiasDom = $this->insertDiasAct($arregloDiasDominicales, $mes, $tipo);

            if($resDiasDom == false){
                
                $flgError = false;
                
            }
            
//            foreach ($arregloDiasDominicales as $valor) {
//
//                if ($valor < 10) {
//
//                    $numDia = "0" . $valor;
//                    
//                } else {
//
//                    $numDia = $valor;
//                }
//
//                $perFecha = $numDia . "-" . $mes;
//                $periodoFecha = date("Y-m-d", strtotime($perFecha));
//                $nom = $utilidades->convertFechaNomDia($periodoFecha);
//                $tipo = "D";
//
//                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);
//
//                if ($resulInsertDia == null) {
//
//                    $flgError = false;
//                }
//            }
        }

        if (count($arregloDiasFestivos) > 0) {
            
            $tipo = 'F';
            $resDiasFest = $this->insertDiasAct($arregloDiasFestivos, $mes, $tipo);
            
             if($resDiasFest == false){
                
                $flgError = false;
                
            }
            
//            foreach ($arregloDiasFestivos as $valor) {
//
//                if ($valor < 10) {
//                    
//                    $numDia = "0" . $valor;
//                    
//                } else {
//
//                    $numDia = $valor;
//                }
//
//                $perFecha = $numDia . "-" . $mes;
//                $periodoFecha = date("Y-m-d", strtotime($perFecha));
//                $nom = $utilidades->convertFechaNomDia($periodoFecha);
//                $tipo = "F";
//
//                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);
//
//                if ($resulInsertDia == null) {
//
//                    $flgError = false;
//                }
//            }
        }
  
        return $flgError;
    }
    
    function insertDiasAnteriores($arregloDiasAnteriores, $mesDiasAnt, $tipo,$mes) {
        
        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $utilidades = new utilidades();
        $flgError = true;
        
        $arregloPer = explode("-", $mes);
        $mesAct = $arregloPer[0];     

        foreach ($arregloDiasAnteriores as $valor) {

                $mesDiasAntF = '';

                if ($valor < 10) {

                    $numDia = "0" . $valor;
                } else {
                    $numDia = $valor;
                }

                if ($mesAct == 1 && ($mesDiasAnt == '12' || $mesDiasAnt == '11')) {

                    $yearAct = date('Y');
                    $yearAnt = $yearAct - 1;
                    $mesDiasAnt = $mesDiasAnt . "-" . $yearAnt;
                } else {

                    $yearAct = date('Y');
                    $mesDiasAntF = $mesDiasAnt . "-" . $yearAct;
                }

                $perFecha = $numDia . "-" . $mesDiasAntF;
                $periodoFecha = date("Y-m-d", strtotime($perFecha));
                $nom = $utilidades->convertFechaNomDia($periodoFecha);
                //$tipo = "H";

                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);

                if ($resulInsertDia == null) {

                    $flgError = false;
                }
            }
        
        
        return $flgError;
    }
    
    function insertDiasAct($arregloDias,$mes,$tipo){
        
        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $utilidades = new utilidades();
        $flgError = true;
        
        foreach ($arregloDias as $valor) {

                if ($valor < 10) {

                    $numDia = "0" . $valor;
                    
                } else {

                    $numDia = $valor;
                }

                $perFecha = $numDia . "-" . $mes;
                $periodoFecha = date("Y-m-d", strtotime($perFecha));
                $nom = $utilidades->convertFechaNomDia($periodoFecha);
                //$tipo = "H";

                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);

                if ($resulInsertDia == null) {

                    $flgError = false;
                }
        }       
        
        return $flgError;
    }    

    function insertDetPlanillaUsuario($cedula, $hrsHabiles, $hrsFestivas, $horasDominicales, $observaciones) {
        
        if($hrsFestivas == null){
            
            $hrsFestivas = 0;
            
        }
        
        if($horasDominicales == null){
            
            $horasDominicales = 0;
        }
        
        if($observaciones == null){
            
            $observaciones = '';
        } 

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resultInsertDetalle = $reporteNominaDatos->insertDetallePlanilla($cedula, $hrsHabiles, $hrsFestivas, $horasDominicales, $observaciones);
        return $resultInsertDetalle;
    }

    function insertEncabezadoPlanilla($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();

        $usuCreo = $_SESSION['usuCodigo'];
        $fechaCreo = date('Y-m-d H:i:s');
        $tipo = "XX";
        $estado = 1;

        $fecha = "01-" . $fecha;
        $fecha = date("Y-m-d", strtotime($fecha));

        $resulInsert = $reporteNominaDatos->insertEncabezadoPlanilla($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $usuCreo, $fechaCreo, $tipo, $estado);

        return $resulInsert;
       
    }

    function valEncabezados($encabezados, $empInt) {

        $pos = Array();
        $encabezadosOblgatorios = array("Cedula", "Nombre", "Horas", "# Dias Lab", "Ordinarios periodo Anterior", "Festivos periodo Anterior", "Dominicales periodo Anterior", "Mes PA", "# Horas Festivas", "Dias Festivos", "# Horas DominicSinComp", "Dias DominicSinComp", "Observaciones");

        $i = 0;
        $val = 0;

        foreach ($encabezados as $valor) {

            if (trim($valor) == trim($encabezadosOblgatorios[$i])) {

                $val++;
                
            } else {

                $pos[$i] = $i;
            }

            $i++;

            if ($i > 12) {

                break;
            }
        }

        if ($val >= 13 && count($pos) == 0) {

            return true;
            
        } else {

            return $pos;
        }
    }

    function valEncabezadosAdicionales($encabezados, $empInt) {

        $longArreglo = count($encabezados);
        $pos = Array();

        for ($i = 14; $i <= $longArreglo; $i++) {

            if ($encabezados[$i] != null && $encabezados[$i] != '') {

                $resValidacion = $this->valAdicional($encabezados[$i], $empInt);

                if ($resValidacion[0]['cantidad'] == 0) {

                    $pos[] = $encabezados[$i];
                }
            }
        }

        if (count($pos) > 0) {

            return $pos;
        } else {

            return true;
        }
    }

    function valAdicional($idAdicional, $empInt) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->valAdicional($idAdicional, $empInt);
        return $resulConsulta;
    }

    function construirConceptos($objHoja, $encabezados, $i, $k) {

        $conceptos = '';

        $longEncabezados = count($encabezados);
        $posEncabezado = "N";

        for ($j = 14; $j <= $longEncabezados; $j++) {

            if ($encabezados[$j] != '') {
                
                if($objHoja[$i][$posEncabezado] == null){
                    
                    $conceptos[$k][$encabezados[$j]] = 0;
                    
                }else{
                    
                    $conceptos[$k][$encabezados[$j]] = $objHoja[$i][$posEncabezado];
                    
                }
                
                $posEncabezado++;
            }
        }

        return $conceptos;
    }

    function valDiasReportados($dias, $cedula, $mes, $empInt, $empCli, $centroCosto) {

        return true;
    }

    function obtenerDias($dias) {
        
        if($dias != null){
            
           $arreglo = explode(",", $dias);
           return $arreglo;
            
        }else{
            
            return null;
        }
        
       
    }

    function valCedCentroCosto($cedula, $empresaInt, $centroCosto, $ciudad) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->valCedCentroCosto($cedula, $empresaInt, $centroCosto, $ciudad);
        return $resulConsulta[0]['cantidad'];
    }

    function obtenerEncabezados($arregloEncabezados) {

        $i = 1;
        foreach ($arregloEncabezados as $valor) {

            $encabezados[$i] = $valor;
            $i = $i + 1;
        }

        return $encabezados;
    }

    function getIdentityPlanilla() {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->getIdentityPlanilla();
        return $resulconsulta;
    }

    function consultarDatosRegByIdPlanilla($id) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->consultarDatosRegByIdPlanilla($id);
        return $resulconsulta;
    }

    function consultarDiasByUsuario($idPlanilla, $idUsuario) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->consultarDiasByUsuario($idPlanilla, $idUsuario);
        return $resulconsulta;
    }

    function consultarConceptosByUsuario($idPlanilla, $idUsuario) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->consultarConceptosByUsuario($idPlanilla, $idUsuario);
        return $resulconsulta;
    }

    function consultarTotalConceptos($idPlanilla) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->consultarTotalConceptos($idPlanilla);
        return $resulconsulta;
    }

    function consultarDetConceptos($idPlanilla) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->consultarDetConceptos($idPlanilla);
        return $resulconsulta;
    }

    function finalizarPlanilla($idPlanilla) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->finalizarPlanilla($idPlanilla);
        return $resulconsulta;
    }

    function eliminarPlanilla($idPlanilla) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulconsulta = $reporteNominaDatos->eliminarPlanilla($idPlanilla);
        return $resulconsulta;
    }

    function cantUsuariosSinRegistrar($idPlanilla, $empInt, $centroCosto, $ciudad) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->cantUsuariosSinRegistrar($idPlanilla, $empInt, $centroCosto, $ciudad);
        return $resulConsulta;
    }

    function valUsuariosSinRegistrar($idPlanilla, $empInt, $centroCosto, $ciudad) {

        $reporteNominaDatos = new reporteNominaPlanoDatos();
        $resulConsulta = $reporteNominaDatos->valUsuariosSinRegistrar($idPlanilla, $empInt, $centroCosto, $ciudad);
        return $resulConsulta;
    }
    
    function valDiaIsNum($arreglosDias){
        
        $flgError = false;
        
        foreach ($arreglosDias as $valor){
            
           
            $isnum = is_numeric($valor);
            
            if($isnum != true){
                
                $flgError = true;
                
            }
            
        }
        
        if($flgError == true){
            
            return null;
        }else {
            
            return true;
        }
        
    }

}
?>

