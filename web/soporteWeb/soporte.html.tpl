<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet" /> 

        <title>Soporte</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Soporte</legend>            

            <form id="soporteForm" name="soporteForm" class="form-horizontal" action="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php" method="post" autocomplete="off">

                <div id="forma" class="well">

                    <div class="col-lg-12">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="modulo">Modulo:</label>
                            <div class="col-md-3">
                                <select id="modulo" name="modulo" class="form-control">
                                    <option value=""></option>
                                   
                                    <option value="1">Contratos</option>
                                    <option value="2">Examenes Medicos</option>
                                   
                                </select>
                            </div>
                        </div>                                 

                    </div>
                                
                    <div class="col-lg-12">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="descripcion">Descripción del problema</label>
                            <div class="col-md-10">                     
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" cols="1000"></textarea>
                            </div>
                        </div>
                        
                    </div>
                                
                    <div class="col-lg-12" id="botones">

                        <a type="button" id="enviar" value="Enviar" class="btn btn-primary" onclick="valVacios();">
                            <span class="glyphicon glyphicon-send">
                                
                            </span> Enviar
                        </a>
                        <a type="button" id="limpiar" value="limpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

                    </div>   

                </div>                     

            </form>           

        </div>
        
        <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        <img src="../../libs/imagenes/cargando.gif">
                    </div>

                </div>
            </div>
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
        

        {$footer}


    </body>  

    <script src="../../libs/jquery/jquery.js"></script>  
    <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
    <script src="../../js/soporteJs/soporteJs.js"></script>
    

</html>