<?php

require_once '../../datos/conexion.php';

class crearLaboratorioDatos{
    
    public function __construct(){}
    
    function consultarNit($nit){
        
        $conexion = new conexion();        
        $sql = "select * from exmed_laboratorio where nit = '".$nit."' ";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
        
    }
    
    function registrarLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado){
         $conexion = new conexion();
         $sql = "insert into exmed_laboratorio (nombre,"
                 . "                       ciudad,"
                 . "                       direccion,"
                 . "                       telefono,"
                 . "                       contacto,"
                 . "                       mail,"
                 . "                       estado,"
                 . "                       nit) "
                 . "               values ('".$nombre."',"
                 . "                       ".$ciudad.","
                 . "                       '".$direccion."',"
                 . "                       '".$telefono."',"
                 . "                       '".$contacto."',"
                 . "                       '".$mail."',"
                 . "                       ".$estado.","
                 . "                       '".$nit."')";
         $resulInsert = $conexion->insertar($sql);
         return $resulInsert;
        
    }
    
    function actLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado,$idLab){
        
        $conexion = new conexion();
        $sql = "update exmed_laboratorio set nit = '".$nit."',"
                . "                     nombre = '".$nombre."',"
                . "                     ciudad = '".$ciudad."',"
                . "                     direccion = '".$direccion."',"
                . "                     telefono = '".$telefono."',"
                . "                     contacto = '".$contacto."',"
                . "                     mail = '".$mail."',"
                . "                     estado = '".$estado."'"
                . "                     where id_laboratorio = ".$idLab."  ";
        
        $resulUpdate = $conexion->insertar($sql);
        
        return $resulUpdate;
          
    }
    
    function eliminarLab($idLab){
        
        $conexion = new conexion();
        $sql = "delete from exmed_laboratorio where id_laboratorio = ".$idLab." ";
        $resulDelete = $conexion->insertar($sql);
        return $resulDelete;
                
    }
}

