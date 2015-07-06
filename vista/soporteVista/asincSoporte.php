<?php

session_start();
include_once '../../controlador/utilidades/utilidades.php';

$utilidades = new utilidades();


if (isset($_POST['accion']) && $_POST['accion'] == 'notificacion'){   
    
    $modulo = $_POST['modulo'];
    
    if($modulo == 1){
        
        $modulo = "Contratos";
        
    }
    
    if($modulo == 2){
        
        $modulo = "Examenes medicos";
        
    }    
    
    $descripcion = $_POST['descripcion'];
    $asunto = 'Soporte';    
    $mailUsuario = $_SESSION['usuMail'];
    $usuario = $_SESSION['usuNombres'];
    
    $body = $modulo."<br><br>".$descripcion."<br><br>".$usuario."<br>".$mailUsuario;
    $destinatario = 'diego.osorio@listos.com.co';      
    
    $resulEnvioMail = $utilidades->envioMail($asunto, $body, $destinatario);
    
    if($resulEnvioMail == 1){
        
        echo("1");        
        
    }else{
        
        echo("-1");
        
    }   
    
}



?>

