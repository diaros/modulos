<?php

    include_once '../../datos/crearTipoExamenDatos/crearTipoExamenDatos.php';
    
    class crearTipoExamenControlador{
        
        public function __construct(){}
        
        function registrarTipoExam($desc,$paraCli,$especial,$estado,$valor){
            
            $crearTipoExamDatos = new crearTipoExamenDatos();            
            $resulInsert = $crearTipoExamDatos->registrarTipoExam($desc,$paraCli,$especial,$estado,$valor);
            return $resulInsert;
            
        }
        
        public function eliminarTipoExamen($idTipoExamen){
            
            $crearTipoExamDatos = new crearTipoExamenDatos();    
            $resulDelete = $crearTipoExamDatos->eliminarTipoExamen($idTipoExamen);
            return $resulDelete;
            
        }
        
    }

?>
