<?php

    include '../../datos/crearCategoriaDatos/crearCategoriaDatos.php';
    
    class crarCategoriaControl{
        
        public function __construct() {            
        }
        
        function registrarCat($nombre,$estado){
            
            $crearCategoriaDatos = new crearCategoriaDatos();
            $resulInsert = $crearCategoriaDatos->registrarCat($nombre,$estado);
            return $resulInsert;            
            
        }
        
        function eliminarCat($idCat){
            
            $crearCategoriaDatos = new crearCategoriaDatos();
            $resulDelete = $crearCategoriaDatos->eliminarCat($idCat);
            return $resulDelete;
        }
        
        function actCat($id,$nombre,$estado){
            
            $crearCategoriaDatos = new crearCategoriaDatos();
            
        }
        
    }

?>

