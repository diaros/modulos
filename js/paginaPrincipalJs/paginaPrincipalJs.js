$(document).ready( function() {
    $('#myCarousel').carousel({
    	interval:   4000
	});
	
	var clickEvent = false;
	$('#myCarousel').on('click', '.nav a', function() {
			clickEvent = true;
			$('.nav li').removeClass('active');
			$(this).parent().addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.nav').children().length -1;
			var current = $('.nav li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.nav li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
        
            
});

function ingresarModulo(app){
    
        $.ajax({
            type: "POST",
            url: "../../vista/logueoVista/asincLogueo.php",
            data: "app=" +app+
                  "&logModulo="+'S',                 
            dataType: "json",
            beforeSend: function() {                
                  $("#modalLoad").modal('toggle');
            },
            success: function(data) {
                
                if(data == '1'){
                    
                    $("#modalLoad").modal('toggle');
                    $("#tituloModal").html("Información");
                    $("#cuerpoModal").html("Cargando funcionalidades.");
                    $("#modalInfo").modal('toggle');
                    location.reload();                   
                }
                
                if(data == '-1'){
                    
                    $("#modalLoad").modal('toggle');
                    $("#tituloModal").html("Información");
                    $("#cuerpoModal").html("Usted no tiene acciones parametrizadas para este modulo. Si asi lo requiere por favor comuniquese con el administrador.");
                    $("#modalInfo").modal('toggle');
                    
                }

            }
        }).done(function(data) {
        });
    
}


$(function () {

    "use strict";

    var $bgobj = $(".ha-bg-parallax"); // assigning the object

    $(window).on("scroll", function () {

        var yPos = -($(window).scrollTop() / $bgobj.data('speed'));

        // Put together our final background position

        var coords = '100% ' + yPos + 'px';

        // Move the background

        $bgobj.css({ backgroundPosition: coords });

    });
        $('div.product-chooser').not('.disabled').find('div.product-chooser-item').on('click', function(){
		$(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
		$(this).addClass('selected');
		$(this).find('input[type="radio"]').prop("checked", true);
		
	});

});

