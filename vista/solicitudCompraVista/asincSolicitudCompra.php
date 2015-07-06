<?php

session_start();

include '../../controlador/solicitudCompraControlador/solicitudCompraControl.php';
include_once '../../controlador/utilidades/utilidades.php';

$solicitudExamen = new solicitudCompraControl();
$utilidades = new utilidades();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarCC') {

    $empInt = $_POST['idEmpInt'];
    $centroCosto = $_POST['centroCosto'];
    $resulConsulta = $solicitudExamen->consultarCentroCostoUnoE($empInt, $centroCosto);
    echo json_encode($resulConsulta);
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarPresupuestoBiplus') {

    $presupuesto = $_POST['presupuesto'];
    $resulConsulta = $solicitudExamen->consultaPresupuesto($presupuesto);

    if ($resulConsulta != null) {

        foreach ($resulConsulta as $fila) {

            $json['cod_cliente'] = trim(utf8_encode($fila['pr_cod_cliente']));
            $json['evento'] = trim(utf8_encode($fila['pr_evento']));
            $json['nom_cliente'] = trim(utf8_encode($fila['pr_cliente']));
            $json['centro_costo'] = trim(utf8_encode($fila['pr_cod_evento_u']));
        }

        echo json_encode($json);
    } else {

        echo ("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaUsuAprueba') {

    $ciudad = $_POST['ciudad'];
    $tipoCompra = $_POST['tipoCompra'];

    $resulConsulta = $solicitudExamen->consultaUsuarioAprueba($tipoCompra, $ciudad);

    if ($resulConsulta != false) {

//            foreach ($resulConsulta as $fila){
//                
//                $json['nombre'] = trim(utf8_encode($fila['nombre']));
//                $json['codigo'] = trim(utf8_encode($fila['codigo']));
//                $json['mail'] = trim(utf8_encode($fila['correo']));
//                
//            }
//            
//            echo json_encode($json);

        echo json_encode($resulConsulta);
    } else {

        echo "-1";
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'registroEncabezado') {

    $tipoCompra = $_POST['tipoCompra'];
    $empInt = $_POST['empInt'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $concepto = $_POST['concepto'];
    $fechaReq = $_POST['fechaReq'];
    $usuAprueba = $_POST['usuAprueba'];
    $observacion = $_POST['descripcion'];



    if ($tipoCompra == 'facturable') {

        $tipoCompra = 1;
        $nitCliente = $_POST['cliente'];
        $aiu = $_POST['aiu'];
        $centroCosto = $_POST['centroCosto'];

        $presupuesto = 0;
        $actividad = '';
    }

    if ($tipoCompra == 'presupuesto') {

        $tipoCompra = 2;

        $presupuesto = $_POST['presupuesto'];
        $actividad = $_POST['actividad'];
        $nitCliente = $_POST['cliente'];

        $aiu = 0;
        $centroCosto = 0;
    }

    if ($tipoCompra == 'administrativa') {

        $tipoCompra = 3;
        $centroCosto = $_POST['centroCosto'];

        $presupuesto = 0;
        $actividad = '';
        $nitCliente = 0;
        $aiu = 0;
    }

    $cantidadItem = $_POST['cantidadItem'];
    $descItem = $_POST['descripcionItem'];
    $especItem = $_POST['especificaionesItem'];
    $ciudadItem = $_POST['ciudadItemItem'];
    $dirItem = $_POST['direccionItem'];
    $contactoItem = $_POST['contactoItem'];

    $estadoSolicitud = '1';
    $estadoItem = '1';

    $idUserReg = $_SESSION['usuCodigo'];
    $fechaReg = date('Y-m-d h:i:s');

    $resulBegin = $utilidades->iniciarTransaccion();

    if ($resulBegin != false) {

        $resulGuardarEncabezado = $solicitudExamen->guardarEncabezado($idUserReg, $fechaReg, $usuAprueba, $nitCliente, $ciudad, $aiu, $centroCosto, $fechaReq, $estadoSolicitud, $tipoCompra, $telefono, $concepto, $empInt, $observacion, $presupuesto, $actividad);

        if ($resulGuardarEncabezado != false) {

            $resulGuardarItem = $solicitudExamen->guardarItem($cantidadItem, $descItem, $especItem, $ciudadItem, $dirItem, $contactoItem, $estadoItem);

            if ($resulGuardarItem != false) {

                $utilidades->commitTransaccion();
                echo("1");
            } else {

                $utilidades->rollbackTransaccion();
                echo("-1");
            }
        } else {

            $utilidades->rollbackTransaccion();
            echo("-1");
        }
    } else {

        echo("error inicio transaccion");
    }
}
?>

