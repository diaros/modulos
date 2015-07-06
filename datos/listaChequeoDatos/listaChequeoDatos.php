<?php

include_once '../../datos/conexion.php';

class listaChequeoDatos{
    
    function __construct(){}
    
    function consultarDocumentos($empInt,$req,$idUser){
        
        $conexion = new conexion();        
        $sql="select a.descripcion,
                     a.id as idDoc,
                     b.id_estado as estado,
                     b.id as idLogDoc,
                     a.orden,
                     d.soporteDerogados
                     from
                     dbo.contratos_documentos_contrato a
                     left join dbo.contratos_log_lista_chequeo as b
                     on(a.id = b.id_documento 
                     and b.id_emp_int = ".$empInt."
                     and b.id_req = ".$req."
                     and b.id_user = ".$idUser." )
                     left join dbo.contratos_estado_documentos as c
                     on (b.id_documento = c.id)
                     left join dbo.contratos_log_estado_req as d
                     on(
                        d.id_emp_int = ".$empInt."
                        and d.requisicion = ".$req."
                        and d.id_usuario = ".$idUser."
                     )    
                     order by a.orden";
        
        $reporte = $conexion->consultar($sql);
        return $reporte;
    
    }
    
    function consultarLogDocumento($idLogDoc) {

        $conexion = new conexion();
        $sql = "select * from contratos_log_lista_chequeo where id = " . $idLogDoc . "";
        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

    function actLogDoc($idLogDoc,$estadoDoc,$idUserReg,$fechaReg){
        
        $conexion = new conexion();        
        $sql="update contratos_log_lista_chequeo set id_estado = ".$estadoDoc.", id_usuario_modifico = ".$idUserReg.", fecha_modificacion= '".$fechaReg."' where id = ".$idLogDoc."";
        $resulUpdate = $conexion->insertar($sql);
        return $resulUpdate;       
        
    }
    
    function insertLogDoc($empInt,$req,$idUser,$estadoDoc,$idDoc,$idUserReg,$fechaReg){
       
        $conexion = new conexion();
        $sql = "insert into contratos_log_lista_chequeo(id_req,id_user,id_emp_int,id_documento,id_estado,id_user_reg,fecha_reg) values(".$req.",".$idUser.",".$empInt.",".$idDoc.",".$estadoDoc.",".$idUserReg.",'".$fechaReg."')";
        $resulInsert = $conexion->insertar($sql);
        return $resulInsert;
        
    }
    
    function registrarLogReq($empInt,$req,$idUser,$idPsicologo = '',$fechareg,$estado,$idUserReg,$rutaArchivo = ''){
        
        $conexion = new conexion();
        
        if($idPsicologo == ''){
            
            $idPsicologo = 0;
            
        }
        
        $sql = "insert into contratos_log_estado_req(id_emp_int,requisicion,id_usuario,id_estado,id_psicologo,fecha_registro,id_user_reg,soporteDerogados) values(".$empInt.",".$req.",".$idUser.",".$estado.",".$idPsicologo.",'".$fechareg."',".$idUserReg.",'".$rutaArchivo."')";
        $resulinsert = $conexion->insertar($sql);
        return $resulinsert;

        
    }
    
    function actualizarLogReq($empInt, $req, $idUser,$idPsicologo = '',$fechareg, $estado,$idUserReg,$rutaArchivo = ''){ 
        
        $conexion = new conexion();
        
        if($idPsicologo == ''){
            
            $idPsicologo = 0;
            
        }
        
        $sql = "update contratos_log_estado_req set id_psicologo = ".$idPsicologo.", fecha_modificacion = '".$fechareg."', id_estado = ".$estado.", id_usuario_modifico = ".$idUserReg.", soporteDerogados = '".$rutaArchivo."'  where id_emp_int = ".$empInt." and requisicion = ".$req." and id_usuario = ".$idUser." ";
        $resulUpdate = $conexion->insertar($sql);
        return $resulUpdate;        
        
    }
    
    function consultarLogReq($empInt,$req,$idUser){
        
        $conexion = new conexion();        
       
        //$sql = "select count(*) as count from contratos_log_estado_req where id_emp_int = ".$empInt." and requisicion = ".$req." and id_usuario = ".$idUser."";
         $sql = "select * from contratos_log_estado_req where id_emp_int = ".$empInt." and requisicion = ".$req." and id_usuario = ".$idUser."";
        
        $resulinsert = $conexion->consultar($sql);
        return $resulinsert;
        
    }
    
   
  
}

?>

