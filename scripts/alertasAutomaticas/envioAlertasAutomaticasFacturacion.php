<?php

include '../../controlador/utilidades/utilidades.php';
require_once '../../libs/PHPMailer/class.phpmailer.php';
require_once '../../libs/PHPMailer/class.smtp.php';
require_once '../../datos/conexion.php';

$conexion = new conexion();

while (true) {

    $sql0 = "select * from estadoScript where nombre = 'alertasAutomaticas'";
    $resulEstadoScrip = $conexion->consultar($sql0);

    if ($resulEstadoScrip[0]['estado'] == 0) {

        $updateSql = "update estadoScript set estado = 1 where nombre = 'alertasAutomaticas'";
        $conexion->insertar($updateSql);

        $sql = "select top 100 * from alertas_automaticas1 where estado = 0";
        $sql2 = "select top 100 * from alertas_automaticas where estado = 0";
        $sql3 = "select top 100 * from alerta_recordar_clave where estado = 0";

        $resulConsulta = $conexion->consultar($sql);
        $resulConsulta2 = $conexion->consultar($sql2);
        $resulConsulta3 = $conexion->consultar($sql3);

        $utilidades = new utilidades();

        foreach ($resulConsulta as $valor) {

            $destinatario = $valor['destinatario'];
            $destinatario = explode(";", $destinatario);

            $copia1 = trim($valor['copia']);

            if ($copia1 == 'noReply@gmail.com') {
                $copia1 = 'info.visionymarketing@gmail.com';
            }

            $asunto = utf8_encode($valor['asunto']);
            $body = utf8_encode($valor['body']);
            $rutaArchivo = $valor['adjunto'];
            $longRutaArchivo = strlen($rutaArchivo);
            $nomArchivo = substr($rutaArchivo, '38', $longRutaArchivo);
            $dest = '../../temporales/archivosEnviados/' . $nomArchivo . '';
            $resulCopy = copy($rutaArchivo, $dest); 

            $envioMail = $utilidades->envioMail($asunto, $body, $destinatario, $dest, $copia1);           
            
            $dest = '';
            $nomArchivo = '';
            $asunto = '';
            $body = '';
            $copia1 = '';

            if ($envioMail == 1) {

                $sqlUpdate = "update alertas_automaticas1 set estado = 1 where id = " . $valor['id'] . "";
                $conexion->insertar($sqlUpdate);
                
            } else {
                
            }
        }

        foreach ($resulConsulta2 as $valor2) {

            $destinatario = $valor2['destinatario'];
            $destinatario = explode(";", $destinatario);
            $copia2 = trim($valor2['copia']);

            $asunto = utf8_encode($valor2['asunto']);
            $body = utf8_encode($valor2['body']);

            $rutaArchivo = $valor2['adjunto'];

            if ($rutaArchivo != null && $rutaArchivo != ';') {

                $longRutaArchivo = strlen($rutaArchivo);
                $nomArchivo = substr($rutaArchivo, '11', $longRutaArchivo);

                $rutaArchivo = "\\\servclo12\subidos\\" . $nomArchivo;

                $dest = '../../temporales/archivosEnviados/' . $nomArchivo . '';
                $resulCopy = copy($rutaArchivo, $dest);
            }

            $envioMail = $utilidades->envioMail($asunto, $body, $destinatario, $dest, $copia2);

            $asunto = '';
            $body = '';
            $desti = '';
            $dest = '';

            $dest = '';
            $nomArchivo = '';

            if ($envioMail == 1) {

                $sqlUpdate = "update alertas_automaticas set estado = 1 where id = " . $valor2['id'] . "";
                $conexion->insertar($sqlUpdate);
            } else {
                
            }
        }

        foreach ($resulConsulta3 as $valor3) {

            $destinatario = $valor3['destino'];
            $asunto = $valor3['body'];
            $body = $valor3['body'] . "<br> Usuario: " . $valor3['usuario'] . "<br> Clave:" . $valor3['clave'];
//$copia3 = 'info.visionymarketing@gmail.com';

            $envioMail = $utilidades->envioMail($asunto, $body, $destinatario);

            $asunto = '';
            $body = '';
            $destinatario = '';
            $dest = '';
            $copia3 = '';

            if ($envioMail == 1) {

                $sqlUpdate = "update alerta_recordar_clave set estado = 1 where id = " . $valor3['id'] . "";
                $conexion->insertar($sqlUpdate);
            } else {
                
            }
        }

        $updateSql = "update estadoScript set estado = 0 where nombre = 'alertasAutomaticas'";
        $conexion->insertar($updateSql);
    }

    sleep(30);
}
?>

