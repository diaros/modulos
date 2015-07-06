<?php

include_once '../../webServices/clientes/clienteAUT.php';

class controlLog {

    var $webService;

    function __construct() {
        $this->webService = new webServiceAut();
    }

    public function logueo1($usuario, $pass) {

        $resulLog = $this->webService->login1($usuario, $pass);

        session_start();

        if ($resulLog == true) {
            return true;
        } else {
            return false;
        }
    }

    public function logModulo($app) {

        session_start();

        $usuCodigo = $_SESSION['usuCodigo'];

        $resulLog = $this->webService->logModulo($usuCodigo, $app);

        if ($resulLog == -1) {
            
            return '-1';
            
        } else {

            $menu = '';

            foreach ($resulLog as $pos => $valor) {

                $menu = $menu . ''
                        . '<ul class="nav navbar-nav">'
                        . '<li class="dropdown">'
                        . '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $pos . '<b class="caret"></b></a>'
                        . '<ul class="dropdown-menu">';

                foreach ($valor as $pos2 => $valor2) {

                    $menu = $menu . '<li>'
                            . '<a href="../../controlador/mappings/rutas.php?accionMenu=' . $valor2 . '">' . $pos2 . '</a>'
                            . '</li>';
                }

                $menu = $menu . '</ul></li></ul>';
            }


            $_SESSION['menu'] = $menu;
            
            return 1;
            
        }

//        if (is_array($resulLog)) {
//            
//        }
    }

    public function logueo($usuario, $pass) {

        $resulLog = $this->webService->login($usuario, $pass);

        session_start();

        if (is_array($resulLog)) {

            $menu = '';

//            foreach ($resulLog as $pos => $valor) {
//
//                $menu = $menu . ''
//                        . '<ul class="nav navbar-nav">'
//                        . '<li class="dropdown">'
//                        . '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $pos . '<b class="caret"></b></a>'
//                        . '<ul class="dropdown-menu">';
//
//                foreach ($valor as $pos2 => $valor2) {
//
//                    $menu = $menu . '<li>'
//                            . '<a href="' . $valor2 . '">' . $pos2 . '</a>'
//                            . '</li>';
//                }
//
//                $menu = $menu . '</ul></li></ul>';
//            }

            foreach ($resulLog as $pos => $valor) {

                $menu = $menu . ''
                        . '<ul class="nav navbar-nav">'
                        . '<li class="dropdown">'
                        . '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $pos . '<b class="caret"></b></a>'
                        . '<ul class="dropdown-menu">';

                foreach ($valor as $pos2 => $valor2) {

                    $menu = $menu . '<li>'
                            . '<a href="../../controlador/mappings/rutas.php?accionMenu=' . $valor2 . '">' . $pos2 . '</a>'
                            . '</li>';
                }

                $menu = $menu . '</ul></li></ul>';
            }


            $_SESSION['menu'] = $menu;
        }

        return $resulLog;
    }

    public function recordarPass($usuario) {

        $resulRecordar = $this->webService->recordarPass($usuario);

        return $resulRecordar;
    }

}
