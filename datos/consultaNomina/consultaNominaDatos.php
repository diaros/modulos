<?php

session_start();
include_once '../../datos/conexion.php';

class consultaNominaDatos {

    function __construct() {}

    function consultarDatosRegByIdPlanilla($id) {

        $conexion = new conexion();
        $sql = "select a.id, a.consecutivo,
                        a.id_emp_int,a.id_emp_cli,
                        a.centro_costo,a.periodo, 
                        a.tipo,a.quincena,
                        b.horas_habiles,
                        b.horas_dominicales,
                        b.horas_festivos,
                        b.id_usuario,
                        e.nom_empl,
                        e.ape_empl,
                        f.suc_nombre as ciudad,
                        d.nombre as concepto,
                        d.valor as vlr_concepto,
                        g.nro_cont
                        from   mod_nomina_planilla a,
                               mod_nomina_planilla_usuario b
                               left join mod_nomina_concepto d on (b.id = d.id_planilla_usuario),
                               mod_nomina_dia c,      
                               kactus.dbo.bi_emple e,
                               dbo.sucursales f,
                               kactus.dbo.nm_contr g
                        where 1 = 1
                        and a.id = " . $id . "
                        and a.id = b.id_planilla
                        and b.id = c.id_planilla_usuario
                        and b.id_usuario = e.cod_empl
                        and (convert(int,a.ciudad)) =  f.suc_codigo
                        and b.id_usuario = g.cod_empl
                        and a.id_emp_int = g.cod_empr
                        and g.ind_acti = 'A'
                        group by a.id, a.consecutivo,
                        a.id_emp_int,a.id_emp_cli,
                        a.centro_costo,a.periodo, 
                        a.tipo,a.quincena,
                        b.horas_habiles,
                        b.horas_dominicales,
                        b.horas_festivos,
                        b.id_usuario,
                        e.nom_empl,
                        e.ape_empl,suc_nombre,d.nombre ,d.valor, g.nro_cont
                        order by e.ape_empl,e.nom_empl";

        $resul = $conexion->consultar($sql);
        return $resul;
    }
    
    function tipoConcepto($idConcepto,$idEmpInt){
        
        $conexion = new conexion();
        $sql = "select a.cap_como
                from dbo.nm_conce a
                where 1=1
                and a.cod_empr = ".$idEmpInt."
                and a.cod_conc = ".$idConcepto."";

        $resul = $conexion->consultarKactus($sql);
        return $resul;  
        
    }

}
?>

