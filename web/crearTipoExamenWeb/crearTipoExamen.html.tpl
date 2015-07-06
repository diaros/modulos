<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../js/crearTipoExamenJs/crearTipoExamen.js"></script>

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/crearTipoExamenCss/crearTipoExamen.css" rel="stylesheet">
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet">

        <title>Crear tipo examen</title>        

    </head>

    <body>
        {$cabecera}
        <div id="contenedor" class="container">

            <legend>Crear tipo examen</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="crearTipoExamenForm" name="crearTipoExamenForm" class="form-horizontal" action="../../vista/crearTipoExamenVista/crearTipoExamenVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="descripcion">Tipo examen:</label>  
                            <div class="col-md-8">
                                <input id="descripcion" name="descripcion" placeholder="Descripción" class="form-control input-md" type="text">                          
                            </div>
                        </div>  
                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="paraclinico">Paraclinico:</label>
                            <div class="col-md-8">
                                <select id="paraclinico" name="paraclinico" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Si</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>                     

                    </div>                     

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="especial">Especial:</label>
                            <div class="col-md-8">
                                <select id="especial" name="especial" class="form-control">

                                    <option value=""></option>
                                    <option value="1">Si</option>
                                    <option value="2">No</option>

                                </select>
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

                    <!-- Multiple Checkboxes (inline) -->
                    <div class="col-lg-5">

                        <div class="form-group">

                            <label class="col-md-4 control-label" for="categorias">Categoria:</label>

                            <div class="col-md-8">

                                {section name=categoria loop=$categorias}

                                    <label class="checkbox" for="{$categorias[categoria].id_categoria_examen}">
                                        <input type="checkbox" id="{$categorias[categoria].id_categoria_examen}" name="{$categorias[categoria].id_categoria_examen}" onclick="valCheck(this.id);">
                                        {$categorias[categoria].nombre}
                                    </label>

                                {/section}

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="validarVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="limpiarForm();">

                    </div>

                </div>

                <hr>

                <div id="tablaTipoExam" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table class="table table-hover table-striped table-condensed" >

                        <thead>

                        <th>Tipo examen</th>
                        <th>Categoria</th>
                        <th>Paraclinico</th>
                        <th>Especial</th>
                        <th>Estado</th>
                        <th>Eliminar</th>

                        </thead>

                        <tbody id="datosTipoExam">

                            {section name=tipoExam loop=$tipoExams}

                                <tr>
                            <div style="display:none;">{$number++}</div>

                            <td>{$tipoExams[tipoExam].nombre}</td>
                            <td>{$tipoExams[tipoExam].categoria}</td>
                            <td>{$tipoExams[tipoExam].paraclinico}</td>
                            <td>{$tipoExams[tipoExam].especial}</td>
                            <td>{$tipoExams[tipoExam].estado}</td>
                            <td>
                                <input id="eliminar{$number}" name="eliminar{$number}" value="Eliminar" type="button" class="btn btn-link" onclick="confirmacionEliminarTipoExamen({$number})">
                            </td>

                            <input type="hidden" id="idTipoExam{$number}" name="idTipoExam{$number}" value="{$tipoExams[tipoExam].id_tipo}">
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

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarTipoExam();">
                            <input type="hidden" id="ocultoId">

                        </div>
                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        {$footer}
    </body>

</html>