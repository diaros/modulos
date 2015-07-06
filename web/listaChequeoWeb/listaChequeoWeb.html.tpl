<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/listaChequeoCss/listaChequeoCss.css" rel="stylesheet"/>
        <title>Lista chequeo</title>        

    </head>

    <body>

        {$cabecera}  
        <div id="contenedor" class="container">         

            <legend>Lista chequeo</legend>            

            <form id="listaChequeoForm" name="listaChequeoForm" class="form-horizontal" action="../../vista/listaChequeoVista/listaChequeoVista.php" method="post" enctype="multipart/form-data">

                <input type="hidden" id="accion" name="accion">
                <input type="hidden" id="idPsico" name="idPsico">

                <input type="hidden" id="empresaIntOculto" name="empresaIntOculto" value="{$idEmpInt}">
                <input type="hidden" id="reqOculto" name="reqOculto" value="{$req}">
                <input type="hidden" id="idUserOculto" name="idUserOculto" value="{$idUser}">
                <input type="hidden" id="rutaArchivoOculto" name="rutaArchivoOculto" value="{$rutaArchivo}">
                <input type="hidden" id="existeSoporteDerogadoOculto" name="existeSoporteDerogadoOculto" value="">                

                <div class="alert alert-danger alert-dismissible" role="alert" style="display:{$mostrarMsj};">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{$tipoMsj}</strong>{$msj}
                </div>

                <div class="well" id="formulario1" name="formulario1">                  

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-7">
                                <select id="empresaInt" name="empresaInt" class="form-control" onchange="limpiarCampos();">
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
                            <label class="col-md-5 control-label" for="requisicion">Numero Requisición:</label>  
                            <div class="col-md-7">
                                <input id="requisicion" name="requisicion" placeholder="" class="form-control input-md" type="text" onblur="consultarUsuariosxReq();">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="idUser">No Identificación:</label>  
                            <div class="col-md-7">
                                {*                                <input id="idUser" name="idUser" placeholder="" class="form-control input-md" type="text" onchange="limpiarCampos();">*}
                                <select id="idUser" name="idUser" class="form-control" onchange="limpiarCampos();" >
                                    <option value="{$idUser}">{$idUser}</option>
                                </select>
                            </div>                            
                        </div>

                    </div>

                    <div class="col-lg-12" style="text-align: right;">

                        <a id="btnGenerarPdf" class="btn btn-primary" style="display: {$mostrarGuardar}" onclick="generarpdf();"><span class="glyphicon glyphicon-file"></span>  Generar PDF</a>
                        <a id="btnFinalizar" class="btn btn-primary" style="display: {$mostrarGuardar}" onclick="consultarPsicoAsignado();">Finalizar</a>
                        <a id="btnGuardar" class="btn btn-primary" style="display: {$mostrarGuardar}" onclick="guardar();">Guardar</a>
                        <a id="btnConsultar" class="btn btn-primary" onclick="consultar();">Consultar</a>
                        <a id="btnLimpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

                    </div>             

                </div>

                <hr>        

                <div id="contenedorTabla" style="display:{$mostrarTabla}"> 

                    <table class="table table-condensed table-hover table-responsive table-striped" id="datosDocumentos">

                        <thead>

                            <tr>

                                <th style="text-align: center;">
                                    Concepto
                                </th>

                                <th style="text-align: center;">
                                    Presentado
                                </th>

                                <th style="text-align: center;">
                                    No Presentado
                                </th>

                                <th style="text-align: center;">
                                    No aplica
                                </th>

                                <th style="text-align: center;">
                                    Derogado
                                </th>

                            </tr>

                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"><input id="marcarTodosPresentado" name="marcarTodos" type="checkbox" onclick="marcar(this.id);"></th>
                        <th style="text-align: center;"><input id="marcarTodosNoPresentado" name="marcarTodos" type="checkbox" onclick="marcar(this.id);"></th>
                        <th style="text-align: center;"><input id="marcarTodosNoAplica" name="marcarTodos" type="checkbox" onclick="marcar(this.id);"></th>
                            {*                        <th style="text-align: center;"><input id="marcarTodosDerogado" name="marcarTodos" type="checkbox" onclick="marcar(this.id);"></th>*}

                        </thead>

                        <tbody id="conceptos">

                            <tr id="filaConsultaSoporteDerogados" style="display:none;">

                                <td>
                                    CONSULTAR SOPORTE DEROGADOS
                                </td>

                                <td></td>
                                <td></td>
                                <td></td>

                                <td style="text-align:center">
                                    <a id="linkSoporteDerogado" href="" target="black"></a>
                                </td>

                            </tr>

                            <tr id="filaSoporteDerogados" style="display:none;">
                                <td>
                                    SOPORTE DOCUMENTOS DEROGADOS
                                </td>

                                <td style="text-align: center;">                                      
                                    {*                                    <input name="presentadoDerogado" id="presentadoDerogado" type="checkbox" onchange="valhCeckDerogado(this.id);">*}
                                </td>

                                <td style="text-align: center;"> 
                                    {*                                    <input name="noPresentadoDerogado" id="noPresentadoDerogado" type="checkbox" onchange="valhCeckDerogado(this.id);">*}
                                </td>

                                <td></td>

                                <td style="text-align: right; max-width: 200px;">
                                    <input id="soporteDerogado" name="soporteDerogado" class="filestyle" type="file" data-buttonName="btn-primary" data-size="sm" data-buttonText="Adjuntar" onchange="valExtension();">
                                </td>

                            </tr>



                            {section name=reporte loop=$reporte}

                            <div style="display: none;">{$number++}</div>                        

                            <tr id="fila{$number}">  

                                <td>
                                    {$reporte[reporte].descripcion}
                                    <input type="hidden" id="idDoc{$number}" name="idDoc{$number}" value="{$reporte[reporte].idDoc}"/>
                                    <input type="hidden" id="idLogDoc{$number}" name="idLogDoc{$number}" value="{$reporte[reporte].idLogDoc}"/>
                                    <input type="hidden" id="idEstado{$number}" name="idEstado{$number}" value="{$reporte[reporte].estado}"/>
                                </td>

                                <td style="text-align: center;">                                      
                                    <input name="presentado{$number}" id="presentado{$number}" type="checkbox" onchange="valCheckBox(this.id,{$number});">
                                </td>

                                <td style="text-align: center;"> 
                                    <input name="noPresentado{$number}" id="noPresentado{$number}" type="checkbox" onchange="valCheckBox(this.id,{$number});">
                                </td>    

                                <td style="text-align: center;"> 
                                    <input name="noAplica{$number}" id="noAplica{$number}" type="checkbox" onchange="valCheckBox(this.id,{$number});">
                                </td>

                                <td style="text-align: center;"> 
                                    <input name="derogado{$number}" id="derogado{$number}" type="checkbox" onchange="valCheckBox(this.id,{$number});">
                                </td>

                            </tr>

                        {/section}                          



                        </tbody>              

                    </table>

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

        <div class="modal fade" id="modalConfirmErrores">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>
                    </div>

                    <div id="divMsjErrores" class="alert alert-danger alert-dismissable" style="display: none;">
                        {* <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>*}
                        {*                                <strong>Informacion</strong> *}
                        <p id="MsjErrores"></p>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta lista de chequeo cuenta con documentos faltantes por favor seleccione el psicologo(a) asociado para enviar la notificación </p>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Psicologo(a):</label>
                            <div class="col-md-7">
                                <select id="psicoErrores" name="psicoErrores" class="form-control">
                                    <option value=""></option>
                                    {section name=psicologo loop=$psicologos}
                                        <option value="{$psicologos[psicologo].usu_codigo}">{$psicologos[psicologo].usu_nombres} {$psicologos[psicologo].usu_apellidos}</option>
                                    {/section}    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="finalizar('-1');">                         

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>

                    </div>

                    <div id="divMsjSinErrores" class="alert alert-danger alert-dismissable" style="display: none;">
                        {*<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>*}
                        {*<strong>Informacion</strong>*} 
                        <p id="MsjSinErrores"></p>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta lista de chequeo cuenta con todos los documentos presentados y sera notificado al area de archivo. Por favor seleccione el psicologo(a) asociado.</p>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Psicologo(a):</label>
                            <div class="col-md-7">
                                <select id="psicoSinErrores" name="psicoSinErrores" class="form-control">
                                    <option value=""></option>
                                    {section name=psicologo loop=$psicologos}
                                        <option value="{$psicologos[psicologo].usu_codigo}">{$psicologos[psicologo].usu_nombres} {$psicologos[psicologo].usu_apellidos}</option>
                                    {/section}    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="finalizar('1');">                         

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        {$footer}

        <script src="../../libs/jquery/jquery.js"></script>
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../libs/filestyle/filestyle.js"></script>
        <script src="../../js/listaChequeoJs/listaChequeoJs.js"></script>

    </body>

</html>