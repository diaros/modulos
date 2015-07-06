<?php

require_once '../../datos/conexion.php';
require_once '../../libs/nuSoap/nusoap.php';

$ms = 'http://192.168.0.163/Proyectos/ExamenesMedicos/webServices';

$server = new soap_server();

$server->configureWSDL('consultaDePrueba', $ms);
$server->wsdl->schemaTargetNamespace = $ms;

$server->register('consultaPrueba', // Nombre de la funcion 
        array(), // Parametros de entrada 
        array('return' => 'xsd:string'), // Parametros de salida 
        $ms);

function consultaPrueba(){
      
    $conexion = new conexion();
    $sql = "select * from actividad";
    $resultado = $conexion->consultarBiplusLog($sql);
    $msj = "No existen datos";
    
    if ($resultado == null) {
        return $msj;
    } else {
       
        $i = 0;
        $xml = '';

        foreach ($resultado as $valor) {

            $xml = $xml . "<reg" . $i . "><idActividad>" . $valor['idActividad'] . "</idActividad><nombreActividad>" . $valor['nombreActividad'] . "</nombreActividad><idProyecto>" . $valor['idProyecto'] . "</idProyecto></reg" . $i . ">";

            $i++;
        }

        return new soapval('return', 'xsd:string', utf8_encode('<consulta>' . $xml . '</consulta>'));
        
        
        
    }
}

//function insercionPrueba($datosUser) {
//    
//    $conexion = new conexion();
//    $sql = "insert into actividad () values ()";
//    $resultado = $conexion->consultarBiplusLog($sql);
//}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>

