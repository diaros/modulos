<?php

include_once '../conexion.php';

class solicitudCompraDatos{
    
    function __construct(){}
    
    function consultarCentroCostoUnoE($empInt,$cc){
    
        $conexion = new conexion();
        
        if(ctype_digit($cc)){
            
            $sql = "select top (10) f284_id,f284_descripcion from dbo.t284_co_ccosto 
                            where f284_id_cia=$empInt
                            and f284_id like '%".$cc."%'
                            and f284_ind_estado=1";
            
        }else{
            
            $sql="select top (10) f284_id,f284_descripcion from dbo.t284_co_ccosto 
                            where f284_id_cia=$empInt
                            and f284_descripcion like '%".$cc."%'
                            and f284_ind_estado=1
                            order by f284_descripcion desc";
            
            
        }
        
        $resulConsulta = $conexion->consultarUnoE($sql);        
        if($resulConsulta != null){
            
            return $resulConsulta;
            
        }               
        
    }
    
    function consultaPresupuesto($presupuesto){
        
        $conexion = new conexion();        
        $sql = "select * from presupuesto where pr_consecutivo = ".$presupuesto." and pr_aprobado = 'S' and pr_estado ='A'";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
        
    }
    
    function consultaUsuarioAprueba($tipoCompra, $ciudad){

        $conexion = new conexion();

        if ($tipoCompra == 'facturable') {
            $sql = "select nombre,correo,codigo from usuarios_aprobacion_compra where (ciudad='$ciudad' or nacional ='S') and facturable ='S'";
        }
        if ($tipoCompra == 'administrativa') {
            $sql = "select nombre,correo,codigo from usuarios_aprobacion_compra where (ciudad='$ciudad' or nacional ='S') and admon ='S'";
        }
        if ($tipoCompra == 'presupuesto') {
            $sql = "select nombre,correo,codigo from usuarios_aprobacion_compra where (ciudad='$ciudad' or nacional ='S') and presupuesto ='S'";
        }
        
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }
    
    function guardarEncabezado($idUserReg,$fechaReg,$usuAprueba,$nitCliente,$ciudad,$aiu,$centroCosto,$fechaReq,$estado,$tipoCompra,$telefono,$concepto,$empInt,$observacion,$presupuesto,$actividad){
        
        $conexion = new conexion();        
        $sql = "insert into mod_compras_solicitud_compra(usu_reg,fecha_reg,ciudad,estado,tipo_compra,tel_contacto,empresa_interna,concepto,nit_cliente,aiu,centro_costo,fecha_orden,usu_aprueba,observaciones,presupuesto)"
                                                ."values(".$idUserReg.",'".$fechaReg."',".$ciudad.",".$estado.",".$tipoCompra.",".$telefono.",".$empInt.",".$concepto.",".$nitCliente.",".$aiu.",".$centroCosto.",'".$fechaReq."',".$usuAprueba.",'".$observacion."',".$presupuesto.")";        
        $resulInsert = $conexion->insertar($sql);        
        return $resulInsert;        
    }
    
    function guardarItem($cantidadItem,$descItem,$especItem,$ciudadItem,$dirItem,$contactoItem,$estadoItem){
        
        $conexion = new conexion();
        $sql = "insert into mod_compras_item_compra(id_solicitud,cantidad,descripcion,especificaciones,ciudad,direccion,contacto,estado)"
                                          . "values(SCOPE_IDENTITY(),".$cantidadItem.",'".$descItem."','".$especItem."','".$ciudadItem."','".$dirItem."','".$contactoItem."',".$estadoItem.")";
        $resulInsert = $conexion->insertar($sql);
        return $resulInsert;
        
    }
    
}

?>