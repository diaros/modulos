<?php

require_once '../../libs/nuSoap/nusoap.php';
require_once '../../webServices/utilidades/utilidadesWs.php';

class webServiceAut {

    public function __construct() {}

    public function login1($usuario, $pass) {

        $utilidades = new utilidadesWs();
        $datosUser = Array();
        $usuCodigo = Array();
        
        //$wsdlUrl = 'https://www.vymapps.com.co/SeguridadAUT/AutAutenticacionWs?wsdl';
        $wsdlUrl = 'http://servclo03:8380/SeguridadAUT/AutAutenticacionWs?wsdl';
        $cliente = new soapclient($wsdlUrl, array('location' => $wsdlUrl));
             
        $datosUser[0]['usuLogin'] = $usuario;
        $datosUser[0]['usuClave'] = $pass;

        $resMetodo = $cliente->__soapCall('autenticar', $datosUser);
        $arrayUser = $utilidades->objectToArray($resMetodo);
        
        $usuCodigo[0]['usuCodigo'] =  $arrayUser['return']['usuCodigo'];     
        $consultaCiudadUsuario = $cliente->__soapCall('consultaCiudadUsuario', $usuCodigo);
        $arregloCiudadUsuario = $utilidades->objectToArray($consultaCiudadUsuario);

        if ($arrayUser['return'] != false) {

            session_start();

            $_SESSION['usuLogin'] = $arrayUser['return']['usuLogin'];
            $_SESSION['usuMail'] = $arrayUser['return']['usuMail'];
            $_SESSION['usuCodigo'] = $arrayUser['return']['usuCodigo'];
            $_SESSION['usuNombres'] = $arrayUser['return']['usuNombres'];
             
            $_SESSION['ciudad'] = $arregloCiudadUsuario['return']['nombreCiudad'];
            $_SESSION['codCiudad'] = $arregloCiudadUsuario['return']['ciuCodigo_AutCiudad'];
       

            return true;
        } else {
            return false;
        }
    }

    public function logModulo($usuCodigo, $app) {

        $utilidades = new utilidadesWs();
        $menu = Array();
        $datosApp = Array();
        $datosApUs = Array();
        $datosApUs2 = Array();

        //$wsdlUrl = 'http://190.242.124.94:8380/SeguridadAUT/AutAutenticacionWs?wsdl';
        $wsdlUrl = 'http://servclo03:8380/SeguridadAUT/AutAutenticacionWs?wsdl';
        $cliente = new soapclient($wsdlUrl, array('location' => $wsdlUrl));

        $datosApp[0]['idAplicacion'] = $app;
        $datosApp[0]['usuCodigo'] = $usuCodigo;

        $usuariosxAplicacion = $cliente->__soapCall('verificarUsuarioAplicacion', $datosApp);
        $arrayUsersxApp = $utilidades->objectToArray($usuariosxAplicacion);

        $datosApUs[0]['aplCodigo'] = $app;
        $datosApUs[0]['tipCodigo'] = '3';
        $datosApUs[0]['acsCodigo'] = null;
        $datosApUs[0]['usuCodigo'] = $usuCodigo;

        $usuarioxAplicacionxAccion = $cliente->__soapCall('consultarAccionesMenu', $datosApUs);
        $arrayUsersxAppxAccion = $utilidades->objectToArray($usuarioxAplicacionxAccion);

        if (sizeof($arrayUsersxAppxAccion) == 0) {
            return '-1';
        } else {

            $res = key_exists("0", $arrayUsersxAppxAccion['return']);

            if ($res == true) {

                foreach ($arrayUsersxAppxAccion['return'] as $valor) {

                    $datosApUs2[0]['aplCodigo'] = $app;
                    $datosApUs2[0]['tipCodigo'] = '3';
                    $datosApUs2[0]['acsCodigo'] = $valor['acsCodigo'];
                    $datosApUs2[0]['usuCodigo'] = $usuCodigo;

                    $nomPadre = $valor['acsNombre'];

                    $usuarioxAplicacionxAccion2 = $cliente->__soapCall('consultarAccionesMenu', $datosApUs2);
                    $arrayUsersxAppxAccion2 = $utilidades->objectToArray($usuarioxAplicacionxAccion2);

                    $res2 = key_exists("0", $arrayUsersxAppxAccion2['return']);

                    if ($res2 == true) {

                        foreach ($arrayUsersxAppxAccion2['return'] as $valor2) {
                            $nomhijo = $valor2['acsNombre'];
                            $menu[$nomPadre][$nomhijo] = $valor2['acsComando'];
                        }
                    } else {

                        foreach ($arrayUsersxAppxAccion2 as $valor2 => $pos2) {
                            $nomhijo = $pos2['acsNombre'];
                            $menu[$nomPadre][$nomhijo] = $pos2['acsComando'];
                        }
                    }
                }
            } else {

                foreach ($arrayUsersxAppxAccion as $valor => $pos) {

                    $datosApUs2[0]['aplCodigo'] = $app;
                    $datosApUs2[0]['tipCodigo'] = '3';
                    $datosApUs2[0]['acsCodigo'] = $pos['acsCodigo'];
                    $datosApUs2[0]['usuCodigo'] = $usuCodigo;

                    $nomPadre = $pos['acsNombre'];

                    $usuarioxAplicacionxAccion2 = $cliente->__soapCall('consultarAccionesMenu', $datosApUs2);
                    $arrayUsersxAppxAccion2 = $utilidades->objectToArray($usuarioxAplicacionxAccion2);
                    
                     $res2 = key_exists("0", $arrayUsersxAppxAccion2['return']);

                    if ($res2 == true) {

                        foreach ($arrayUsersxAppxAccion2['return'] as $valor2) {

                            $nomhijo = $valor2['acsNombre'];
                            $menu[$nomPadre][$nomhijo] = $valor2['acsComando'];
                        }
                    } else {

                        foreach ($arrayUsersxAppxAccion2 as $valor2 => $pos2) {

                            $nomhijo = $pos2['acsNombre'];
                            $menu[$nomPadre][$nomhijo] = $pos2['acsComando'];
                        }
                    }
                }
            }

            if ($arrayUsersxApp['return'] != false) {

                return $menu;
            } else {
                return false;
            }
        }
    }

    public function login($usuario, $pass) {

        $utilidades = new utilidadesWs();
        $datosUser = Array();
        $datosApp = Array();
        $datosApUs = Array();
        $datosApUs2 = Array();
        $menu = Array();

        $wsdlUrl = 'http://190.242.124.94:8380/SeguridadAUT/AutAutenticacionWs?wsdl';
        $cliente = new soapclient($wsdlUrl, array('location' => $wsdlUrl));

        $datosUser[0]['usuLogin'] = $usuario;
        $datosUser[0]['usuClave'] = $pass;

        $resMetodo = $cliente->__soapCall('autenticar', $datosUser);
        $arrayUser = $utilidades->objectToArray($resMetodo);

        $datosApp[0]['idAplicacion'] = '6';

        if (isset($arrayUser['return']['usuCodigo'])) {

            $datosApp[0]['usuCodigo'] = $arrayUser['return']['usuCodigo'];
        }

        $usuariosxAplicacion = $cliente->__soapCall('verificarUsuarioAplicacion', $datosApp);
        $arrayUsersxApp = $utilidades->objectToArray($usuariosxAplicacion);

        $datosApUs[0]['aplCodigo'] = '6';
        $datosApUs[0]['tipCodigo'] = '3';
        $datosApUs[0]['acsCodigo'] = null;
        $datosApUs[0]['usuCodigo'] = $arrayUser['return']['usuCodigo'];

        $usuarioxAplicacionxAccion = $cliente->__soapCall('consultarAccionesMenu', $datosApUs);
        $arrayUsersxAppxAccion = $utilidades->objectToArray($usuarioxAplicacionxAccion);

        $res = key_exists("0", $arrayUsersxAppxAccion['return']);

        if ($res == true) {

            foreach ($arrayUsersxAppxAccion['return'] as $valor) {

                $datosApUs2[0]['aplCodigo'] = '6';
                $datosApUs2[0]['tipCodigo'] = '3';
                $datosApUs2[0]['acsCodigo'] = $valor['acsCodigo'];
                $datosApUs2[0]['usuCodigo'] = $arrayUser['return']['usuCodigo'];

                $nomPadre = $valor['acsNombre'];

                $usuarioxAplicacionxAccion2 = $cliente->__soapCall('consultarAccionesMenu', $datosApUs2);
                $arrayUsersxAppxAccion2 = $utilidades->objectToArray($usuarioxAplicacionxAccion2);

                $res2 = key_exists("0", $arrayUsersxAppxAccion2['return']);

                if ($res2 == true) {

                    foreach ($arrayUsersxAppxAccion2['return'] as $valor2) {

                        $nomhijo = $valor2['acsNombre'];
                        $menu[$nomPadre][$nomhijo] = $valor2['acsComando'];
                    }
                } else {

                    foreach ($arrayUsersxAppxAccion2 as $valor2 => $pos2) {

                        $nomhijo = $pos2['acsNombre'];
                        $menu[$nomPadre][$nomhijo] = $pos2['acsComando'];
                    }
                }
            }
        } else {

            foreach ($arrayUsersxAppxAccion as $valor => $pos) {

                $datosApUs2[0]['aplCodigo'] = '6';
                $datosApUs2[0]['tipCodigo'] = '3';
                $datosApUs2[0]['acsCodigo'] = $pos['acsCodigo'];
                $datosApUs2[0]['usuCodigo'] = $arrayUser['return']['usuCodigo'];

                $nomPadre = $pos['acsNombre'];

                $usuarioxAplicacionxAccion2 = $cliente->__soapCall('consultarAccionesMenu', $datosApUs2);
                $arrayUsersxAppxAccion2 = $utilidades->objectToArray($usuarioxAplicacionxAccion2);

                foreach ($arrayUsersxAppxAccion2['return'] as $valor2) {

                    $nomhijo = $valor2['acsNombre'];
                    $menu[$nomPadre][$nomhijo] = $valor2['acsComando'];
                }
            }
        }

        if ($arrayUsersxApp['return'] != false) {

            session_start();

            $_SESSION['usuLogin'] = $arrayUser['return']['usuLogin'];
            $_SESSION['usuMail'] = $arrayUser['return']['usuMail'];
            $_SESSION['usuCodigo'] = $arrayUser['return']['usuCodigo'];

            return $menu;
        } else {
            return false;
        }
    }

    public function recordarPass($usuario) {

        $utilidades = new utilidadesWs();

        $datosUser = Array();
        $datosUser[0]['usuLogin'] = $usuario;
        $datosUser[0]['nombreApp'] = 'Modulos administrativos';

        $wsdlUrl = 'http://servclo03:8380/SeguridadAUT/AutAutenticacionWs?wsdl';
        $cliente = new soapclient($wsdlUrl, array('location' => $wsdlUrl));

        $resMetodo = $cliente->__soapCall('consultarPorLogin', $datosUser);
        $arrayUser = $utilidades->objectToArray($resMetodo);

        return $arrayUser;
    }

}

?>