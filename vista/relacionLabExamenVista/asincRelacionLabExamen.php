<?php

include '../../controlador/relacionLabExamenControlador/relacionLabExamenControl.php';

$relacionLabExam = new relacionLabExamenControl();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarExamenes') {

    $idLab = $_POST['idLab'];

    $resulConsulta = $relacionLabExam->consultarExamenes($idLab);

    if ($resulConsulta != false) {

        echo json_encode($resulConsulta);
        
    } else {

        echo('-1');
    }
}
?>

