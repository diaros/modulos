<?php

session_start();
if(!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    
    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/relacionClienteTipoExamenControlador/relacionClienteTipoExamenControl.php';
include '../../controlador/utilidades/utilidades.php';

$utilidades = new utilidades();
$relacionClienteExamen = new relacionClienteTipoExamenControl();

$msjError = "none";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$number = 0;
$flgError = false;
$mostrarConsulta = "none";

$consutaEmpInt = $utilidades->consultarEmpInterna();


if(isset($_POST[accion]) && $_POST['accion'] == 'relacionar'){

    $inicioRegistro = $utilidades->iniciarTransaccion();    
    
    if($inicioRegistro != false){
        
       $totalReg = $_POST['totalReg'];
       
        for($i=0 ; $i < $totalReg; $i++){
            
            $estadRel = $_POST['idRelacionOculto'.$i];
            
            if($estadRel != '0'){
                      
                $idRelacion = $_POST['idRelacionOculto'.$i];
                
                if(array_key_exists("estadoExamen".$i, $_POST)){
                    
                    $estadoRelExam = 1;
                    
                }else{
                    
                    $estadoRelExam = 0;
                }
                                
                $valorExam = $_POST['vlrExamen'.$i];                
                $facturable = $_POST['naturaleza'.$i];
                
                $resulUpdate = $relacionClienteExamen->actRelacion($idRelacion,$estadoRelExam,$valorExam,$facturable);
                
                if($resulUpdate ==false){
                    
                    $flgError = true;
                   
                }
              
            }else {
                
                if(array_key_exists("estadoExamen".$i, $_POST)){
                    
                    $estadoRelExam = 1;
                    
                }else{
                    
                    $estadoRelExam = 0;
                }
                                
                $valorExam = $_POST['vlrExamen'.$i];                
                $facturable = $_POST['naturaleza'.$i];
                $idExam = $_POST['idExam'.$i];
                $empInt = $_POST['empInt'];
                $nit = $_POST['empUsu'];               
                
                $resulInsert = $relacionClienteExamen->insertRelacion($empInt,$nit,$idExam,$estadoRelExam, $valorExam, $facturable);  
                
                if($resulInsert ==false){
                    
                    $flgError = true;
                   
                }
               // $i++;
            }            
            
        }
        
        if($flgError == true){
            
            $utilidades->rollbackTransaccion();
            $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
            $mostrarMsj = "block";            
            
        }else if($flgError == false){
            
            $utilidades->commitTransaccion();
            $msjExito = ":) Los registros han sido exitosos";
            $mostrarMsjExito = "block";
        }
        
    }else{
        
        $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
        $mostrarMsj = "block"; 
        
    }
    
    
    
}


$smarty->assign("mostrarConsulta", $mostrarConsulta, true);
$smarty->assign("number", $number, true);
$smarty->assign("mostrarMsjExito", $mostrarMsjExito, true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);

$smarty->assign("empInternas",$consutaEmpInt,true);
$smarty->assign("empUsuarias",$consultaEmpUsuarias,true);

$smarty->display('../../web/relacionClienteTipoExamenWeb/relacionClienteTipoExamen.html.tpl');

?>

