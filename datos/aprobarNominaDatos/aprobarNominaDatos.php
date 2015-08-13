<?php

session_start();
include_once '../../datos/conexion.php';

class aprobarNominaDatos {

    function __construct() {
        
    }

    function consultaRegNomina($condicionDinamica) {

        $conexion = new conexion();
        $sql = "select top 50 a.id,
                              a.periodo,
                              a.usu_creo,
                              g.ape_empl,
                              g.nom_empl,
                              a.centro_costo,
                              f.nom_ccos,
                              b.nombre as cliente,
                              c.suc_nombre as ciudad,
                              d.nom_empr as empresa,
                              e.estado as estado "
                . "from dbo.mod_nomina_planilla a,
                                dbo.cliente_general b,
                                dbo.Sucursales c,
                                kactus.dbo.gn_empre d,
                                dbo.mod_nomina_estado e,
                                kactus.dbo.gn_ccost f,
                                kactus.dbo.bi_emple g
                          where 1=1 "
                . "" . $condicionDinamica . " "
                . " and a.id_emp_int = d.cod_empr
                          and convert(varchar,a.id_emp_cli) = b.nit
                          and a.ciudad = c.suc_codigo
                          and a.estado = e.id
                          and a.centro_costo = f.cod_ccos
                          and a.id_emp_int = f.cod_empr
                          and a.usu_creo = g.cod_empl
                          and a.estado in (2,4)";
        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

    function aprobarRegNom($id) {

        $conexion = new conexion();
        $sqlUpdate = 'update dbo.mod_nomina_planilla set estado = 4 where id = ' . $id . '  ';
        $resulUpdate = $conexion->insertar($sqlUpdate);
        return $resulUpdate;
    }

    function totalUsuarios($condicionDinamica,$estado) {

        $conexion = new conexion();
        $sql = "select count(*) as totalUsers
                    from dbo.mod_nomina_planilla a,
                    dbo.cliente_general b,
                    dbo.Sucursales c,
                    kactus.dbo.gn_empre d,
                    dbo.mod_nomina_estado e,
                    dbo.mod_nomina_planilla_usuario f

                    where 1=1  
                    " . $condicionDinamica . "
                    and a.id_emp_int = d.cod_empr
                    and convert(varchar,a.id_emp_cli) = b.nit
                    and a.ciudad = c.suc_codigo
                    and a.estado = e.id
                    and a.id = f.id_planilla
                    and a.estado = ".$estado."";
        $reporte = $conexion->consultar($sql);
        return $reporte[0]['totalUsers'];
    }

    function totalConceptos($condicionDinamica,$estado) {

        $conexion = new conexion();
        $sql = " select sum(g.valor) as totalConceptos
                    
                    from dbo.mod_nomina_planilla a,
                    dbo.cliente_general b,
                    dbo.Sucursales c,
                    kactus.dbo.gn_empre d,
                    dbo.mod_nomina_estado e,
                    dbo.mod_nomina_planilla_usuario f,
                    dbo.mod_nomina_concepto g,
                    kactus.dbo.nm_conce h

                    where 1=1   
                    " . $condicionDinamica . "
                    and a.id_emp_int = d.cod_empr
                    and convert(varchar,a.id_emp_cli) = b.nit
                    and a.ciudad = c.suc_codigo
                    and a.estado = e.id
                    and a.id = f.id_planilla
                    and f.id = g.id_planilla_usuario
                    and g.nombre = h.cod_conc
                    and a.id_emp_int =h.cod_empr
                    and h.cap_como = 'V'
                    and a.estado = ".$estado." ";
        $reporte = $conexion->consultar($sql);
        return $reporte[0]['totalConceptos'];
    }

    function totalDominicales($condicionDinamica, $estado) {

        $conexion = new conexion();
        $sql = "select sum (g.valor) as hrsDominicales
                    from dbo.mod_nomina_planilla a,
                         dbo.cliente_general b,
                         dbo.Sucursales c,
                         kactus.dbo.gn_empre d,
                         dbo.mod_nomina_estado e,
                         dbo.mod_nomina_planilla_usuario f,
                         dbo.mod_nomina_concepto g

                    where 1=1   
                    " . $condicionDinamica . "
                    and a.id_emp_int = d.cod_empr
                    and convert(varchar,a.id_emp_cli) = b.nit
                    and a.ciudad = c.suc_codigo
                    and a.estado = e.id
                    and a.id = f.id_planilla
                    and f.id = g.id_planilla_usuario
                    and g.nombre = 95
                    and a.estado = ".$estado." ";
        $reporte = $conexion->consultar($sql);
        return $reporte[0]['hrsDominicales'];
    }

    function totalFestivos($condicionDinamica , $estado) {

        $conexion = new conexion();
        $sql = "select sum (g.valor) as hrsFestivos
                    from dbo.mod_nomina_planilla a,
                         dbo.cliente_general b,
                         dbo.Sucursales c,
                         kactus.dbo.gn_empre d,
                         dbo.mod_nomina_estado e,
                         dbo.mod_nomina_planilla_usuario f,
                          dbo.mod_nomina_concepto g

                    where 1=1   
                    " . $condicionDinamica . "
                    and a.id_emp_int = d.cod_empr
                    and convert(varchar,a.id_emp_cli) = b.nit
                    and a.ciudad = c.suc_codigo
                    and a.estado = e.id
                    and a.id = f.id_planilla
                    and f.id = g.id_planilla_usuario
                    and g.nombre = 5
                    and a.estado = ".$estado." ";
        $reporte = $conexion->consultar($sql);
        return $reporte[0]['hrsFestivos'];
    }

    function totalOrdinarias($condicionDinamica, $estado) {

        $conexion = new conexion();
        $sql = "select sum (f.horas_habiles) as hrsOrdinarias
                    from dbo.mod_nomina_planilla a,
                         dbo.cliente_general b,
                         dbo.Sucursales c,
                         kactus.dbo.gn_empre d,
                         dbo.mod_nomina_estado e,
                         dbo.mod_nomina_planilla_usuario f

                    where 1=1   
                    " . $condicionDinamica . "
                    and a.id_emp_int = d.cod_empr
                    and convert(varchar,a.id_emp_cli) = b.nit
                    and a.ciudad = c.suc_codigo
                    and a.estado = e.id
                    and a.id = f.id_planilla
                    and a.estado = ".$estado." ";
        $reporte = $conexion->consultar($sql);
        return $reporte[0]['hrsOrdinarias'];
    }

    function detDominicales($condicionDinamica) {

        $conexion = new conexion();
        $sql = "select g.nom_empl as nombre ,
                        g.ape_empl as apellido,
                        f.id_usuario as cedula ,
                        h.valor as hrsDom

                        from dbo.mod_nomina_planilla a,
                             dbo.cliente_general b,
                             dbo.Sucursales c,
                             kactus.dbo.gn_empre d,
                             dbo.mod_nomina_estado e,
                             dbo.mod_nomina_planilla_usuario f,
                             kactus.dbo.bi_emple g,
                             dbo.mod_nomina_concepto h

                        where 1=1  
                         " . $condicionDinamica . "
                        and a.id_emp_int = d.cod_empr
                        and convert(varchar,a.id_emp_cli) = b.nit
                        and a.ciudad = c.suc_codigo
                        and a.estado = e.id
                        and a.id = f.id_planilla
                        and f.id_usuario = g.cod_empl
                        and a.id_emp_int = g.cod_empr
                        and f.id = h.id_planilla_usuario
                        and h.nombre = 95
                        --and f.horas_dominicales != 0";
        
        $reporte = $conexion->consultar($sql);
        return $reporte;
    }
    
    function detFestivos($condicionDinamica) {

        $conexion = new conexion();
        $sql = "select g.nom_empl as nombre ,
                        g.ape_empl as apellido,
                        f.id_usuario as cedula ,
                        h.valor as hrsFest

                        from dbo.mod_nomina_planilla a,
                             dbo.cliente_general b,
                             dbo.Sucursales c,
                             kactus.dbo.gn_empre d,
                             dbo.mod_nomina_estado e,
                             dbo.mod_nomina_planilla_usuario f,
                             kactus.dbo.bi_emple g,
                             dbo.mod_nomina_concepto h

                        where 1=1  
                         " . $condicionDinamica . "
                        and a.id_emp_int = d.cod_empr
                        and convert(varchar,a.id_emp_cli) = b.nit
                        and a.ciudad = c.suc_codigo
                        and a.estado = e.id
                        and a.id = f.id_planilla
                        and f.id_usuario = g.cod_empl
                        and a.id_emp_int = g.cod_empr
                        and f.id = h.id_planilla_usuario
                        and h.nombre = 5
                        --and f.horas_festivos != 0";
        
        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

    function detAdicionales($idPlanillas) {

        $conexion = new conexion();
//        $sql = " select d.nom_conc as nombre,
//                sum (c.valor)as totalConcepto
//
//                 from dbo.mod_nomina_planilla as a,
//                 dbo.mod_nomina_planilla_usuario b,
//                 dbo.mod_nomina_concepto c,
//                 kactus.dbo.nm_conce d,
//                 dbo.cliente_general e,
//                 dbo.Sucursales f,
//                 kactus.dbo.gn_empre g,
//                 dbo.mod_nomina_estado h
//                 
//                 where 1 = 1          
//                 " . $condicionDinamica . "
//                 and a.id_emp_int = d.cod_empr
//                 and c.nombre = d.cod_conc    
//                 and a.id = b.id_planilla
//                 and b.id = c.id_planilla_usuario
//                 and convert(varchar,a.id_emp_cli) = e.nit
//                 and a.ciudad = f.suc_codigo
//                 and a.id_emp_int = g.cod_empr
//                 and a.estado = h.id
//                 group by d.nom_conc";

        $sql = "select d.nom_conc as nombre,
                        sum (c.valor)as totalConcepto

                 from dbo.mod_nomina_planilla as a,
                 dbo.mod_nomina_planilla_usuario b,
                 dbo.mod_nomina_concepto c,
                 kactus.dbo.nm_conce d
                 where 1 = 1

                 and a.id in (" . $idPlanillas . ")
                 and a.id_emp_int = d.cod_empr
                 and c.nombre = d.cod_conc    
                 and a.id = b.id_planilla
                 and b.id = c.id_planilla_usuario
                 and d.cod_empr = a.id_emp_int
                 and d.cap_como = 'V'
                 group by d.nom_conc";

        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

}
?>

