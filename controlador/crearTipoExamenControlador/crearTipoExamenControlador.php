<?php

include_once '../../datos/crearTipoExamenDatos/crearTipoExamenDatos.php';

class crearTipoExamenControlador {

    public function __construct() {}

    function registrarTipoExam($desc, $paraCli, $especial, $estado, $categoria) {

        $crearTipoExamDatos = new crearTipoExamenDatos();
        $resulInsert = $crearTipoExamDatos->registrarTipoExam($desc, $paraCli, $especial, $estado, $categoria);        
        return $resulInsert;
    }
    
    function relExamCat($categoria){
        
        $crearTipoExamDatos = new crearTipoExamenDatos();
        $resulInsert = $crearTipoExamDatos->regRelacionExmenCat($categoria);
        return $resulInsert;
        
    }
 

    public function eliminarTipoExamen($idTipoExamen) {

        $crearTipoExamDatos = new crearTipoExamenDatos();

        $resulDeleteRel = $crearTipoExamDatos->eliminarRelExamenCat($idTipoExamen);

        if ($resulDeleteRel != false) {

            $resulDelete = $crearTipoExamDatos->eliminarTipoExamen($idTipoExamen);

            if ($resulDelete != false) {

                return $resulDelete;
                
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

}
?>

