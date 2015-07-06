<?php

include_once '../../controlador/facturacionExamenesControlador/facturacionExamenesControlador.php';
include_once '../../controlador/utilidades/utilidades.php';

echo(date('h:i:s'));
//validarExamenesUsuarios();
facturarExamenes_Usuarios();

function facturarExamenes_Usuarios() {

    $utilidades = new utilidades();
    $facturacionExamenes = new facturacionExamenesControlador();

    $resulFacturacion = $facturacionExamenes->facturarExamenes();

    if ($resulFacturacion === null) {

        //validarExamenesUsuarios();
        //echo "<br>";
        echo(date('h:i:s'));
        $asunto = "Reporte del proceso de facturacion de examenes medicos";
        $body = "Cordial saludo \n \n El proceso de facturacion de examenes medicos ha sido ejecutado sin errores el dia " . date('Y-m-d') . " ";
        $destinatario = "diego.osorio@grupolistos.co";
        $utilidades->envioMail($asunto, $body, $destinatario);
        
    } elseif ($resulFacturacion === false) {

        // echo "<br>";
        // echo(date('h:i:s'));
        $asunto = "Reporte del proceso de facturacion de examenes medicos";
        $body = "Cordial saludo \n \n Ha ocurrido un fallo en ejecucion del procedimiento almacenado.";
        $destinatario = "diego.osorio@grupolistos.co";
        $utilidades->envioMail($asunto, $body, $destinatario);
    } else {

        $reporteError = "";
        $i = 1;
        foreach ($resulFacturacion as $pos => $valor) {

            $reporteError = $reporteError . "Error No: " . $i . "\n\n";
            $reporteError = $reporteError . "[f665_tipo_reg]:" . $valor['f665_tipo_reg'] . "\n\n\n";
            $reporteError = $reporteError . "[f665_subtipo_reg]:" . $valor['f665_subtipo_reg'] . "\n\n\n";
            $reporteError = $reporteError . "[f665_version]:" . $valor['f665_version'] . "\n\n\n";
            $reporteError = $reporteError . "[f665_nro_registro]:" . $valor['f665_nro_registro'] . "\n\n\n";
            $reporteError = $reporteError . "[f665_nivel_error]:" . $valor['f665_nivel_error'] . "\n\n\n";
            $reporteError = $reporteError . "[f665_nivel_error]:" . $valor['f665_valor_error'] . "\n\n\n";
            $reporteError = $reporteError . "[f665_detalle_error]:" . $valor['f665_detalle_error'] . "\n\n\n";
            $i++;
        }

        //echo "<br>";
        //echo(date('h:i:s'));
        $asunto = "Reporte del proceso de facturacion de examenes medicos";
        $body = "Cordial saludo <br><br> El proceso de facturacion de examenes medicos ha sido ejecutado con el siguiente reporte de errores: <br><br> " . $reporteError . " ";
        $destinatario = "diego.osorio@grupolistos.co";
        $utilidades->envioMail($asunto, $body, $destinatario);
    }
}
?>

