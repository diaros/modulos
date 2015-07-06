<?php

include_once '../../controlador/utilidades/utilidades.php';
require_once '../../controlador/consultaExamenesControlador/consultaExamenesControl.php';

$utilidades = new utilidades();
$consultaExamenes = new consultaExamenesControl();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaEmpUsuarias') {

    $idEmpInt = $_POST['idEmpInt'];

    $resConsultaEmpUsuarias = $utilidades->consultarEmpUsuariasByEmpInt($idEmpInt);

    if ($resConsultaEmpUsuarias != false) {

        foreach ($resConsultaEmpUsuarias as $fila) {

            $json[$fila['nit']] = $fila['nombre'];
        }

        echo json_encode($json);
        
    } else {

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'reporteExamenes'){
    
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $empresaInt = $_POST['empresaInt'];
    $cliente = $_POST['cliente'];
    $solIni = $_POST['solIni'];
    $solFin = $_POST['solFin'];
    $cedula = $_POST['cedula'];
    $estado = $_POST['estado'];
    
    if ($fechaIni != '' && $fechaFin != '') {

        $condicionDinamica = $condicionDinamica . " and a.fecha_proceso BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
    }

    if ($empresaInt != '') {

        $condicionDinamica = $condicionDinamica . " and a.empresa = '" . $empresaInt . "'";
    }

    if ($cliente != '') {

        $condicionDinamica = $condicionDinamica . " and a.nit_cliente = '" . $cliente . "' ";
    }

    if ($solIni != '' and $solFin != '') {

        $condicionDinamica = $condicionDinamica . "and a.id_solicitud_examen BETWEEN " . $solIni . " and " . $solFin . " ";
    }
    
    if ($cedula != '') {

        $condicionDinamica = $condicionDinamica . " and b.cedula = '" . $cedula . "'";
    }
    
    if ($estado != '') {

        if ($estado == 0) {

            $condicionDinamica = $condicionDinamica . " and f.estado is null ";
            
        } else {

            $condicionDinamica = $condicionDinamica . " and f.estado = '" . $estado . "' ";
        }
    }   
    
    $reporte = $consultaExamenes->reporteTotal($condicionDinamica, $inicio, $registrosxPag);
    
    $generarExcel = $consultaExamenes->generarExcel($reporte);
    
    echo $generarExcel;
    
    
}

?>

