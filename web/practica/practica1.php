<!DOCTYPE html>

<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="practicaCss.css">
        <title>Practica</title>
    </head>
    
    <body>
        
        <div id="contenedor">
            
            <h1 id="titulo">Formulario</h1>
             <form id="formularioForm" action="logica.php" method="post">
            <div id="contendorForm">
                
               
                    
                    <div class="campo">
                        <label>Fecha Inicio</label>
                        <input type="date" id="fecIni" name="fecIni"  maxlength="50" required/>
                    </div> 
                    
                    <div class="campo">
                        <label>Fecha fin</label>
                        <input type="date" id="fecFin" name="fecFin" maxlength="50" required/>
                    </div> 
                    
                     <div class="campo">
                        <label>Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="50" required/>
                    </div> 
                    
                    <div class="campo">
                        <label>Apellido</label>
                        <input type="text" id="apellido" name="apellido" maxlength="50" required/>
                    </div> 
                    
                     <div class="campo">
                        <label>Tipo identificación</label>
                        <select id="tipoId" name="tipoId" required onchange="valTipoId();">
                            <option id="0"></option>
                            <option id="ced">Cedula</option>
                            <option id="pas">Pasaporte</option>
                            <option id="ti">Tarjeta de identidad</option>
                        </select>
                    </div> 
                    
                    <div class="campo">
                        <label>Numero Id</label>
                        <input type="text" id="numeroId" name="numeroId" maxlength="50" required/>
                    </div> 
                    
                    <div class="campo" style="display: none" id="contenedorMail">
                        <label>Correo</label>
                        <input type="email" id="correo" name="correo" maxlength="100" required />
                    </div>
                    
                     <div class="campo">
                        <label>Observación</label>
                        <textarea rows="4" cols="25" type="text" id="observ" name="observ" maxlength="200" required></textarea>
                    </div>
                    
                    
                    
                
                
            </div>  
                 <div class="btn">
                        <button id="btnEnviar" value="Enviar">Enviar</button>
                    </div>
            </form>
        </div>        
        
        <script src="practicaJS.js"></script>
    </body>    
    
</html>


<?php

?>
