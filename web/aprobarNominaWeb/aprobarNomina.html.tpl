<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" >

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/aprobarNominaCss/aprobarNominaCss.css" rel="stylesheet"/> 

        <title>Aprobar Nomina</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Aprobar Nomina</legend>

            <form id="formReporteNominaPlano" name='formReporteNominaPlano' class="form-horizontal" action='../../vista/reporteNominaPlanoVista/reporteNominaPlanoVista.php' method="post" enctype="multipart/form-data">

                <div class="well">

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                                <div class="col-md-8">
                                    <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpClienteBySupervisor();">
                                        <option value=""></option>
                                        {section name=empInt loop=$empresaInterna}
                                            <option value="{$empresaInterna[empInt].cod_Empr}">{$empresaInterna[empInt].nom_empr}</option>
                                        {/section}    
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empUsu">Empresa cliente:</label>
                                <div class="col-md-8">
                                    <select id="empUsu" name="empUsu" class="form-control" onchange="consultarCC();"></select>
                                </div>
                            </div>                     

                        </div>
                                  
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="appendedtext">Rango Fechas</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="fecIni" name="appendedtext" class="form-control datepicker fechas" placeholder="fecha ini" type="text">
                                        <span class="input-group-addon">-</span>
                                         <input id="fecFin" name="appendedtext" class="form-control datepicker fechas" placeholder="fecha fin" type="text">
                                    </div>
                                   
                                </div>
                            </div>
                        </div>                                    

                    </div>                   

                </div>

            </form>            

        </div>

        {$footer}

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../js/aprobarNominaJs/aprobarNomina.js"></script> 

    </body>    

</html>