<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">       

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />       
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/paginaPrincipalCss/paginaPrincipalCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/wow/css/animate.css" rel="stylesheet">

        <title>Pagina principal</title>

    </head>

    <body>

        {$cabecera}

        {*        <div class="container" id="contenedor">
                          
        <h1 style="text-align: center;">Bienvenido(a) {$nomUser} a Modulos Administrativos</h1>
        
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <div class="item active">
        <img src="http://www.3aaa.co.uk/wp-content/uploads/2014/06/peoplethree-e1405594049583.png">
        <div class="carousel-caption">
        <h2>
        Listos S.A</h2>
        <p>Gente lista siempre lista</p>
        </div>
        </div>
        <!-- End Item -->
        <div class="item">
        <img src="http://www.jklsolutions.co.uk/images/people-header.jpg">
        <div class="carousel-caption">
        <h2>Vision y marketing</h2>
        <p>Especialistas en punto de compra</p>
        </div>
        </div>
        <!-- End Item -->
        <div class="item">
        <img src="http://www.goldmansachs.com/careers/why-goldman-sachs/our-people/our-people-masthead.jpg">
        <div class="carousel-caption">
        <h2>Tercerizar</h2>
        <p>Actividades de asesoramiento empresarial y en materia de gestión</p>
        </div>
        </div>
        <!-- End Item -->
        <div class="item">
        <img src="http://www.jklsolutions.co.uk/images/people-header.jpg">
        <div class="carousel-caption">
        <h2>MRI Andina</h2>
        <p>Experts in global search</p>
        </div>
        </div>
        <!-- End Item -->
        </div>
        <!-- End Carousel Inner -->
        <ul class="nav nav-pills nav-justified">
        <li data-target="#myCarousel" data-slide-to="0" class="active"><a href="#">Listos<small>Gente lista siempre lista</small></a></li>
        <li data-target="#myCarousel" data-slide-to="1"><a href="#">Vision y marketing<small>especialistas en punto de compra</small></a></li>
        <li data-target="#myCarousel" data-slide-to="2"><a href="#">Tercerizar<small>Actividades de asesoramiento empresarial</small></a></li>
        <li data-target="#myCarousel" data-slide-to="3"><a href="#">MRI Andina<small>Experts in global search</small></a></li>
        </ul>
        </div>
        <!-- End Carousel -->

        <hr class="col-lg-12">
        </div>*}

        <div id="contenedorImgParallax" class="container-fluid">

            <div>
                
                <div id="contenedorVideo">
                    
                    <div id="textB" class="overlay wow fadeInUp" data-wow-offset="0" data-wow-delay="0.5s">                      
                         <h1 id="textBienvenida">Bienvenido a la intranet del grupo <span>Listos S.A.S</span></h1>              
                    </div>
                    
                    <video id="the-video" class="videoPresentacion" loop="" autoplay="">
                        <source src="../../libs/videos/presentacion/5.mp4"/>
                    </video>           
                    
                </div>             
                     

               {* <div class="ha-bg-parallax text-center block-marginb-none" data-type="background" data-speed="20">

                    <div class="ha-parallax-body">

                        <div class="ha-content ha-content-whitecolor wow bounceInDown">

                            Bienvenido(a) {$nomUser} a la intranet del Grupo Listos.

                        </div>

                        <div class="ha-parallax-divider-wrapper">

                            <span class="ha-diamond-divider-md img-responsive"></span>
                            

                        </div>

                        <div class="ha-heading-parallax"></div>

                    </div>                

                </div>*}
                    
            </div>
                
        </div>
                            
                           
                            
      
                            
        <div id="contenedorCita" class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="text-center">
                        <h2>Seleccion de modulos</h2>
                        <p>Por favor seleccione un modulo para cargar sus respectivas funcionalidades</p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>



        <div class="container" id="contenedor">         

            {*            <h1 style="text-align: center;">Bienvenido(a) {$nomUser} a Modulos Administrativos</h1>*}

            <div id="info" class="col-lg-12">

                <div class="col-lg-6 wow bounceIn" data-wow-offset="0" data-wow-delay="0.4s">                

                    <i class="fa fa-user-md fa-5x"></i>
                    {*<img class="img-rounded" data-src="holder.js/140x140" alt="140x140" style="width: 140px; height: 140px;" src="../../libs/imagenes/iconos/icon3.png"></img>*}
                    <h2>
                        Examenes Medicos
                    </h2>

                    <p>
                        Modulo de solicitud, parametrización y facturacion de examenes medicos.
                    </p>

                    <p>
                        <a class="btn btn-primary btn-lg" onclick="ingresarModulo('6');">Ingresar</a>
                    </p>

                </div>

                <div class="col-lg-6 wow bounceIn" data-wow-offset="0" data-wow-delay="0.6s">
                    <i class="fa fa-file-text-o  fa-5x"></i>
                    {*                <img class="img-rounded" data-src="holder.js/140x140" alt="140x140" style="width: 140px; height: 140px;" src="../../libs/imagenes/iconos/icon2.png"></img>*}
                    <h2>
                        Contratos
                    </h2>

                    <p>
                        Modulo de generacion y gestion de requisiciones y contratos.     
                    </p>

                    <p>
                        <a class="btn btn-danger btn-lg" onclick="ingresarModulo('8');">Ingresar</a>
                    </p>

                </div>

            </div>


            <div id="info2" class="col-lg-12">

                <div class="col-lg-6 wow bounceIn"  data-wow-offset="0" data-wow-delay="0.8s">
                    <i class="fa fa-calendar fa-5x"></i>
                    {*                <img class="img-rounded" data-src="holder.js/140x140" alt="140x140" style="width: 140px; height: 140px;" src="../../libs/imagenes/iconos/icon2.png"></img>*}
                    <h2>
                        Nomina
                    </h2>

                    <p>
                        Modulo de reporte y gestion de novedades de nomina.     
                    </p>

                    <p>
                        <a class="btn btn-success btn-lg" onclick="ingresarModulo('8');">Ingresar</a>
                    </p>

                </div> 

                <div class="col-lg-6 wow bounceIn"  data-wow-offset="0" data-wow-delay="1.0s">
                    <i class="fa fa-shopping-cart fa-5x"></i>
                    {*                <img class="img-rounded" data-src="holder.js/140x140" alt="140x140" style="width: 140px; height: 140px;" src="../../libs/imagenes/iconos/icon2.png"></img>*}
                    <h2>
                        Compras
                    </h2>

                    <p>
                        Modulo de solicitud y gestion de compras.     
                    </p>

                    <p>
                        <a class="btn btn-warning btn-lg" onclick="ingresarModulo('8');">Ingresar</a>
                    </p>

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

        <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        <img src="../../libs/imagenes/cargando.gif">
                    </div>

                </div>
            </div>
        </div>
        {$footer}

        <script src="../../libs/jquery/jquery.js"></script>
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../js/paginaPrincipalJs/paginaPrincipalJs.js"></script>
        <script src="../../libs/wow/js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>

    </body>



</html>