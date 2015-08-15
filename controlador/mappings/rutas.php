<?php

$accionMenu = $_GET['accionMenu'];
$arregloInfinito = array();

//Perfil 1 Solicitud y aprobacion de examenes
$arregloInfinito['goAprobarExamen'] = array('ruta' => '../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php');
$arregloInfinito['goConsultaExamenes'] = array('ruta' => '../../vista/consultaExamenesVista/consultaExamenesVista.php');
$arregloInfinito['goSolicitudExamen'] = array('ruta' => '../../vista/solicitudExamenVista/solicitudExamenVista.php');
$arregloInfinito['goAnularSolicitud'] = array('ruta' => '../../vista/anularSolicitudVista/anularSolcitudVista.php');

//Perfil 2 Parametrizaciones generales y de relaciones y Perfil 4 admin
$arregloInfinito['goCrearCategoria'] = array('ruta' => '../../vista/crearCategoriaVista/crearCategoriaVista.php');
$arregloInfinito['goCrearLaboratorio'] = array('ruta' => '../../vista/crearLaboratorioVista/crearLaboratorioVista.php');
$arregloInfinito['goCrearTipoExamen'] = array('ruta' => '../../vista/crearTipoExamenVista/crearTipoExamenVista.php');

$arregloInfinito['goRelacionClienteTipoExamen'] = array('ruta' => '../../vista/relacionClienteTipoExamenVista/relacionClienteTipoExamenVista.php');
$arregloInfinito['goRelacionLaboratorioExamen'] = array('ruta' => '../../vista/relacionLabExamenVista/relacionLabExamenVista.php');
$arregloInfinito['goRelacionPsicologoCliente'] = array('ruta' => '../../vista/relacionPsicologoClienteVista/relacionPsicologoClienteVista.php');
$arregloInfinito['goRelacionPsicologoCliente'] = array('ruta' => '../../vista/relacionPsicologoClienteVista/relacionPsicologoClienteVista.php');

//Perfil 3 Facturacion
$arregloInfinito['goCrearTipoCobro'] = array('ruta' => '../../vista/crearCentroCostoVista/crearCentroCostoVista.php');


//Perfil 4 Admin Parametrizaciones Generales y anular solicitud
//

//Modulo contratos
$arregloInfinito['goGestionContratos'] = array('ruta' => '../../vista/gestionContratosVista/gestionContratosVista.php');
$arregloInfinito['goConsultaRequisiciones'] = array('ruta' => '../../vista/consultaRequisicionesVista/consultaRequisicionesVista.php');
$arregloInfinito['goGestionRequisiciones'] = array('ruta' => '../../vista/gestionRequisicionesVista/gestionRequisicionesVista.php');
$arregloInfinito['goListaChequeo'] = array('ruta' => '../../vista/listaChequeoVista/listaChequeoVista.php');
$arregloInfinito['goDashBoard'] = array('ruta' => '../../vista/dashBoardVista/dashBoardVista.php');

//Modulo Nomina
$arregloInfinito['goReporteNomina'] = array('ruta' => '../../vista/reporteNominaPlanoVista/reporteNominaPlanoVista.php');
$arregloInfinito['goAprobarNomina'] = array('ruta' => '../../vista/aprobarNominaVista/aprobarNominaVista.php');
$arregloInfinito['goConsultarNomina'] = array('ruta' => '../../vista/consultaNominaVista/consultaNominaVista.php');


header("Location:" . $arregloInfinito[$accionMenu]['ruta']);

?>

