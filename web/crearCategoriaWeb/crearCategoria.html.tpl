<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">       

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/crearCategoriaCss/crearCategoria.css" rel="stylesheet">
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet">

        <title>Crear categoria</title>
    </head>

    <body>
        {$cabecera}

        <div id="contenedor" class="container">
            <legend>Crear categoria</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="crearCategoriaForm" name="crearCategoriaForm" class="form-horizontal" action="../../vista/crearCategoriaVista/crearCategoriaVista.php" method="post" autocomplete="off"> 

                <div class="well" id="forma">

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombre">Nombre:</label>  
                            <div class="col-md-8">
                                <input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text">                          
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
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger">

                    </div>


                </div>

                <hr>

                <div id="tablaCategorias" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Eliminar</th>

                        </thead>

                        <tbody id="datosCat">

                            {section name=categoria loop=$categorias}

                                <tr>
                            <div style="display:none;">{$number++}</div>
                            <td>{$categorias[categoria].nombre}</td>
                            <td>{$categorias[categoria].estado}</td>

                            <td>
                                <input id="eliminar{$number}" name="eliminar{$number}" value="Eliminar" type="button" class="btn btn-link" onclick="confirmacionEliminar({$number})">
                            </td>

                            <input type="hidden" id="idCat{$number}" name="idCat{$number}" value="{$categorias[categoria].id_categoria_examen}">
                            </tr>

                        {/section}    

                        </tbody>

                    </table>


                </div>

            </form>


        </div>

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

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <p>Esta seguro que desea eliminar esta categoria?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarCat();">
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

    <script src="../../libs/jquery/jquery.js"></script>  
    <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
    <script src="../../js/crearCategoriaJs/crearCategoriaJs.js"></script>


</html>