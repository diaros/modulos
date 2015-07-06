<?php

require_once '../../datos/conexion.php';

class crearCategoriaDatos {

    public function __construct() {
        
    }

    function registrarCat($nombre,$estado) {

        $conexion = new conexion();
        $sql = "insert into exmed_categoria_examen (nombre,estado) values('" . $nombre . "'," . $estado . ")";
        $resulInsert = $conexion->insertar($sql);
        return $resulInsert;
    }
    
    function eliminarCat($idCat){
        
        $conexion = new conexion();
        $sql = "delete from exmed_categoria_examen where id_categoria_examen = ".$idCat." ";
        $resulDelete = $conexion->insertar($sql);
        return $resulDelete;
        
    }

}
