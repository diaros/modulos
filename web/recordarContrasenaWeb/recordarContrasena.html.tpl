<!DOCTYPE html>

<html>

    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../css/recordarContrasenaCss/recordarContrasenaCss.css" rel="stylesheet" />

        <title>Recordar contraseña</title>
    </head>

    <body>

        <div class="container">

            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                <div class="panel panel-info" >

                    <div class="panel-heading">
                        <div class="panel-title">Recordar contraseña</div>
                    </div>     

                    <div id="panelBody" class="panel-body" >                        

                        <form id="loginform" class="form-horizontal" role="form" action="../../vista/recordarContrasenaVista/recordarContrasenaVista.php" autocomplete="off">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Usuario">                                        
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">

                                    <a id="btn-login" href="#" class="btn btn-info btn-block" onclick="valVacios();">Enviar</a>


                                </div>
                            </div>

                        </form>
                    </div>                     
                </div>  
            </div>           

        </div>        

    </body>

    <script src="../../libs/jquery/jquery.js"></script>  
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>  
    <script src="../../js/recordarContrasenaJs/recordarContrasenaJs.js"></script>

</html>