<?php

include '../../datos/reporteNominaDatos/reporteNominaDatos.php';
include_once '../../controlador/utilidades/utilidades.php';

session_start();

class reporteNominaControl {

    function __construct() {
        
    }

    function consultarClietneBySupervisor($idUser, $idEmpInt) {

        $reporteNominaDatos = new reporteNominaDatos();
        $resulConsulta = $reporteNominaDatos->consultarClietneBySupervisor($idUser, $idEmpInt);
        return $resulConsulta;
    }

    function cosultarCentroCostos($idEmpInt, $idEmpCli) {

        $reporteNominaDatos = new reporteNominaDatos();
        $resulConsulta = $reporteNominaDatos->cosultarCentroCostos(trim($idEmpInt), trim($idEmpCli));
        return $resulConsulta;
    }

    function consultarUsuarios($empInt, $centroCosto, $ciudad) {

        $reporteNominaDatos = new reporteNominaDatos();
        $resulConsulta = $reporteNominaDatos->consultarUsuarios($empInt, $centroCosto, $ciudad);
        return $resulConsulta;
    }

    function consultarDiaFestivo($fecha) {

        $utilidades = new utilidades();

        $fechaVal = $fecha[2] . "/" . $fecha[0] . "/" . $fecha['1'];
        $resulConsulta = $utilidades->consultarDiaFestivo($fechaVal);
        return $resulConsulta;
    }

    //modificar
    function insertEncabezadoPlanilla($arregloUsuHabiles, $arregloUsuAdicionales, $empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $periodo) {

        $reporteNominaDatos = new reporteNominaDatos();
        $flgError = false;

        $usuCreo = $_SESSION['usuCodigo'];
        $fechaCreo = date('Y-m-d H:i:s');

        $resulInsert = $reporteNominaDatos->insertEncabezadoPlanilla($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $usuCreo, $fechaCreo);

        if ($resulInsert != null) {

            $pos = 1;

            foreach ($arregloUsuHabiles as $usuario) {

                $longArreglo = count($usuario);
                $cedula = $usuario['1'];
                $observaciones = $usuario[$longArreglo - 1];

                $resulInsertDetPlanilla = $this->insertDetallePlanillaHabiles($cedula, $observaciones);

                if ($resulInsertDetPlanilla != null) {

                    $resultInsertDias = $this->insertDiaHabiles($usuario, $pos, $periodo);
                } else {

                    $flgError = true;
                }

                $pos = $pos + 1;
            }

            $pos = 1;

            foreach ($arregloUsuAdicionales as $usuario) {

                $longArreglo = count($usuario);
                $cedula = $usuario['1'];
                $observaciones = $usuario[$longArreglo - 1];
                $comision = $usuario[$longArreglo - 2];
                $auxMov = $usuario[$longArreglo - 3];
                $rn = $usuario[$longArreglo - 4];
                $hedn = $usuario[$longArreglo - 5];
                $hed = $usuario[$longArreglo - 6];
                $hefn = $usuario[$longArreglo - 7];
                $hef = $usuario[$longArreglo - 8];
                $hen = $usuario[$longArreglo - 9];
                $he = $usuario[$longArreglo - 10];

                $resulInsertDetPlanilla = $this->insertDetallePlanillaAdicionales($cedula, $comision, $auxMov, $rn, $hedn, $hed, $hefn, $hef, $hen, $he, $observaciones);

                if ($resulInsertDetPlanilla != null) {

                    $resultInsertDias = $this->insertDiaAdicional($usuario, $pos, $periodo);
                }

                $pos = $pos + 1;
            }

            if ($flgError != true) {
                return true;
            } else {

                return false;
            }
        } else {

            return '-1';
        }
    }

    //
    //modificar
    function insertDetallePlanillaHabiles($cedula, $observaciones) {

        $reporteNominaDatos = new reporteNominaDatos();
        $resultInsertDetalle = $reporteNominaDatos->insertDetallePlanilla($cedula, $observaciones);
        return $resultInsertDetalle;
    }

    //

    function insertDetallePlanillaAdicionales($cedula, $comision, $auxMov, $rn, $hedn, $hed, $hefn, $hef, $hen, $he, $observaciones) {

        $reporteNominaDatos = new reporteNominaDatos();
        $resultInsertDetalle = $reporteNominaDatos->insertDetallePlanillaAdicionales($cedula, $comision, $auxMov, $rn, $hedn, $hed, $hefn, $hef, $hen, $he, $observaciones);
        return $resultInsertDetalle;
    }

    function insertDiaAdicional($usuario, $pos, $periodo) {

        $reporteNominaDatos = new reporteNominaDatos();
        $utilidades = new utilidades();
        $longUsuario = count($usuario);
        $flgError = false;
        $periodoFecha = '';

        for ($i = 2; $i < $longUsuario - 10; $i++) {

            $numDia = '';
            $longPal = strlen($usuario[$i]);

            if ($pos < 10) {
                
                $numDia = substr($usuario[$i], 11, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else if ($pos < 100) {

                $numDia = substr($usuario[$i], 12, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else {

                $numDia = substr($usuario[$i], 13, $longPal);
                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            }

            if ($numDia != false) {

                $periodoFecha = $numDia . "-" . $periodo;
                $periodoFecha = date("Y-m-d", strtotime($periodoFecha));
                $nom = $utilidades->convertFechaNomDia($periodoFecha);

                if ($nom == 'Domingo') {

                    $tipo = "D";
                } else {

                    $tipo = "F";
                }


                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);

                if ($resulInsertDia == false) {

                    $flgError = true;
                }
            }
        }
    }

    function insertDiaHabiles($usuario, $pos, $periodo) {

        $reporteNominaDatos = new reporteNominaDatos();
        $utilidades = new utilidades();
        $longUsuario = count($usuario);
        $flgError = false;
        $periodoFecha = '';

        for ($i = 2; $i < $longUsuario - 1; $i++) {

            $numDia = '';
            $longPal = strlen($usuario[$i]);

            if ($pos < 10) {

                $numDia = substr($usuario[$i], 4, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else if ($pos < 100) {

                $numDia = substr($usuario[$i], 5, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else {

                $numDia = substr($usuario[$i], 6, $longPal);
                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            }

            if ($numDia != false) {

                $periodoFecha = $numDia . "-" . $periodo;
                $periodoFecha = date("Y-m-d", strtotime($periodoFecha));
                $nom = $utilidades->convertFechaNomDia($periodoFecha);
                $tipo = "H";
                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);

                if ($resulInsertDia == false) {

                    $flgError = true;
                }
            }
        }

        return $flgError;
    }

    //nuevas funciones
    function insertEncabezadoPlanilla2($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $periodo, $tipo,$estado) {

        $reporteNominaDatos = new reporteNominaDatos();

        $usuCreo = $_SESSION['usuCodigo'];
        $fechaCreo = date('Y-m-d H:i:s');

        $resulInsert = $reporteNominaDatos->insertEncabezadoPlanilla($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $usuCreo, $fechaCreo, $tipo,$estado);

        return $resulInsert;
    }

    function insertDetalleHabiles($arregloUsuHabiles, $periodo) {

        $reporteNominaDatos = new reporteNominaDatos();
        $flgError = true;

        foreach ($arregloUsuHabiles as $usuario) {

            $longArreglo = count($usuario);
            $cedula = $usuario['1'];
            $observaciones = $usuario[$longArreglo - 1];

            $resultInsertDetalle = $reporteNominaDatos->insertDetallePlanilla($cedula, $observaciones);

            if ($resultInsertDetalle == false) {

                $flgError = false;
            } else {

                $resulInserDiasHabiles = $this->insertDiasHabiles($usuario, $periodo);

                if ($resulInserDiasHabiles == false) {

                    $flgError = false;
                }
            }
        }

        return $flgError;
    }

    function insertDiasHabiles($usuario, $periodo) {

        $reporteNominaDatos = new reporteNominaDatos();
        $utilidades = new utilidades();
        $pos = 1;

//        foreach ($arregloUsuHabiles as $usuario) {

        $longUsuario = count($usuario);
        $flgError = true;
        $periodoFecha = '';

        for ($i = 2; $i < $longUsuario - 1; $i++) {

            $numDia = '';
            $longPal = strlen($usuario[$i]);

            if ($pos < 10) {

                $numDia = substr($usuario[$i], 4, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else if ($pos < 100) {

                $numDia = substr($usuario[$i], 5, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else {

                $numDia = substr($usuario[$i], 6, $longPal);
                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            }

            if ($numDia != false) {

                $periodoFecha = $numDia . "-" . $periodo;
                $periodoFecha = date("Y-m-d", strtotime($periodoFecha));
                $nom = $utilidades->convertFechaNomDia($periodoFecha);
                $tipo = "H";
                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);

                if ($resulInsertDia == false) {

                    $flgError = false;
                }
            }
        }
//        }

        return $flgError;
    }

    function insertDetalleAdicionales($arregloUsuAdicionales, $periodo) {

        $reporteNominaDatos = new reporteNominaDatos();
        $flgError = true;

        foreach ($arregloUsuAdicionales as $usuario) {

            $longArreglo = count($usuario);
            $cedula = $usuario['1'];
            $observaciones = $usuario[$longArreglo - 1];
            $comision = $usuario[$longArreglo - 2];
            $auxMov = $usuario[$longArreglo - 3];
            $rn = $usuario[$longArreglo - 4];
            $hedn = $usuario[$longArreglo - 5];
            $hed = $usuario[$longArreglo - 6];
            $hefn = $usuario[$longArreglo - 7];
            $hef = $usuario[$longArreglo - 8];
            $hen = $usuario[$longArreglo - 9];
            $he = $usuario[$longArreglo - 10];

            $resulInsertDetPlanilla = $reporteNominaDatos->insertDetallePlanillaAdicionales($cedula, $comision, $auxMov, $rn, $hedn, $hed, $hefn, $hef, $hen, $he, $observaciones);

            if ($resulInsertDetPlanilla == null) {

                $flgError = false;
            } else {

                $resulInsertDiasAdicionales = $this->insertDiasAdicionales($usuario, $periodo);

                if ($resulInsertDiasAdicionales == false) {

                    $flgError = false;
                }
            }
        }

        return $flgError;
    }

    function insertDiasAdicionales($usuario, $periodo) {

        $reporteNominaDatos = new reporteNominaDatos();
        $utilidades = new utilidades();
        $pos = 1;
        $flgError = true;

//        foreach ($arregloUsuAdicionales as $usuario) {

        $longUsuario = count($usuario);

        for ($i = 2; $i < $longUsuario - 10; $i++) {

            $numDia = '';
            $longPal = strlen($usuario[$i]);
            $periodoFecha = '';

            if ($pos < 10) {

                $numDia = substr($usuario[$i], 11, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else if ($pos < 100) {

                $numDia = substr($usuario[$i], 12, $longPal);

                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            } else {

                $numDia = substr($usuario[$i], 13, $longPal);
                if ($numDia < 10) {

                    $numDia = "0" . $numDia;
                }
            }

            if ($numDia != false) {

                $periodoFecha = $numDia . "-" . $periodo;
                $periodoFecha = date("Y-m-d", strtotime($periodoFecha));
                $nom = $utilidades->convertFechaNomDia($periodoFecha);

                if ($nom == 'Domingo') {

                    $tipo = "D";
                } else {

                    $tipo = "F";
                }

                $resulInsertDia = $reporteNominaDatos->insertDia($periodoFecha, $tipo, $nom);

                if ($resulInsertDia == false) {

                    $flgError = false;
                }
            }
        }
//        }

        return $flgError;
    }
    
    function getIdentityPlanilla(){
        
         $reporteNominaDatos = new reporteNominaDatos();
         $resulConsulta = $reporteNominaDatos->getIdentityPlanilla();
         return $resulConsulta;
        
    }
    
    function cosultaPlanillaById($id) {

        $reporteNominaDatos = new reporteNominaDatos();
        $resulConsulta = $reporteNominaDatos->cosultaPlanillaById($id);
        return $resulConsulta;
    }

    //
}
?>

