<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/crearCentroCosto/crearCentroCostoCss.css" rel="stylesheet"> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"> 

        <title>Crear centro costo</title>   

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Crear tipo cobro</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="crearClienteForm" name="crearClienteForm" class="form-horizontal" action="../../vista/crearCentroCostoVista/crearCentroCostoVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-8">
                                <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpCliente();">
                                    <option value=""></option>
                                    {section name=empInt loop=$empresaInterna}
                                        <option value="{$empresaInterna[empInt].cod_Empr}">{$empresaInterna[empInt].nom_empr}</option>
                                    {/section}    
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empUsu">Empresa cliente</label>
                            <div class="col-md-8">
                                <select id="empUsu" name="empUsu" class="form-control">                                   

                                </select>
                            </div>
                        </div>                     

                    </div>  

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="aiu">AIU:</label>  

                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="aiu" name="aiu" placeholder="aiu" class="form-control input-md" type="text" onblur="valNumerico()">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>  

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tipoFac">Tipo facturación:</label>
                            <div class="col-md-8">
                                <select id="tipoFac" name="tipoFac" class="form-control" onchange="valTipoFac();">

                                    <option value=""></option>

                                    {section name=tipoFac loop=$tipoFacs}

                                        <option value="{$tipoFacs[tipoFac].id_tipo_facturacion}">{$tipoFacs[tipoFac].nombre}</option>

                                    {/section}

                                </select>

                            </div>

                        </div>

                    </div>

                    <div id="campArbCli" class="col-lg-5" style="display: none">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="arbCliente">Arbol cliente:</label>
                            <div class="col-md-8">
                                <select id="arbCliente" name="arbCliente" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div id="campIdClient" class="col-lg-5" style="display: none">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="idClieKactus">Identificador cliente:</label>  
                            <div class="col-md-8">
                                <input id="idClieKactus" name="idClieKactus" placeholder="Id cliente kactus" class="form-control input-md" type="text">                          
                            </div>
                        </div>  
                    </div>

                    <div id="campIdClient" class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="idClieKactus">Acepta cobro de no aptos?</label>  
                            <div class="col-md-8">

                                <label class="radio" for="tipoDato-0">
                                    <input type="radio" name="res" id="res1" value="1" checked>
                                    Si
                                </label>

                                <label class="radio" for="tipoDato-0">
                                    <input type="radio" name="res" id="res2" value="0">
                                    No
                                </label>

                            </div>
                        </div>  
                    </div>                

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valVaciosCC();">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>                

                </div>

                <hr>

                <div id="tablaCentroCosto" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                        <th>Empresa interna</th>
                        <th>Empresa cliente</th>
                        <th>AIU %</th>
                        <th>Tipo facturacion</th>
                            {*                      <th>Arbol cliente</th>*}
                        <th>Id cliente Kactus</th>
                        <th>Acepta cobro aptos</th>
                        <th>Eliminar</th>

                        </thead>

                        <tbody id="datosCentroCosto">

                            {section name=centroCosto loop=$centroCostos}

                                <tr>

                            <div style="display:none;">{$number++}</div>

                            <td>{$centroCostos[centroCosto].id_empresa_interna}</td>
                            <td>{$centroCostos[centroCosto].id_empresa_cliente}</td>
                            <td>{$centroCostos[centroCosto].aiu}</td>
                            <td>{$centroCostos[centroCosto].tipo_facturacion}</td>
                            {*                            <td>{$centroCostos[centroCosto].arbol_cliente}</td>*}
                            <td>{$centroCostos[centroCosto].id_cliente_kactus}</td>
                            <td>{$centroCostos[centroCosto].cobro_aptos}</td>
                            <td>
                                <input id="eliminar{$number}" name="eliminar{$number}" value="Eliminar" type="button" class="btn btn-link" onclick="confirmacionEliminarCentroCosto({$number})">
                            </td>

                            <input type="hidden" id="idCentroCosto{$number}" name="idCentroCosto{$number}" value="{$centroCostos[centroCosto].id_tipo_cobro}">

                            </tr>

                        {/section}    

                        </tbody>

                    </table>    

                </div>

            </form>

        </div>

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta seguro que desea eliminar este registro?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarCentroCosto();">
                            <input type="hidden" id="ocultoId">

                        </div>
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

        {$footer}

    </body>   

    <script src="../../libs/jquery/jquery.js"></script>  
    <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
    <script src="../../js/crearCentroCostoJs/crearCentroCosto.js"></script>

</html>