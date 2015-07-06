<?php

include '../../datos/anularSolicitudDatos/anularSolicitudDatos.php';

class anularSolicitudcontrol {

    function __construct(){}

    function consultarOrden($idOrden, $idUser) {

        $anularOrdenDatos = new anularSolicitudDatos();
        $resulConsulta = $anularOrdenDatos->consultarOrden($idOrden, $idUser);
        return $resulConsulta;
        
    }

    function anularOrden($consOrden) {

        $anularOrdenDatos = new anularSolicitudDatos();
        $resulUpdate = $anularOrdenDatos->anularOrden($consOrden);
        return $resulUpdate;
    }

    function totalRegistrosAnular($condicionDinamica, $idUser) {

        $anularOrdenDatos = new anularSolicitudDatos();
        $resulConsulta = $anularOrdenDatos->totalRegistrosAnular($condicionDinamica, $idUser);
        return $resulConsulta;
    }

    function consultarExamenesAnular($condicionDinamica, $inicio, $limite, $idUser) {

        $anularOrdenDatos = new anularSolicitudDatos();
        $consulta = $anularOrdenDatos->consultarExamenesAnular($condicionDinamica, $inicio, $limite, $idUser);
        return $consulta;
    }

}
?>

