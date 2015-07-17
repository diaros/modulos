<!DOCTYPE html>

<html>

    <head>
        
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">       

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/solicitudExamenCss/solicitudExamenCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 

        <title>Solicitud examen</title>
        
    </head>

    <body>            

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Solicitud examen</legend>
            
            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <input type="hidden" id="idUserLog" name="idUserLog" value="{$idUserLog}">

            <form id="crearClienteForm" name="crearClienteForm" class="form-horizontal" action="../../vista/solicitudExamenVista/solicitudExamenVista.php" method="post" autocomplete="off">

                <ul class="nav nav-tabs">
                    <li id="tab1"><a href="#solExamenMedico" data-toggle="tab" id="pesta1">Solicitud examen medico</a></li>
                    <li id="tab2" style="display:none;"><a href="#selecExamenes" data-toggle="tab"  id="pesta2">Seleccion de examenes</a></li>
                </ul>

                <div class="tab-content tabs-below">                    

                    <input type="hidden" id="tipoFacOculto" name="tipoFacOculto" value="">
                    <input type="hidden" id="tipoReg" name="tipoReg" value="{$vlrRegActivo}">
                    <input type="hidden" id="idOrden" name="idOrden" value="">

                    <div class="tab-pane active" id="solExamenMedico">

                        <div class="well" id="forma">
                           
                            <div class="panel-heading">
                                <h4>Información empresarial</h4>
                            </div>                        

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                                    <div class="col-md-8">
                                        <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpClienteSE();">
                                            <option value=""></option>
                                            {section name=empInt loop=$empresaInterna}
                                            <option value="{$empresaInterna[empInt].cod_Empr}">{$empresaInterna[empInt].nom_empr}</option>
                                            {/section}    
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="empUsu">Empresa cliente:</label>
                                    <div class="col-md-8">
                                        <select id="empUsu" name="empUsu" class="form-control" onchange="consultarTipoFac();"></select>
                                    </div>
                                </div>                     

                            </div>

                            <div class="col-lg-5">

                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="centroCosto">Centro costo:</label>
                                    <div class="col-md-8">
                                        <select id="centroCosto" name="centroCosto" class="form-control"></select>
                                    </div>

                                </div>                     

                            </div>

                            <div class="col-lg-5" id="campoNivel" style="display:none;">

                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="nivel">Nivel:</label>

                                    <div class="col-md-8">
                                        <select id="nivel" name="nivel" class="form-control"></select>
                                    </div>

                                </div>                     

                            </div>            

                        </div>

                        <div class="well" id="forma">                            

                            <div class="panel-heading">
                                <h4>Informacion IPS / Laboratorio</h4>
                            </div>

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="ciudad">Ciudad:</label>
                                    <div class="col-md-8">
                                        <select id="ciudad" name="ciudad" class="form-control" >
                                          
                                        </select>
                                    </div>
                                </div>                     

                            </div>

                            <div class="col-lg-5">

                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="lab">Laboratorio:</label>

                                    <div class="col-md-8">
                                        <select id="lab" name="lab" class="form-control">
                                            
                                            <option value=""></option>
                                            
                                            {section name=laboratorio loop=$laboratorios}
                                                <option value="{$laboratorios[laboratorio].id_laboratorio}">{$laboratorios[laboratorio].nombre}</option>
                                            {/section}
                                            
                                        </select>
                                    </div>

                                </div>                     

                            </div>

                            <div class="col-lg-10">

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="observ">Observaciones:</label>

                                    <div class="col-md-10">

                                        <textarea class="form-control" id="observ" name="observ"></textarea>

                                    </div>
                                </div>                                

                            </div>            

                        </div>
                                            
                       <div id="panelWell">
                           
                           <div class="panel-heading">
                                <h4>Datos personales</h4>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="idUser">No.Identificación:</label>  
                                    <div class="col-md-8">
                                        <input id="idUser" name="idUser" placeholder="Identificación" class="form-control input-md" type="text" onblur="consultarUser();">                          
                                    </div>
                                </div>
                            </div> 

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nomUser">Nombre:</label>  
                                    <div class="col-md-8">
                                        <input id="nomUser" name="nomUser" placeholder="Nombre" class="form-control input-md" type="text">                          
                                    </div>
                                </div>

                            </div> 

                            <div class="col-lg-5">                           
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="cargo">Cargo:</label>  
                                    <div class="col-md-8">
                                        
                                            <input class="form-control input-md" id="cargo" name="cargo" type="text" placeholder="Cargo" >
                                            <input type="hidden" id="cargoId" name="cargoId" value=""/>
                                        
                                    </div>
                                </div> 

                            </div>

                            <div class="col-lg-12" id="botones">

                                <button type="button" id="cosulUsersOrden" name="cosulUsersOrden" class="btn btn-primary" style="display:none;" onclick="consultarUsuariosOrden();"><span class="glyphicon glyphicon-refresh"></span> Recargar tabla</button>
                                <input type="button" id="guardarUser" value="Guardar usuario" class="btn btn-success" onclick="valVaciosUser();" style="display:none">
                                <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valVaciosSE();">
                                <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                            </div>                            

                        </div>                    

                    {*    <div class="well" id="forma">

                            <div class="panel-heading">
                                <h4>Datos personales</h4>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="idUser">No.Identificación:</label>  
                                    <div class="col-md-8">
                                        <input id="idUser" name="idUser" placeholder="Identificación" class="form-control input-md" type="text" onblur="consultarUser();">                          
                                    </div>
                                </div>
                            </div> 

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nomUser">Nombre:</label>  
                                    <div class="col-md-8">
                                        <input id="nomUser" name="nomUser" placeholder="Nombre" class="form-control input-md" type="text">                          
                                    </div>
                                </div>

                            </div> 

                            <div class="col-lg-5">                           
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="cargo">Cargo:</label>  
                                    <div class="col-md-8">
                                        
                                            <input class="form-control input-md" id="cargo" name="cargo" type="text" placeholder="Cargo" >
                                            <input type="hidden" id="cargoId" name="cargoId" value=""/>
                                        
                                    </div>
                                </div> 

                            </div>

                            <div class="col-lg-12" id="botones">

                                <button type="button" id="cosulUsersOrden" name="cosulUsersOrden" class="btn btn-primary" style="display:none;" onclick="consultarUsuariosOrden();"><span class="glyphicon glyphicon-refresh"></span> Recargar tabla</button>
                                <input type="button" id="guardarUser" value="Guardar usuario" class="btn btn-success" onclick="valVaciosUser();" style="display:none">
                                <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valVaciosSE();">
                                <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                            </div>

                        </div>*}

                        <hr>

                        <div id="tablaUsuarios" class="col-lg-12" style="display:{$mostrarConsulta};">

                            <table id="tablaDatosUsuarios" class="table table-hover table-striped table-condensed">

                                <thead>

                                <th>Id orden</th>
                                <th>Nombre</th>
                                <th>Cedula</th>
                                <th>Eliminar</th>

                                </thead> 

                                <tbody id="datosUsuarios">
                                </tbody>

                            </table>                  

                        </div>


                    </div>

                    <div class="tab-pane" id="selecExamenes">

                        <div class="well" id="forma">

                            <div class="panel-heading">
                                <h4>Seleccion de examenes</h4>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="catExam">Categoria:</label>
                                    <div class="col-md-8">

                                        <select id="catExam" name="catExam" class="form-control" onchange="conultarExamenes();">
                                        </select>     

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="examen">Examen:</label>
                                    <div class="col-md-8" id="examen">
                                    </div>
                                </div>
                            </div>                      

                            <div class="col-lg-12" id="botones">
                                
                                <button type="button" id="cosulExamsOrden" name="cosulExamsOrden" class="btn btn-primary" style="display:none;" onclick="consultarExamenesOrden();"><span class="glyphicon glyphicon-refresh"></span> Recargar tabla</button>
                                <input type="button" id="finalizarSol" value="Finalizar solicitud" class="btn btn-success" onclick="confirmFinalizarSol();" style="display:none">
                                <input type="button" id="guardarExam" value="Guardar" class="btn btn-primary" onclick="valVacionExam();">
                                <input type="button" id="limpiarExam" value="Limpiar" class="btn btn-danger" onclick="reiniciarExam();">

                            </div>

                        </div>

                        <hr>

                        <div id="tablaExamen" class="col-lg-12" style="display:{$mostrarConsultaExamen};">

                            <table id="tablaDatosExamen" class="table table-hover table-striped table-condensed">

                                <thead>

                                    <th>Id orden</th>
                                    <th>Examen</th>
                                    <th>Eliminar</th>

                                </thead> 

                                <tbody id="datosExamen">
                                </tbody>

                            </table>                  

                        </div>                    

                    </div>

                </div>

            </form>           

        </div>

        <div class="modal fade" id="modalInfo">

            <div class="modal-dialog">
                <div class="modal-content" >

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

           <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content noFondoModal">
                    <div class="modal-body" style="text-align: center;">
                        {*<img src="../../libs/imagenes/cargando.gif">*}
                        <span class=" fa fa-cog fa-spin fa-6x iconblue"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta seguro que desea eliminar este registro?</p>

                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarUser();">
                            <input type="hidden" id="ocultoId">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <div class="modal fade" id="modalConfirm2">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal3"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal3">

                        <p>Esta seguro que desea eliminar este registro?</p>

                        <div class="col-lg-12" id="botones3">

                            <input type="button" id="guardar2" value="Confirmar" class="btn btn-primary" onclick="eliminarExamen();">
                            <input type="hidden" id="ocultoId2">

                        </div>                        
                   
                    </div>
                         
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <div class="modal fade" id="modalConfirm3">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal3">Finalizar solicitud</h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal3">

                        <p>Esta seguro que desea finalizar la soliciutd?</p>

                        <div class="col-lg-12" id="botones3">

                            <input type="button" id="finalizar" value="Confirmar" class="btn btn-primary" onclick="finalizarSol();">                            

                        </div>                        
                   
                    </div>
                         
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        {$footer}
        
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../js/solicitudExamenJs/solicitudExamen.js"></script>      

    </body>   

</html>