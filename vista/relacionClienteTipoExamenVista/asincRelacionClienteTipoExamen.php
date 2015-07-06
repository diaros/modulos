<?php

include '../../controlador/utilidades/utilidades.php';
include '../../controlador/relacionClienteTipoExamenControlador/relacionClienteTipoExamenControl.php';

$utilidades = new utilidades();
$relacionTipoExamenCli = new relacionClienteTipoExamenControl();

if (isset($_POST[accion]) && $_POST['accion'] == 'consultaEmpUsuarias') {

    $idEmpInt = $_POST['idEmpInt'];

    $resConsultaEmpUsuarias = $utilidades->consultarEmpUsuariasByEmpInt($idEmpInt);

    if ($resConsultaEmpUsuarias != false) {

        foreach ($resConsultaEmpUsuarias as $fila) {

            $json[$fila['nit']] = utf8_encode($fila['nombre']);
        }

        echo json_encode($json);
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarExamenes') {

    $idEmpInt = $_POST['idEmpInt'];
    $nitEmpUsu = trim($_POST['nitEmpUsu']);

    $resulConsulta = $relacionTipoExamenCli->consultarExamenes($idEmpInt, $nitEmpUsu);

    if ($resulConsulta != false) {

        echo json_encode($resulConsulta);
        
    } else {

        echo("-1");
    }
}

?>
