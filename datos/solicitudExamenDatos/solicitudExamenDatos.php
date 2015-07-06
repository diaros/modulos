<?php

include_once '../conexion.php';

class solicitudExamendatos {

    function __construct() {}

    function consultarCargoByLetra($nomCarg, $empInt) {

        $conexion = new conexion();
        $sql = "select top 20 cod_carg,nom_carg from dbo.bi_cargo where nom_carg like '%" . $nomCarg . "%' and bi_cargo.cod_empr = " . $empInt . "";
        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function consultarCargoByEmpInt($idEmpInt) {

        $conexion = new conexion();
        $sql = "select cod_carg,nom_carg from kactus.dbo.bi_cargo where bi_cargo.cod_empr = " . $idEmpInt . " order by nom_carg";
        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function consultarLabByCiudad($idCiudad) {

        $conexion = new conexion();
        $sql = "select id_laboratorio,nombre from exmed_laboratorio where ciudad ='" . $idCiudad . "'";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultTipoFacCliente($idEmpInt, $idEmpCli) {

        $conexion = new conexion();

        $sql = "select tipo_facturacion,arbol_cliente,id_cliente_kactus
                from exmed_tipo_cobro
                where id_empresa_cliente = '" . $idEmpCli . "'
                and id_empresa_interna = '" . $idEmpInt . "'";

        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultarCentroCosto($idEmpInt, $idEmpCli) {

        $conexion = new conexion();
        $sql = "select cod_clie,nom_clie from nm_fapar where (NIT_CLIE = '" . $idEmpCli . "' or OBS_ERVA= '" . $idEmpCli . "' ) and COD_EMPR = " . $idEmpInt . " and EST_CLIE = 'A'";
        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function consultarNivel($idEmpInt, $idEmpCli, $tipoFac, $arbClie, $idCliKac){

        $conexion = new conexion();

        if ($tipoFac == 3) {

            $sql = "select gn_nivel.cod_nive , gn_nivel.nom_nive
                        from dbo.gn_nivel
                        where gn_nivel.cod_empr=1
                        and gn_nivel.num_nive=5
                        and gn_nivel.cod_nive in 
                        (--Consulta nivel 3
                            select distinct (cod_nive) FROM dbo.gn_anive 
                            where  gn_anive.cod_empr=" . $idEmpInt . " and
                            rmt_ante in         
                                    (--Consulta nivel 2
                                    select rmt_aniv FROM dbo.gn_anive 
                                    where rmt_ante in 
                                                    (--Consulta nivel 1
                                                    SELECT rmt_aniv FROM dbo.gn_anive 
                                                    WHERE gn_anive.cod_empr=" . $idEmpInt . " 
                                                    AND gn_anive.ide_arbo = 'bi'
                                                    and gn_anive.num_nive = 1
                                                    and gn_anive.cod_nive =1)
                                    and gn_anive.num_nive=2
                                    and gn_anive.cod_nive=" . $idCliKac . "
                                    and gn_anive.cod_empr=" . $idEmpInt . ")) order by nom_nive";
        }

        if ($tipoFac == 4) {

            $sql = "select gn_nivel.cod_nive , gn_nivel.nom_nive
                        from dbo.gn_nivel
                        where gn_nivel.cod_empr=1
                        and gn_nivel.num_nive=5
                        and gn_nivel.cod_nive in 
                        (--Consulta nivel 4
                            select distinct (cod_nive) FROM dbo.gn_anive 
                            where  gn_anive.cod_empr=" . $idEmpInt . " and
                            rmt_ante in
                                    (--Consulta nivel 3
                                    select rmt_aniv FROM dbo.gn_anive 
                                    where  gn_anive.cod_empr=" . $idEmpInt . " and
                                    rmt_ante in         
                                            (--Consulta nivel 2
                                            select rmt_aniv FROM dbo.gn_anive 
                                            where rmt_ante in 
                                                            (--Consulta nivel 1
                                                            SELECT rmt_aniv FROM dbo.gn_anive 
                                                            WHERE gn_anive.cod_empr=" . $idEmpInt . " 
                                                            AND gn_anive.ide_arbo = 'bi'
                                                            and gn_anive.num_nive = 1
                                                            and gn_anive.cod_nive =1)
                                            and gn_anive.num_nive=2
                                            and gn_anive.cod_nive=" . $idCliKac . "
                                            and gn_anive.cod_empr=" . $idEmpInt . ")
                                            ))order by nom_nive";
        }

        if ($tipoFac == 5) {

            $sql = "select gn_nivel.cod_nive , gn_nivel.nom_nive
                            from dbo.gn_nivel
                            where gn_nivel.cod_empr=1
                            and gn_nivel.num_nive=5
                            and gn_nivel.cod_nive in 
                            (
                                    --Consulta nivel 5
                                    select distinct (cod_nive) FROM dbo.gn_anive 
                                    where  gn_anive.cod_empr=" . $idEmpInt . " and
                                    rmt_ante in
                                            (--Consulta nivel 4
                                            select rmt_aniv FROM dbo.gn_anive 
                                            where  gn_anive.cod_empr=" . $idEmpInt . " and
                                            rmt_ante in
                                                    (--Consulta nivel 3
                                                    select rmt_aniv FROM dbo.gn_anive 
                                                    where  gn_anive.cod_empr=" . $idEmpInt . " and
                                                    rmt_ante in         
                                                            (--Consulta nivel 2
                                                            select rmt_aniv FROM dbo.gn_anive 
                                                            where rmt_ante in 
                                                                            (--Consulta nivel 1
                                                                            SELECT rmt_aniv FROM dbo.gn_anive 
                                                                            WHERE gn_anive.cod_empr=1 
                                                                            AND gn_anive.ide_arbo = 'bi'
                                                                            and gn_anive.num_nive = 1
                                                                            and gn_anive.cod_nive =1)
                                                            and gn_anive.num_nive=2
                                                            and gn_anive.cod_nive=" . $idCliKac . "
                                                            and gn_anive.cod_empr=" . $idEmpInt . ")
                                                            )))order by nom_nive";
        }

        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function registrarSolicitud($empInt, $empUsu, $centroCosto, $nivel, $ciudad, $lab, $idUserLog, $fechaP, $observ) {

        $conexion = new conexion();

        if ($nivel == '') {

            $sqlInsert = "insert into exmed_solicitud_examen(empresa,fecha_proceso,nit_cliente,centro_costo,ciudad,id_laboratorio,usuario_elaboro,estado,observacion)values(" . $empInt . ",'" . $fechaP . "'," . $empUsu . "," . $centroCosto . ",'" . $ciudad . "'," . $lab . "," . $idUserLog . ",1,'" . $observ . "')";
        } else {

            $sqlInsert = "insert into exmed_solicitud_examen(empresa,fecha_proceso,nit_cliente,centro_costo,ciudad,id_laboratorio,usuario_elaboro,estado,nivel,observacion)values(" . $empInt . ",'" . $fechaP . "'," . $empUsu . "," . $centroCosto . ",'" . $ciudad . "'," . $lab . "," . $idUserLog . ",1," . $nivel . ",'" . $observ . "')";
        }

        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function resgistrarUser($idUser, $nomUser, $cargo) {

        $conexion = new conexion();
        $sqlInsert = "insert into exmed_examen_item_cedula(id_orden,cedula,nombre,cargo) values(SCOPE_IDENTITY()," . $idUser . ",'" . $nomUser . "','" . $cargo . "')";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function consultarSeq() {

        $conexion = new conexion();
        $sql = "select MAX(id_solicitud_examen) as seq from exmed_solicitud_examen";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultarUsuarios($idOrden) {

        $conexion = new conexion();
        $sql ="select a.id_examen_item_cedula,
                        a.id_orden,nombre,
                        a.cedula,
                        b.nom_carg 

                 from exmed_examen_item_cedula a,
                      kactus.dbo.bi_cargo b,
                      exmed_solicitud_examen c 

                 where 1 = 1
                 and   a.cargo = b.cod_carg
                 and   a.id_orden = c.id_solicitud_examen
                 and   c.empresa = b.cod_empr
                 and   a.id_orden = ".$idOrden."  ";
        
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function registrarUsuario($idUser, $nomUser, $cargo, $idOrden) {

        $conexion = new conexion();
        $sqlInser = "insert into exmed_examen_item_cedula(id_orden,cedula,nombre,cargo) values(" . $idOrden . "," . $idUser . ",'" . $nomUser . "','" . $cargo . "')";
        $resulInsert = $conexion->insertar($sqlInser);
        return $resulInsert;
        
    }

    function consultarUserOrden($idUser, $idOrden) {

        $conexion = new conexion();
        $sql = "select count(*) as cant from exmed_examen_item_cedula where id_orden = " . $idOrden . " and cedula = " . $idUser . " ";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
        
    }

    function eliminarUser($idReg) {

        $conexion = new conexion();
        $sqlDelete = "delete from exmed_examen_item_cedula where id_examen_item_cedula= " . $idReg . "";
        $resulDelete = $conexion->insertar($sqlDelete);
        return $resulDelete;
    }

    function eliminarExamen($idItem) {

        $conexion = new conexion();
        $sqlDelete = "delete from exmed_item_orden_examen where id_item_orden_examen = " . $idItem . "";
        $resulDelete = $conexion->insertar($sqlDelete);
        return $resulDelete;
    }

    function consultaExamenes($catego, $nit, $idEmpInt) {

        $conexion = new conexion();
        $sql = "select a.id_examen,
                       b.nombre

                 from exmed_relacion_cliente_examen as a,
                      exmed_tipo_examen as b,
                      exmed_categoria_examen as c

                 where a.nit_cliente = " . $nit . "
                   and a.id_empresa_int =" . $idEmpInt . "
                   and c.id_categoria_examen = " . $catego . "
                   and b.id_categoria = c.id_categoria_examen
                   and b.id_tipo_examen = a.id_examen
                   and a.estado = 1";


        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function registrarExamen($idOrden, $idExam) {

        $conexion = new conexion();
        $sqlInsert = "insert into exmed_item_orden_examen (id_orden,id_examen) values(" . $idOrden . "," . $idExam . ")";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function regUserExamen($idOrden, $idUser, $idExamen,$idEmpInt) {
        $conexion = new conexion();
        
        if($idEmpInt == 3){
            
            $sqlInsert = "insert into exmed_usuario_examen(id_orden,id_examen_item_cedula,id_item_orden_examen,ovs) values(" . $idOrden . "," . $idUser . "," . $idExamen . ", -1)";
            $resulInsert = $conexion->insertar($sqlInsert);
            return $resulInsert;
            
        }else{
            
            $sqlInsert = "insert into exmed_usuario_examen(id_orden,id_examen_item_cedula,id_item_orden_examen) values(" . $idOrden . "," . $idUser . "," . $idExamen . ")";
            $resulInsert = $conexion->insertar($sqlInsert);
            return $resulInsert;
            
        }       
        
    }

    function consultarExamenesOrden($idOrden) {

        $conexion = new conexion();
        $sql = "select  a.id_item_orden_examen,
                        c.nombre as nombre_catego,
                        b.nombre,
                        a.id_examen,
                        a.id_orden
                   from exmed_item_orden_examen as a,
                        exmed_tipo_examen as b,
                        dbo.exmed_categoria_examen c
                   where a.id_examen = b.id_tipo_examen
                   and   b.id_categoria = c.id_categoria_examen
                   and   a.id_orden = ".$idOrden." ";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consulExistenciaOrdenExam($idOrden, $idExam) {

        $conexion = new conexion();
        $sql = "select count(*) as cant from exmed_item_orden_examen where id_orden = " . $idOrden . " and id_examen = " . $idExam . "";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function finalizarSol($idOrden) {

        $conexion = new conexion();
        $sqlUpdate = "update exmed_solicitud_examen set estado = 2 where id_solicitud_examen = " . $idOrden . " ";
        $resulUpdate = $conexion->insertar($sqlUpdate);
        return $resulUpdate;
    }

    function consultarCatExam($idCliInt, $idEmpInt) {

        $conexion = new conexion();
        $sql = "select distinct (a.id_categoria_examen),
                             a.nombre 

                        from dbo.exmed_categoria_examen a,
                             dbo.exmed_relacion_cliente_examen b,
                             dbo.exmed_tipo_examen c

                        where b.id_empresa_int = ".$idEmpInt."
                        and   b.nit_cliente = ".$idCliInt."   
                        and   b.id_examen = c.id_tipo_examen
                        and   c.id_categoria = a.id_categoria_examen";
        
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }
    
    function consultarDatosSolicitud($idOrden){
        
        $conexion = new conexion();
        $sql = "select a.fecha_proceso,
                        a.observacion,
                        a.empresa,
                        b.nombre,
                        d.NOM_CLIE,
                        c.nombre as nombre_lab,
                        c.direccion,
                        c.telefono,
                        c.mail,
                        e.usu_nombre

                 from dbo.exmed_solicitud_examen a,
                      dbo.cliente_general b,
                      dbo.exmed_laboratorio c,
                      kactus.dbo.NM_FAPAR d,
                      dbo.Usuarios e

                  where a.nit_cliente = b.nit
                  and   a.empresa = b.empresa
                  and   a.id_laboratorio = c.id_laboratorio
                  and   a.centro_costo = d.COD_CLIE
                  and   a.empresa = d.COD_EMPR
                  and   a.usuario_elaboro = e.usu_id
                  and   a.id_solicitud_examen = ".$idOrden." ";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
        
        
    }

}
?>

