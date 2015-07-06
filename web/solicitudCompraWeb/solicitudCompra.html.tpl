<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/solicitudCompraCss/solicitusComraCss.css" rel="stylesheet"/> 

        <title>Solicitud compra</title>

    </head>

    <body>

        {$cabecera}
        <div id="contenedor" class="container">

            <legend>Solicitud compra</legend>

            <form id="solicitudCompraForm" name="solicitudComraForm" class="form-horizontal" action="../../vista/solicitudCompraVista/solicitudCompraVista.php" method="post" autocomplete="off">

                {*<div id="panelWell" name="panelWell">*}
                <div class="well">

                    <p class="text-muted">Encabezado de la solicitud</p>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

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

                        <div class="col-lg-8">

                            <div class="form-group">
                                
                                <label class="col-md-2 control-label" for="tipoCompra">Tipo compra:</label>
                                <div class="col-md-10">

                                    <div class="btn-group" data-toggle="buttons">

                                        <label id="facturable" class="btn btn-success" onclick="asignarTipoCompra(this.id);">Compra Facturable
                                            <input type="radio" name="options"  autocomplete="off" onclick="asignarTipoCompra(this.id);">
                                            <span id="spanFacturable" class="fa fa-check"></span>
                                        </label>

                                        <label id="presupuesto" class="btn btn-primary" style="margin-left: 13px;" onclick="asignarTipoCompra(this.id);">Incluida en Presupuesto
                                            <input type="radio" name="options"  autocomplete="off">
                                            <span id="spanPresupuesto" class="fa fa-check"></span>
                                        </label>

                                        <label id="administrativa" class="btn btn-warning" style="margin-left: 13px;" onclick="asignarTipoCompra(this.id);">Administrativa
                                            <input type="radio" name="options"  autocomplete="off" >
                                            <span id="spanAdministrativa" class="fa fa-check"></span>
                                        </label>

                                        <input type="hidden" id="tipoCompraOculto" name="tipoCompraOculto" />

                                    </div>

                                </div>

                            </div>                     

                        </div>                  

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="telContacto">Telefono:</label>
                                <div class="col-md-8">
                                    <input id="telContacto" name="telContacto" placeholder="Telefono" class="form-control input-md" type="text">   
                                </div>
                            </div>                     

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ciudad">Ciudad:</label>
                                <div class="col-md-8">
                                    <select id="ciudad" name="ciudad" class="form-control" onchange="consultarUsuarioAprueba();">
                                        <option value=""></option>
                                        {section name=ciudad loop=$ciudades}
                                            <option value="{$ciudades[ciudad].suc_codigo}">{$ciudades[ciudad].suc_nombre}</option>
                                        {/section}     
                                    </select>
                                </div>
                            </div>                     

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="conceptos">Concepto:</label>
                                <div class="col-md-8">
                                    <select id="conceptos" name="conceptos" class="form-control" >
                                        <option value=""></option>
                                        {section name=conceptos loop=$conceptosCompra}
                                            <option value="{$conceptosCompra[conceptos].codigo}">{$conceptosCompra[conceptos].detalle}</option>
                                        {/section}     
                                    </select>
                                </div>
                            </div>                     

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empCli">Cliente:</label>
                                <div class="col-md-8">
                                    <select id="empCli" name="empCli" class="form-control"></select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="presupuestoBiplus">Presupuesto Biplus:</label>
                                <div class="col-md-8">
                                    <input id="presupuestoBiplus" name="presupuestoBiplus" placeholder="" class="form-control input-md" type="text" onblur="validaPresupuesto();">      
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="aiu">AIU:</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="aiu" name="aiu" class="form-control" placeholder="" type="text" style="text-align: center;">
                                        <span class="input-group-addon">%</span>
                                    </div>

                                </div>
                            </div>

                        </div>    

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">

                                <label class="col-md-4 control-label" for="centroCosto">Centro costo:</label>  
                                <div class="col-md-8">

                                    <input class="form-control input-md" id="centroCosto" name="centroCosto" type="text" placeholder="" >
                                    <input type="hidden" id="centroCostoId" name="centroCostoId" value=""/>

                                </div>

                            </div> 

                        </div>

                        <div id="divActividad" class="col-lg-8">

                            <div class="form-group">                                
                                <label class="col-md-2 control-label" for="actividad">Actividad:</label>  
                                <div class="col-md-10">
                                    <input class="form-control input-md" id="actividad" name="actividad" type="text" disabled="true">                                   
                                </div>                                
                            </div>

                        </div>

                    </div>                                    

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">

                                <label class="col-md-4 control-label" for="fechaReq">Fecha requerido:</label>  
                                <div class="col-md-8">

                                    <input id="fechaReq" name="fechaReq"  placeholder="" class="form-control input-sm datepicker" type="text">

                                </div>

                            </div> 

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="usuAprueba">Solicitud de aprobación a:</label>
                                <div class="col-md-8">
                                    <select id="usuAprueba" name="usuAprueba" class="form-control">                                        
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="descripcion">Descripción:</label>
                                <div class="col-md-8">                     
                                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                                    
                    <div class="col-lg-12" style="text-align: right;">

                        <a id="btnGenerarPdf" class="btn btn-primary" style="display: {$mostrarGuardar}" onclick="generarpdf();"><span class="glyphicon glyphicon-file"></span>  Generar PDF</a>
                        <a id="btnFinalizar" class="btn btn-primary" style="display: {$mostrarGuardar}" onclick="consultarPsicoAsignado();">Finalizar</a>
                        <a id="btnLimpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

                    </div> 

                </div>              

                <div class="panel panel-default" style="overflow: hidden;">

                    <div class="panel-heading" style="overflow:hidden;">
                        {*                    <h3 class="panel-title">Registro de items generico</h3>*}
                        <div class="col-lg-10"><p class="text-muted">Registro de items generico</p></div>
                        
                        <div class="col-lg-2" id="divIcon" style="display: none; text-align: center;"><span id="spanIcono" class="fa fa-spin"></span></div>
                        
                    </div>


                    <table id="tablaItems" class="table table-condensed table-responsive table-striped">

                        <thead>

                            <tr>
                                
                                <th style="text-align: center;">
                                    Cantidad                             
                                </th>

                                <th style="text-align: center;">
                                    Descripciòn                             
                                </th>     

                                <th style="text-align: center;">
                                    Especificaciones                             
                                </th>     

                                <th style="text-align: center;">
                                    Ciudad                             
                                </th>     

                                <th style="text-align: center;">
                                    Direcciòn                                
                                </th>     

                                <th style="text-align: center;">
                                    Contacto/Recibe                             
                                </th>

                                <th>
                                    Agregar
                                </th>
                                
                                <th>
                                    Borrar
                                </th>

                            </tr>


                        </thead>

                        <tbody id="listaItems">

                            <tr id="filaItem1">
                                <td><input id="cantItem1" style="text-align: center;" type="text" class="form-control"></td>
                                <td><input id="descItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="especItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="ciudadItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="dirItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="contacItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td>                                 
                                    <a type="button" class="btn btn-primary" id="agregar1" onclick="agregarItem(this.id);">
                                       <span class="fa fa-check">                                
                                    </span>
                                   </a>                                     
                                </td>
                                                              
                                <td>                                 
                                   <a type="button" class="btn btn-danger" id="borrar1" onclick="eliminarItem(this.id);">
                                       <span class="fa fa-trash">                                
                                    </span>
                                   </a>                                     
                                </td>  
                            </tr>                           

                        </tbody>                        

                    </table>

                </div>

            </form>

        </div>

        {$footer}

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../libs/moment-develop/min/moment.min.js"></script>  
        <script src="../../libs/calendario/bootstrap-datetimepicker-master/src/js/bootstrap-datetimepicker.js"></script>    
        <script src="../../js/solicitudCompraJs/solicitudCompra.js"></script> 
        
    </body>

</html>