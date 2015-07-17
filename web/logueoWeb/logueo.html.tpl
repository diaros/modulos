<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet" />
        <link type="text/css" href="../../css/logueoCss/logueoCss.css" rel="stylesheet" />

        <title>Logueo</title>

    </head>

    <body>

        <div class="container">

            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                <div class="panel panel-info" >

                    <div class="panel-heading">
                        <div class="panel-title">Modulos Administrativos</div>
                    </div>     

                    <div id="panelBody" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form id="loginform" class="form-horizontal" role="form" action="../../vista/paginaPrincipalVista/paginaPrincipalVista.php" autocomplete="off">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Usuario">                                        
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="pass" type="password" class="form-control" name="pass" placeholder="Contraseña">
                            </div>

                            {*  <div class="input-group">
                            <div class="checkbox">
                            <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                            </div>
                            </div>*}

                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">

                                    <a id="btn-login" href="#" class="btn btn-primary btn-block" onclick="valVacios();">Ingresar</a>
                                    <a id="btn-fblogin" href="#" class="btn btn-warning btn-block" onclick="mostrarModal();">Recordar contraseña</a>

                                </div>
                            </div>                             
                        </form>
                    </div>                     
                </div>  
            </div>
            
        </div>

        <div class="modal fade" id="modalInfo">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Advertencia</h4>
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

        <div class="modal fade" id="modalRecordar">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Recordar contraseña</h4>
                    </div>

                    <div class="modal-body" id="cuerpoModalRecordar">

                        <div id="divMsj" class="alert alert-info alert-dismissable" style="display:none;">
{*                            <button type="button"  data-dismiss="alert" aria-hidden="true">&times;</button>*}
                            <strong>Informacion</strong><p id="msjRecordarPass"></p>
                        </div>

                        <div id="panelBody" class="panel-body" >

                            <form id="recordarForm" class="form-horizontal" role="form" autocomplete="off">

                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="nombreUsuario" type="text" class="form-control" name="nombreUsuario" value="" placeholder="Ingrese su nombre de usuario">                                        
                                </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">

                                        <a id="btn-login" class="btn btn-primary btn-block" onclick="valVaciosNick();">Enviar</a>                                        
                                        <input type="reset" class="btn btn-danger btn-block" id="limpiarRecordar" name="limpiarRecordar" value="Limpiar" onclick="ocultarMsj();">
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                    <div class="modal-footer">
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
        
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>  
        <script src="../../js/logueoJs/logueoJs.js"></script>
        <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
        
    </body>

</html>
