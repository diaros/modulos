<?php

require_once '../../datos/conexion.php';

class utilidadesWs {

    public function __construct() {}

    //funcion para pasar de obj_sdt_class a Arreglo
    public function objectToArray($d) {

        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */

            return array_map(array($this, 'objectToArray'), $d);
        } else {
            // Return array
            return $d;
        }
    }

    public function XML2JSON($xml) {

        function normalizeSimpleXML($obj, &$result) {
            $data = $obj;
            if (is_object($data)) {
                $data = get_object_vars($data);
            }
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $res = null;
                    normalizeSimpleXML($value, $res);
                    if (($key == '@attributes') && ($key)) {
                        $result = $res;
                    } else {
                        $result[$key] = $res;
                    }
                }
            } else {
                $result = $data;
            }
        }

        normalizeSimpleXML(simplexml_load_string($xml), $result);
        return json_encode($result);
    }

}

?>