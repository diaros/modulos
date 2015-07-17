<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/ejecutarSPCss/ejecutarSPCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 

        <title>Ejecutar facturacion de examenes</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Ejecutar facturacion de examenes</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <input type="hidden" id="idUserLog" name="idUserLog" value="{$idUserLog}">

            <form id="ejecutarSpForm" name="ejecutarSpForm" class="form-horizontal" action="../../vista/ejecutarSPVista/ejecutarSPVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <div class="col-lg-12" style="text-align: center">
                        <div class="form-group">
                            <input type="button" id="ejecutarSpBtn" name="ejecutarSpBtn" value="Ejecutar Procedimiento almacenado" class="btn btn-primary btn-group-sm" onclick="confirmarEjecucion();">
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
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <p>Esta seguro que desea ejecutar el procedimiento de facturación?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="ejecutarSP();">
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
    <script src="../../js/ejecutarSPJs/ejecutarSPJs.js"></script>      

</html>