<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {

    header("Location: ../../vista/logueoVista/logueoVista.php");
}


include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';
include '../../controlador/relacionPsicologoClienteControlador/relacionPsicologoClienteControl.php';

$utilidades = new utilidades();
$relPsicologoCliente = new relacionPsicologoClienteControl();

$msjError = "none";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$number = 0;
$mostrarConsulta = "none";
$flgError = false;

$consutaEmpInt = $utilidades->consultarEmpInterna();
$consultaUsuPsico = $utilidades->consultarUsuariosPsicologos();

if (isset($_POST['accion']) && $_POST['accion'] == 'relacionar') {

    $inicioRegistro = $utilidades->iniciarTransaccion();

    if ($inicioRegistro != false) {

        $totalReg = $_POST['totalReg'];

        for ($i = 0; $i < $totalReg; $i++) {

            if (array_key_exists("idRelOculto" . $i, $_POST) && $_POST["idRelOculto" . $i] != 'null') {

                if (array_key_exists("estadoRel" . $i, $_POST)) {

                    $estadoRel = 1;
                } else {

                    $estadoRel = 0;
                }

                $idRel = $_POST["idRelOculto" . $i];

                $resulUpdate = $relPsicologoCliente->actRelacion($idRel, $estadoRel);

                if ($resulUpdate == false) {

                    $flgError = true;
                }
            } else {

                if (array_key_exists("estadoRel" . $i, $_POST)) {

                    $estadoRel = 1;
                    $idUsu = $_POST['usuario'];
                    $nitCliente = $_POST['nitCliente' . $i];

                    $resulInsert = $relPsicologoCliente->insertRelacion($idUsu, $nitCliente, $estadoRel);

                    if ($resulInsert == false) {

                        $flgError = true;
                    }
                }
            }
        }
    } else {

        $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
        $mostrarMsj = "block";
    }

    if ($flgError == true) {

        $utilidades->rollbackTransaccion();
        $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
        $mostrarMsj = "block";
    } else if ($flgError == false) {

        $utilidades->commitTransaccion();
        $msjExito = ":) Los registros han sido exitosos";
        $mostrarMsjExito = "block";
    }
}

$smarty->assign("mostrarMsjExito", $mostrarMsjExito, true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);

$smarty->assign("mostrarConsulta", $mostrarConsulta, true);
$smarty->assign("empInternas", $consutaEmpInt, true);
$smarty->assign("usuariosPsico", $consultaUsuPsico, true);

$smarty->display('../../web/relacionPsicologoClienteWeb/relacionPsicologoCliente.html.tpl');
?>

