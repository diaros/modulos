<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/capturaAnticipoCss/capturaAnticipoCss.css"rel="stylesheet" />

        <title>Captura Anticipo</title>   

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Captura Anticipo</legend>

            <form id="capturaAnticipoForm" name="capturaAnticipoForm" class="form-horizontal" action="../../vista/capturaAnticipoVista/capturaAnticipoVista.php" method="post" autocomplete="off">

                <div class="well" style="z-index: -1;">

                    <div class="col-lg-12">

                        <p class="text-muted">Información empresa</p>

                        <div class="col-lg-4">

                            <div class="form-group">

                                <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                                <div class="col-md-8">
                                    <select id="empresaInt" name="empresaInt" class="form-control">
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

                                <label class="col-md-4 control-label" for="fechaReq">Fecha requerido:</label>  
                                <div class="col-md-8">
                                    <input id="fechaReq" name="fechaReq"  placeholder="" class="form-control input-sm datepicker" type="text">
                                </div>

                            </div> 

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <p class="text-muted">Información usuario</p>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="idUser">No.Identificación:</label>  
                                <div class="col-md-8">
                                    <input id="idUser" name="idUser" placeholder="" class="form-control input-md" type="text" onblur="consultaCta();">                          
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">                           

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nombreUser">Nombre:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="nombreUser" name="nombreUser" type="text" placeholder="" >                                      
                                </div>
                            </div> 

                        </div>

                        <div class="col-lg-4">                           

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="mailUser">Correo electronico:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="mailUser" name="mailUser" type="text" placeholder="" >                                      
                                </div>
                            </div> 

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">                           

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="telefono">Telefono:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="telefono" name="telefono" type="text" placeholder="" >                                      
                                </div>
                            </div> 

                        </div>

                        <div class="col-lg-4">                           

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="suc">Sucursal:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="suc" name="suc" type="text" placeholder="" >                                      
                                </div>
                            </div> 

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <p class="text-muted">Información cuenta</p>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="entidadFin">Entidad financiera:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="entidadFin" name="entidadFin" type="text" placeholder="" >                                      
                                </div>
                            </div>                    
                        </div>    

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nroCuenta">No.Cuenta:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="nroCuenta" name="nroCuenta" type="text" placeholder="" >                                      
                                </div>
                            </div>                    
                        </div>  

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tipoCta">Tipo cuenta:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="tipoCta" name="tipoCta" type="text" placeholder="" >                                      
                                </div>
                            </div>                    
                        </div>

                    </div>

                    <div class="col-lg-12">

                        <p class="text-muted">Información anticipo</p>                    

                        <div class="col-lg-8">

                            <div class="form-group">

                                <label class="col-md-2 control-label" for="tipoCompra">Tipo Anticipo:</label>
                                <div class="col-md-10">

                                    <div class="btn-group" data-toggle="buttons">                                      

                                        <label id="facturable" class="btn btn-success" onclick="valTipoAnticipo(this.id);">Facturable
                                            <input type="radio" name="options"  autocomplete="off" onclick="asignarTipoCompra(this.id);">
                                            <span id="spanFacturable" class="fa fa-check"></span>
                                        </label>                                       

                                        <label id="presupuesto" class="btn btn-primary" onclick="valTipoAnticipo(this.id);">Presupuesto
                                            <input type="radio" name="options"  autocomplete="off">
                                            <span id="spanPresupuesto" class="fa fa-check"></span>
                                        </label>                                      

                                        <label id="administrativa" class="btn btn-warning"  onclick="valTipoAnticipo(this.id);">Administrativo
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
                                <label class="col-md-4 control-label" for="nroPresupuesto">No. Presupuesto:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="nroPresupuesto" name="nroPresupuesto" type="text" placeholder="" disabled="true" onblur="consultarUnidadNegocioPresupuesto();">                                      
                                </div>
                            </div>                    
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="centroCosto">Centro de costo:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="centroCosto" name="centroCosto" type="text" placeholder="" onblur="consultarUniNegocio();">
                                    <input id="idcentroCostoOculto" name="idcentroCostoOculto" type="hidden" onchange="consultarUniNegocio();">  
                                </div>
                            </div>                    
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="cliente">Cliente:</label>  
                                <div class="col-md-8">                                        
                                    <input class="form-control input-md" id="cliente" name="cliente" type="text" placeholder="" >                                      
                                </div>
                            </div>                    
                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="unidadNeg">Unidad negocio:</label>
                                <div class="col-md-8">
                                    <select id="unidadNeg" name="unidadNeg" class="form-control" onchange="">
                                        <option value=""></option>                                         
                                    </select>
                                </div>
                            </div>                      

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="usuFac">Nombre a quien facturar:</label>
                                <div class="col-md-8">
                                    <input class="form-control input-md" id="usuFac" name="usuFac" type="text" placeholder="" >        
                                </div>
                            </div>                      

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="vlrAnticipo">Valor anticipo</label>
                                <div class="col-md-8">
                                    <input class="form-control input-md" id="vlrAnticipo" name="vlrAnticipo" type="text" placeholder="" >    
                                </div>
                            </div>                      

                        </div>

                    </div>

                </div>               

            </form>

        </div>

        <div class="modal fade" id="modalConceptosPresupuesto">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h4 class="modal-title" id="tituloModal">Conceptos Presupuesto</h4>
                        <div id="divMsjConcepto" class="alert alert-info alert-dismissable" style="display: none;">
{*                            <button type="button" class="close" aria-hidden="true">&times;</button>*}
                            <strong>Información</strong> 
                            <p id="textModalConceptosPresupuesto"></p>
                        </div>

                    </div>

                    <div class="modal-body" id="cuerpoModal">


                        <table id="tableConceptos" class="table table-hover table-striped table-condensed">

                            <thead>

                                <tr>
                                    <th>Cuenta contable</th>
                                    <th>Concepto</th>
                                    <th>Vlr Presupuesto</th>
                                    <th>Valor</th>                                    
                                </tr>

                            </thead>

                            <tbody id="datosConceptos">                        
                            </tbody>

                        </table>
                        
                        <div class="col-md-12" style="margin-top: 5px; text-align: right;">

                            <input type="button" value="Aceptar" class="btn btn-primary" >
                            <input type="button" value="Limpiar" class="btn btn-danger">

                        </div> 

                    </div>

                    <div class="modal-footer">
                        
                        
                        
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  

        <div class="modal fade" id="modalInfo">

            <div class="modal-dialog">
                <div class="modal-content" >

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModalInfo"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModalInfo">


                    </div>

                    <div class="modal-footer">
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->   

        {$footer}

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../libs/moment-develop/min/moment.min.js"></script>  
        <script src="../../libs/calendario/bootstrap-datetimepicker-master/src/js/bootstrap-datetimepicker.js"></script>    

        <script src="../../js/capturaAnticipoJs/capturaAnticipo.js"></script>

    </body>

</html>
