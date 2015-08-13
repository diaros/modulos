<?php

include '../../controlador/utilidades/utilidades.php';
include '../../controlador/solicitudExamenControlador/solicitudExamenControl.php';

$utilidades = new utilidades();
$solicitudExamen = new solicitudExamenControl();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaEmpUsuarias'){

    $idEmpInt = $_POST['idEmpInt'];

    $resConsultaEmpUsuarias = $utilidades->consultarEmpUsuariasByEmpInt($idEmpInt);
    

    if ($resConsultaEmpUsuarias != false) {

        foreach ($resConsultaEmpUsuarias as $fila) {

            $json[$fila['nit']] = trim(utf8_encode($fila['nombre']));
        }

        echo json_encode($json);
        
    } else {

        echo '-1';
    }
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaPorLetra') {

    $nomCarg = $_POST['texto'];
    $idEmpInt = $_POST['idEmpresa'];
    $resulConsulta = $solicitudExamen->consultarCargoByLetra($nomCarg, $idEmpInt);
    
     if ($resulConsulta != false) {
         
        echo json_encode($resulConsulta);
        
    }   
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarCargo') {

    $idEmpInt = $_POST['idEmpInt'];
    $consultaCargo = $solicitudExamen->consultarCargoByEmpInt($idEmpInt);

    if ($consultaCargo != false) {
        echo json_encode($consultaCargo);
    } else {

        echo("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarLab') {

    $idCiudad = $_POST['idCiudad'];
    $consultaLab = $solicitudExamen->consultarLabByCiudad($idCiudad);

    if ($consultaLab != false) {

        echo json_encode($consultaLab);
    } else {

        echo("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarUser') {

    $id = $_POST['idUser'];

    if ($id != '') {

        $resulConsulta = $utilidades->consultaUserByID($id);

        if ($resulConsulta != false) {

            echo utf8_encode($resulConsulta[0]['usu_nombre']);
        } else {

            echo("-1");
        }
    } else {
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarTipoFac') {

    $idEmpInt = $_POST['idEmpInt'];
    $idEmpCli = $_POST['idCliInt'];

    $consultTipoFac = $solicitudExamen->consultTipoFacCliente($idEmpInt, $idEmpCli);

    if ($consultTipoFac != false) {

        echo json_encode($consultTipoFac);
    } else if ($$consultTipoFac == null) {

        echo ("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarCC'){

    $idEmpInt = $_POST['idEmpInt'];
    $idEmpCli = $_POST['idCliInt'];

    $resulConsulta = $solicitudExamen->consultarCentroCosto($idEmpInt, $idEmpCli);

    if ($resulConsulta != false) {

        echo json_encode($resulConsulta);    
        
    } else {
        echo("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarNivel') {

    $idEmpInt = $_POST['idEmpInt'];
    $idEmpCli = $_POST['idCliInt'];
    $tipoFac = $_POST['tipoFac'];
    $arbClie = $_POST['arbClie'];
    $idCliKac = $_POST['idCliKac'];

    $consultaNivel = $solicitudExamen->consultarNivel($idEmpInt, $idEmpCli, $tipoFac, $arbClie, $idCliKac);

    if ($consultaNivel != false) {

        echo json_encode($consultaNivel);
        
    } else {

        echo("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'regSolicitud') {

    $empInt = $_POST['empInt'];
    $empUsu = $_POST['empUsu'];
    $centroCosto = $_POST['centroCosto'];
    $nivel = $_POST['nivel'];
    $ciudad = $_POST['ciudad'];
    $lab = $_POST['lab'];
    $idUser = $_POST['idUser'];
    $nomUser = $_POST['nomUser'];
    $cargo = $_POST['cargo'];
    $idUserLog = $_POST['idUserLog'];
    $observ = $_POST['observ'];

    $nomUser = $utilidades->sanear_string($nomUser);
    $$observ = $utilidades->sanear_string($observ);

    $resulBegin = $utilidades->iniciarTransaccion();

    if ($resulBegin != false) {

        $resulInsert = $solicitudExamen->registrarSolicitud($empInt, $empUsu, $centroCosto, $nivel, $ciudad, $lab, $idUser, $nomUser, $cargo, $idUserLog, $observ);

        if ($resulInsert != false) {

            $resulComiit = $utilidades->commitTransaccion();
            
            $resulSeq = $solicitudExamen->consultarSecuencia();

            if ($resulSeq != false) {

                echo ($resulSeq);
                
            } else {

                echo '-1';
            }
        } else {

            $utilidades->rollbackTransaccion();
            echo("-1");
        }
    } else {

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarUsuariosOrden') {

    $idOrden = trim($_POST['idOrden']);

    $resulConsulta = $solicitudExamen->consultarUsuarios($idOrden);

    if ($resulConsulta != false && $resulConsulta != null) {

        echo json_encode($resulConsulta);
    } else if ($resulConsulta === null) {

        echo '1';
    } else if ($resulConsulta === false) {

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'regUser') {

    $idUser = $_POST['idUser'];
    $nomUser = $_POST['nomUser'];
    $cargo = $_POST['cargo'];
    $idOrden = trim($_POST['idOrden']);

    $nomUser = $utilidades->sanear_string($nomUser);

    $consultarExistenciaUserOrden = $solicitudExamen->consultarUserOrden($idUser, $idOrden);

    if ($consultarExistenciaUserOrden != false) {

        if ($consultarExistenciaUserOrden[0]['cant'] >= 1) {

            echo '-2';
        } else {

            $resulInsert = $solicitudExamen->registrarUsuario($idUser, $nomUser, $cargo, $idOrden);

            if ($resulInsert != false) {

                echo '1';
            } else {

                echo '-1';
            }
        }
    } else {

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminarUser') {

    $idReg = $_POST['idReg'];
    $resulDelete = $solicitudExamen->eliminarUser($idReg);


    if ($resulDelete != false) {

        echo "1";
    } else {

        echo "-1";
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consulExamenes') {

    $catego = $_POST['catego'];
    $nit = trim($_POST['nit']);
    $idEmpInt = $_POST['idEmpInt'];

    $resulConsulta = $solicitudExamen->consultaExamenes($catego, $nit, $idEmpInt);

    if ($resulConsulta != false) {

        echo json_encode($resulConsulta);
    } else {

        echo "-1";
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'registrarExamen') {

    $flgError == false;
    $flgExistencia == false;
    
    $idOrden = trim($_POST['idOrden']);
    $arregloIdExamenes = $_POST['arregloIdExamenes'];
    
    $utilidades->iniciarTransaccion();

    foreach ($arregloIdExamenes as $valor) {

        $consultarExistenciaExamenOrden = $solicitudExamen->consulExistenciaOrdenExam($idOrden, $valor);

        $resulConsultaExistencia = $consultarExistenciaExamenOrden[0]['cant'];

        if ($resulConsultaExistencia >= 1) {

           $flgExistencia = true;
            
        } else {

            $resulInsert = $solicitudExamen->registrarExamen($idOrden, $valor);

            if ($resulInsert != false) {              
                
            } else {

                $flgError = true;
            }
        }
    }
    
    if($flgError == true){
        
        $utilidades->rollbackTransaccion();
        echo '-1';
        
    }
    
    if($flgExistencia == true){
        $utilidades->rollbackTransaccion();
        echo '-2';
    }
    
    if($flgError == false && $flgExistencia == false){
        
        $utilidades->commitTransaccion();
        echo '1';
        
    } 
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarExamenesOrden') {

    $idOrden = trim($_POST['idOrden']);

    $resulConsulta = $solicitudExamen->consultarExamenesOrden($idOrden);

    if ($resulConsulta != false && $resulConsulta != null) {

        echo json_encode($resulConsulta);
    } else if ($resulConsulta === null) {

        echo '1';
    } else if ($resulConsulta === false) {

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminarExam') {

    $idItem = $_POST['idItem'];
    $resulDelete = $solicitudExamen->eliminarExamen($idItem);

    if ($resulDelete != false) {

        echo "1";
    } else {

        echo "-1";
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'finalizarSol') {

    $flgError = false;

    $idOrden = trim($_POST['idOrden']);
    $idEmpInt = $_POST['idEmpInt'];
    $arregloUsers = $_POST['arregloUsers'];
    $arregloExamenes = $_POST['arregloExamenes'];

    $utilidades->iniciarTransaccion();

    foreach ($arregloUsers as $valor) {

        foreach ($arregloExamenes as $valor2){

            $resulInsert = $solicitudExamen->regUserExamen($idOrden, $valor, $valor2,$idEmpInt);

            if ($resulInsert == false) {

                $flgError = true;
            }
        }
    }

    $resulUpdate = $solicitudExamen->finalizarSol($idOrden);

    if ($resulUpdate == false) {

        $flgError = true;
    }

    if ($flgError == true) {

        $utilidades->rollbackTransaccion();
        echo '-1';
        
    } else {

        $utilidades->commitTransaccion();
        echo '1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarCatExams') {

    $idCliInt = $_POST['idCliInt'];
    $idEmpInt = $_POST['idEmpInt'];

    $resulConsulta = $solicitudExamen->consultarCatExam($idCliInt, $idEmpInt);

    if ($resulConsulta != false) {

        echo json_encode($resulConsulta);
        
    } else {

        echo '-1';
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarCiudades'){
   
    $idEmpInt = $_POST['idEmpInt'];
    
    $resulConsulta = $utilidades->consultarCiudades($idEmpInt);
    
    if($resulConsulta != false){      
        
        echo json_encode($resulConsulta);
        
    }
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarCargoAuto'){
    
    $cargo = $_POST['texto'];
    $idEmpInt = $_POST['idEmpInt'];
    
    $resulConsulta = $solicitudExamen->consultarCargoByLetra($cargo, $idEmpInt);
    
    echo json_encode($resulConsulta);   
}

?>

