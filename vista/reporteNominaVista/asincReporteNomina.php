<?php

include '../../controlador/reporteNominaControlador/reporteNominaControl.php';
include_once '../../controlador/utilidades/utilidades.php';

$reporteNomimaControl = new reporteNominaControl();
$utilidades = new utilidades();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaClientes') {

    $idEmpInt = $_POST['idEmpInt'];
    $idUser = $_SESSION['usuCodigo'];

    $resulConsultaCliente = $reporteNomimaControl->consultarClietneBySupervisor($idUser, $idEmpInt);

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

    $resulConsultaCC = $reporteNomimaControl->cosultarCentroCostos($idEmpInt, $idEmpCli);

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

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarUsuarios') {

    $empInt = $_POST['empInt'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];

    $resulConsulta = $reporteNomimaControl->consultarUsuarios($empInt, $centroCosto, $ciudad);

    if ($resulConsulta != false) {

        echo json_encode($resulConsulta);
    } else {

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarFestivo') {

    $fecha = $_POST['fecha'];
    $resulConsulta = $reporteNomimaControl->consultarDiaFestivo($fecha);

    if ($resulConsulta[0]['festivo'] == '1') {

        echo ('1');
    } else {

        echo('0');
    }
}

//a modificar -Eliminar
if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {

    $arregloUsuHabiles = $_POST['arregloUsuHabiles'];
    $arregloUsuAdicionales = $_POST['arregloUsuAdicionales'];
    $empresaInt = $_POST['empInt'];
    $empUsu = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $periodo = $_POST['periodo'];
    $quincena = $_POST['quincena'];

    $fecha = "01-" . $periodo;
    $fecha = date("Y-m-d", strtotime($fecha));

    $inicio = $utilidades->iniciarTransaccion();

    if ($inicio != null) {

        $resulInsertEncabezado = $reporteNomimaControl->insertEncabezadoPlanilla($arregloUsuHabiles, $arregloUsuAdicionales, $empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $periodo);

        if ($resulInsertEncabezado != false) {

            $utilidades->commitTransaccion();
        } else {

            $utilidades->rollbackTransaccion();
        }
    } else {

        echo("-1");
    }
}
//

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarExistencia') {

    $empUsu = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $periodo = $_POST['periodo'];
    $quincena = $_POST['quincena'];
}

//guardar habiles
if (isset($_POST['accion']) && $_POST['accion'] == 'guardarHabiles') {

    $arregloUsuHabiles = $_POST['arregloUsuHabiles'];
    $empresaInt = $_POST['empInt'];
    $empUsu = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $periodo = $_POST['periodo'];
    $quincena = $_POST['quincena'];

    $fecha = "01-" . $periodo;
    $fecha = date("Y-m-d", strtotime($fecha));

    $inicio = $utilidades->iniciarTransaccion();

    if ($inicio != null) {

        $tipo = 'HA';
        $estado = 1;

        $resulInsertEncabezado = $reporteNomimaControl->insertEncabezadoPlanilla2($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $periodo, $tipo,$estado);

        if ($resulInsertEncabezado != false) {

            $resulInserHabiles = $reporteNomimaControl->insertDetalleHabiles($arregloUsuHabiles, $periodo);

            if ($resulInserHabiles != false) {
                
                $id = $reporteNomimaControl->getIdentityPlanilla();
                
                $consultaDatos = $reporteNomimaControl->cosultaPlanillaById($id[0]['id']);                
                $resulCommit = $utilidades->commitTransaccion();
                

                if ($resulCommit != false) {

                    echo json_encode($consultaDatos);
                    
                } else {
                    
                    $utilidades->rollbackTransaccion();
                    echo("-1");
                    
                }
                
            } else {

                $utilidades->rollbackTransaccion();
                echo("-1");
            }
        } else {

            $utilidades->rollbackTransaccion();
            echo("-1");
        }
    } else {

        $utilidades->rollbackTransaccion();
        echo("-1");
    }
}
//
//guardar adicionales
if (isset($_POST['accion']) && $_POST['accion'] == 'guardarAdicionales') {

    $arregloUsuAdicionales = $_POST['arregloUsuAdicionales'];
    $empresaInt = $_POST['empInt'];
    $empUsu = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $periodo = $_POST['periodo'];
    $quincena = $_POST['quincena'];

    $fecha = "01-" . $periodo;
    $fecha = date("Y-m-d", strtotime($fecha));

    $inicio = $utilidades->iniciarTransaccion();

    if ($inicio != null) {

        $tipo = 'AD';
        $estado = 1;

        $resulInsertEncabezado = $reporteNomimaControl->insertEncabezadoPlanilla2($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $periodo, $tipo,$estado);

        if ($resulInsertEncabezado != false) {

            $resulInsertDetalleAdicionales = $reporteNomimaControl->insertDetalleAdicionales($arregloUsuAdicionales, $periodo);

            if ($resulInsertDetalleAdicionales != false) {
                
                $id = $utilidades->getScopeIdentity();
                $resulCommit = $utilidades->commitTransaccion();

                if ($resulCommit != false) {

                    echo '1';
                    
                } else {

                    $utilidades->rollbackTransaccion();
                    echo '-1';
                }
            } else {
                $utilidades->rollbackTransaccion();
                echo ("-1");
            }
        } else {
            $utilidades->rollbackTransaccion();
            echo ("-1");
        }
    } else {
        $utilidades->rollbackTransaccion();
        echo ("-1");
    }
}
//
?>

