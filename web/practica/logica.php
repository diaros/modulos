<!DOCUMENT hml>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">
    </head>

    <body>

        <h1>Resultado</h1>
        
        <p>Los datos han sido enviados..</p>
        
        <h5>Nombre:</h5><p><?php
        echo($_POST['nombre']);
        ?></p>
        
        <h5>Apellido:</h5><p><?php
        echo($_POST['apellido']);
        ?></p>
           
        <h5>numero id:</h5><p><?php
        echo($_POST['numeroId']);
        ?></p>
        
    </body>   

</html>


