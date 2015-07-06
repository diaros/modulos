<!DOCTYPE html>
<html>

    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/DataTables-1.10.3/media/css/jquery.dataTables.min.css">
        <link type="text/css" href="../../css/crearLaboratorioCss/crearLaboratorio.css" rel="stylesheet">
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet">

        <title>Crear laboratorio</title>
        
    </head>

    <body>
        
        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Crear laboratorio</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="crearLaboratorioForm" name="crearLaboratorioForm" class="form-horizontal" action="../../vista/crearLaboratorioVista/crearLaboratorioVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <input type="hidden" id="idLab" name="idLab" value="" />

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nit">Nit:</label>  
                            <div class="col-md-8">
                                <input id="nit" name="nit" placeholder="Nit" class="form-control input-md" type="text" onblur="valNit();">                          
                            </div>
                        </div>  
                    </div>    

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombre">Nombre:</label>  
                            <div class="col-md-8">
                                <input id="nombre" name="nombre" placeholder="nombre" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div>    

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ciudad">Ciudad:</label>
                            <div class="col-md-8">
                                <select id="ciudad" name="ciudad" class="form-control">
                                    <option value=""></option>
                                    {section name=ciudad loop=$ciudades}
                                        <option value="{$ciudades[ciudad].suc_codigo}">{$ciudades[ciudad].suc_nombre}</option>
                                    {/section}

                                </select>
                            </div>
                        </div>                     

                    </div>

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="direccion">Direccion:</label>  
                            <div class="col-md-8">
                                <input id="direccion" name="direccion" placeholder="Direccion" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div>    

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="telefono">Telefono:</label>  
                            <div class="col-md-8">
                                <input id="telefono" name="telefono" placeholder="Telefono" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div> 

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="contacto">Contacto:</label>  
                            <div class="col-md-8">
                                <input id="contacto" name="contacto" placeholder="contacto" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div>  

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mail">Mail Contacto:</label>  
                            <div class="col-md-8">
                                <input id="mail" name="mail" placeholder="Mail Contacto" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Estado:</label>

                            <div class="col-md-8">
                                <select id="estado" name="estado" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>                     

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="validarVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>

                </div>

                <hr>                                    

                <div id="tablaLaboratorios" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table id="registrosLab" class="table table-hover table-striped table-condensed">

                        <thead>
                            <tr>
                                <th>Nit</th>
                                <th>Nombre</th>
                                <th>Ciudad</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Contacto</th>
                                <th>Mail contacto</th>
                                <th>Estado</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <tbody id="datosLab">

                            {section name=laboratorio loop=$laboratorios}

                                <tr>
                            <div style="display:none">{$number++}</div>

                            <td>{$laboratorios[laboratorio].nit}</td>
                            <td>{$laboratorios[laboratorio].nombre}</td>
                            <td>{$laboratorios[laboratorio].suc_nombre}</td>
                            <td>{$laboratorios[laboratorio].direccion}</td>
                            <td>{$laboratorios[laboratorio].telefono}</td>
                            <td>{$laboratorios[laboratorio].contacto}</td>
                            <td>{$laboratorios[laboratorio].mail}</td>
                            <td>{$laboratorios[laboratorio].estado}</td> 

                            <td>
                                <input type="button" class="btn btn-link" value="Eliminar" onclick="confirmacionEliminar({$number});"></input>
                            </td>                            
                            <input type="hidden" id="idLab{$number}" name="idLab{$number}" value="{$laboratorios[laboratorio].id_laboratorio}">

                            </tr>                               

                        {/section}                                

                        </tbody>

                    </table>

                </div>

            </form>

        </div>

        <div class="modal fade" id="modalInfo">

            <div class="modal-dialog">
                <div class="modal-content">

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
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        <img src="../../libs/imagenes/cargando.gif">
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <p>Esta seguro que desea eliminar este registro?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarLab();">
                            <input type="hidden" id="ocultoId">

                        </div>
                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 


        {$footer}
        
        
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../libs/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
        <script src="../../js/crearLaboratorioJs/crearLaboratorio.js"></script>
        
    </body>        

</html>