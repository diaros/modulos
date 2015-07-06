<?php

require_once '../../datos/conexion.php';
require_once '../../libs/PHPMailer/class.phpmailer.php';
require_once '../../libs/PHPMailer/class.smtp.php';

class utilidades {

    public function __construct() {
        
    }

    //funciones comunes

    public function iniciarTransaccion() {

        $conexion = new conexion();
        $sql = "BEGIN TRANSACTION";
        $inicioTransaccion = $conexion->insertar($sql);
        return $inicioTransaccion;
    }

    public function rollbackTransaccion() {

        $conexion = new conexion();
        $sql = "ROLLBACK";
        $rollbackTransaccion = $conexion->insertar($sql);
        return $rollbackTransaccion;
    }

    public function commitTransaccion() {

        $conexion = new conexion();
        $sql = "COMMIT";
        $commitTransaccion = $conexion->insertar($sql);
        return $commitTransaccion;
    }

    public function envioMail($asunto, $body, $destinatario, $adjunto = "", $copia = "") {
        
        if($body == null){
            
            $body = 'Msj';
        }
        
        // inicio envio de mail 
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "info.visionymarketing@gmail.com"; //cambiar
        //$mail->Username = "visionymarketing.info@gmail.com"; //cambiar
        $mail->Password = "PASS123$"; //cambiar
        $mail->From = "info.visionymarketing@gmail.com"; //cambiar
        $mail->FromName = "Modulos Administrativos Listos S.A.S"; //cambiar
        $mail->Subject = $asunto;
        $mail->AltBody = utf8_decode($body);
        $mail->MsgHTML($body);

        if (is_array($destinatario)) {

            foreach ($destinatario as $valor) {
                
                $mail->AddAddress(trim($valor), "Destinatario");
            }
        } else {

            $mail->AddAddress($destinatario, "Destinatario");
        }

        if (is_array($copia)) {

            foreach ($copia as $valor2) {

                $mail->addCC($valor2);
            }
        } else {

            $copia = trim($copia);
            $mail->addCC($copia);
        }

        $mail->AddAttachment($adjunto);
        $mail->IsHTML(true);

        $estadoEnvio = $mail->Send();

        if (!$estadoEnvio) {
            return '-1';
        } else {
            $mail->clearAttachments();
            $mail->clearCCs();
            $mail->clearAllRecipients();
            return '1';
        }
        //fin envio de mail
    }

    public function sanear_string($string) {

        $string = trim($string);

        $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

        $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

        $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

        $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

        $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

        $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
                array("\\", "¨", "º", "~",
            "#", "@", "!",
            "·", "$", "%", "&",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "`", "]",
            "+", "}", "{", "¨", "´",
            ">", "< ", ";",
            ".", " ¥", " ¤", "�"), '', $string
        );

        return $string;
    }

    public function consultarUserAutById($idUser) {

        $conexion = new conexion();
        $sql = "select * from AUT_USUARIO where usu_codigo = " . $idUser . " ";
        $resul = $conexion->consultarAUT($sql);
        return $resul;
    }

    public function consultarMailByIdAUT($idUser) {

        $conexion = new conexion();
        //$sql = "select sn_correo from usuarios where usu_id = " . $idUser . "";
        $sql = "select USU_MAIL from AUT_USUARIO where usu_codigo = " . $idUser . "";
        $resulConsulta = $conexion->consultarAUT($sql);
        return $resulConsulta;
    }

    public function fechatextual($dia, $mes, $año) {

        static $meses = array('error',
            'enero', 'febrero', 'marzo',
            'abril', 'mayo', 'junio',
            'julio', 'agosto', 'setiembre',
            'octubre', 'noviembre', 'diciembre');

        static $dias = array(
            'domingo', 'lunes', 'martes',
            'miércoles', 'jueves', 'viernes',
            'sábado');

        $sem = date('w', mktime(0, 0, 0, $mes, $dia, $año));
        $mes = (int) $mes; // así entiente igual '05' que '5'

        return "$dias[$sem], $dia de $meses[$mes] de $año";
    }

    public function convertFechaNomDia($fecha) {

        $fechats = strtotime($fecha);

        switch (date('w', $fechats)) {
            case 0: return "Domingo";
                break;
            case 1: return "Lunes";
                break;
            case 2: return "Martes";
                break;
            case 3: return "Miercoles";
                break;
            case 4: return "Jueves";
                break;
            case 5: return "Viernes";
                break;
            case 6: return "Sabado";
                break;
        }
    }

    public function consultarDiaFestivo($fecha) {

        $conexion = new conexion();
        $sql = "select count(*) as festivo from calendario_base where fecha = '" . $fecha . "'";
        $resul = $conexion->consultar($sql);
        return $resul;
    }

    //Fin funciones comunes
    //inicio funciones Compras

    public function consultarConceptosCompra() {

        $conexion = new conexion();
        $sql = "select * from conceptos_compra order by detalle";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    //Fin funciones compras
    //Inicio Funciones Modulo Exmed

    public function consultarClientes() {

        $conexion = new conexion();
        $sql = "select nit, nombre from cliente_general where estado = 'A' group by nit,nombre order by nombre";
        $resulConsulta = $conexion->consultar($sql);

        return $resulConsulta;
    }

    public function consultarEmpInterna() {

        $conexion = new conexion();
        $sql = "select cod_Empr,nom_empr from gn_empre where cod_empr in(1,2,3)";
        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    public function consultarSucursales() {

        $conexion = new conexion();
        $sql = "select suc_codigo, suc_nombre from sucursales order by suc_nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarCiudades($idEmpInt) {

        $conexion = new conexion();
        $sql = "select id_ciudad, nombre from exmed_ciudades where id_emp_int = " . $idEmpInt . " order by nombre ";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarCategorias() {

        $conexion = new conexion();
        $sql = "select id_categoria_examen,nombre,(case when estado = 1 then 'Activo' else 'Inactivo' end) as estado from exmed_categoria_examen order by nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarCategoriasActivas() {

        $conexion = new conexion();
        $sql = "select id_categoria_examen,nombre from exmed_categoria_examen where estado = 1 order by nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarLab() {

        $conexion = new conexion();
        $sql = "select id_laboratorio,nombre,suc_nombre,direccion,telefono,contacto,mail,nit,(case when estado = 1 then 'Activo' else 'Inactivo' end) as estado from exmed_laboratorio,sucursales where ciudad = suc_codigo order by nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarTipoExams() {

        $conexion = new conexion();

        $sql = "select a.id_tipo_examen,
                a.nombre,
                b.nombre as categoria,
                (case when a.paraclinico = 1 then 'Si' else 'No' end) as paraclinico,
                (case when a.especial = 1 then 'Si' else 'No' end) as especial,
                (case when a.estado = 1 then 'Activo' else 'Inactivo' end) as estado 
                from exmed_tipo_examen a,exmed_categoria_examen b 
                where a.id_categoria = b.id_categoria_examen 
                order by a.nombre";
        $resulConsulta = $conexion->consultar($sql);

        return $resulConsulta;
    }

    public function consultarEmpUsuarias() {

        $conexion = new conexion();
        $sql = "select nit ,nombre from cliente_general where estado = 'A' group by nit,nombre order by nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarEmpUsuariasByEmpInt($idEmpInt) {

        $conexion = new conexion();
        $sql = "select nit ,nombre from cliente_general where estado = 'A' and empresa = " . $idEmpInt . " and nombre != '' group by nit,nombre order by nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarUsuariosPsicologos() {

        $conexion = new conexion();
        $sql = "select usu_id, usu_nombre from usuarios where usu_estado = 0 and usu_area = 8 order by usu_nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarLaboratorios() {

        $conexion = new conexion();
        $sql = "select * from exmed_laboratorio order by nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultarTipoFacturacion() {

        $conexion = new conexion();
        $sql = "select * from exmed_tipo_facturacion order by nombre";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultaUserByID($id) {

        $conexion = new conexion();
        $sql = "select * from usuarios where usu_cedula = " . $id . "";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function regLog($idUser, $accion) {

        $conexion = new conexion();
        $fecha = date('Y-m-d H:i:s');
        $sql = "insert into exmed_log_acciones values('" . $fecha . "','" . $accion . "',$idUser)";
        $resulInsert = $conexion->insertar($sql);
        return $resulInsert;
    }

    //funciones modulo Contratos

    public function consultarPsicologos() {

        $conexion = new conexion();
        //$sql = "select sn_correo,usu_id, usu_nombre from usuarios where usu_estado = 0 and usu_area = 8 order by usu_nombre";
        //$resulConsulta = $conexion->consultar($sql);
        $sql = "select a.usu_codigo,a.usu_nombres,a.usu_apellidos from aut_usuario a,aut_perfil_usuario b where a.usu_codigo = b.usu_codigo and b.per_codigo = 158";
        $resulConsulta = $conexion->consultarAUT($sql);
        return $resulConsulta;
    }

    public function consultaEstadosReq() {

        $conexion = new conexion();
        $sql = "select id,descripcion from contratos_estado_requisicion";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    public function consultaProcesos() {

        $conexion = new conexion();
        $sql = "select * from contratos_proceso";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    //fin funciones Modulo Contrato
}
