<?php

include_once '../../datos/conexion.php';

class gestionContratosDatos {

    function __construct() {}

    function consultarObservacion($empInt, $req, $idUser) {

        $conexion = new conexion();
        $sql = "select a.OBS_ERVA from sl_macon a,gn_ccost b,nm_fapar c where rmt_requ='$req' and a.cod_empl='$idUser' and a.cod_empr ='$empInt' and a.cod_empr =b.cod_empr and a.cod_ccos = b.cod_ccos  and a.cod_empr = c.cod_empr and a.cod_clie = c.cod_clie";
        $resultConsulta = $conexion->consultarKactus($sql);
        return $resultConsulta;
    }

    function consultarUsuariosxReq($empInt, $req, $idUser) {

        if ($idUser != '') {

            $condicion = "and a.cod_empl ='" . $idUser . "'";
        }

        $conexion = new conexion();
        $sql = "select *
            
                from sl_macon a,
                     gn_ccost b,
                     nm_fapar c,
                     bi_emple d,
                     gn_divip e,
                     bi_cargo f,
                     gn_empre g 

                where rmt_requ='" . $req . "' 
                      and a.cod_empr ='" . $empInt . "' 
                      " . $condicion . "
                      and a.cod_empr =b.cod_empr 
                      and a.cod_ccos = b.cod_ccos  
                      and a.cod_empr = c.cod_empr 
                      and a.cod_clie = c.cod_clie 
                      and a.cod_empr = d.cod_empr 
                      and a.cod_empl = d.cod_empl 
                      and d.mpi_naci = e.cod_mpio 
                      and d.dto_naci = e.cod_dpto 
                      and d.pai_naci = e.cod_pais 
                      and a.cod_empr = f.cod_empr 
                      and a.cod_carg = f.cod_carg 
                      and a.cod_empr = g.cod_empr ";

        $resultConsulta = $conexion->consultarKactus($sql);
        return $resultConsulta;
    }
    
    function consultarUsuariosxReq2($empInt, $req) {

        $conexion = new conexion();
        $sql = "select d.cod_empl,d.ape_empl,d.nom_empl
            
                from sl_macon a,
                     gn_ccost b,
                     nm_fapar c,
                     bi_emple d,
                     gn_divip e,
                     bi_cargo f,
                     gn_empre g 

                where rmt_requ='" . $req . "' 
                      and a.cod_empr ='" . $empInt . "' 
                      " . $condicion . "
                      and a.cod_empr =b.cod_empr 
                      and a.cod_ccos = b.cod_ccos  
                      and a.cod_empr = c.cod_empr 
                      and a.cod_clie = c.cod_clie 
                      and a.cod_empr = d.cod_empr 
                      and a.cod_empl = d.cod_empl 
                      and d.mpi_naci = e.cod_mpio 
                      and d.dto_naci = e.cod_dpto 
                      and d.pai_naci = e.cod_pais 
                      and a.cod_empr = f.cod_empr 
                      and a.cod_carg = f.cod_carg 
                      and a.cod_empr = g.cod_empr 
                      order by d.nom_empl";

        $resultConsulta = $conexion->consultarKactus($sql);
      
        return $resultConsulta;
    }

    function consultarMunicipio($empInt, $req, $idUser) {

        $conexion = new conexion();

        $sql1 = "select * from sl_macon a,gn_ccost b,nm_fapar c,bi_emple d,gn_divip e,bi_cargo f,gn_empre g where rmt_requ='$req' and a.cod_empr ='$empInt' and a.cod_empl ='" . $idUser . "' and a.cod_empr =b.cod_empr and a.cod_ccos = b.cod_ccos  and a.cod_empr = c.cod_empr and a.cod_clie = c.cod_clie and a.cod_empr = d.cod_empr and a.cod_empl = d.cod_empl and d.mpi_naci = e.cod_mpio and d.dto_naci = e.cod_dpto and d.pai_naci = e.cod_pais and a.cod_empr = f.cod_empr and a.cod_carg = f.cod_carg and a.cod_empr = g.cod_empr ";
        $resultConsulta = $conexion->consultarKactus($sql1);

        $pais = $resultConsulta[0]['pai_expe'];
        $dto = $resultConsulta[0]['dto_expe'];
        $mpio = $resultConsulta[0]['mpi_expe'];

        $sql2 = "select * from gn_divip where cod_pais='$pais' and cod_dpto ='$dto' and cod_mpio = '$mpio'  ";
        $resultConsulta2 = $conexion->consultarKactus($sql2);

        return $resultConsulta2[0]['nom_mpio'];
    }

    function consultarCliente($empInt, $codClie) {

        $conexion = new conexion();
        $sql = "select nom_clie from nm_fapar where cod_clie = " . $codClie . " and cod_empr = " . $empInt . " ";
        $resultConsulta = $conexion->consultarKactus($sql);
        return $resultConsulta[0]['nom_clie'];
    }

    function consultarSucursal($mpiCont) {

        $conexion = new conexion();
        $sql = "Select * from sucursales1 b where b.suc_codigo = '" . $mpiCont . "' ";
        $resulConsulta = $conexion->consultar($sql);
        return ($resulConsulta);
    }

    function consultaMpio($pais, $depto, $municipio = '') {

        $conexion = new conexion();
        $sql = "select nom_mpio from gn_divip where cod_pais='$pais' and cod_dpto ='$depto' and cod_mpio = '$municipio'  ";
        $resulConsulta = $conexion->consultarKactus($sql);
        return ($resulConsulta[0]['nom_mpio']);
    }

    function consultaSeguridadSocial($empInt, $codigEnt, $tipoEnt) {

        $conexion = new conexion();
        $sql = "select nom_enti from nm_entid where cod_empr ='$empInt' and cod_enti ='$codigEnt' and tip_enti ='" . $tipoEnt . "'";
        $resulConsulta = $conexion->consultarKactus($sql);
        return ($resulConsulta[0]['nom_enti']);
    }

    function registrarLogContrato($req, $idUser, $idUserCreo, $empInt, $salario, $contrato, $logo, $fechaFin) {
        
        $fechaReg = date('Y-m-d');
        
        if ($fechaFin == '') {

            $conexion = new conexion();
            $sql = "insert into contratos_log_contrato (requisicion,id_usuario,id_usuario_creo,id_emp_int,per_salario,logo,tipo_contrato,fecha_creacion) values('" . $req . "','" . $idUser . "','" . $idUserCreo . "','" . $empInt . "','" . $salario . "','" . $logo . "','".$contrato."','".$fechaReg."')";
            $resulInsert = $conexion->insertar($sql);
            return ($resulInsert);
            
        } else {

            $conexion = new conexion();
            $sql = "insert into contratos_log_contrato (requisicion,id_usuario,id_usuario_creo,id_emp_int,per_salario,logo,tipo_contrato,fecha_fin_contrato,fecha_creacion) values('" . $req . "','" . $idUser . "','" . $idUserCreo . "','" . $empInt . "','" . $salario . "','" . $logo . "', '".$contrato."' ,'" . $fechaFin . "','".$fechaReg."')";
            $resulInsert = $conexion->insertar($sql);
            return ($resulInsert);
        }
    }

    function consultarSeqLogContrato() {

        $conexion = new conexion();
        $sql = "select max (id) as id from contratos_log_contrato;";
        $resulConsulta = $conexion->consultar($sql);
        return ($resulConsulta[0]['id']);
    }
    
    function consultaLogContrato($req, $idUser, $empInt){
        
        $conexion = new conexion();
        $sql = "select id from contratos_log_contrato where requisicion = '".$req."' and id_usuario = '".$idUser."' and id_emp_int = '".$empInt."'";
        $resulConsulta = $conexion->consultar($sql);
        return ($resulConsulta[0]['id']);
        
    }
    
    function actualizarContrato($req, $idUser, $empInt, $idUserModifico,$contrato = '', $fechaFin = ''){
        
         $fechaAct = date('Y-m-d');
        
        if ($fechaFin == '') {
            
            $conexion = new conexion();
            $fechaFin = '';            
            $sql = "update contratos_log_contrato set tipo_contrato = ".$contrato." ,fecha_fin_contrato = '".$fechaFin."', id_usuario_modifico = ".$idUserModifico.",fecha_modificacion = '".$fechaAct."' where requisicion = ".$req." and id_usuario = ".$idUser." and id_emp_int = ".$empInt." ";
            $resulInsert = $conexion->insertar($sql);
            return ($resulInsert);
            
        } else {

            $conexion = new conexion();
            $sql = "update contratos_log_contrato set tipo_contrato = ".$contrato.", fecha_fin_contrato = '".$fechaFin."' , id_usuario_modifico = ".$idUserModifico.",fecha_modificacion = '".$fechaAct."' where requisicion = ".$req." and id_usuario = ".$idUser." and id_emp_int = ".$empInt."";
            $resulInsert = $conexion->insertar($sql);
            return ($resulInsert);
        }
        
    }

}

?>

