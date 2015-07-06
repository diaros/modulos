$(document).on("ready", inicio);

//setInterval(function(){ 
//    
//     reporteContratosxMes();
//    reporteEstadoReq();
//    reporteContratoxEmrpesa();
//    reporteContratosxTipo();
//
//
//}, 5000);

function inicio() {

    reporteContratosxMes();
    reporteEstadoReq();
    reporteContratoxEmrpesa();
    reporteContratosxTipo();

}

function reporteContratosxTipo() {

    var array = [];
    $.ajax({
        type: 'POST',
        url: "../../vista/dashBoardVista/asincDashBoard.php",
        data: {
            accion: 'contratosxTipo'
        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            var datos = new Array();

            $.each(data, function(llave, valor) {

                datos.push(valor.tipo);
                datos.push(parseInt(valor.cantidad));

            });

            array = datos;

            mostrarContratosxTipo(array);

        }

    });


}

function reporteContratoxEmrpesa() {

    var array = [];
    $.ajax({
        type: 'POST',
        url: "../../vista/dashBoardVista/asincDashBoard.php",
        data: {
            accion: 'contratosxEmpresa'

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            var datos = new Array();

            $.each(data, function(llave, valor) {

                datos.push(valor.empresa);
                datos.push(parseInt(valor.cantidad));

            });

            array = datos;

            console.log(datos);

            mostrarContratosxEmpresa(array);

        }

    });

}

function reporteEstadoReq() {

    var array = [];
    $.ajax({
        type: 'POST',
        url: "../../vista/dashBoardVista/asincDashBoard.php",
        data: {
            accion: 'estadoReq'

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            var datos = new Array();

            $.each(data, function(llave, valor) {

                datos.push(valor.estado);
                datos.push(parseInt(valor.cantidad));

            });

            array = datos;

            mostrarEstadoReq(array);

        }


    });



}

function reporteContratosxMes() {

    var array = [];

    $.ajax({
        type: 'POST',
        url: "../../vista/dashBoardVista/asincDashBoard.php",
        data: {
            accion: 'contratosxMes'

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            var datos = new Array();

            $.each(data, function(llave, valor) {

                datos.push(parseInt(valor));

            });

            array = datos;

            mostrarContratosxMes(array);

        }

    });

}

function mostrarContratosxMes(datos) {

    var buyerData = {
        labels: ["Enero", "febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        datasets: [
            
            {
                label: "Contratos vs Mes",
                fillColor: "rgba(175,238,238,0.4)",
                strokeColor: "#09CBD9",
                pointColor: "#fff",
                pointStrokeColor: "#09CBD9",
                data: datos
            }

        ]
    };

    var contratosMes = document.getElementById('contratosMes').getContext('2d');
    new Chart(contratosMes).Line(buyerData);
    
}

function mostrarEstadoReq(datos) {

    var total;
    var aceptadas;
    var devueltas;
    var archivadas;
    var prestamo;
    var revisada;

    aceptadas = datos[1];
    archivadas = datos[3];
    devueltas = datos[5];
    prestamo = datos[7];
    revisada = datos[9];
    total = aceptadas + devueltas + archivadas + prestamo;

    $("#totalReq").html(total);
    $("#reqArchivadas").html(archivadas + prestamo);
    $("#reqAceptadas").html(aceptadas);
    $("#reqDevueltas").html(devueltas);

    var pieData = [
        {   
            //aceptada
            label: datos[0],
            value: datos[1],
            color: "#09CBD9"

        },
        {   //archivada
            label: datos[2],
            value: datos[3],
            color: "#6D67D9"

        },
        {   
            //devuelta
            label: datos[4],
            value: datos[5],
            color: "#D16044"

        },
        {   
            //Prestamo
            label: datos[6],
            value: datos[7],
            color: "#D103D9"

        }
    ];


    var pieOptions = {
        segmentShowStroke: true,
        animateScale: true
    };


    var estadoContratos = document.getElementById("estadoContratos").getContext("2d");
    new Chart(estadoContratos).Pie(pieData, pieOptions);

    var estadoContratos2 = document.getElementById("estadoContratos2").getContext("2d");
    new Chart(estadoContratos2).Doughnut(pieData, pieOptions);




}

function mostrarContratosxTipo(datos) {

    var pieData = [
        {
            //inferior ano
            label: datos[0],
            value: datos[1],
            color: "#6A256C"

        },
        {
            //obra labor
            label: datos[2],
            value: datos[3],
            color: "#4ACAB4"

        }
    ];

    var pieOptions = {
        segmentShowStroke: true,
        animateScale: true
    };

    var contratosxTipo = document.getElementById("contratosxTipo").getContext("2d");
    new Chart(contratosxTipo).Doughnut(pieData, pieOptions);


}

function mostrarContratosxEmpresa(datos) {
    
    var emp1;
    var emp2;
    var emp3;
    var emp4;
    var emp5;
    var emp6;
    var emp7;
    var emp8;
    var emp9;
    var emp10;
    var emp11;
    var emp12;
    var emp13;
           

    var cant1;
    var cant2;
    var cant3;
    var cant4;
    var cant5;
    var cant6;
    var cant7;
    var cant8;
    var cant9;
    var cant10;
    var cant11;
    var cant12;
    var cant13;
             

    emp1  = datos[0];
    cant1 = datos[1];

    emp2  = datos[2];
    cant2 = datos[3];

    emp3  = datos[4];
    cant3 = datos[5];
    
    emp4  = datos[6];
    cant4 = datos[7];
    
    emp5 = datos[8];
    cant5 = datos[9];
    
    emp6 = datos[10];
    cant6 = datos[11];
    
    emp7 = datos[12];
    cant7 = datos[13];
    
    emp8 = datos[14];
    cant8 = datos[15];
    
    emp9  = datos[16];
    cant9 = datos[17];
    
    emp10  = datos[18];
    cant10 = datos[19];
   
    emp11 = datos[20];
    cant11 = datos[21];
    
    emp12  = datos[22];
    cant12 = datos[23];
    
    emp13  = datos[24];
    cant13 = datos[25];
    
    

    emp1  = emp1.trim();
    emp2  = emp2.trim();
    emp3  = emp3.trim();
    emp4  = emp4.trim();
    emp5  = emp5.trim();
    emp6  = emp6.trim();
    emp7  = emp7.trim();
    emp8  = emp8.trim();
    emp9  = emp9.trim();
    emp10 = emp10.trim();
    emp11 = emp11.trim();
    emp12 = emp12.trim();
    emp13 = emp13.trim();
    
    var total = cant7 + cant12 + cant13;
    
    $("#contratosListos").html(cant7);
    $("#contratosTercerizar").html(cant12);
    $("#contratosVyM").html(cant13);
    $("#totalContratos").html(total);

    var pieData = [
        {
            //ADMINISTRACION DE NOMINAS       
            label: emp1,
            value: cant1,
            color: "#782FBF"

        },
        {
            //BC EXPLORACION Y PRODUCCION DE HIDROCARBUROS SL SUCURSAL COLOMBIA               
            label: emp2,
            value: cant2,
            color: "#974EA6"

        },
        {
            //COOPERATIVA DE TRABAJO ASOCIADO LOS CERROS                                      
            label: emp3,
            value: cant3,
            color: "#834EA6"

        },
        {
            //CORPORACION COMFENALCO VALLE UNIVERSIDAD LIBRE                                  
            label: emp4,
            value: cant4,
            color: "#ED6788"

        },
        {
            //INDUSTRIAS ERLAN S.A.S                                                          
            label: emp5,
            value: cant5,
            color: "#3D0F38"

        },
        {
            //LENDDO COLOMBIA S.A.S                                                           
            label: emp6,
            value: cant6,
            color: "#8964EB"

        },
        {
            //LISTOS S.A.S                                                                    
            label: emp7,
            value: cant7,
            color: "#8950EB"

        },
        {
            //MARY KAY COLOMBIA SAS                                                           
            label: emp8,
            value: cant8,
            color: "#893CEB"

        },
        {
            //PRECOOP. DE TRABAJO ASOCIADO MERCADECOOP                                        
            label: emp9,
            value: cant9,
            color: "#D57CA6"

        },
        {
            //PRECOOPERATIVA SEGURCOOP                                                        
            label: emp10,
            value: cant10,
            color: "#6C065E"

        },
        {
            //PRUEBA                                                                          
            label: emp11,
            value: cant11,
            color: "#83E3CD"

        },
        {
            //TERCERIZAR S.A.S                                                                
            label: emp12,
            value: cant12,
            color: "#83E3CD"

        },
        {
            //VISION  & MARKETING  S.A.S                                                      
            label: emp13,
            value: cant13,
            color: "#D16044"

        }
    ];


    var pieOptions = {
        segmentShowStroke: true,
        animateScale: true
    };


    var contratosxEmpresa = document.getElementById("contratosxEmpresa").getContext("2d");
    new Chart(contratosxEmpresa).Pie(pieData, pieOptions);


}