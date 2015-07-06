<?php

include_once '../../datos/gestionContratosDatos/gestionContratosDatos.php';
include_once '../../controlador/utilidades/utilidades.php';
include '../../libs/fpdf17/fpdf.php';

session_start();

class gestionContratosControlador {

    function __construct(){}

    function consultarObservacion($empInt, $req, $idUser) {
        
        $gestionDatos = new gestionContratosDatos();
        $resulConsulta = $gestionDatos->consultarObservacion($empInt, $req, $idUser);
        return $resulConsulta;
        
    }
    
    function consultarUsuariosxReq2($empInt, $req) {
            
            $gestionDatos = new gestionContratosDatos();
            $resulConsulta = $gestionDatos->consultarUsuariosxReq2($empInt, $req);
            return $resulConsulta;
        }

    function consultarUsuariosxReq($empInt, $req, $idUser = '', $att = '', $cita = '', $direccion = '', $accion) {

        $gestionDatos = new gestionContratosDatos();
        $resulConsulta = $gestionDatos->consultarUsuariosxReq($empInt, $req, $idUser);

        if ($resulConsulta != null && $accion == 'generarCartaInformativa') {
            $resulGeneracionCarta = $this->generarCartaInformativa($resulConsulta);
            return $resulGeneracionCarta;
        }

        if ($resulConsulta != null && $accion == 'generarcartaPresentacion') {
            $resulGeneracionCartaPresentacion = $this->generarCartaPresentacion($resulConsulta, $empInt, $req, $idUser, $att, $cita, $direccion);
            return $resulGeneracionCartaPresentacion;
        }

        if ($resulConsulta != null && $accion == 'generarCertificadoInduccion') {
            $resulCertificadoInduccion = $this->generarCertificadoInduccion($resulConsulta, $empInt, $req, $idUser);
            return $resulCertificadoInduccion;
        }

        if ($resulConsulta != null && $accion == 'generarClausulaAdicional') {
            $resulClausulaAdicional = $this->generarClausulaAdicional($resulConsulta, $empInt, $req, $idUser);
            return $resulClausulaAdicional;
        }

        if ($resulConsulta != null && $accion == 'generarDecreto3377') {

            $resulClausulaAdicional = $this->generarDecreto3377($resulConsulta, $empInt, $req, $idUser);
            return $resulClausulaAdicional;
        }

        if ($resulConsulta != null && $accion == 'generarContrato'){
            return $resulConsulta;
        }

        if ($resulConsulta != null && $accion == 'generarPaqueteContrato') {

            return $resulConsulta;
        }

        if ($resulConsulta != null && $accion == 'listaChequeo') {

            return $resulConsulta;
        }
        
        if ($resulConsulta != null && $accion == 'consultarUsuariosxReq'){
            
            return $resulConsulta;
            
        }
        
    }

    function generarCartaInformativa($resulConsulta) {

        $pdf = new FPDF();
        $pdf->AddPage();
        $fecha = date('d-m-Y');
        $ciduade = 'Cali';

        foreach ($resulConsulta as $valor) {

            $texto1 = utf8_decode("INFORMACIÓN IMPORTANTE");
            $parrafo = utf8_decode("Se le informa al trabajador contratado que para darle cumplimiento a lo ordenado en el articulo 57 Numerial 7 de C.S.T, al  finalizar la  relacion  contractual que lo une a la empresa, puede solicitar la práctica del examen médico de egreso dentro de los cinco (5) días siguientes a la conclusión de la misma, para lo cual deberá presentarse en la sede de la compañia " . trim(odbc_result($rs_consulta, "nom_empr")) . " a fin de reclamar la  orden  correspondiente para asistir ante el médico que ésta designe. Vencido dicho término,  se  entenderá su renuncia a este derecho, o si entregada la  ordén Usted no concurre a la práctica del referido examen");
            $fecha = date('d-m-Y');

            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(0, 20, 'Ciudad y Fecha : ' . $ciduade . ' ' . $fecha . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, '' . trim($valor['nom_empl']) . " " . utf8_decode(trim($valor['ape_empl'])) . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, 'Identificado con la cedula de ciudadania: ' . trim($valor['cod_empl']) . ' ', 0, 0, 'L');
            $pdf->Ln(10);
            $pdf->Cell(0, 20, ' ' . $texto1 . ' ', 0, 0, 'C');
            $pdf->Ln(20);
            $pdf->SetFont('Times');
            $pdf->Write(5, '' . $parrafo . '');
            $pdf->Ln(20);
            $pdf->Cell(0, 20, 'Firma del trabajador enterado:_________________________', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, 'C.C:' . trim($valor['cod_empl']) . ' ', 0, 0, 'L');
            $pdf->Ln(70);
        }

        $fechaDoc = date('d-m-Y_H-i-s');
        $ruta = "../../temporales/cartaInformativa/cartaInformativa" . $fechaDoc . ".pdf";
        $pdf->Output($ruta);
        return($ruta);
    }

    function generarCartaPresentacion($resulConsulta, $empInt, $req, $idUser, $att, $cita, $direccion) {

        $gestionDatos = new gestionContratosDatos();
        $codClie = $resulConsulta[0]['COD_CLIE'];
        $municipio = $gestionDatos->consultarMunicipio($empInt, $req, $idUser);
        $cliente = $gestionDatos->consultarCliente($empInt, $codClie);

        $pdf = new FPDF();
        //$pdf->AddPage();
        $fecha = date('d-m-Y');
        $ciduade = 'Cali';

        foreach ($resulConsulta as $valor) {

            $fecha = date('d-m-Y');
            $texto1 = utf8_decode('Señores');
            $texto2 = utf8_decode('Dirección');
            $texto3 = utf8_decode('Apreciados señores');
            $parrafo = utf8_decode('De acuerdo a la solicitud de servicio efectuado por ustedes, nos complace informarles que hemos seleccionado a: ' . utf8_encode(trim($valor['nom_empl'])) . ' ' . utf8_encode(trim($valor['ape_empl'])) . ' identificado(a) con la C.C No. ' . $valor['cod_empl'] . ' expedida en : ' . trim($municipio) . ' para ejecutar la labor de: ' . trim($valor['nom_carg']) . '  ');
            $parrafo2 = utf8_decode("Les agradecemos nos informen sobre cualquier sugerencia o inconveniente que se les presente, para solucionarlo inmediatamente.");
            //$text = utf8_decode("Cali: Calle 21 Norte #8 n 21 - Bogota: carrera 47 # 100-41 - Barranquilla: Carrera 59 # 75-133 B/Concepción Bucaramanga: Calle 59 # 32-79 - Buenaventura: Carrera 3 # 7-09 Edificio Lopera Of.202 - Buga: Calle 6 # 11-48 - Buga: Calle 6 # 11 - 48 Of. 12 Centro - Cartagena: Centro industrial Ternera Bodega M1 - Duitama: Calle 15 # 17-71 Oficina 603 edificio Carrara - Ibague: Calle 35 # 4-B-38 - Medellin: Carrera 7 A # 47-33 B/Velodromo - Neiva: Carrera 1 F # 54-08 - Palmira: Calle 32 # 30-64 Centro - Pasto: Carrera 25 # 15-62 Centro Comercial San Juan del lago Local 315 - Pereira: Avenida 30 de agosto # 38-68 - Santander de quilichao: Calle 6 # 10-67 - Tulua Carrera 25 # 31-20 Villavicencio: Carrera 35 # 34-46 B/Barzal Bajo - Yopal: Carrera 28 # 11 -54 - Santa Marta: Km 8 Sector Pasos Colorados");

            $linea1 = utf8_decode("Cali: Calle 21 Norte #8 n 21 - Bogota: carrera 47 # 100-41 - Barranquilla: Carrera 59 # 75-133 B/Concepción Bucaramanga: Calle 59 # 32-79 -");
            $linea2 = utf8_decode("Buenaventura: Carrera 3 # 7-09 Edificio Lopera Of.202 - Buga: Calle 6 # 11-48 - Buga: Calle 6 # 11 - 48 Of. 12 Centro - Cartagena: Centro");
            $linea3 = utf8_decode("industrial Ternera Bodega M1 - Duitama: Calle 15 # 17-71 Oficina 603 edificio Carrara - Ibague: Calle 35 # 4-B-38 - Medellin: Carrera 7 A # 47-33");
            $linea4 = utf8_decode("B/Velodromo - Neiva: Carrera 1 F # 54-08 - Palmira: Calle 32 # 30-64 Centro - Pasto: Carrera 25 # 15-62 Centro Comercial San Juan del lago");
            $linea5 = utf8_decode("Local 315 - Pereira: Avenida 30 de agosto # 38-68 - Santander de quilichao: Calle 6 # 10-67 - Tulua Carrera 25 # 31-20 Villavicencio: Carrera 35 #");
            $linea6 = utf8_decode("34-46 B/Barzal Bajo - Yopal: Carrera 28 # 11 -54 - Santa Marta: Km 8 Sector Pasos Colorados");

            $pdf->AddPage();
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 20, 'Ciudad y Fecha : ' . $ciduade . ' ' . $fecha . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, '' . $texto1 . ' : ' . trim($cliente) . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, 'Att: ' . $att . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, '' . $texto2 . ':' . $direccion . ' ', 0, 0, 'L');
            $pdf->Ln(10);
            $pdf->Cell(0, 20, '' . $texto3 . ':', 0, 0, 'L');
            $pdf->Ln(20);
            $pdf->SetFont('Times');
            $pdf->Write(5, '' . $parrafo . '');
            $pdf->Ln(10);
            $pdf->Cell(0, 20, 'Hora cita : ' . $cita . ' ', 0, 0, 'L');

            $pdf->Ln(20);
            $pdf->Write(5, '' . $parrafo2 . '');

            $pdf->Ln(10);
            $pdf->Write(5, 'Muchas gracias por utilizar nuestros servicios');

            $pdf->Ln(20);
            $pdf->Write(5, 'Cordialmente');

            $pdf->Ln(40);
            $pdf->Write(5, 'Departamento de seleccion');

            $pdf->Ln(50);
            $pdf->SetFont('Times', 'B', 8);

            $pdf->Cell(0, 10, ' ' . $linea1 . ' ', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 10, ' ' . $linea2 . ' ', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 10, ' ' . $linea3 . ' ', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 10, ' ' . $linea4 . ' ', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 10, ' ' . $linea5 . ' ', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 10, ' ' . $linea6 . ' ', 0, 0, 'C');
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Afiliados a Acoset - www.listo.com.co', 0, 0, 'C');
        }

        $fechaDoc = date('d-m-Y_H-i-s');

        $ruta = "../../temporales/cartaPresentacion/cartaPresentacion" . $fechaDoc . ".pdf";
        $pdf->Output($ruta);
        return($ruta);
    }

    function generarCertificadoInduccion($resulConsulta, $empInt, $req, $idUser) {

        $gestionDatos = new gestionContratosDatos();

        if ($empInt == 1) {

            $imgsrc = "../../libs/imagenes/logos/logo_head1.JPG";
        }

        if ($empInt == 2) {

            $imgsrc = "../../libs/imagenes/logos/Logo_Tercerizar.png";
        }

        if ($empInt == 3) {
            $imgsrc = "../../libs/imagenes/logos/logo-vm.png";
        }

        $pdf = new FPDF();
        $fecha = date('d-m-Y');
        $ciduade = 'Cali';

        foreach ($resulConsulta as $valor) {

            $pdf->AddPage();
            $codClie = $resulConsulta[0]['COD_CLIE'];

            if ($idUser == '') {

                $idUser = $valor['COD_EMPL'];
            }

            $municipio = $gestionDatos->consultarMunicipio($empInt, $req, $idUser);
            //$cliente = $gestionDatos->consultarCliente($empInt, $codClie);

            $fecha = date('d-m-Y');

            $pdf->SetFont('Times', 'B', 8);

            $parrafo = utf8_decode("Yo " . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . " Identificado con la cédula de ciudadanía No: " . trim($valor['cod_empl']) . " de " . trim($municipio) . " Certifico que recibí inducción sobre:");

            $linea1 = utf8_decode("1.La labor que voy a desempeñar");
            $linea2 = utf8_decode("2.Riesgos y medidas preventivas a tomar en dicha labor y los elementos de proteccion personal que debo usar.");
            $linea3 = utf8_decode("3.El procedimiento a seguir con los accidentes de trabajo y enfermedades laborales en caso de presentarse.");
            $linea4 = utf8_decode("4.Reglamento de higiene y seguridad industrial y politica integral de gestión.");
            $linea5 = utf8_decode("5.Los servicios y beneficios que presta la EPS(Entidad promotora de salud),ARL(Administradora de riesgos laborales) y la caja de compensación");
            $linea6 = utf8_decode("Recibí copias de afiliación a:");

            if ($empInt == 3) {

                $pdf->Image($imgsrc, 10, 8, 15);

            } else {

                $pdf->Image($imgsrc, 10, 8, 33);
            }          
            
            $pdf->Cell(190, 10, 'Proceso', 0, 0, 'C');
//            $pdf->Cell(5, 10, 'Codigo:FO-REC-13', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(190, 10, 'Bienestar y Capacitacion', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(190, 10, 'Certificado de induccion', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, 'Ciudad y Fecha : ' . $ciduade . ' ' . $fecha . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Write(5, '' . $parrafo . '');
            $pdf->Ln();
            $pdf->Cell(0, 6, ' ' . $linea1 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea2 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea3 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea4 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea5 . ' ', 0, 0, 'L');
            $pdf->Ln(8);
            $pdf->Cell(0, 6, ' ' . $linea6 . ' ', 0, 0, 'L');
            $pdf->Ln(10);
            $pdf->Cell(35, 3, 'E.P.S:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(20, 3, 'A.R.L:', 0, 0, 'C');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(20, 3, 'A.F.P:', 0, 0, 'C');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(35, 3, 'Carnet de la empresa:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(35, 3, 'Carnet de la A.R.L:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(35, 3, 'Formato bienvenida:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(0, 6, 'Atentamente', 0, 0, 'C');
            $pdf->Ln(12);
            $pdf->Cell(0, 6, '___________________________________', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, 'Firma del trabajador', 0, 1, 'C');
            $pdf->Cell(0, 6, 'C.C: ' . $valor['cod_empl'] . ' ', 0, 0, 'C');

//            $pdf->Ln(25);
        }

        $fechaDoc = date('d-m-Y_H-i-s');
        $ruta = "../../temporales/certificadoInduccion/certificadoInduccion" . $fechaDoc . ".pdf";
        $pdf->Output($ruta);

        return $ruta;
    }

    function generarClausulaAdicional($resulConsulta, $empInt, $req, $idUser) {

        $pdf = new FPDF();
        $fecha = date('d-m-Y');
        $ciduade = 'Cali';

        foreach ($resulConsulta as $valor) {
            $pdf->AddPage();
            $texto1 = utf8_decode("Cláusula adicional al contrato de trabajo suscrito por: " . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . " identidicado con la C.C: " . trim($valor['cod_empl']) . " como trabajador y  " . trim($valor['nom_empr']) . " como empleador por mutuo acuerdo y consentimiento acordamos que:");
            $texto2 = utf8_decode("El trabajador se compromete con la empresa de manera expresa, a no hacer uso personal o para terceras personas que tengan vínculo con la empresa, de los productos de degustación o promoción suministrados por los clientes o por cualquier otra persona, ya que estos deberán ser utilizados para los fines determinados  por la empresa. El incumplimiento de esta prohibición será considerada como un incumplimiento grave de las obligaciones a cargo del trabajador, que conllevaría a la terminación del contrato de trabajo por justa causa, sin lugar a indemnización alguna.");
            $texto3 = utf8_decode("Por lo anterior, el trabajador autoriza de manera expresa a la empresa para descontar de sus salarios,y demás prestaciones sociales que se le adeuden, el valor de los productos de degustación o promoción suministrados que se hubiere utilizado indebidamente.");
            $fecha = date('d-m-Y');

            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(0, 20, ' Clausula adicional ', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->SetFont('Times');
            $pdf->Cell(20, 6, 'Ciudad y Fecha : ' . $ciduade . ' ' . $fecha . ' ', 0, 1, 'L');
            $pdf->Ln(10);
            $pdf->Write(5, '' . $texto1 . '');
            $pdf->Ln(10);
            $pdf->Write(5, '' . $texto2 . '');
            $pdf->Ln(10);
            $pdf->Write(5, '' . $texto3 . '');
            $pdf->Ln(20);
            $pdf->Cell(60, 20, 'Firma del trabajador enterado:', 0, 0, 'L');
            $pdf->Cell(80, 20, 'La empresa', 0, 0, 'R');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, 'C.C:' . trim($valor['COD_EMPL']) . ' ', 0, 0, 'L');
            $pdf->Ln(50);
        }

        $fechaDoc = date('d-m-Y_H-i-s');
        $ruta = "../../temporales/clausulaAdicional/clausulaAdicional" . $fechaDoc . ".pdf";
        $pdf->Output($ruta);
        return $ruta;
    }

    function generarDecreto3377($resulConsulta, $empInt, $req, $idUser) {

        $pdf = new FPDF();
        $fecha = date('d-m-Y');
        $ciduade = 'Cali';

        if ($empInt == 1) {

            $txtEmpresa = "LISTOS S.A.S";
        }

        if ($empInt == 2) {

            $txtEmpresa = "TERCERIZAR S.A.S";
        }

        if ($empInt == 3) {

            $txtEmpresa = "VISION Y MARKETING S.A.S";
        }

        foreach ($resulConsulta as $valor) {

            $fecha = date('d-m-Y');
            $pdf->AddPage();
            $pdf->SetFont('Times', 'B', 12);
            $texto1 = utf8_decode("Señores");

            $pdf->Ln(25);
            $pdf->Cell(35, 6, 'Santiago de cali:', 0, 0, 'L');
            $pdf->Cell(50, 6, '______________________________', 0, 1, 'L');
            $pdf->Ln(5);
            $pdf->Cell(20, 20, ' ' . $texto1 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, ' ' . $txtEmpresa . ' ', 0, 0, 'L');
            $pdf->Ln(20);
            $pdf->SetFont('Times', '', 12);
            $parrafo1 = utf8_decode("Por medio de la presente, y teniendo como soporte el Decreto 1377 de 2013, reglamentario de la Ley 1581 de 2012, autorizo a la firma " . $txtEmpresa . " , como responsable de mis datos personales obtenidos o que llegue a obtener en el futuro a través de sus distintos canales de atención, para que continúe con el tratamiento y manejo de dichos datos.");
            $parrafo2 = utf8_decode("Esta autorizacion permite a " . $txtEmpresa . " , no solo a recolectar y almacenar , sino también a transferir, usar , circular, suprimir, compartir, actualizar, trasmitir, de acuerdo con el procedimiento para el tratamiento de los datos personales sin restriccion o reserva alguna.");
            $parrafo3 = utf8_decode("El alcance de esta autorización comprende la facultad para que " . $txtEmpresa . " le envíe mensajes con contenidos comerciales, notificaciones, información del estado de cuenta, saldos, cuotas pendiens de pago y demas información relativa al portafolio de servicios de la entidad, a través de correo electronico y/o mensajes de texto al móvil.");
            $parrafo4 = utf8_decode("No obstante lo anterior, me reservo el derecho de conocer, actualizar, rectificar y suprimir mis datos personales, a traves de los canales dispuestos por " . $txtEmpresa . " para tal fin.");

            $pdf->MultiCell(0, 5, $parrafo1);
            $pdf->Ln(5);
            $pdf->MultiCell(0, 5, $parrafo2);
            $pdf->Ln(5);
            $pdf->MultiCell(0, 5, $parrafo3);
            $pdf->Ln(5);
            $pdf->MultiCell(0, 5, $parrafo4);
            $pdf->Ln(10);
            $pdf->Cell(0, 20, 'Atentamete:', 0, 0, 'L');
            $pdf->Ln(30);
            $pdf->Cell(0, 20, ' ' . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 20, 'C.C: ' . trim($valor['cod_empl']) . ' ', 0, 0, 'L');
        }

        $fechaDoc = date('d-m-Y_H-i-s');
        $ruta = "../../temporales/decreto3377/decreto" . $fechaDoc . ".pdf";
        $pdf->Output($ruta);
        return $ruta;
    }

    function generarContrato($empInt, $req, $idUser, $logo, $tipContra, $fechaFin, $accion,$adicionales) {

        $pdf = new FPDF();
        $gestionDatos = new gestionContratosDatos();
        $utilidades = new utilidades();
        $idUserCreo = $_SESSION['usuCodigo'];
        $resulRegLog = true;
        $resulUpdateLog = true;
        $nuevoReg = false;
        $actualizacion = false;

        $resulConsulta = $this->consultarUsuariosxReq($empInt, $req, $idUser, $att, $cita, $direccion, $accion);

        if ($tipContra == 'inferior') {

            $fechaFin2 = explode("/", $fechaFin);
            $año = $fechaFin2[0];
            $mes = $fechaFin2[1];
            $dia = $fechaFin2[2];
            $fechaFinText = $utilidades->fechatextual($dia, $mes, $año);
        }

        if ($resulConsulta != null) {

            if ($logo == 'sin') {

                $imgsrc = "";
            }

            if ($logo == 'con') {

                if ($empInt == 1) {
                    $imgsrc = "../../libs/imagenes/logos/logo_head1.JPG";
                }

                if ($empInt == 2) {
                    $imgsrc = "../../libs/imagenes/logos/Logo_Tercerizar.png";
                }

                if ($empInt == 3) {
                    $imgsrc = "../../libs/imagenes/logos/logo-vm.png";
                }
            }

            if ($tipContra == 'obraTipo1') {

                $titulo = utf8_decode("QUE DURE LA REALIZACIÓN DE LA OBRA O LABOR CONTRATADA");
                $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.Obligaciones:El Empleador contrata los servicios  personales del Trabajador y éste se obliga:   a) A poner al servicio del Empleador toda su capacidad normal de  trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio  mencionado y en las labores anexas y complementarias del mismo, de conformidad  con las órdenes e instrucciones que le imparta El Empleador o sus  representantes,  b) Cumplir con sus  obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades  del servicio.- c) Observar rigurosamente la disciplina interna establecida por  el empleador y las persona autorizadas por ella.- d) A no prestar directa ni  indirectamente servicios laborales a otros Empleadores, ni a trabajar por  cuenta propia en el mismo oficio, durante la vigencia de este contrato, so pena  de recibir sanciones disciplinarias y legales que la norma laboral faculta al  empleador.- e) Informar al empleador oportunamente y por escrito, el cambio de  su domicilio que será el lugar donde recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar  la jornada ordinaria, en los turnos y dentro de las horas señaladas por el  empleador o sus representantes, pudiendo hacer éstos los ajustes o cambios de  horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las  partes, podrán repartirse las horas de la jornada ordinaria, en la forma  prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de  descanso entre las secciones de la jornada, no se computan dentro de la misma,  según el articulo 167 ibidem. g) Cuidar permanentemente los intereses del  empleador y la empresa cliente. h) Programar diariamente su trabajo y asistir  puntualmente a las reuniones que efectúe   el empleador o la empresa cliente a las cuales hubiere sido citado. i).  Observar completa armonía y comprensión con los clientes, con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador y la empresa cliente. k) A presentar  dentro&nbsp; de las 48 horas siguiente ante el empleador, la justificación de  su ausencia al puesto de trabajo causado por la incapacidad medica,  certificada&nbsp; por el medico adscrito a la EPS donde se encuentre afiliado. l) Velar por el  cuidado de las instalaciones de la Empresa Usuaria, así como también los equipos,  muebles, enseres y demás elementos entregados para el cumplimiento de sus  funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los planes  de trabajo que se indique por parte de Listos S.A. o de la Empresa Usuaria,  bien sea por escrito o por recomendaciones verbales.- n).- Las demás funciones  que se le indiquen oportunamente.Segunda.—Duración.- El presente contrato tendrá  como duración el tiempo que dure la  realización de la obra o labor contratada arriba señalada, la cual durara por el tiempo  estrictamente necesario solicitado al Empleador   por la Empresa   Usuaria. En consecuencia, este contrato termina en el momento  en que la Empresa   Usuaria comunique al Empleador que ha dejado de requerir los  servicios de El Trabajador sin que el Empleador tenga que reconocerle  indemnización alguna. Tercera.- Período de prueba Los primeros sesenta días de vigencia  del presente contrato se consideran como período de prueba y, por consiguiente,  cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier  momento durante dicho período. Vencido éste, la duración del contrato será por  el tiempo que dure la realización de la obra o labor contratada  arriba señalada, es decir mientras subsistan  las causas que le dieron origen y la materia del trabajo.- Cuarta.- Incorporación  de disposiciones.- Las partes declaran que en el presente contrato  se entienden incorporadas, en lo pertinente, las disposiciones legales que  regulan las relaciones entre la empresa y sus trabajadores, en especial, las  del contrato de trabajo para el oficio que se suscribe, y  las obligaciones consignadas en los  reglamentos de trabajo y de higiene y seguridad industrial del empleador y de la Empresa Usuaria, disposiciones  que manifiesta conocer y se compromete a acatar. Quinta.-  Remuneración. El Empleador pagará al Trabajador por la prestación  de sus servicios bajo la modalidad arriba citada, la cual será  pagadera en las oportunidades que se indican  en el encabezamiento de este contrato. Dentro de este pago se encuentra  incluida la remuneración de los descansos dominicales y festivos de que tratan  los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se  aclara y se conviene que en los casos en los que El Trabajador llegare a  devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5%  de dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está  destinado a remunerar el descanso en los días dominicales y festivos de que  tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.-Sexta.-No constituye salario.— En  atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo,  modificado por el artículo 15 de la   Ley 50 de 1990, las partes en el presente contrato convienen  de manera expresa que no constituyen salario las sumas en dinero o en especie  que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el  futuro adicional a su salario ordinario, el trabajador del empleador o de la  empresa cliente, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador o de la empresa cliente, tales como la  alimentación, habitación o vestuario, las primas extralegales, de vacaciones,  de servicios o de navidad. Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima. Trabajo suplementario: —Todo trabajo suplementario o en horas extras y todo trabajo en día  domingo o festivo en los que legalmente debe concederse descanso, se remunerará  conforme a la ley, así como los correspondientes recargos nocturnos. Para el  reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo previamente por escrito.  Cuando la necesidad de este trabajo se presente de manera imprevista o  inaplazable, deberá ejecutarse y darse cuenta de él por escrito, a la mayor  brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia,  no reconocerá ningún trabajo suplementario o en días de descanso legalmente  obligatorio que no haya sido autorizado previamente o avisado inmediatamente,  como queda dicho. Octava. — Jornada: El Trabajador se obliga a laborar la  jornada ordinaria en los turnos y dentro de las horas señaladas por El  Empleador o por la empresa cliente, pudiendo hacer éstos ajustes o cambios de  horario cuando lo estime conveniente. Conforme a lo indicado en el articulo 25  de la Ley 789 de  2.002, modificatorio del articulo 160 del C.S.T., el trabajo ordinario será el  que se realiza entre las 6 Horas (6   A.M.) y las 22 horas (10 P.M.) y el trabajo nocturno es  el comprendido entre las 22 Horas (10 P.M.) y las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo  segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena— Justa Causa.- Son justas causas  para dar por terminado unilateralmente este contrato por cualquiera de las  partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además,  por parte del Empleador, el incumplimiento de las obligaciones señaladas en la  cláusula primera de este contrato, al igual que las faltas que para el efecto  se califiquen como graves en el espacio reservado para cláusulas adicionales en  el presente contrato. Décima. Traslado de lugar.-.Las partes podrán convenir que  el trabajo se preste en lugar distinto del inicialmente contratado, siempre que  tales traslados no desmejoren las condiciones laborales o de remuneración del  Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el  traslado serán cubiertos por El Empleador de conformidad con el numeral 8º del  artículo 57 del Código Sustantivo del Trabajo. El Trabajador se obliga a  aceptar los cambios de oficio que decida El Empleador dentro de su poder  subordinante, siempre que se respeten las condiciones laborales del Trabajador  y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad  y los derechos mínimos del Trabajador, de conformidad con el artículo 23 del  Código Sustantivo del Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. décima  Primero. Buena  fe Contractual—Este contrato ha sido redactado estrictamente de  acuerdo con la ley y la jurisprudencia y será interpretado de buena fe y en  consonancia con el Código Sustantivo del Trabajo, cuyo objeto, definido en su  artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores  dentro de un espíritu de coordinación económica y equilibrio social. Duodécima.Cláusula Arbitral:  Teniendo como sustento la convención colectiva suscrita por el empleador con  sus trabajadores y el articulo 51 de la   Ley 712 del 2.001, modificatoria del articulo 131 del Código  Procesal del Trabajo, las partes determinan de común acuerdo que las  Controversias que se presenten, relativas a conflictos jurídicos laborales,  jurídicos económicos del trabajo, reconocimiento de derechos inciertos y discutibles,  relativos a: salarios, prestaciones sociales, descansos, pagos indemnizatorios,  sanciones,  pagos  no saláriales,  derivados de este contrato, y que resultaren  sobre la naturaleza e interpretación del presente contrato se resolverá  por un tribunal de arbitramento, conformado  por tres (3) árbitros que deberán ser abogados, designados por la cámara de  comercio del lugar donde se desarrollo el contrato, el cual se sujetara a los  dispuesto por el decreto 2279 de 1.989; ley 23 de 1.991; Decreto 2651 de 1.991,  y demás normas que lo modifiquen o reglamenten, y su fallo, en derecho,  obligara a las partes. Décima Tercera-. Confidencialidad.  Las partes aquí intervinientes han acordado proteger la información  confidencial suministrada y/o compartida entre las partes derivadas del  presente contrato, y como tal, no debe darse a conocer a ninguna persona ajena  al presente acuerdo. Por Información  Confidencial; se entenderá aquella información relativa al negocio  cualquiera de los intervinientes en este contrato y/o cualquier comunicación  oral o escrita, que otorgue una ventaja competitiva en caso de conocimiento por  terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación.");
            }
            
             if ($tipContra == 'obraTipo2') {

                $titulo = utf8_decode("QUE DURE LA REALIZACIÓN DE LA OBRA O LABOR CONTRATADA");
                $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha celebrado el presente contrato individual de trabajo, regido además por las siguientes cláusulas: PRIMERA.—OBLIGACIONES: El Empleador contrata los servicios personales del Trabajador y éste se obliga: a) A poner al servicio del Empleador toda su capacidad normal de trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio mencionado y en las labores anexas y complementarias del mismo, de conformidad con las órdenes e instrucciones que le imparta El Empleador o sus representantes, b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades del servicio.c) Observar rigurosamente la disciplina interna establecida por el empleador y las persona autorizadas por ella.d) A no prestar directa ni indirectamente servicios laborales a otros Empleadores, ni a trabajar por cuenta propia en elmismo oficio, durante la vigencia de este contrato, so pena de recibir sanciones disciplinarias y legales que la norma laboral faculta al empleador.e) Informar al empleador oportunamente y por escrito, el cambio de su domicilio que será el lugar donde recibirá las notificaciones de que habla la Ley 789 de 2.002.f) Laborar la jornada ordinaria, en los turnos y dentro de las horas señaladas por el empleador o sus representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán repartirse las horas de la jornada ordinaria, en la forma prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada, no se computan dentro de la misma, según el articulo 167 ibidem. g) Cuidar permanentemente los intereses del empleador. h) Programar diariamente su trabajo y asistir puntualmente a las reuniones que efectúe el empleador a las cuales hubiere sido citado. i). —Observar completa armonía y comprensión con sus superiores y compañeros de trabajo, en sus relaciones personales y en la ejecución de su labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y disciplina con el empleador. k) A presentar dentro de las 48 horas siguientes ante el empleador, la justificación de su ausencia al puesto de trabajo causado por la incapacidad medica, certificada por el medico adscrito a la EPS donde se encuentre afiliado. l) Velar por el cuidado de las instalaciones de el empleador, así como también los equipos, muebles, enseres y demás elementos entregados para el cumplimiento de sus funciones, con el fin de evitar daños y extravíos.m). Cumplir con los planes de trabajo que se indique por parte de el empleador, bien sea por escrito o por recomendaciones verbales.n). Las demás funciones que se le indiquen oportunamente.SEGUNDA DURACIÓN.El presente contrato tendrá como duración el tiempo que dure la realización de la obra o labor contratada arriba señalada, la cual durara por el tiempo estrictamente necesario para cumplir con la obra que le determine el empleador. Por consecuencia, este contrato termina en el momento en que el empleador comunique al Trabajador que la obra terminó, sin que el Empleador tenga que reconocerle indemnización alguna. TERCERA.PERÍODO DE PRUEBA Los primeros sesenta días de vigencia del presente contrato se consideran como período de prueba y, por consiguiente, cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier momento durante dicho período. Vencido éste, la duración del contrato será por el tiempo que dure la realización de la obra o labor contratada arriba señalada, es decir mientras subsistan las causas que le dieron origen y la materia del trabajo.CUARTA. INCORPORACIÓN DE DISPOSICIONES.Las partes declaran que en el presente contrato se entienden incorporadas, en lo pertinente, las disposiciones legales que regulan las relaciones entre el empleador y sus trabajadores, en especial, las del contrato de trabajo para el oficio que se suscribe, y las obligaciones consignadas en los reglamentos de trabajo y de higiene y seguridad industrial del empleador, disposiciones que manifiesta conocer y se compromete a acatar. QUINTA. .REMUNERACIÓN. El Empleador pagará al Trabajador por la prestación de sus servicios bajo la modalidad arriba citada, la cual será pagadera en las oportunidades que se indican en el encabezamiento de este contrato. Dentro de este pago se encuentra incluida la remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se aclara y se conviene que en los casos en los que El Trabajador llegare a devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5% de dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está destinado a remunerar el descanso en los días dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.SEXTA. NO CONSTITUYE SALARIO.— En atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo, modificado por el artículo 15 de la Ley 50 de 1990, las partes en el presente contrato convienen de manera expresa que no constituyen salario las sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el futuro adicional a su salario ordinario, el trabajador del empleador, como propinas, primas, bonificaciones o gratificaciones ocasionales, participación de utilidades, y lo que recibe en dinero o en especie no para su beneficio como ayudas o auxilios habituales u ocasionales, tales como alimentación, o vestuario, bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del contrato de trabajo, ni aquellos que se hacen, no para enriquecer su patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de representación, medios de transporte, elementos de trabajo y otros semejantes. Tampoco constituyen salario las prestaciones sociales de que tratan los títulos VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios habituales u ocasionales acordados convencional o contractualmente u otorgados en forma extralegal por el empleador, tales como la alimentación, habitación o vestuario, las primas extralegales, de vacaciones, de servicios o de navidad. Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos aquí señalados, que no constituyen salario no hacen parte de la base para liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA, Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a la seguridad social establecidas por la Ley 100 de 1993.SÉPTIMA. TRABAJO SUPLEMENTARIO: —Todo trabajo suplementario o en horas extras y todo trabajo en día domingo o festivo en los que legalmente debe concederse descanso, se remunerará conforme a la ley, así como los correspondientes recargos nocturnos. Para el reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo previamente por escrito. Cuando la necesidad de este trabajo se presente de manera imprevista o inaplazable, deberá ejecutarse y darse cuenta de él por escrito, a la menor brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia, no reconocerá ningún trabajo suplementario o en días de descanso legalmente obligatorio que no haya sido autorizado previamente o avisado inmediatamente, como queda dicho. OCTAVA. — JORNADA: El Trabajador se obliga a laborar la jornada ordinaria en los turnos y dentro de las horas señaladas por El Empleador, pudiendo hacer éstos ajustes o cambios de horario cuando lo estime conveniente. Conforme a lo indicado en el articulo 25 de la Ley 789 de 2.002, modificatorio del articulo 160 del C.S.T., el trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 22 horas (10 P.M.) y el trabajo nocturno es el comprendido entre las 22 Horas (10 P.M.) y las 6 Horas (6 A.M.). Parágrafo Primero: Conforme lo indicado por la Ley Laboral, el empleador y el trabajador podrán acordar temporal o indefinidamente la organización de turnos de trabajo sucesivos que permitan operar a el empleador o secciones de la misma sin solución de continuidad durante todos los días de la semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo segundo: El empleador y el trabajador, podrán acordar que la jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un día de descanso obligatorio, que podrá coincidir con el domingo. En este, el numero de horas de trabajo diario podrá repartirse de manera variable durante la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario, cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. NOVENA— JUSTA CAUSA.Son justas causas para dar por terminado unilateralmente este contrato por cualquiera de las partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además, por parte del Empleador, el incumplimiento de las obligaciones señaladas en la cláusula primera de este contrato, al igual que las faltas que para el efecto se califiquen como graves en el espacio reservado para cláusulas adicionales en el presente contrato. DÉCIMA. TRASLADO DE LUGAR.—. Las partes podrán convenir que el trabajo se preste en lugar distinto del inicialmente contratado, siempre que tales traslados no desmejoren las condiciones laborales o de remuneración del Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el traslado serán cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del Código Sustantivo del Trabajo. El Trabajador se obliga a aceptar los cambios de oficio que decida El Empleador dentro de su poder subordinante, siempre que se respeten las condiciones laborales del Trabajador y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad y los derechos mínimos del Trabajador, de conformidad con el artículo 23 del Código Sustantivo del Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. DÉCIMA PRIMERA. Buena fe Contractual—Este contrato ha sido redactado estrictamente de acuerdo con la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con el Código Sustantivo del Trabajo, cuyo objeto, definido en su artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de un espíritu de coordinación económica y equilibrio social. DUODÉCIMA.— CLAUSULA ARBITRALl: Teniendo como sustento la convención colectiva suscrita por el empleador con sus trabajadores y el articulo 51 de la Ley 712 del 2.001, modificatoria del articulo 131 del Código Procesal del Trabajo, las partes determinan de común acuerdo que las Controversias que se presenten, relativas a conflictos jurídicos laborales, jurídicos económicos del trabajo, reconocimiento de derechos inciertos y discutibles, relativos a: salarios, prestaciones sociales, descansos, pagos indemnizatorios, sanciones, pagos no saláriales, derivados de este contrato, y que resultaren sobre la naturaleza e interpretación del presente contrato se resolverá por un tribunal de arbitramento, conformado por tres (3) árbitros que deberán ser abogados, designados por la cámara de comercio del lugar donde se desarrolló el contrato, el cual se sujetara a lo dispuesto por el decreto 2279 de 1.989; ley 23 de 1.991; Decreto 2651 de 1.991, y demás normas que lo modifiquen o reglamenten, y su fallo, en derecho, obligara a las partes. DÉCIMA TERCERA. CONFIDENCIALIDAD. Las partes aquí intervinientes han acordado proteger la informacion confidencial suministrada y/o compartida entre las partes derivadas del presente contrato, y como tal, no debe darse a conocer a ninguna persona ajena al presente acuerdo. Por Información Confidencial se entenderá aquella información relativa al negocio cualquiera de los intervinientes en este contrato y/o cualquier comunicación oral o escrita, que otorgue una ventaja competitiva en caso de conocimiento por terceras personas ajenas a este acuerdo.DÉCIMA CUARTA: DEDUCCIONES. Cuando por causa emanada directa o indirectamente de la relación contractual existan obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en cualquier tiempo y, más concretamente, a la terminación del presente contrato, así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las partes que la presente autorización cumple las condiciones de orden escrita previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del mismo tenor y valor, en la ciudad y fecha que se indican a continuacion");
            }

            if ($tipContra == 'inferior') {

                $titulo = utf8_decode("CONTRATO A TÉRMINO FIJO INFERIOR A UN AÑO");
                $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.—Obligaciones: El Empleador contrata los  servicios personales del Trabajador y éste se obliga:  a) A poner al servicio del Empleador toda su  capacidad normal de trabajo, en forma exclusiva en el desempeño de las  funciones propias del oficio mencionado y en las labores anexas y  complementarias del mismo, de conformidad con las órdenes e instrucciones que  le imparta El Empleador o sus representantes,   b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el  lugar tiempo y necesidades del servicio.- c) Observar rigurosamente la  disciplina interna establecida por el empleador y las persona autorizadas por  ella.- d) A no prestar directa ni indirectamente servicios laborales a otros  Empleadores, ni a trabajar por cuenta propia en el mismo oficio, durante la  vigencia de este contrato, so pena de recibir sanciones disciplinarias y  legales que la norma laboral faculta al empleador.- e) Informar al empleador  oportunamente y por escrito, el cambio de su domicilio que será el lugar donde  recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar la jornada  ordinaria, en los turnos y dentro de las horas señaladas por el empleador o sus  representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando  lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán  repartirse las horas de la jornada ordinaria, en la forma prevista en el  articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre  las secciones de la jornada, no se computan dentro de la misma, según el  articulo 167 ibidem. g) Cuidar permanentemente los intereses del empleador. h)  Programar diariamente su trabajo y asistir puntualmente a las reuniones que  efectúe  el empleador a las cuales hubiere  sido citado. i). —Observar completa armonía y comprensión con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador. k) A presentar dentro&nbsp; de las 48 horas siguientes ante el  empleador, la justificación de su ausencia al puesto de trabajo causado por la  incapacidad medica, certificada&nbsp; por el medico adscrito a la EPS donde se encuentre  afiliado. l) Velar por el cuidado de las instalaciones de la Empresa, así como también  los equipos, muebles, enseres y demás elementos entregados para el cumplimiento  de sus funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los  planes de trabajo que se le indique, bien sea por escrito o por recomendaciones  verbales.- n).- Las demás funciones que se le indiquen oportunamente.-Segunda. Termino  inicial del contrato: La vigencia del presente contrato será hasta el " . $fechaFinText . " . Si antes de la fecha de vencimiento del término  estipulado, ninguna de las partes avisare por escrito a la otra su  determinación de no prorrogar el presente contrato con una antelación no  inferior a treinta (30) días calendario, este se entenderá renovado por un periodo  igual al inicialmente pactado y así sucesivamente. Este contrato podrá  prorrogarse hasta por tres (3) periodos iguales o inferiores, al cabo de los  cuales el término de renovación será de un año, y así sucesivamente, de acuerdo  con lo previsto en el articulo 46 de la Ley 50 de 1.990.- Tercera—Período de prueba.-Los primeros (2) dos meses del presente contrato se consideran como período de prueba y, por  consiguiente, cualquiera de las partes podrá terminar el contrato  unilateralmente, en cualquier momento durante dicho período. Vencido éste, la duración del contrato  será indefinida, mientras subsistan las causas que le dieron origen y la materia del trabajo.-Cuarta.- Incorporación de disposiciones.-Las partes declaran que en el  presente contrato se entienden incorporadas, en lo pertinente, las  disposiciones legales que regulan las relaciones entre la empresa y sus  trabajadores, en especial, las del contrato de trabajo para el oficio que se  suscribe, y  las obligaciones consignadas  en los reglamentos de trabajo y de higiene y seguridad industrial del  empleador, disposiciones que manifiesta conocer y se compromete a acatar. Quinta.- Remuneración.-El Empleador pagará al Trabajador por la  prestación de sus servicios bajo la modalidad arriba citada, la cual  será  pagadera en las oportunidades que  se indican en el encabezamiento de este contrato. Dentro de este pago se  encuentra incluida la remuneración de los descansos dominicales y festivos de  que tratan los capítulos I y II del título VII del Código Sustantivo del  Trabajo. Se aclara y se conviene que en los casos en los que El Trabajador  llegare a devengar comisiones o cualquiera otra modalidad de salario variable,  el 82.5% de dichos ingresos, constituye remuneración ordinaria, y el 17.5%  restante está destinado a remunerar el descanso en los días dominicales y  festivos de que tratan los capítulos I y II del título VII del Código  Sustantivo del Trabajo.-.-Sexta: No  constituye salario.— En atención a lo ordenado por el artículo 128 del  Código Sustantivo del Trabajo, modificado por el artículo 15 de la Ley 50 de 1990, las partes en  el presente contrato convienen de manera expresa que no constituyen salario las  sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o  llegue a recibir en el futuro adicional a su salario ordinario, el trabajador  del empleador, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador, tales como la alimentación, habitación o  vestuario, las primas extralegales, de vacaciones, de servicios o de navidad.  Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima.  Trabajo suplementario:—Todo trabajo suplementario o en horas extras y todo  trabajo en día domingo o festivo en los que legalmente debe concederse  descanso, se remunerará conforme a la ley, así como los correspondientes  recargos nocturnos. Para el reconocimiento y pago del trabajo suplementario,  dominical o festivo El Empleador o sus representantes deben autorizarlo  previamente por escrito. Cuando la necesidad de este trabajo se presente de  manera imprevista o inaplazable, deberá ejecutarse y darse cuenta de él por  escrito, a la mayor brevedad, al Empleador o a sus representantes. El Empleador,  en consecuencia, no reconocerá ningún trabajo suplementario o en días de  descanso legalmente obligatorio que no haya sido autorizado previamente o  avisado inmediatamente, como queda dicho. Octava.  — Jornada: El Trabajador se obliga a laborar la jornada ordinaria en los  turnos y dentro de las horas señaladas por El Empleador, pudiendo hacer éstos  ajustes o cambios de horario cuando lo estime conveniente. Conforme a lo  indicado en el articulo 25 de la   Ley 789 de 2.002, modificatorio del articulo 160 del C.S.T.,  el trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 22 horas (10  P.M.) y el trabajo nocturno es el comprendido entre las 22 Horas (10 P.M.) y  las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena- Justa Causa.- Son justas  causas para dar por terminado unilateralmente este contrato por cualquiera de  las partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y,  además, por parte del Empleador, el incumplimiento de las obligaciones señaladas  en la cláusula primera de este contrato, al igual que las faltas que para el  efecto se califiquen como graves en el espacio reservado para cláusulas  adicionales en el presente contrato. Décima.  Traslado de lugar.-.Las partes podrán convenir que el trabajo se preste  en lugar distinto del inicialmente contratado, siempre que tales traslados no  desmejoren las condiciones laborales o de remuneración del Trabajador, o  impliquen perjuicios para él. Los gastos que se originen con el traslado serán  cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del  Código Sustantivo del Trabajo. El Trabajador se obliga a aceptar los cambios de  oficio que decida El Empleador dentro de su poder subordinante, siempre que se  respeten las condiciones laborales del Trabajador y no se le causen perjuicios.  Todo ello sin que se afecte el honor, la dignidad y los derechos mínimos del  Trabajador, de conformidad con el artículo 23 del Código Sustantivo del  Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. Décima primera.Buena  fe Contractual Este contrato ha sido redactado estrictamente de acuerdo con  la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con  el Código Sustantivo del Trabajo, cuyo objeto, definido en su artículo 1º, es  lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de  un espíritu de coordinación económica y equilibrio social. Duodécima.—Cláusula  Arbitral: Teniendo como sustento la convención colectiva suscrita por el  empleador con sus trabajadores y el articulo 51 de la Ley 712 del 2.001,  modificatoria del articulo 131 del Código Procesal del Trabajo, las partes  determinan de común acuerdo que las Controversias que se presenten, relativas a  conflictos jurídicos laborales, jurídicos económicos del trabajo,  reconocimiento de derechos inciertos y discutibles, relativos a: salarios,  prestaciones sociales, descansos, pagos indemnizatorios, sanciones,  pagos   no saláriales,  derivados de este  contrato, y que resultaren sobre la naturaleza e interpretación del presente  contrato se resolverá  por un tribunal de  arbitramento, conformado por tres (3) árbitros que deberán ser abogados,  designados por la cámara de comercio del lugar donde se desarrollo el contrato,  el cual se sujetara a los dispuesto por el decreto 2279 de 1.989; ley 23 de  1.991; Decreto 2651 de 1.991, y demás normas que lo modifiquen o reglamenten, y  su fallo, en derecho, obligara a las partes. Décima  tercera -.  Confidencialidad-. Las partes aquí intervinientes han acordado  proteger la información confidencial suministrada y/o compartida entre las  partes derivadas del presente contrato, y como tal, no debe darse a conocer a  ninguna persona ajena al presente acuerdo. Por &quot;Información Confidencial; se entenderá aquella información relativa  al negocio cualquiera de los intervinientes en este contrato y/o cualquier  comunicación oral o escrita, que otorgue una ventaja competitiva en caso de  conocimiento por terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación. ");
            }

            foreach ($resulConsulta as $valor) {
                
                $perSal = $valor['TIP_REMU'];
                
                  switch ($perSal){
                      
                        case 'P':
                            $perSalAux = 1;
                            break;
                        case 'M':
                            $perSalAux = 2;
                            break;
                        case 'H':
                            $perSalAux = 3;
                            break;
                        case 'C':
                           $perSalAux = 4;
                            break;
                    }  
                
                $ideUser = $valor['cod_empl'];
                    
                $consultaLogContrato = $this->consultarLogContrato($req, $ideUser, $empInt);

                if ($consultaLogContrato == null) {

                    $resulRegLog = $this->registrarLogContrato($req, $ideUser, $idUserCreo, $empInt, $perSalAux, $tipContra, $logo, $fechaFin);
                    $nuevoReg = true;
                    
                }else{
                    
                    $resulUpdateLog = $this->actualizarLogContrato($req, $ideUser, $empInt,$tipContra,$fechaFin,$idUserCreo);                   
                    $actualizacion = true;
                }

                if ($resulRegLog == null) {
                    
                    $flgError = true;
                    
                }
                
                 if ($resulUpdateLog == null) {
                    
                    $flgError = true;
                    
                }

                if ($flgError == false) {
                    
                    if($nuevoReg == true){                    
                        
                        $idContrato = $gestionDatos->consultarSeqLogContrato();                    
                    
                    
                    }else if($actualizacion == true){
                        
                        $idContrato = $consultaLogContrato;                   
                        
                    }

                    $idUser = $valor['cod_empl'];
                    $municipio = $gestionDatos->consultarMunicipio($empInt, $req, $idUser);
                    $mpiCont = $valor['MPI_CONT'];
                    $datosSuc = $gestionDatos->consultarSucursal($mpiCont);

                    $deptoNaci = $gestionDatos->consultaMpio($valor['pai_naci'], $valor['dto_naci']);
                    $ciudadNaci = $gestionDatos->consultaMpio($valor['pai_naci'], $valor['dto_naci'], $valor['mpi_naci']);

                    $deptoResi = $gestionDatos->consultaMpio($valor['pai_resi'], $valor['dto_resi']);
                    $ciudadResi = $gestionDatos->consultaMpio($valor['pai_resi'], $valor['dto_resi'], $valor['mpi_resi']);

                    $pdf->AddPage();
                    $fecha = date('d-m-Y');
                    $pdf->SetFont('Times', 'B', 8);

                    if ($logo != '' && $logo != 'sin') {

                        if ($empInt == 3) {

                            $pdf->Image($imgsrc, 10, 8, 15);
                            
                        } else {

                            $pdf->Image($imgsrc, 10, 8, 33);
                        }
                    }

                    if ($tipContra == 'obraTipo1' || $tipContra == 'obraTipo2') {
                        $pdf->Cell(170, 10, 'CONTRATO DE TRABAJO POR EL TIEMPO', 0, 0, 'C');
                    }

                    $pdf->Ln(5);
                    $pdf->Cell(178, 10, ' ' . $titulo . ' ', 0, 0, 'C');
                    $pdf->Cell(0, 10, '# Contrato:' . $idContrato . ' ', 0, 0, 'L');

                    $pdf->Ln(5);
                    $pdf->Cell(0, 10,'Nit: '. $valor['nit_empr'], 0, 0, 'L');

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Nombre del Empleador:', 0, 0, 'L');
                    $pdf->Cell(50, 10, $valor['nom_empr'], 0, 0, 'L'); // corregir
                    $pdf->Cell(50, 10, 'NIT del Empleador:', 0, 0, 'L');
                    $pdf->Cell(50, 10, $valor['nit_empr'], 0, 0, 'L');

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Domicilio del Empleador:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . $datosSuc[0]['suc_direccion'] . ' ', 0, 0, 'L');
                    $pdf->Cell(50, 10, 'Ciudad:', 0, 0, 'L');
                    $pdf->Cell(50, 10, '' . $datosSuc[0]['suc_nombre'] . ' ', 0, 0, 'L');

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Telefono:', 0, 0, 'L');
                    $pdf->Cell(50, 10, '' . $datosSuc[0]['suc_telefono'] . '', 0, 0, 'L');

                    $pdf->Ln(5);

                    $pdf->Cell(50, 10, 'Nombre del trabajador:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . ' ', 0, 0, 'L');

                    $pdf->Ln(5);

                    $pdf->Cell(50, 10, 'Identificacion:', 0, 0, 'L');
                    //$pdf->MultiCell(70, 7, ' ' . trim($valor['cod_empl']) . ' de ' . trim($municipio) . ' ');
                    $pdf->Cell(50, 10, ' ' . trim($valor['cod_empl']) . ' de ' . trim($municipio) . ' ', 0, 0, 'L');
                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Libreta militar:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . trim($valor['num_lmil']) . " Dto " . trim($valor['dis_lmil']) . ' ', 0, 0, 'L');

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Lugar y fecha de nacimiento:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . trim(substr($valor['fec_naci'], 8, 2)) . "/" . trim(substr($valor['fec_naci'], 5, 2)) . "/" . trim(substr($valor['fec_naci'], 0, 4)) . "  " . trim($deptoNaci) . " " . trim($ciudadNaci) . ' ', 0, 0, 'L');

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Direccion del Trabajador:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . trim($valor['dir_resi']) . " " . trim($valor['bar_resi']) . ' ', 0, 0, 'L');
                    $pdf->Ln(5);

                    $pdf->Cell(50, 10, 'Ciudad:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . trim($deptoResi) . "  " . trim($ciudadResi) . ' ', 0, 0, 'L');
                    $pdf->Ln(5);

                    $pdf->Cell(50, 10, 'Telefono:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . $valor['tel_resi'] . ' ', 0, 0, 'L');

                    $pdf->Ln(5);

                    $pdf->Cell(50, 10, 'Afiliacion:', 0, 0, 'L');
                    $pdf->Cell(50, 10, 'Axa Colpatria', 0, 0, 'L');

                    $codigoAfp = $valor['COD_EAFP'];
                    $codigoEps = $valor['COD_EEPS'];

                    $nomAfp = $gestionDatos->consultaSeguridadSocial($empInt, $codigoAfp, "AFP");
                    $nomEps = $gestionDatos->consultaSeguridadSocial($empInt, $codigoEps, "EPS");

                    $pdf->Cell(50, 8, 'AFP: ' . trim($nomAfp) . ' ', 0, 0, 'L');

                    //$pdf->Cell(50, 10, 'EPS: ' . trim($nomEps) . ' ', 0, 0, 'L');                    
                    //$pdf->MultiCell(50,10, 'AFP: ' . trim($nomAfp) . ' ',0,'L');
                    //$pdf->MultiCell(0,3, 'EPS: ' . trim($nomEps) . ' ',0);         

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, '', 0, 0, 'L');
                    $pdf->Cell(50, 10, 'EPS: ' . trim($nomEps) . ' ', 0, 0, 'L');
                    $pdf->Ln(5);
                    
                    if ($tipContra == 'obraTipo1') {
                        
                        $pdf->Cell(50, 10, 'Empresa usuaria:', 0, 0, 'L');
                        $pdf->Cell(50, 10, ' ' . $valor['NOM_CLIE'] . ' ', 0, 0, 'L');
                        
                    }                 

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Labor Contratada:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . $valor['nom_carg'] . ' ', 0, 0, 'L');

//                    if ($tipContra == 'inferior') {
//
//                        $fechaFin2 = explode("/", $fechaFin);
//                        $año = $fechaFin2[0];
//                        $mes = $fechaFin2[1];
//                        $dia = $fechaFin2[2];
//                        $fechaFinText = $utilidades->fechatextual($dia, $mes, $año);
//                    }

                    $fechaIn = $valor['FEC_INGL'];
                    //$fechaIni = strtotime($fecha);
                    $fechaIni = explode("-", $fechaIn);

                    $anoIni = $fechaIni[0];
                    $mesIni = $fechaIni[1];
                    $diaIni = substr($fechaIni[2], 0, 2);

                    $fechaIniText = $utilidades->fechatextual($diaIni, $mesIni, $anoIni);

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Fecha inicio:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' ' . $fechaIniText . ' ', 0, 0, 'L');

                    $salario = explode(".", number_format($valor['SAL_CONT']), 4);

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Salario:', 0, 0, 'L');
                    $pdf->Cell(50, 10, ' $' . $salario[0] . trim(".") . ' ' . trim($salario[1]) . ' ', 0, 0, 'L');                   
                  
                    
                    switch ($perSal) {
                        case 'P':
                            $pdf->Cell(50, 10, 'Periocidad de pago: Parcial', 0, 0, 'L');
                            break;
                        case 'M':
                            $pdf->Cell(50, 10, 'Periocidad de pago: Medio tiempo', 0, 0, 'L');
                            break;
                        case 'H':
                            $pdf->Cell(50, 10, 'Periocidad de pago: Hora', 0, 0, 'L');
                            break;
                        case 'C':
                            $pdf->Cell(50, 10, 'Periocidad de pago: Completo', 0, 0, 'L');
                            break;
                    }                   
                    

//                    if ($perSal == 'hora') {
//
//                        $pdf->Cell(50, 10, 'Hora(X)', 0, 0, 'L');
//                    }
//
//                    if ($perSal == 'diario') {
//
//                        $pdf->Cell(50, 10, 'Diario(X)', 0, 0, 'L');
//                    }
//
//                    if ($perSal == 'mensual') {
//
//                        $pdf->Cell(50, 10, 'Mes(X)', 0, 0, 'L');
//                    }

                    $pdf->Ln(5);
                    $pdf->Cell(50, 10, 'Adicionales:', 0, 0, 'L');
                    //$pdf->Cell(50, 10, '' . $adicionales . ' ', 0, 0, 'L');
                     $pdf->Ln(8);
                    $pdf->MultiCell(0, 4, utf8_decode($adicionales));
                    //$pdf->Ln(3);
                    $pdf->Cell(50, 10, 'Periodos de pagos:', 0, 0, 'L');

                    if ($valor['COD_GPRO'] == 23 || $valor['COD_GPRO'] == 36 || $valor['COD_GPRO'] == 12 || $valor['COD_GPRO'] == 24 || $valor['COD_GPRO'] == 37 || $valor['COD_GPRO'] == 21 || $valor['COD_GPRO'] == 28 || $valor['COD_GPRO'] == 22 || $valor['COD_GPRO'] == 33) {

                        $pdf->Cell(50, 10, 'Semanal (X)', 0, 0, 'L');
                    }

                    if ($valor['COD_GPRO'] == 2 || $valor['COD_GPRO'] == 13) {

                        $pdf->Cell(50, 10, 'Decadal (X)', 0, 0, 'L');
                    }

                    if ($valor['COD_GPRO'] == 5 or $valor['COD_GPRO'] == 4 or $valor['COD_GPRO'] == 16 or $valor['COD_GPRO'] == 29 or $valor['COD_GPRO'] == 34 or $valor['COD_GPRO'] == 44 or $valor['COD_GPRO'] == 8 or $valor['COD_GPRO'] == 19 or $valor['COD_GPRO'] == 30 or $valor['COD_GPRO'] == 35 or $valor['COD_GPRO'] == 48 or $valor['COD_GPRO'] == 9 or $valor['COD_GPRO'] == 20 or $valor['COD_GPRO'] == 31 or $valor['COD_GPRO'] == 42 or $valor['COD_GPRO'] == 15 or $valor['COD_GPRO'] == 25 or $valor['COD_GPRO'] == 32 or $valor['COD_GPRO'] == 43) {

                        $pdf->Cell(50, 10, 'Quincenal (X)', 0, 0, 'L');
                    }

                    if ($valor['COD_GPRO'] == 11 or $valor['COD_GPRO'] == 27 or $valor['COD_GPRO'] == 41 or $valor['COD_GPRO'] == 6 or $valor['COD_GPRO'] == 17 or $valor['COD_GPRO'] == 38 or $valor['COD_GPRO'] == 46 or $valor['COD_GPRO'] == 7 or $valor['COD_GPRO'] == 18 or $valor['COD_GPRO'] == 39 or $valor['COD_GPRO'] == 10 or $valor['COD_GPRO'] == 26 or $valor['COD_GPRO'] == 40) {

                        $pdf->Cell(50, 10, 'Mensual (X)', 0, 0, 'L');
                    }

                    if ($tipContra == 'inferior') {

                        $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.—Obligaciones: El Empleador contrata los  servicios personales del Trabajador y éste se obliga:  a) A poner al servicio del Empleador toda su  capacidad normal de trabajo, en forma exclusiva en el desempeño de las  funciones propias del oficio mencionado y en las labores anexas y  complementarias del mismo, de conformidad con las órdenes e instrucciones que  le imparta El Empleador o sus representantes,   b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el  lugar tiempo y necesidades del servicio.- c) Observar rigurosamente la  disciplina interna establecida por el empleador y las persona autorizadas por  ella.- d) A no prestar directa ni indirectamente servicios laborales a otros  Empleadores, ni a trabajar por cuenta propia en el mismo oficio, durante la  vigencia de este contrato, so pena de recibir sanciones disciplinarias y  legales que la norma laboral faculta al empleador.- e) Informar al empleador  oportunamente y por escrito, el cambio de su domicilio que será el lugar donde  recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar la jornada  ordinaria, en los turnos y dentro de las horas señaladas por el empleador o sus  representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando  lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán  repartirse las horas de la jornada ordinaria, en la forma prevista en el  articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre  las secciones de la jornada, no se computan dentro de la misma, según el  articulo 167 ibidem. g) Cuidar permanentemente los intereses del empleador. h)  Programar diariamente su trabajo y asistir puntualmente a las reuniones que  efectúe  el empleador a las cuales hubiere  sido citado. i). —Observar completa armonía y comprensión con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador. k) A presentar dentro&nbsp; de las 48 horas siguientes ante el  empleador, la justificación de su ausencia al puesto de trabajo causado por la  incapacidad medica, certificada&nbsp; por el medico adscrito a la EPS donde se encuentre  afiliado. l) Velar por el cuidado de las instalaciones de la Empresa, así como también  los equipos, muebles, enseres y demás elementos entregados para el cumplimiento  de sus funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los  planes de trabajo que se le indique, bien sea por escrito o por recomendaciones  verbales.- n).- Las demás funciones que se le indiquen oportunamente.-Segunda. Termino  inicial del contrato: La vigencia del presente contrato será hasta el " . $fechaFinText . " . Si antes de la fecha de vencimiento del término  estipulado, ninguna de las partes avisare por escrito a la otra su  determinación de no prorrogar el presente contrato con una antelación no  inferior a treinta (30) días calendario, este se entenderá renovado por un periodo  igual al inicialmente pactado y así sucesivamente. Este contrato podrá  prorrogarse hasta por tres (3) periodos iguales o inferiores, al cabo de los  cuales el término de renovación será de un año, y así sucesivamente, de acuerdo  con lo previsto en el articulo 46 de la Ley 50 de 1.990.- Tercera—Período de prueba.-Los primeros (2) dos meses del presente contrato se consideran como período de prueba y, por  consiguiente, cualquiera de las partes podrá terminar el contrato  unilateralmente, en cualquier momento durante dicho período. Vencido éste, la duración del contrato  será indefinida, mientras subsistan las causas que le dieron origen y la materia del trabajo.-Cuarta.- Incorporación de disposiciones.-Las partes declaran que en el  presente contrato se entienden incorporadas, en lo pertinente, las  disposiciones legales que regulan las relaciones entre la empresa y sus  trabajadores, en especial, las del contrato de trabajo para el oficio que se  suscribe, y  las obligaciones consignadas  en los reglamentos de trabajo y de higiene y seguridad industrial del  empleador, disposiciones que manifiesta conocer y se compromete a acatar. Quinta.- Remuneración.-El Empleador pagará al Trabajador por la  prestación de sus servicios bajo la modalidad arriba citada, la cual  será  pagadera en las oportunidades que  se indican en el encabezamiento de este contrato. Dentro de este pago se  encuentra incluida la remuneración de los descansos dominicales y festivos de  que tratan los capítulos I y II del título VII del Código Sustantivo del  Trabajo. Se aclara y se conviene que en los casos en los que El Trabajador  llegare a devengar comisiones o cualquiera otra modalidad de salario variable,  el 82.5% de dichos ingresos, constituye remuneración ordinaria, y el 17.5%  restante está destinado a remunerar el descanso en los días dominicales y  festivos de que tratan los capítulos I y II del título VII del Código  Sustantivo del Trabajo.-.-Sexta: No  constituye salario.— En atención a lo ordenado por el artículo 128 del  Código Sustantivo del Trabajo, modificado por el artículo 15 de la Ley 50 de 1990, las partes en  el presente contrato convienen de manera expresa que no constituyen salario las  sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o  llegue a recibir en el futuro adicional a su salario ordinario, el trabajador  del empleador, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador, tales como la alimentación, habitación o  vestuario, las primas extralegales, de vacaciones, de servicios o de navidad.  Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima.  Trabajo suplementario:—Todo trabajo suplementario o en horas extras y todo  trabajo en día domingo o festivo en los que legalmente debe concederse  descanso, se remunerará conforme a la ley, así como los correspondientes  recargos nocturnos. Para el reconocimiento y pago del trabajo suplementario,  dominical o festivo El Empleador o sus representantes deben autorizarlo  previamente por escrito. Cuando la necesidad de este trabajo se presente de  manera imprevista o inaplazable, deberá ejecutarse y darse cuenta de él por  escrito, a la mayor brevedad, al Empleador o a sus representantes. El Empleador,  en consecuencia, no reconocerá ningún trabajo suplementario o en días de  descanso legalmente obligatorio que no haya sido autorizado previamente o  avisado inmediatamente, como queda dicho. Octava.  — Jornada: El Trabajador se obliga a laborar la jornada ordinaria en los  turnos y dentro de las horas señaladas por El Empleador, pudiendo hacer éstos  ajustes o cambios de horario cuando lo estime conveniente. Conforme a lo  indicado en el articulo 25 de la   Ley 789 de 2.002, modificatorio del articulo 160 del C.S.T.,  el trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 22 horas (10  P.M.) y el trabajo nocturno es el comprendido entre las 22 Horas (10 P.M.) y  las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena- Justa Causa.- Son justas  causas para dar por terminado unilateralmente este contrato por cualquiera de  las partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y,  además, por parte del Empleador, el incumplimiento de las obligaciones señaladas  en la cláusula primera de este contrato, al igual que las faltas que para el  efecto se califiquen como graves en el espacio reservado para cláusulas  adicionales en el presente contrato. Décima.  Traslado de lugar.-.Las partes podrán convenir que el trabajo se preste  en lugar distinto del inicialmente contratado, siempre que tales traslados no  desmejoren las condiciones laborales o de remuneración del Trabajador, o  impliquen perjuicios para él. Los gastos que se originen con el traslado serán  cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del  Código Sustantivo del Trabajo. El Trabajador se obliga a aceptar los cambios de  oficio que decida El Empleador dentro de su poder subordinante, siempre que se  respeten las condiciones laborales del Trabajador y no se le causen perjuicios.  Todo ello sin que se afecte el honor, la dignidad y los derechos mínimos del  Trabajador, de conformidad con el artículo 23 del Código Sustantivo del  Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. Décima primera.Buena  fe Contractual Este contrato ha sido redactado estrictamente de acuerdo con  la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con  el Código Sustantivo del Trabajo, cuyo objeto, definido en su artículo 1º, es  lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de  un espíritu de coordinación económica y equilibrio social. Duodécima.—Cláusula  Arbitral: Teniendo como sustento la convención colectiva suscrita por el  empleador con sus trabajadores y el articulo 51 de la Ley 712 del 2.001,  modificatoria del articulo 131 del Código Procesal del Trabajo, las partes  determinan de común acuerdo que las Controversias que se presenten, relativas a  conflictos jurídicos laborales, jurídicos económicos del trabajo,  reconocimiento de derechos inciertos y discutibles, relativos a: salarios,  prestaciones sociales, descansos, pagos indemnizatorios, sanciones,  pagos   no saláriales,  derivados de este  contrato, y que resultaren sobre la naturaleza e interpretación del presente  contrato se resolverá  por un tribunal de  arbitramento, conformado por tres (3) árbitros que deberán ser abogados,  designados por la cámara de comercio del lugar donde se desarrollo el contrato,  el cual se sujetara a los dispuesto por el decreto 2279 de 1.989; ley 23 de  1.991; Decreto 2651 de 1.991, y demás normas que lo modifiquen o reglamenten, y  su fallo, en derecho, obligara a las partes. Décima  tercera -.  Confidencialidad-. Las partes aquí intervinientes han acordado  proteger la información confidencial suministrada y/o compartida entre las  partes derivadas del presente contrato, y como tal, no debe darse a conocer a  ninguna persona ajena al presente acuerdo. Por &quot;Información Confidencial; se entenderá aquella información relativa  al negocio cualquiera de los intervinientes en este contrato y/o cualquier  comunicación oral o escrita, que otorgue una ventaja competitiva en caso de  conocimiento por terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación. ");
                        
                    } else if ($tipContra == 'obraTipo1') {

                        $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.Obligaciones:El Empleador contrata los servicios  personales del Trabajador y éste se obliga:   a) A poner al servicio del Empleador toda su capacidad normal de  trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio  mencionado y en las labores anexas y complementarias del mismo, de conformidad  con las órdenes e instrucciones que le imparta El Empleador o sus  representantes,  b) Cumplir con sus  obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades  del servicio.- c) Observar rigurosamente la disciplina interna establecida por  el empleador y las persona autorizadas por ella.- d) A no prestar directa ni  indirectamente servicios laborales a otros Empleadores, ni a trabajar por  cuenta propia en el mismo oficio, durante la vigencia de este contrato, so pena  de recibir sanciones disciplinarias y legales que la norma laboral faculta al  empleador.- e) Informar al empleador oportunamente y por escrito, el cambio de  su domicilio que será el lugar donde recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar  la jornada ordinaria, en los turnos y dentro de las horas señaladas por el  empleador o sus representantes, pudiendo hacer éstos los ajustes o cambios de  horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las  partes, podrán repartirse las horas de la jornada ordinaria, en la forma  prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de  descanso entre las secciones de la jornada, no se computan dentro de la misma,  según el articulo 167 ibidem. g) Cuidar permanentemente los intereses del  empleador y la empresa cliente. h) Programar diariamente su trabajo y asistir  puntualmente a las reuniones que efectúe   el empleador o la empresa cliente a las cuales hubiere sido citado. i).  Observar completa armonía y comprensión con los clientes, con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador y la empresa cliente. k) A presentar  dentro&nbsp; de las 48 horas siguiente ante el empleador, la justificación de  su ausencia al puesto de trabajo causado por la incapacidad medica,  certificada&nbsp; por el medico adscrito a la EPS donde se encuentre afiliado. l) Velar por el  cuidado de las instalaciones de la Empresa Usuaria, así como también los equipos,  muebles, enseres y demás elementos entregados para el cumplimiento de sus  funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los planes  de trabajo que se indique por parte de Listos S.A. o de la Empresa Usuaria,  bien sea por escrito o por recomendaciones verbales.- n).- Las demás funciones  que se le indiquen oportunamente.Segunda.—Duración.- El presente contrato tendrá  como duración el tiempo que dure la  realización de la obra o labor contratada arriba señalada, la cual durara por el tiempo  estrictamente necesario solicitado al Empleador   por la Empresa   Usuaria. En consecuencia, este contrato termina en el momento  en que la Empresa   Usuaria comunique al Empleador que ha dejado de requerir los  servicios de El Trabajador sin que el Empleador tenga que reconocerle  indemnización alguna. Tercera.- Período de prueba Los primeros sesenta días de vigencia  del presente contrato se consideran como período de prueba y, por consiguiente,  cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier  momento durante dicho período. Vencido éste, la duración del contrato será por  el tiempo que dure la realización de la obra o labor contratada  arriba señalada, es decir mientras subsistan  las causas que le dieron origen y la materia del trabajo.- Cuarta.- Incorporación  de disposiciones.- Las partes declaran que en el presente contrato  se entienden incorporadas, en lo pertinente, las disposiciones legales que  regulan las relaciones entre la empresa y sus trabajadores, en especial, las  del contrato de trabajo para el oficio que se suscribe, y  las obligaciones consignadas en los  reglamentos de trabajo y de higiene y seguridad industrial del empleador y de la Empresa Usuaria, disposiciones  que manifiesta conocer y se compromete a acatar. Quinta.-  Remuneración. El Empleador pagará al Trabajador por la prestación  de sus servicios bajo la modalidad arriba citada, la cual será  pagadera en las oportunidades que se indican  en el encabezamiento de este contrato. Dentro de este pago se encuentra  incluida la remuneración de los descansos dominicales y festivos de que tratan  los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se  aclara y se conviene que en los casos en los que El Trabajador llegare a  devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5%  de dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está  destinado a remunerar el descanso en los días dominicales y festivos de que  tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.-Sexta.-No constituye salario.— En  atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo,  modificado por el artículo 15 de la   Ley 50 de 1990, las partes en el presente contrato convienen  de manera expresa que no constituyen salario las sumas en dinero o en especie  que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el  futuro adicional a su salario ordinario, el trabajador del empleador o de la  empresa cliente, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador o de la empresa cliente, tales como la  alimentación, habitación o vestuario, las primas extralegales, de vacaciones,  de servicios o de navidad. Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima. Trabajo suplementario: —Todo trabajo suplementario o en horas extras y todo trabajo en día  domingo o festivo en los que legalmente debe concederse descanso, se remunerará  conforme a la ley, así como los correspondientes recargos nocturnos. Para el  reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo previamente por escrito.  Cuando la necesidad de este trabajo se presente de manera imprevista o  inaplazable, deberá ejecutarse y darse cuenta de él por escrito, a la mayor  brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia,  no reconocerá ningún trabajo suplementario o en días de descanso legalmente  obligatorio que no haya sido autorizado previamente o avisado inmediatamente,  como queda dicho. Octava. — Jornada: El Trabajador se obliga a laborar la  jornada ordinaria en los turnos y dentro de las horas señaladas por El  Empleador o por la empresa cliente, pudiendo hacer éstos ajustes o cambios de  horario cuando lo estime conveniente. Conforme a lo indicado en el articulo 25  de la Ley 789 de  2.002, modificatorio del articulo 160 del C.S.T., el trabajo ordinario será el  que se realiza entre las 6 Horas (6   A.M.) y las 22 horas (10 P.M.) y el trabajo nocturno es  el comprendido entre las 22 Horas (10 P.M.) y las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo  segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena— Justa Causa.- Son justas causas  para dar por terminado unilateralmente este contrato por cualquiera de las  partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además,  por parte del Empleador, el incumplimiento de las obligaciones señaladas en la  cláusula primera de este contrato, al igual que las faltas que para el efecto  se califiquen como graves en el espacio reservado para cláusulas adicionales en  el presente contrato. Décima. Traslado de lugar.-.Las partes podrán convenir que  el trabajo se preste en lugar distinto del inicialmente contratado, siempre que  tales traslados no desmejoren las condiciones laborales o de remuneración del  Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el  traslado serán cubiertos por El Empleador de conformidad con el numeral 8º del  artículo 57 del Código Sustantivo del Trabajo. El Trabajador se obliga a  aceptar los cambios de oficio que decida El Empleador dentro de su poder  subordinante, siempre que se respeten las condiciones laborales del Trabajador  y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad  y los derechos mínimos del Trabajador, de conformidad con el artículo 23 del  Código Sustantivo del Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. décima  Primero. Buena  fe Contractual—Este contrato ha sido redactado estrictamente de  acuerdo con la ley y la jurisprudencia y será interpretado de buena fe y en  consonancia con el Código Sustantivo del Trabajo, cuyo objeto, definido en su  artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores  dentro de un espíritu de coordinación económica y equilibrio social. Duodécima.Cláusula Arbitral:  Teniendo como sustento la convención colectiva suscrita por el empleador con  sus trabajadores y el articulo 51 de la   Ley 712 del 2.001, modificatoria del articulo 131 del Código  Procesal del Trabajo, las partes determinan de común acuerdo que las  Controversias que se presenten, relativas a conflictos jurídicos laborales,  jurídicos económicos del trabajo, reconocimiento de derechos inciertos y discutibles,  relativos a: salarios, prestaciones sociales, descansos, pagos indemnizatorios,  sanciones,  pagos  no saláriales,  derivados de este contrato, y que resultaren  sobre la naturaleza e interpretación del presente contrato se resolverá  por un tribunal de arbitramento, conformado  por tres (3) árbitros que deberán ser abogados, designados por la cámara de  comercio del lugar donde se desarrollo el contrato, el cual se sujetara a los  dispuesto por el decreto 2279 de 1.989; ley 23 de 1.991; Decreto 2651 de 1.991,  y demás normas que lo modifiquen o reglamenten, y su fallo, en derecho,  obligara a las partes. Décima Tercera-. Confidencialidad.  Las partes aquí intervinientes han acordado proteger la información  confidencial suministrada y/o compartida entre las partes derivadas del  presente contrato, y como tal, no debe darse a conocer a ninguna persona ajena  al presente acuerdo. Por Información  Confidencial; se entenderá aquella información relativa al negocio  cualquiera de los intervinientes en este contrato y/o cualquier comunicación  oral o escrita, que otorgue una ventaja competitiva en caso de conocimiento por  terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación.");
                                            
                    }else if($tipContra == 'obraTipo2'){
                         $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha celebrado el presente contrato individual de trabajo, regido además por las siguientes cláusulas: PRIMERA.—OBLIGACIONES: El Empleador contrata los servicios personales del Trabajador y éste se obliga: a) A poner al servicio del Empleador toda su capacidad normal de trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio mencionado y en las labores anexas y complementarias del mismo, de conformidad con las órdenes e instrucciones que le imparta El Empleador o sus representantes, b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades del servicio.c) Observar rigurosamente la disciplina interna establecida por el empleador y las persona autorizadas por ella.d) A no prestar directa ni indirectamente servicios laborales a otros Empleadores, ni a trabajar por cuenta propia en elmismo oficio, durante la vigencia de este contrato, so pena de recibir sanciones disciplinarias y legales que la norma laboral faculta al empleador.e) Informar al empleador oportunamente y por escrito, el cambio de su domicilio que será el lugar donde recibirá las notificaciones de que habla la Ley 789 de 2.002.f) Laborar la jornada ordinaria, en los turnos y dentro de las horas señaladas por el empleador o sus representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán repartirse las horas de la jornada ordinaria, en la forma prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada, no se computan dentro de la misma, según el articulo 167 ibidem. g) Cuidar permanentemente los intereses del empleador. h) Programar diariamente su trabajo y asistir puntualmente a las reuniones que efectúe el empleador a las cuales hubiere sido citado. i). —Observar completa armonía y comprensión con sus superiores y compañeros de trabajo, en sus relaciones personales y en la ejecución de su labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y disciplina con el empleador. k) A presentar dentro de las 48 horas siguientes ante el empleador, la justificación de su ausencia al puesto de trabajo causado por la incapacidad medica, certificada por el medico adscrito a la EPS donde se encuentre afiliado. l) Velar por el cuidado de las instalaciones de el empleador, así como también los equipos, muebles, enseres y demás elementos entregados para el cumplimiento de sus funciones, con el fin de evitar daños y extravíos.m). Cumplir con los planes de trabajo que se indique por parte de el empleador, bien sea por escrito o por recomendaciones verbales.n). Las demás funciones que se le indiquen oportunamente.SEGUNDA DURACIÓN.El presente contrato tendrá como duración el tiempo que dure la realización de la obra o labor contratada arriba señalada, la cual durara por el tiempo estrictamente necesario para cumplir con la obra que le determine el empleador. Por consecuencia, este contrato termina en el momento en que el empleador comunique al Trabajador que la obra terminó, sin que el Empleador tenga que reconocerle indemnización alguna. TERCERA.PERÍODO DE PRUEBA Los primeros sesenta días de vigencia del presente contrato se consideran como período de prueba y, por consiguiente, cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier momento durante dicho período. Vencido éste, la duración del contrato será por el tiempo que dure la realización de la obra o labor contratada arriba señalada, es decir mientras subsistan las causas que le dieron origen y la materia del trabajo.CUARTA. INCORPORACIÓN DE DISPOSICIONES.Las partes declaran que en el presente contrato se entienden incorporadas, en lo pertinente, las disposiciones legales que regulan las relaciones entre el empleador y sus trabajadores, en especial, las del contrato de trabajo para el oficio que se suscribe, y las obligaciones consignadas en los reglamentos de trabajo y de higiene y seguridad industrial del empleador, disposiciones que manifiesta conocer y se compromete a acatar. QUINTA. .REMUNERACIÓN. El Empleador pagará al Trabajador por la prestación de sus servicios bajo la modalidad arriba citada, la cual será pagadera en las oportunidades que se indican en el encabezamiento de este contrato. Dentro de este pago se encuentra incluida la remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se aclara y se conviene que en los casos en los que El Trabajador llegare a devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5% de dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está destinado a remunerar el descanso en los días dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.SEXTA. NO CONSTITUYE SALARIO.— En atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo, modificado por el artículo 15 de la Ley 50 de 1990, las partes en el presente contrato convienen de manera expresa que no constituyen salario las sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el futuro adicional a su salario ordinario, el trabajador del empleador, como propinas, primas, bonificaciones o gratificaciones ocasionales, participación de utilidades, y lo que recibe en dinero o en especie no para su beneficio como ayudas o auxilios habituales u ocasionales, tales como alimentación, o vestuario, bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del contrato de trabajo, ni aquellos que se hacen, no para enriquecer su patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de representación, medios de transporte, elementos de trabajo y otros semejantes. Tampoco constituyen salario las prestaciones sociales de que tratan los títulos VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios habituales u ocasionales acordados convencional o contractualmente u otorgados en forma extralegal por el empleador, tales como la alimentación, habitación o vestuario, las primas extralegales, de vacaciones, de servicios o de navidad. Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos aquí señalados, que no constituyen salario no hacen parte de la base para liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA, Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a la seguridad social establecidas por la Ley 100 de 1993.SÉPTIMA. TRABAJO SUPLEMENTARIO: —Todo trabajo suplementario o en horas extras y todo trabajo en día domingo o festivo en los que legalmente debe concederse descanso, se remunerará conforme a la ley, así como los correspondientes recargos nocturnos. Para el reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo previamente por escrito. Cuando la necesidad de este trabajo se presente de manera imprevista o inaplazable, deberá ejecutarse y darse cuenta de él por escrito, a la menor brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia, no reconocerá ningún trabajo suplementario o en días de descanso legalmente obligatorio que no haya sido autorizado previamente o avisado inmediatamente, como queda dicho. OCTAVA. — JORNADA: El Trabajador se obliga a laborar la jornada ordinaria en los turnos y dentro de las horas señaladas por El Empleador, pudiendo hacer éstos ajustes o cambios de horario cuando lo estime conveniente. Conforme a lo indicado en el articulo 25 de la Ley 789 de 2.002, modificatorio del articulo 160 del C.S.T., el trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 22 horas (10 P.M.) y el trabajo nocturno es el comprendido entre las 22 Horas (10 P.M.) y las 6 Horas (6 A.M.). Parágrafo Primero: Conforme lo indicado por la Ley Laboral, el empleador y el trabajador podrán acordar temporal o indefinidamente la organización de turnos de trabajo sucesivos que permitan operar a el empleador o secciones de la misma sin solución de continuidad durante todos los días de la semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo segundo: El empleador y el trabajador, podrán acordar que la jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un día de descanso obligatorio, que podrá coincidir con el domingo. En este, el numero de horas de trabajo diario podrá repartirse de manera variable durante la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario, cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. NOVENA— JUSTA CAUSA.Son justas causas para dar por terminado unilateralmente este contrato por cualquiera de las partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además, por parte del Empleador, el incumplimiento de las obligaciones señaladas en la cláusula primera de este contrato, al igual que las faltas que para el efecto se califiquen como graves en el espacio reservado para cláusulas adicionales en el presente contrato. DÉCIMA. TRASLADO DE LUGAR.—. Las partes podrán convenir que el trabajo se preste en lugar distinto del inicialmente contratado, siempre que tales traslados no desmejoren las condiciones laborales o de remuneración del Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el traslado serán cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del Código Sustantivo del Trabajo. El Trabajador se obliga a aceptar los cambios de oficio que decida El Empleador dentro de su poder subordinante, siempre que se respeten las condiciones laborales del Trabajador y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad y los derechos mínimos del Trabajador, de conformidad con el artículo 23 del Código Sustantivo del Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. DÉCIMA PRIMERA. Buena fe Contractual—Este contrato ha sido redactado estrictamente de acuerdo con la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con el Código Sustantivo del Trabajo, cuyo objeto, definido en su artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de un espíritu de coordinación económica y equilibrio social. DUODÉCIMA.— CLAUSULA ARBITRALl: Teniendo como sustento la convención colectiva suscrita por el empleador con sus trabajadores y el articulo 51 de la Ley 712 del 2.001, modificatoria del articulo 131 del Código Procesal del Trabajo, las partes determinan de común acuerdo que las Controversias que se presenten, relativas a conflictos jurídicos laborales, jurídicos económicos del trabajo, reconocimiento de derechos inciertos y discutibles, relativos a: salarios, prestaciones sociales, descansos, pagos indemnizatorios, sanciones, pagos no saláriales, derivados de este contrato, y que resultaren sobre la naturaleza e interpretación del presente contrato se resolverá por un tribunal de arbitramento, conformado por tres (3) árbitros que deberán ser abogados, designados por la cámara de comercio del lugar donde se desarrolló el contrato, el cual se sujetara a lo dispuesto por el decreto 2279 de 1.989; ley 23 de 1.991; Decreto 2651 de 1.991, y demás normas que lo modifiquen o reglamenten, y su fallo, en derecho, obligara a las partes. DÉCIMA TERCERA. CONFIDENCIALIDAD. Las partes aquí intervinientes han acordado proteger la informacion confidencial suministrada y/o compartida entre las partes derivadas del presente contrato, y como tal, no debe darse a conocer a ninguna persona ajena al presente acuerdo. Por Información Confidencial se entenderá aquella información relativa al negocio cualquiera de los intervinientes en este contrato y/o cualquier comunicación oral o escrita, que otorgue una ventaja competitiva en caso de conocimiento por terceras personas ajenas a este acuerdo.DÉCIMA CUARTA: DEDUCCIONES. Cuando por causa emanada directa o indirectamente de la relación contractual existan obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en cualquier tiempo y, más concretamente, a la terminación del presente contrato, así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las partes que la presente autorización cumple las condiciones de orden escrita previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del mismo tenor y valor, en la ciudad y fecha que se indican a continuacion");
                        
                    }

                    $pdf->Ln(10);
                    $pdf->SetFont('Times', '', 9);
                    $pdf->MultiCell(0, 4, $parrafo);

                    $fechaMod = explode("-", $fecha);
                    $año = $fechaMod[2];
                    $mes = $fechaMod[1];
                    $dia = $fechaMod[0];
                    $fechaFinAux = $utilidades->fechatextual($dia, $mes, $año);


                    $pdf->Cell(0, 10,' '. $datosSuc[0]['suc_nombre'] .',' . utf8_decode($fechaFinAux) . ' ', 0, 0, 'R');

                    $pdf->Ln(20);
                    $pdf->Cell(50, 6, '', 'B', 0, 'L');
                    $pdf->Cell(75, 6, '', 0, 0, 'L');
                    //$pdf->Cell(50, 6, '', 0, 0, 'L');
                    $pdf->Cell(60, 6, '', 'B', 1, 'L');
                    $pdf->Cell(50, 6, 'El empleador', 0, 0, 'L');
                    $pdf->Cell(75, 6, '', 0, 0, 'L');
                    $pdf->Cell(50, 6, 'El trabajador', 0, 1, 'L');
                    $pdf->Cell(50, 6, '', 0, 0, 'L');
                    $pdf->Cell(75, 6, '', 0, 0, 'L');
                    $pdf->Cell(50, 6, 'C.C: ' . $valor['cod_empl'] . ' ', 0, 1, 'L');
                    
                } else {

                    return "-1";
                }
            }

            $fechaDoc = date('d-m-Y_H-i-s');
            $ruta = "../../temporales/contratos/contrato" . $fechaDoc . ".pdf";
            $pdf->Output($ruta);
            return $ruta;
        }
    }

    function registrarLogContrato($req, $idUser, $idUserCreo, $empInt, $perSal, $tipContra, $logo, $fechaFin) {

        $gestionDatos = new gestionContratosDatos();

        if ($perSal == 'hora') {
            $salario = 1;
        }

        if ($perSal == 'diario') {
            $salario = 2;
        }

        if ($perSal == 'mensual') {
            $salario = 3;
        }

        if ($tipContra == 'obra') {
            $contrato = 1;
        }

        if ($tipContra == 'inferior') {
            $contrato = 2;
        }

        if ($logo == 'sin') {

            $logo = '0';
        } else {
            $logo = '1';
        }

        $resulInsert = $gestionDatos->registrarLogContrato($req, $idUser, $idUserCreo, $empInt, $salario, $contrato, $logo, $fechaFin);

        return $resulInsert;
    }

    function consultarLogContrato($req, $idUser, $empInt) {

        $gestionDatos = new gestionContratosDatos();

//        if ($perSal == 'hora') {
//            $salario = 1;
//        }
//
//        if ($perSal == 'diario') {
//            $salario = 2;
//        }
//
//        if ($perSal == 'mensual') {
//            $salario = 3;
//        }
//
//        if ($tipContra == 'obra') {
//            $contrato = 1;
//        }
//
//        if ($tipContra == 'inferior') {
//            $contrato = 2;
//        }

        $resulConsulta = $gestionDatos->consultaLogContrato($req, $idUser, $empInt);

        return $resulConsulta;
    }
    
    function actualizarLogContrato($req, $idUser, $empInt, $tipContra = '', $fechaFin = '',$idUserCreo){
        
        if ($tipContra == 'obraTipo1') {
            $contrato = 1;
        }

        if ($tipContra == 'inferior') {
        
            $contrato = 2;
        
        }
        
        if ($tipContra == 'obraTipo2') {
            $contrato = 3;
        }
        
        $gestionDatos = new gestionContratosDatos();
        
        $resulConsulta = $gestionDatos->actualizarContrato($req, $idUser, $empInt ,$idUserCreo,$contrato, $fechaFin );

        return $resulConsulta;
        
        
    }

    function paqueteContrato($empInt, $req, $idUser, $logo, $perSal, $tipContra, $fechaFin, $accion) {

        $pdf = new FPDF();
        $gestionDatos = new gestionContratosDatos();
        $utilidades = new utilidades();
        $idUserCreo = $_SESSION['usuCodigo'];
        $resulRegLog = true;

        if ($tipContra == 'inferior') {

            $fechaFin2 = explode("/", $fechaFin);
            $año = $fechaFin2[0];
            $mes = $fechaFin2[1];
            $dia = $fechaFin2[2];
            $fechaFinText = $utilidades->fechatextual($dia, $mes, $año);
        }

        $resulConsulta = $this->consultarUsuariosxReq($empInt, $req, $idUser, $att, $cita, $direccion, $accion);

        if ($resulConsulta != null) {

            //Inicio creacion Contrato      
            
            if ($logo == 'sin') {

                $imgsrc = "";
            }

            if ($logo == 'con') {

                if ($empInt == 1) {
                    $imgsrc = "../../libs/imagenes/logos/logo_head1.JPG";
                }

                if ($empInt == 2) {
                    $imgsrc = "../../libs/imagenes/logos/Logo_Tercerizar.png";
                }

                if ($empInt == 3) {
                    $imgsrc = "../../libs/imagenes/logos/logo-vm.png";
                }
            }

            if ($tipContra == 'obraTipo1') {

                $titulo = utf8_decode("QUE DURE LA REALIZACIÓN DE LA OBRA O LABOR CONTRATADA");
                $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.Obligaciones:El Empleador contrata los servicios  personales del Trabajador y éste se obliga:   a) A poner al servicio del Empleador toda su capacidad normal de  trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio  mencionado y en las labores anexas y complementarias del mismo, de conformidad  con las órdenes e instrucciones que le imparta El Empleador o sus  representantes,  b) Cumplir con sus  obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades  del servicio.- c) Observar rigurosamente la disciplina interna establecida por  el empleador y las persona autorizadas por ella.- d) A no prestar directa ni  indirectamente servicios laborales a otros Empleadores, ni a trabajar por  cuenta propia en el mismo oficio, durante la vigencia de este contrato, so pena  de recibir sanciones disciplinarias y legales que la norma laboral faculta al  empleador.- e) Informar al empleador oportunamente y por escrito, el cambio de  su domicilio que será el lugar donde recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar  la jornada ordinaria, en los turnos y dentro de las horas señaladas por el  empleador o sus representantes, pudiendo hacer éstos los ajustes o cambios de  horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las  partes, podrán repartirse las horas de la jornada ordinaria, en la forma  prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de  descanso entre las secciones de la jornada, no se computan dentro de la misma,  según el articulo 167 ibidem. g) Cuidar permanentemente los intereses del  empleador y la empresa cliente. h) Programar diariamente su trabajo y asistir  puntualmente a las reuniones que efectúe   el empleador o la empresa cliente a las cuales hubiere sido citado. i).  Observar completa armonía y comprensión con los clientes, con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador y la empresa cliente. k) A presentar  dentro&nbsp; de las 48 horas siguiente ante el empleador, la justificación de  su ausencia al puesto de trabajo causado por la incapacidad medica,  certificada&nbsp; por el medico adscrito a la EPS donde se encuentre afiliado. l) Velar por el  cuidado de las instalaciones de la Empresa Usuaria, así como también los equipos,  muebles, enseres y demás elementos entregados para el cumplimiento de sus  funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los planes  de trabajo que se indique por parte de Listos S.A. o de la Empresa Usuaria,  bien sea por escrito o por recomendaciones verbales.- n).- Las demás funciones  que se le indiquen oportunamente.Segunda.—Duración.- El presente contrato tendrá  como duración el tiempo que dure la  realización de la obra o labor contratada arriba señalada, la cual durara por el tiempo  estrictamente necesario solicitado al Empleador   por la Empresa   Usuaria. En consecuencia, este contrato termina en el momento  en que la Empresa   Usuaria comunique al Empleador que ha dejado de requerir los  servicios de El Trabajador sin que el Empleador tenga que reconocerle  indemnización alguna. Tercera.- Período de prueba Los primeros sesenta días de vigencia  del presente contrato se consideran como período de prueba y, por consiguiente,  cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier  momento durante dicho período. Vencido éste, la duración del contrato será por  el tiempo que dure la realización de la obra o labor contratada  arriba señalada, es decir mientras subsistan  las causas que le dieron origen y la materia del trabajo.- Cuarta.- Incorporación  de disposiciones.- Las partes declaran que en el presente contrato  se entienden incorporadas, en lo pertinente, las disposiciones legales que  regulan las relaciones entre la empresa y sus trabajadores, en especial, las  del contrato de trabajo para el oficio que se suscribe, y  las obligaciones consignadas en los  reglamentos de trabajo y de higiene y seguridad industrial del empleador y de la Empresa Usuaria, disposiciones  que manifiesta conocer y se compromete a acatar. Quinta.-  Remuneración. El Empleador pagará al Trabajador por la prestación  de sus servicios bajo la modalidad arriba citada, la cual será  pagadera en las oportunidades que se indican  en el encabezamiento de este contrato. Dentro de este pago se encuentra  incluida la remuneración de los descansos dominicales y festivos de que tratan  los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se  aclara y se conviene que en los casos en los que El Trabajador llegare a  devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5%  de dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está  destinado a remunerar el descanso en los días dominicales y festivos de que  tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.-Sexta.-No constituye salario.— En  atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo,  modificado por el artículo 15 de la   Ley 50 de 1990, las partes en el presente contrato convienen  de manera expresa que no constituyen salario las sumas en dinero o en especie  que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el  futuro adicional a su salario ordinario, el trabajador del empleador o de la  empresa cliente, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador o de la empresa cliente, tales como la  alimentación, habitación o vestuario, las primas extralegales, de vacaciones,  de servicios o de navidad. Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima. Trabajo suplementario: —Todo trabajo suplementario o en horas extras y todo trabajo en día  domingo o festivo en los que legalmente debe concederse descanso, se remunerará  conforme a la ley, así como los correspondientes recargos nocturnos. Para el  reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo previamente por escrito.  Cuando la necesidad de este trabajo se presente de manera imprevista o  inaplazable, deberá ejecutarse y darse cuenta de él por escrito, a la mayor  brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia,  no reconocerá ningún trabajo suplementario o en días de descanso legalmente  obligatorio que no haya sido autorizado previamente o avisado inmediatamente,  como queda dicho. Octava. — Jornada: El Trabajador se obliga a laborar la  jornada ordinaria en los turnos y dentro de las horas señaladas por El  Empleador o por la empresa cliente, pudiendo hacer éstos ajustes o cambios de  horario cuando lo estime conveniente. Conforme a lo indicado en el articulo 25  de la Ley 789 de  2.002, modificatorio del articulo 160 del C.S.T., el trabajo ordinario será el  que se realiza entre las 6 Horas (6   A.M.) y las 22 horas (10 P.M.) y el trabajo nocturno es  el comprendido entre las 22 Horas (10 P.M.) y las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo  segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena— Justa Causa.- Son justas causas  para dar por terminado unilateralmente este contrato por cualquiera de las  partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además,  por parte del Empleador, el incumplimiento de las obligaciones señaladas en la  cláusula primera de este contrato, al igual que las faltas que para el efecto  se califiquen como graves en el espacio reservado para cláusulas adicionales en  el presente contrato. Décima. Traslado de lugar.-.Las partes podrán convenir que  el trabajo se preste en lugar distinto del inicialmente contratado, siempre que  tales traslados no desmejoren las condiciones laborales o de remuneración del  Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el  traslado serán cubiertos por El Empleador de conformidad con el numeral 8º del  artículo 57 del Código Sustantivo del Trabajo. El Trabajador se obliga a  aceptar los cambios de oficio que decida El Empleador dentro de su poder  subordinante, siempre que se respeten las condiciones laborales del Trabajador  y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad  y los derechos mínimos del Trabajador, de conformidad con el artículo 23 del  Código Sustantivo del Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. décima  Primero. Buena  fe Contractual—Este contrato ha sido redactado estrictamente de  acuerdo con la ley y la jurisprudencia y será interpretado de buena fe y en  consonancia con el Código Sustantivo del Trabajo, cuyo objeto, definido en su  artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores  dentro de un espíritu de coordinación económica y equilibrio social. Duodécima.Cláusula Arbitral:  Teniendo como sustento la convención colectiva suscrita por el empleador con  sus trabajadores y el articulo 51 de la   Ley 712 del 2.001, modificatoria del articulo 131 del Código  Procesal del Trabajo, las partes determinan de común acuerdo que las  Controversias que se presenten, relativas a conflictos jurídicos laborales,  jurídicos económicos del trabajo, reconocimiento de derechos inciertos y discutibles,  relativos a: salarios, prestaciones sociales, descansos, pagos indemnizatorios,  sanciones,  pagos  no saláriales,  derivados de este contrato, y que resultaren  sobre la naturaleza e interpretación del presente contrato se resolverá  por un tribunal de arbitramento, conformado  por tres (3) árbitros que deberán ser abogados, designados por la cámara de  comercio del lugar donde se desarrollo el contrato, el cual se sujetara a los  dispuesto por el decreto 2279 de 1.989; ley 23 de 1.991; Decreto 2651 de 1.991,  y demás normas que lo modifiquen o reglamenten, y su fallo, en derecho,  obligara a las partes. Décima Tercera-. Confidencialidad.  Las partes aquí intervinientes han acordado proteger la información  confidencial suministrada y/o compartida entre las partes derivadas del  presente contrato, y como tal, no debe darse a conocer a ninguna persona ajena  al presente acuerdo. Por Información  Confidencial; se entenderá aquella información relativa al negocio  cualquiera de los intervinientes en este contrato y/o cualquier comunicación  oral o escrita, que otorgue una ventaja competitiva en caso de conocimiento por  terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación.");
            }
            
            if ($tipContra == 'obraTipo2') {

                $titulo = utf8_decode("QUE DURE LA REALIZACIÓN DE LA OBRA O LABOR CONTRATADA");
                $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha celebrado el presente contrato individual de trabajo, regido además por las siguientes cláusulas: PRIMERA.—OBLIGACIONES: El Empleador contrata los servicios personales del Trabajador y éste se obliga: a) A poner al servicio del Empleador toda su capacidad normal de trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio mencionado y en las labores anexas y complementarias del mismo, de conformidad con las órdenes e instrucciones que le imparta El Empleador o sus representantes, b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades del servicio.c) Observar rigurosamente la disciplina interna establecida por el empleador y las persona autorizadas por ella.d) A no prestar directa ni indirectamente servicios laborales a otros Empleadores, ni a trabajar por cuenta propia en elmismo oficio, durante la vigencia de este contrato, so pena de recibir sanciones disciplinarias y legales que la norma laboral faculta al empleador.e) Informar al empleador oportunamente y por escrito, el cambio de su domicilio que será el lugar donde recibirá las notificaciones de que habla la Ley 789 de 2.002.f) Laborar la jornada ordinaria, en los turnos y dentro de las horas señaladas por el empleador o sus representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán repartirse las horas de la jornada ordinaria, en la forma prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada, no se computan dentro de la misma, según el articulo 167 ibidem. g) Cuidar permanentemente los intereses del empleador. h) Programar diariamente su trabajo y asistir puntualmente a las reuniones que efectúe el empleador a las cuales hubiere sido citado. i). —Observar completa armonía y comprensión con sus superiores y compañeros de trabajo, en sus relaciones personales y en la ejecución de su labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y disciplina con el empleador. k) A presentar dentro de las 48 horas siguientes ante el empleador, la justificación de su ausencia al puesto de trabajo causado por la incapacidad medica, certificada por el medico adscrito a la EPS donde se encuentre afiliado. l) Velar por el cuidado de las instalaciones de el empleador, así como también los equipos, muebles, enseres y demás elementos entregados para el cumplimiento de sus funciones, con el fin de evitar daños y extravíos.m). Cumplir con los planes de trabajo que se indique por parte de el empleador, bien sea por escrito o por recomendaciones verbales.n). Las demás funciones que se le indiquen oportunamente.SEGUNDA DURACIÓN.El presente contrato tendrá como duración el tiempo que dure la realización de la obra o labor contratada arriba señalada, la cual durara por el tiempo estrictamente necesario para cumplir con la obra que le determine el empleador. Por consecuencia, este contrato termina en el momento en que el empleador comunique al Trabajador que la obra terminó, sin que el Empleador tenga que reconocerle indemnización alguna. TERCERA.PERÍODO DE PRUEBA Los primeros sesenta días de vigencia del presente contrato se consideran como período de prueba y, por consiguiente, cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier momento durante dicho período. Vencido éste, la duración del contrato será por el tiempo que dure la realización de la obra o labor contratada arriba señalada, es decir mientras subsistan las causas que le dieron origen y la materia del trabajo.CUARTA. INCORPORACIÓN DE DISPOSICIONES.Las partes declaran que en el presente contrato se entienden incorporadas, en lo pertinente, las disposiciones legales que regulan las relaciones entre el empleador y sus trabajadores, en especial, las del contrato de trabajo para el oficio que se suscribe, y las obligaciones consignadas en los reglamentos de trabajo y de higiene y seguridad industrial del empleador, disposiciones que manifiesta conocer y se compromete a acatar. QUINTA. .REMUNERACIÓN. El Empleador pagará al Trabajador por la prestación de sus servicios bajo la modalidad arriba citada, la cual será pagadera en las oportunidades que se indican en el encabezamiento de este contrato. Dentro de este pago se encuentra incluida la remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se aclara y se conviene que en los casos en los que El Trabajador llegare a devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5% de dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está destinado a remunerar el descanso en los días dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.SEXTA. NO CONSTITUYE SALARIO.— En atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo, modificado por el artículo 15 de la Ley 50 de 1990, las partes en el presente contrato convienen de manera expresa que no constituyen salario las sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el futuro adicional a su salario ordinario, el trabajador del empleador, como propinas, primas, bonificaciones o gratificaciones ocasionales, participación de utilidades, y lo que recibe en dinero o en especie no para su beneficio como ayudas o auxilios habituales u ocasionales, tales como alimentación, o vestuario, bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del contrato de trabajo, ni aquellos que se hacen, no para enriquecer su patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de representación, medios de transporte, elementos de trabajo y otros semejantes. Tampoco constituyen salario las prestaciones sociales de que tratan los títulos VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios habituales u ocasionales acordados convencional o contractualmente u otorgados en forma extralegal por el empleador, tales como la alimentación, habitación o vestuario, las primas extralegales, de vacaciones, de servicios o de navidad. Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos aquí señalados, que no constituyen salario no hacen parte de la base para liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA, Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a la seguridad social establecidas por la Ley 100 de 1993.SÉPTIMA. TRABAJO SUPLEMENTARIO: —Todo trabajo suplementario o en horas extras y todo trabajo en día domingo o festivo en los que legalmente debe concederse descanso, se remunerará conforme a la ley, así como los correspondientes recargos nocturnos. Para el reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo previamente por escrito. Cuando la necesidad de este trabajo se presente de manera imprevista o inaplazable, deberá ejecutarse y darse cuenta de él por escrito, a la menor brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia, no reconocerá ningún trabajo suplementario o en días de descanso legalmente obligatorio que no haya sido autorizado previamente o avisado inmediatamente, como queda dicho. OCTAVA. — JORNADA: El Trabajador se obliga a laborar la jornada ordinaria en los turnos y dentro de las horas señaladas por El Empleador, pudiendo hacer éstos ajustes o cambios de horario cuando lo estime conveniente. Conforme a lo indicado en el articulo 25 de la Ley 789 de 2.002, modificatorio del articulo 160 del C.S.T., el trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 22 horas (10 P.M.) y el trabajo nocturno es el comprendido entre las 22 Horas (10 P.M.) y las 6 Horas (6 A.M.). Parágrafo Primero: Conforme lo indicado por la Ley Laboral, el empleador y el trabajador podrán acordar temporal o indefinidamente la organización de turnos de trabajo sucesivos que permitan operar a el empleador o secciones de la misma sin solución de continuidad durante todos los días de la semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo segundo: El empleador y el trabajador, podrán acordar que la jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un día de descanso obligatorio, que podrá coincidir con el domingo. En este, el numero de horas de trabajo diario podrá repartirse de manera variable durante la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario, cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. NOVENA— JUSTA CAUSA.Son justas causas para dar por terminado unilateralmente este contrato por cualquiera de las partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además, por parte del Empleador, el incumplimiento de las obligaciones señaladas en la cláusula primera de este contrato, al igual que las faltas que para el efecto se califiquen como graves en el espacio reservado para cláusulas adicionales en el presente contrato. DÉCIMA. TRASLADO DE LUGAR.—. Las partes podrán convenir que el trabajo se preste en lugar distinto del inicialmente contratado, siempre que tales traslados no desmejoren las condiciones laborales o de remuneración del Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el traslado serán cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del Código Sustantivo del Trabajo. El Trabajador se obliga a aceptar los cambios de oficio que decida El Empleador dentro de su poder subordinante, siempre que se respeten las condiciones laborales del Trabajador y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad y los derechos mínimos del Trabajador, de conformidad con el artículo 23 del Código Sustantivo del Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. DÉCIMA PRIMERA. Buena fe Contractual—Este contrato ha sido redactado estrictamente de acuerdo con la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con el Código Sustantivo del Trabajo, cuyo objeto, definido en su artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de un espíritu de coordinación económica y equilibrio social. DUODÉCIMA.— CLAUSULA ARBITRALl: Teniendo como sustento la convención colectiva suscrita por el empleador con sus trabajadores y el articulo 51 de la Ley 712 del 2.001, modificatoria del articulo 131 del Código Procesal del Trabajo, las partes determinan de común acuerdo que las Controversias que se presenten, relativas a conflictos jurídicos laborales, jurídicos económicos del trabajo, reconocimiento de derechos inciertos y discutibles, relativos a: salarios, prestaciones sociales, descansos, pagos indemnizatorios, sanciones, pagos no saláriales, derivados de este contrato, y que resultaren sobre la naturaleza e interpretación del presente contrato se resolverá por un tribunal de arbitramento, conformado por tres (3) árbitros que deberán ser abogados, designados por la cámara de comercio del lugar donde se desarrolló el contrato, el cual se sujetara a lo dispuesto por el decreto 2279 de 1.989; ley 23 de 1.991; Decreto 2651 de 1.991, y demás normas que lo modifiquen o reglamenten, y su fallo, en derecho, obligara a las partes. DÉCIMA TERCERA. CONFIDENCIALIDAD. Las partes aquí intervinientes han acordado proteger la informacion confidencial suministrada y/o compartida entre las partes derivadas del presente contrato, y como tal, no debe darse a conocer a ninguna persona ajena al presente acuerdo. Por Información Confidencial se entenderá aquella información relativa al negocio cualquiera de los intervinientes en este contrato y/o cualquier comunicación oral o escrita, que otorgue una ventaja competitiva en caso de conocimiento por terceras personas ajenas a este acuerdo.DÉCIMA CUARTA: DEDUCCIONES. Cuando por causa emanada directa o indirectamente de la relación contractual existan obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en cualquier tiempo y, más concretamente, a la terminación del presente contrato, así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las partes que la presente autorización cumple las condiciones de orden escrita previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del mismo tenor y valor, en la ciudad y fecha que se indican a continuacion");
            }

            if ($tipContra == 'inferior') {

                $titulo = utf8_decode("CONTRATO A TÉRMINO FIJO INFERIOR A UN AÑO");
                $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.—Obligaciones: El Empleador contrata los  servicios personales del Trabajador y éste se obliga:  a) A poner al servicio del Empleador toda su  capacidad normal de trabajo, en forma exclusiva en el desempeño de las  funciones propias del oficio mencionado y en las labores anexas y  complementarias del mismo, de conformidad con las órdenes e instrucciones que  le imparta El Empleador o sus representantes,   b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el  lugar tiempo y necesidades del servicio.- c) Observar rigurosamente la  disciplina interna establecida por el empleador y las persona autorizadas por  ella.- d) A no prestar directa ni indirectamente servicios laborales a otros  Empleadores, ni a trabajar por cuenta propia en el mismo oficio, durante la  vigencia de este contrato, so pena de recibir sanciones disciplinarias y  legales que la norma laboral faculta al empleador.- e) Informar al empleador  oportunamente y por escrito, el cambio de su domicilio que será el lugar donde  recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar la jornada  ordinaria, en los turnos y dentro de las horas señaladas por el empleador o sus  representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando  lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán  repartirse las horas de la jornada ordinaria, en la forma prevista en el  articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre  las secciones de la jornada, no se computan dentro de la misma, según el  articulo 167 ibidem. g) Cuidar permanentemente los intereses del empleador. h)  Programar diariamente su trabajo y asistir puntualmente a las reuniones que  efectúe  el empleador a las cuales hubiere  sido citado. i). —Observar completa armonía y comprensión con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador. k) A presentar dentro&nbsp; de las 48 horas siguientes ante el  empleador, la justificación de su ausencia al puesto de trabajo causado por la  incapacidad medica, certificada&nbsp; por el medico adscrito a la EPS donde se encuentre  afiliado. l) Velar por el cuidado de las instalaciones de la Empresa, así como también  los equipos, muebles, enseres y demás elementos entregados para el cumplimiento  de sus funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los  planes de trabajo que se le indique, bien sea por escrito o por recomendaciones  verbales.- n).- Las demás funciones que se le indiquen oportunamente.-Segunda. Termino  inicial del contrato: La vigencia del presente contrato será hasta el " . $fechaFinText . " . Si antes de la fecha de vencimiento del término  estipulado, ninguna de las partes avisare por escrito a la otra su  determinación de no prorrogar el presente contrato con una antelación no  inferior a treinta (30) días calendario, este se entenderá renovado por un periodo  igual al inicialmente pactado y así sucesivamente. Este contrato podrá  prorrogarse hasta por tres (3) periodos iguales o inferiores, al cabo de los  cuales el término de renovación será de un año, y así sucesivamente, de acuerdo  con lo previsto en el articulo 46 de la Ley 50 de 1.990.- Tercera—Período de prueba.-Los primeros (2) dos meses del presente contrato se consideran como período de prueba y, por  consiguiente, cualquiera de las partes podrá terminar el contrato  unilateralmente, en cualquier momento durante dicho período. Vencido éste, la duración del contrato  será indefinida, mientras subsistan las causas que le dieron origen y la materia del trabajo.-Cuarta.- Incorporación de disposiciones.-Las partes declaran que en el  presente contrato se entienden incorporadas, en lo pertinente, las  disposiciones legales que regulan las relaciones entre la empresa y sus  trabajadores, en especial, las del contrato de trabajo para el oficio que se  suscribe, y  las obligaciones consignadas  en los reglamentos de trabajo y de higiene y seguridad industrial del  empleador, disposiciones que manifiesta conocer y se compromete a acatar. Quinta.- Remuneración.-El Empleador pagará al Trabajador por la  prestación de sus servicios bajo la modalidad arriba citada, la cual  será  pagadera en las oportunidades que  se indican en el encabezamiento de este contrato. Dentro de este pago se  encuentra incluida la remuneración de los descansos dominicales y festivos de  que tratan los capítulos I y II del título VII del Código Sustantivo del  Trabajo. Se aclara y se conviene que en los casos en los que El Trabajador  llegare a devengar comisiones o cualquiera otra modalidad de salario variable,  el 82.5% de dichos ingresos, constituye remuneración ordinaria, y el 17.5%  restante está destinado a remunerar el descanso en los días dominicales y  festivos de que tratan los capítulos I y II del título VII del Código  Sustantivo del Trabajo.-.-Sexta: No  constituye salario.— En atención a lo ordenado por el artículo 128 del  Código Sustantivo del Trabajo, modificado por el artículo 15 de la Ley 50 de 1990, las partes en  el presente contrato convienen de manera expresa que no constituyen salario las  sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o  llegue a recibir en el futuro adicional a su salario ordinario, el trabajador  del empleador, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador, tales como la alimentación, habitación o  vestuario, las primas extralegales, de vacaciones, de servicios o de navidad.  Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima.  Trabajo suplementario:—Todo trabajo suplementario o en horas extras y todo  trabajo en día domingo o festivo en los que legalmente debe concederse  descanso, se remunerará conforme a la ley, así como los correspondientes  recargos nocturnos. Para el reconocimiento y pago del trabajo suplementario,  dominical o festivo El Empleador o sus representantes deben autorizarlo  previamente por escrito. Cuando la necesidad de este trabajo se presente de  manera imprevista o inaplazable, deberá ejecutarse y darse cuenta de él por  escrito, a la mayor brevedad, al Empleador o a sus representantes. El Empleador,  en consecuencia, no reconocerá ningún trabajo suplementario o en días de  descanso legalmente obligatorio que no haya sido autorizado previamente o  avisado inmediatamente, como queda dicho. Octava.  — Jornada: El Trabajador se obliga a laborar la jornada ordinaria en los  turnos y dentro de las horas señaladas por El Empleador, pudiendo hacer éstos  ajustes o cambios de horario cuando lo estime conveniente. Conforme a lo  indicado en el articulo 25 de la   Ley 789 de 2.002, modificatorio del articulo 160 del C.S.T.,  el trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 22 horas (10  P.M.) y el trabajo nocturno es el comprendido entre las 22 Horas (10 P.M.) y  las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena- Justa Causa.- Son justas  causas para dar por terminado unilateralmente este contrato por cualquiera de  las partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y,  además, por parte del Empleador, el incumplimiento de las obligaciones señaladas  en la cláusula primera de este contrato, al igual que las faltas que para el  efecto se califiquen como graves en el espacio reservado para cláusulas  adicionales en el presente contrato. Décima.  Traslado de lugar.-.Las partes podrán convenir que el trabajo se preste  en lugar distinto del inicialmente contratado, siempre que tales traslados no  desmejoren las condiciones laborales o de remuneración del Trabajador, o  impliquen perjuicios para él. Los gastos que se originen con el traslado serán  cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del  Código Sustantivo del Trabajo. El Trabajador se obliga a aceptar los cambios de  oficio que decida El Empleador dentro de su poder subordinante, siempre que se  respeten las condiciones laborales del Trabajador y no se le causen perjuicios.  Todo ello sin que se afecte el honor, la dignidad y los derechos mínimos del  Trabajador, de conformidad con el artículo 23 del Código Sustantivo del  Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. Décima primera.Buena  fe Contractual Este contrato ha sido redactado estrictamente de acuerdo con  la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con  el Código Sustantivo del Trabajo, cuyo objeto, definido en su artículo 1º, es  lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de  un espíritu de coordinación económica y equilibrio social. Duodécima.—Cláusula  Arbitral: Teniendo como sustento la convención colectiva suscrita por el  empleador con sus trabajadores y el articulo 51 de la Ley 712 del 2.001,  modificatoria del articulo 131 del Código Procesal del Trabajo, las partes  determinan de común acuerdo que las Controversias que se presenten, relativas a  conflictos jurídicos laborales, jurídicos económicos del trabajo,  reconocimiento de derechos inciertos y discutibles, relativos a: salarios,  prestaciones sociales, descansos, pagos indemnizatorios, sanciones,  pagos   no saláriales,  derivados de este  contrato, y que resultaren sobre la naturaleza e interpretación del presente  contrato se resolverá  por un tribunal de  arbitramento, conformado por tres (3) árbitros que deberán ser abogados,  designados por la cámara de comercio del lugar donde se desarrollo el contrato,  el cual se sujetara a los dispuesto por el decreto 2279 de 1.989; ley 23 de  1.991; Decreto 2651 de 1.991, y demás normas que lo modifiquen o reglamenten, y  su fallo, en derecho, obligara a las partes. Décima  tercera -.  Confidencialidad-. Las partes aquí intervinientes han acordado  proteger la información confidencial suministrada y/o compartida entre las  partes derivadas del presente contrato, y como tal, no debe darse a conocer a  ninguna persona ajena al presente acuerdo. Por &quot;Información Confidencial; se entenderá aquella información relativa  al negocio cualquiera de los intervinientes en este contrato y/o cualquier  comunicación oral o escrita, que otorgue una ventaja competitiva en caso de  conocimiento por terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación. ");
            }

            foreach ($resulConsulta as $valor) {

//                $consultaLogContrato = $this->consultarLogContrato($req, $valor['cod_empl'], $empInt, $perSal, $tipContra, $logo, $fechaFin);
//
//                if ($consultaLogContrato == 0) {
//                    $resulRegLog = $this->registrarLogContrato($req, $valor['cod_empl'], $idUserCreo, $empInt, $perSal, $tipContra, $logo, $fechaFin);
//                }
//
//                if ($resulRegLog == null) {
//                    $flgError = true;
//                }
//
//                if ($flgError == false) {
//
//                    $idContrato = $gestionDatos->consultarSeqLogContrato();
//
//                    $idUser = $valor['cod_empl'];
//                    $municipio = $gestionDatos->consultarMunicipio($empInt, $req, $idUser);
//                    $mpiCont = $valor['MPI_CONT'];
//                    $datosSuc = $gestionDatos->consultarSucursal($mpiCont);
//
//                    $deptoNaci = $gestionDatos->consultaMpio($valor['pai_naci'], $valor['dto_naci']);
//                    $ciudadNaci = $gestionDatos->consultaMpio($valor['pai_naci'], $valor['dto_naci'], $valor['mpi_naci']);
//
//                    $deptoResi = $gestionDatos->consultaMpio($valor['pai_resi'], $valor['dto_resi']);
//                    $ciudadResi = $gestionDatos->consultaMpio($valor['pai_resi'], $valor['dto_resi'], $valor['mpi_resi']);
//
//                    $pdf->AddPage();
//                    $fecha = date('d-m-Y');
//                    $pdf->SetFont('Times', 'B', 8);
//
//                     if ($logo != '' && $logo != 'sin') {
//
//                        if ($empInt == 3) {
//
//                            $pdf->Image($imgsrc, 10, 8, 15);
//                            
//                        } else {
//
//                            $pdf->Image($imgsrc, 10, 8, 33);
//                        }
//                    }
//
//                    if ($tipContra == 'obra') {
//                        $pdf->Cell(180, 10, 'CONTRATO DE TRABAJO POR EL TIEMPO', 0, 0, 'C');
//                    }
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(180, 10, ' ' . $titulo . ' ', 0, 0, 'C');
//                    $pdf->Cell(10, 10, '# Contrato:' . $idContrato . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(0, 10, 'NIT.890311.341-0 ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Nombre del Empleador:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, 'LISTOS S.A.S', 0, 0, 'L');
//                    $pdf->Cell(50, 10, 'NIT del Empleador:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, 'NIT.890311.341-0 ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Domicilio del Empleador:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . $datosSuc[0]['suc_direccion'] . ' ', 0, 0, 'L');
//                    $pdf->Cell(50, 10, 'Ciudad:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, '' . $datosSuc[0]['suc_nombre'] . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Telefono:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, '' . $datosSuc[0]['suc_telefono'] . '', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//
//                    $pdf->Cell(50, 10, 'Nombre del trabajador:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . trim($valor['nom_empl']) . " " . trim($valor['ape_empl']) . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//
//                    $pdf->Cell(50, 10, 'Identificacion:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . trim($valor['cod_empl']) . ' de ' . trim($municipio) . ' ', 0, 0, 'L');
//                    $pdf->Cell(50, 10, 'Libreta militar:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . trim($valor['num_lmil']) . " Dto " . trim($valor['dis_lmil']) . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Lugar y fecha de nacimiento:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . trim(substr($valor['fec_naci'], 8, 2)) . "/" . trim(substr($valor['fec_naci'], 5, 2)) . "/" . trim(substr($valor['fec_naci'], 0, 4)) . "  " . trim($deptoNaci) . " " . trim($ciudadNaci) . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Direccion del Trabajador:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . trim($valor['dir_resi']) . " " . trim($valor['bar_resi']) . ' ', 0, 0, 'L');
//                    $pdf->Ln(5);
//
//                    $pdf->Cell(50, 10, 'Ciudad:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . trim($deptoResi) . "  (" . trim($ciudadResi) . ' ', 0, 0, 'L');
//                    $pdf->Ln(5);
//
//                    $pdf->Cell(50, 10, 'Telefono:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . $valor['tel_resi'] . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Afiliacion:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, 'ARP:BOLIVAR', 0, 0, 'L');
//
//                    $codigoAfp = $valor['COD_EAFP'];
//                    $codigoEps = $valor['COD_EEPS'];
//
//                    $nomAfp = $gestionDatos->consultaSeguridadSocial($empInt, $codigoAfp, "AFP");
//                    $nomEps = $gestionDatos->consultaSeguridadSocial($empInt, $codigoEps, "EPS");
//
//                    $pdf->Cell(50, 10, 'AFP: ' . trim($nomAfp) . ' ', 0, 0, 'L');
//
//                    $pdf->Cell(50, 10, 'EPS: ' . trim($nomEps) . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Empresa usuaria:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . $valor['NOM_CLIE'] . ' ', 0, 0, 'L');
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Labor Contratada:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . $valor['nom_carg'] . ' ', 0, 0, 'L');
//
//                    if ($tipContra == 'inferior') {
//
//                        $fechaFin2 = explode("/", $fechaFin);
//                        $año = $fechaFin2[0];
//                        $mes = $fechaFin2[1];
//                        $dia = $fechaFin2[2];
//                        $fechaFinText = $utilidades->fechatextual($dia, $mes, $año);
//                    }
//
//                    $fechaIn = $valor['FEC_INGL'];
//                    //$fechaIni = strtotime($fecha);
//                    $fechaIni = explode("-", $fechaIn);
//
//                    $anoIni = $fechaIni[0];
//                    $mesIni = $fechaIni[1];
//                    $diaIni = substr($fechaIni[2], 0, 2);
//
//                    $fechaIniText = $utilidades->fechatextual($diaIni, $mesIni, $anoIni);
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Fecha inicio:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' ' . $fechaIniText . ' ', 0, 0, 'L');
//
//                    $salario = explode(".", number_format($valor['SAL_CONT']), 4);
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Salario:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, ' $' . $salario[0] . trim(".") . ' ' . trim($salario[1]) . ' ', 0, 0, 'L');
//
//                    if ($perSal == 'hora') {
//
//                        $pdf->Cell(50, 10, 'Hora(X)', 0, 0, 'L');
//                    }
//
//                    if ($perSal == 'diario') {
//
//                        $pdf->Cell(50, 10, 'Diario(X)', 0, 0, 'L');
//                    }
//
//                    if ($perSal == 'mensual') {
//
//                        $pdf->Cell(50, 10, 'Mes(X)', 0, 0, 'L');
//                    }
//
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Adicionales:', 0, 0, 'L');
//                    $pdf->Cell(50, 10, '' . $adicional . ' ', 0, 0, 'L');
//                    $pdf->Ln(5);
//                    $pdf->Cell(50, 10, 'Periodos de pagos:', 0, 0, 'L');
//
//                    if ($valor['COD_GPRO'] == 23 || $valor['COD_GPRO'] == 36 || $valor['COD_GPRO'] == 12 || $valor['COD_GPRO'] == 24 || $valor['COD_GPRO'] == 37 || $valor['COD_GPRO'] == 21 || $valor['COD_GPRO'] == 28 || $valor['COD_GPRO'] == 22 || $valor['COD_GPRO'] == 33) {
//
//                        $pdf->Cell(50, 10, 'Semanal (X)', 0, 0, 'L');
//                    }
//
//                    if ($valor['COD_GPRO'] == 2 || $valor['COD_GPRO'] == 13) {
//
//                        $pdf->Cell(50, 10, 'Decadal (X)', 0, 0, 'L');
//                    }
//
//                    if ($valor['COD_GPRO'] == 5 or $valor['COD_GPRO'] == 4 or $valor['COD_GPRO'] == 16 or $valor['COD_GPRO'] == 29 or $valor['COD_GPRO'] == 34 or $valor['COD_GPRO'] == 44 or $valor['COD_GPRO'] == 8 or $valor['COD_GPRO'] == 19 or $valor['COD_GPRO'] == 30 or $valor['COD_GPRO'] == 35 or $valor['COD_GPRO'] == 48 or $valor['COD_GPRO'] == 9 or $valor['COD_GPRO'] == 20 or $valor['COD_GPRO'] == 31 or $valor['COD_GPRO'] == 42 or $valor['COD_GPRO'] == 15 or $valor['COD_GPRO'] == 25 or $valor['COD_GPRO'] == 32 or $valor['COD_GPRO'] == 43) {
//
//                        $pdf->Cell(50, 10, 'Quincenal (X)', 0, 0, 'L');
//                    }
//
//                    if ($valor['COD_GPRO'] == 11 or $valor['COD_GPRO'] == 27 or $valor['COD_GPRO'] == 41 or $valor['COD_GPRO'] == 6 or $valor['COD_GPRO'] == 17 or $valor['COD_GPRO'] == 38 or $valor['COD_GPRO'] == 46 or $valor['COD_GPRO'] == 7 or $valor['COD_GPRO'] == 18 or $valor['COD_GPRO'] == 39 or $valor['COD_GPRO'] == 10 or $valor['COD_GPRO'] == 26 or $valor['COD_GPRO'] == 40) {
//
//                        $pdf->Cell(50, 10, 'Mensual (X)', 0, 0, 'L');
//                    }
//
//                    if ($tipContra == 'inferior') {
//
//                        $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.—Obligaciones: El Empleador contrata los  servicios personales del Trabajador y éste se obliga:  a) A poner al servicio del Empleador toda su  capacidad normal de trabajo, en forma exclusiva en el desempeño de las  funciones propias del oficio mencionado y en las labores anexas y  complementarias del mismo, de conformidad con las órdenes e instrucciones que  le imparta El Empleador o sus representantes,   b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el  lugar tiempo y necesidades del servicio.- c) Observar rigurosamente la  disciplina interna establecida por el empleador y las persona autorizadas por  ella.- d) A no prestar directa ni indirectamente servicios laborales a otros  Empleadores, ni a trabajar por cuenta propia en el mismo oficio, durante la  vigencia de este contrato, so pena de recibir sanciones disciplinarias y  legales que la norma laboral faculta al empleador.- e) Informar al empleador  oportunamente y por escrito, el cambio de su domicilio que será el lugar donde  recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar la jornada  ordinaria, en los turnos y dentro de las horas señaladas por el empleador o sus  representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando  lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán  repartirse las horas de la jornada ordinaria, en la forma prevista en el  articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre  las secciones de la jornada, no se computan dentro de la misma, según el  articulo 167 ibidem. g) Cuidar permanentemente los intereses del empleador. h)  Programar diariamente su trabajo y asistir puntualmente a las reuniones que  efectúe  el empleador a las cuales hubiere  sido citado. i). —Observar completa armonía y comprensión con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador. k) A presentar dentro&nbsp; de las 48 horas siguientes ante el  empleador, la justificación de su ausencia al puesto de trabajo causado por la  incapacidad medica, certificada&nbsp; por el medico adscrito a la EPS donde se encuentre  afiliado. l) Velar por el cuidado de las instalaciones de la Empresa, así como también  los equipos, muebles, enseres y demás elementos entregados para el cumplimiento  de sus funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los  planes de trabajo que se le indique, bien sea por escrito o por recomendaciones  verbales.- n).- Las demás funciones que se le indiquen oportunamente.-Segunda. Termino  inicial del contrato: La vigencia del presente contrato será hasta el " . $fechaFinText . " . Si antes de la fecha de vencimiento del término  estipulado, ninguna de las partes avisare por escrito a la otra su  determinación de no prorrogar el presente contrato con una antelación no  inferior a treinta (30) días calendario, este se entenderá renovado por un periodo  igual al inicialmente pactado y así sucesivamente. Este contrato podrá  prorrogarse hasta por tres (3) periodos iguales o inferiores, al cabo de los  cuales el término de renovación será de un año, y así sucesivamente, de acuerdo  con lo previsto en el articulo 46 de la Ley 50 de 1.990.- Tercera—Período de prueba.-Los primeros (2) dos meses del presente contrato se consideran como período de prueba y, por  consiguiente, cualquiera de las partes podrá terminar el contrato  unilateralmente, en cualquier momento durante dicho período. Vencido éste, la duración del contrato  será indefinida, mientras subsistan las causas que le dieron origen y la materia del trabajo.-Cuarta.- Incorporación de disposiciones.-Las partes declaran que en el  presente contrato se entienden incorporadas, en lo pertinente, las  disposiciones legales que regulan las relaciones entre la empresa y sus  trabajadores, en especial, las del contrato de trabajo para el oficio que se  suscribe, y  las obligaciones consignadas  en los reglamentos de trabajo y de higiene y seguridad industrial del  empleador, disposiciones que manifiesta conocer y se compromete a acatar. Quinta.- Remuneración.-El Empleador pagará al Trabajador por la  prestación de sus servicios bajo la modalidad arriba citada, la cual  será  pagadera en las oportunidades que  se indican en el encabezamiento de este contrato. Dentro de este pago se  encuentra incluida la remuneración de los descansos dominicales y festivos de  que tratan los capítulos I y II del título VII del Código Sustantivo del  Trabajo. Se aclara y se conviene que en los casos en los que El Trabajador  llegare a devengar comisiones o cualquiera otra modalidad de salario variable,  el 82.5% de dichos ingresos, constituye remuneración ordinaria, y el 17.5%  restante está destinado a remunerar el descanso en los días dominicales y  festivos de que tratan los capítulos I y II del título VII del Código  Sustantivo del Trabajo.-.-Sexta: No  constituye salario.— En atención a lo ordenado por el artículo 128 del  Código Sustantivo del Trabajo, modificado por el artículo 15 de la Ley 50 de 1990, las partes en  el presente contrato convienen de manera expresa que no constituyen salario las  sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o  llegue a recibir en el futuro adicional a su salario ordinario, el trabajador  del empleador, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador, tales como la alimentación, habitación o  vestuario, las primas extralegales, de vacaciones, de servicios o de navidad.  Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima.  Trabajo suplementario:—Todo trabajo suplementario o en horas extras y todo  trabajo en día domingo o festivo en los que legalmente debe concederse  descanso, se remunerará conforme a la ley, así como los correspondientes  recargos nocturnos. Para el reconocimiento y pago del trabajo suplementario,  dominical o festivo El Empleador o sus representantes deben autorizarlo  previamente por escrito. Cuando la necesidad de este trabajo se presente de  manera imprevista o inaplazable, deberá ejecutarse y darse cuenta de él por  escrito, a la mayor brevedad, al Empleador o a sus representantes. El Empleador,  en consecuencia, no reconocerá ningún trabajo suplementario o en días de  descanso legalmente obligatorio que no haya sido autorizado previamente o  avisado inmediatamente, como queda dicho. Octava.  — Jornada: El Trabajador se obliga a laborar la jornada ordinaria en los  turnos y dentro de las horas señaladas por El Empleador, pudiendo hacer éstos  ajustes o cambios de horario cuando lo estime conveniente. Conforme a lo  indicado en el articulo 25 de la   Ley 789 de 2.002, modificatorio del articulo 160 del C.S.T.,  el trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 22 horas (10  P.M.) y el trabajo nocturno es el comprendido entre las 22 Horas (10 P.M.) y  las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena- Justa Causa.- Son justas  causas para dar por terminado unilateralmente este contrato por cualquiera de  las partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y,  además, por parte del Empleador, el incumplimiento de las obligaciones señaladas  en la cláusula primera de este contrato, al igual que las faltas que para el  efecto se califiquen como graves en el espacio reservado para cláusulas  adicionales en el presente contrato. Décima.  Traslado de lugar.-.Las partes podrán convenir que el trabajo se preste  en lugar distinto del inicialmente contratado, siempre que tales traslados no  desmejoren las condiciones laborales o de remuneración del Trabajador, o  impliquen perjuicios para él. Los gastos que se originen con el traslado serán  cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del  Código Sustantivo del Trabajo. El Trabajador se obliga a aceptar los cambios de  oficio que decida El Empleador dentro de su poder subordinante, siempre que se  respeten las condiciones laborales del Trabajador y no se le causen perjuicios.  Todo ello sin que se afecte el honor, la dignidad y los derechos mínimos del  Trabajador, de conformidad con el artículo 23 del Código Sustantivo del  Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. Décima primera.Buena  fe Contractual Este contrato ha sido redactado estrictamente de acuerdo con  la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con  el Código Sustantivo del Trabajo, cuyo objeto, definido en su artículo 1º, es  lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de  un espíritu de coordinación económica y equilibrio social. Duodécima.—Cláusula  Arbitral: Teniendo como sustento la convención colectiva suscrita por el  empleador con sus trabajadores y el articulo 51 de la Ley 712 del 2.001,  modificatoria del articulo 131 del Código Procesal del Trabajo, las partes  determinan de común acuerdo que las Controversias que se presenten, relativas a  conflictos jurídicos laborales, jurídicos económicos del trabajo,  reconocimiento de derechos inciertos y discutibles, relativos a: salarios,  prestaciones sociales, descansos, pagos indemnizatorios, sanciones,  pagos   no saláriales,  derivados de este  contrato, y que resultaren sobre la naturaleza e interpretación del presente  contrato se resolverá  por un tribunal de  arbitramento, conformado por tres (3) árbitros que deberán ser abogados,  designados por la cámara de comercio del lugar donde se desarrollo el contrato,  el cual se sujetara a los dispuesto por el decreto 2279 de 1.989; ley 23 de  1.991; Decreto 2651 de 1.991, y demás normas que lo modifiquen o reglamenten, y  su fallo, en derecho, obligara a las partes. Décima  tercera -.  Confidencialidad-. Las partes aquí intervinientes han acordado  proteger la información confidencial suministrada y/o compartida entre las  partes derivadas del presente contrato, y como tal, no debe darse a conocer a  ninguna persona ajena al presente acuerdo. Por &quot;Información Confidencial; se entenderá aquella información relativa  al negocio cualquiera de los intervinientes en este contrato y/o cualquier  comunicación oral o escrita, que otorgue una ventaja competitiva en caso de  conocimiento por terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación. ");
//                    } elseif ($tipContra == 'obra') {
//
//                        $parrafo = utf8_decode("Entre El Empleador y El Trabajador, de las  condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha  celebrado el presente contrato individual de trabajo, regido además por las  siguientes cláusulas: Primera.Obligaciones:El Empleador contrata los servicios  personales del Trabajador y éste se obliga:   a) A poner al servicio del Empleador toda su capacidad normal de  trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio  mencionado y en las labores anexas y complementarias del mismo, de conformidad  con las órdenes e instrucciones que le imparta El Empleador o sus  representantes,  b) Cumplir con sus  obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades  del servicio.- c) Observar rigurosamente la disciplina interna establecida por  el empleador y las persona autorizadas por ella.- d) A no prestar directa ni  indirectamente servicios laborales a otros Empleadores, ni a trabajar por  cuenta propia en el mismo oficio, durante la vigencia de este contrato, so pena  de recibir sanciones disciplinarias y legales que la norma laboral faculta al  empleador.- e) Informar al empleador oportunamente y por escrito, el cambio de  su domicilio que será el lugar donde recibirá las notificaciones de que habla la Ley 789 de 2.002.- f) Laborar  la jornada ordinaria, en los turnos y dentro de las horas señaladas por el  empleador o sus representantes, pudiendo hacer éstos los ajustes o cambios de  horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las  partes, podrán repartirse las horas de la jornada ordinaria, en la forma  prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de  descanso entre las secciones de la jornada, no se computan dentro de la misma,  según el articulo 167 ibidem. g) Cuidar permanentemente los intereses del  empleador y la empresa cliente. h) Programar diariamente su trabajo y asistir  puntualmente a las reuniones que efectúe   el empleador o la empresa cliente a las cuales hubiere sido citado. i).  Observar completa armonía y comprensión con los clientes, con sus superiores y  compañeros de trabajo, en sus relaciones personales y en la ejecución de su  labor. j) Cumplir permanentemente con espíritu de lealtad, colaboración y  disciplina con el empleador y la empresa cliente. k) A presentar  dentro&nbsp; de las 48 horas siguiente ante el empleador, la justificación de  su ausencia al puesto de trabajo causado por la incapacidad medica,  certificada&nbsp; por el medico adscrito a la EPS donde se encuentre afiliado. l) Velar por el  cuidado de las instalaciones de la Empresa Usuaria, así como también los equipos,  muebles, enseres y demás elementos entregados para el cumplimiento de sus  funciones, con el fin de evitar daños y extravíos.- m).- Cumplir con los planes  de trabajo que se indique por parte de Listos S.A. o de la Empresa Usuaria,  bien sea por escrito o por recomendaciones verbales.- n).- Las demás funciones  que se le indiquen oportunamente.Segunda.—Duración.- El presente contrato tendrá  como duración el tiempo que dure la  realización de la obra o labor contratada arriba señalada, la cual durara por el tiempo  estrictamente necesario solicitado al Empleador   por la Empresa   Usuaria. En consecuencia, este contrato termina en el momento  en que la Empresa   Usuaria comunique al Empleador que ha dejado de requerir los  servicios de El Trabajador sin que el Empleador tenga que reconocerle  indemnización alguna. Tercera.- Período de prueba Los primeros sesenta días de vigencia  del presente contrato se consideran como período de prueba y, por consiguiente,  cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier  momento durante dicho período. Vencido éste, la duración del contrato será por  el tiempo que dure la realización de la obra o labor contratada  arriba señalada, es decir mientras subsistan  las causas que le dieron origen y la materia del trabajo.- Cuarta.- Incorporación  de disposiciones.- Las partes declaran que en el presente contrato  se entienden incorporadas, en lo pertinente, las disposiciones legales que  regulan las relaciones entre la empresa y sus trabajadores, en especial, las  del contrato de trabajo para el oficio que se suscribe, y  las obligaciones consignadas en los  reglamentos de trabajo y de higiene y seguridad industrial del empleador y de la Empresa Usuaria, disposiciones  que manifiesta conocer y se compromete a acatar. Quinta.-  Remuneración. El Empleador pagará al Trabajador por la prestación  de sus servicios bajo la modalidad arriba citada, la cual será  pagadera en las oportunidades que se indican  en el encabezamiento de este contrato. Dentro de este pago se encuentra  incluida la remuneración de los descansos dominicales y festivos de que tratan  los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se  aclara y se conviene que en los casos en los que El Trabajador llegare a  devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5%  de dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está  destinado a remunerar el descanso en los días dominicales y festivos de que  tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.-Sexta.-No constituye salario.— En  atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo,  modificado por el artículo 15 de la   Ley 50 de 1990, las partes en el presente contrato convienen  de manera expresa que no constituyen salario las sumas en dinero o en especie  que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el  futuro adicional a su salario ordinario, el trabajador del empleador o de la  empresa cliente, como propinas, primas, bonificaciones o gratificaciones  ocasionales, participación de utilidades, y lo que recibe en dinero o en  especie no para su beneficio como  ayudas  o auxilios habituales u ocasionales, tales como alimentación, o vestuario,  bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del  contrato de trabajo, ni aquellos que se hacen, no para enriquecer su  patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de  representación, medios de transporte, elementos de trabajo y otros semejantes.  Tampoco constituyen salario las prestaciones sociales de que tratan los títulos  VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios  habituales u ocasionales acordados convencional o contractualmente u otorgados  en forma extralegal por el empleador o de la empresa cliente, tales como la  alimentación, habitación o vestuario, las primas extralegales, de vacaciones,  de servicios o de navidad. Igualmente y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos  aquí señalados, que no constituyen salario no hacen parte de la base para  liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA,  Instituto Colombiano de Bienestar Familiar, ICBF, Escuela Superior de  Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a  la seguridad social establecidas por la   Ley 100 de 1993.- Séptima. Trabajo suplementario: —Todo trabajo suplementario o en horas extras y todo trabajo en día  domingo o festivo en los que legalmente debe concederse descanso, se remunerará  conforme a la ley, así como los correspondientes recargos nocturnos. Para el  reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo previamente por escrito.  Cuando la necesidad de este trabajo se presente de manera imprevista o  inaplazable, deberá ejecutarse y darse cuenta de él por escrito, a la mayor  brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia,  no reconocerá ningún trabajo suplementario o en días de descanso legalmente  obligatorio que no haya sido autorizado previamente o avisado inmediatamente,  como queda dicho. Octava. — Jornada: El Trabajador se obliga a laborar la  jornada ordinaria en los turnos y dentro de las horas señaladas por El  Empleador o por la empresa cliente, pudiendo hacer éstos ajustes o cambios de  horario cuando lo estime conveniente. Conforme a lo indicado en el articulo 25  de la Ley 789 de  2.002, modificatorio del articulo 160 del C.S.T., el trabajo ordinario será el  que se realiza entre las 6 Horas (6   A.M.) y las 22 horas (10 P.M.) y el trabajo nocturno es  el comprendido entre las 22 Horas (10 P.M.) y las 6 Horas (6  A.M.). Parágrafo Primero: Conforme lo  indicado por la Ley Laboral,  el empleador y el trabajador podrán acordar temporal o indefinidamente la  organización de turnos de trabajo sucesivos que permitan operar a la empresa o  secciones de la misma sin solución de continuidad durante todos los días de la  semana, siempre y cuando el respectivo turno no exceda de 6 horas al día y 36 a la semana. Parágrafo  segundo: El empleador y el trabajador, podrán acordar que la  jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas  diarias flexibles de trabajo, distribuidas en máximo 6 días a la semana con un  día de descanso obligatorio, que podrá coincidir con el domingo. En este, el  numero de horas de trabajo diario podrá repartirse de manera variable durante  la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y hasta  diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,  cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho  (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 10 P.M. Novena— Justa Causa.- Son justas causas  para dar por terminado unilateralmente este contrato por cualquiera de las  partes, las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además,  por parte del Empleador, el incumplimiento de las obligaciones señaladas en la  cláusula primera de este contrato, al igual que las faltas que para el efecto  se califiquen como graves en el espacio reservado para cláusulas adicionales en  el presente contrato. Décima. Traslado de lugar.-.Las partes podrán convenir que  el trabajo se preste en lugar distinto del inicialmente contratado, siempre que  tales traslados no desmejoren las condiciones laborales o de remuneración del  Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el  traslado serán cubiertos por El Empleador de conformidad con el numeral 8º del  artículo 57 del Código Sustantivo del Trabajo. El Trabajador se obliga a  aceptar los cambios de oficio que decida El Empleador dentro de su poder  subordinante, siempre que se respeten las condiciones laborales del Trabajador  y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad  y los derechos mínimos del Trabajador, de conformidad con el artículo 23 del  Código Sustantivo del Trabajo, modificado por el artículo 1º de la Ley 50 de 1990. décima  Primero. Buena  fe Contractual—Este contrato ha sido redactado estrictamente de  acuerdo con la ley y la jurisprudencia y será interpretado de buena fe y en  consonancia con el Código Sustantivo del Trabajo, cuyo objeto, definido en su  artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores  dentro de un espíritu de coordinación económica y equilibrio social. Duodécima.Cláusula Arbitral:  Teniendo como sustento la convención colectiva suscrita por el empleador con  sus trabajadores y el articulo 51 de la   Ley 712 del 2.001, modificatoria del articulo 131 del Código  Procesal del Trabajo, las partes determinan de común acuerdo que las  Controversias que se presenten, relativas a conflictos jurídicos laborales,  jurídicos económicos del trabajo, reconocimiento de derechos inciertos y discutibles,  relativos a: salarios, prestaciones sociales, descansos, pagos indemnizatorios,  sanciones,  pagos  no saláriales,  derivados de este contrato, y que resultaren  sobre la naturaleza e interpretación del presente contrato se resolverá  por un tribunal de arbitramento, conformado  por tres (3) árbitros que deberán ser abogados, designados por la cámara de  comercio del lugar donde se desarrollo el contrato, el cual se sujetara a los  dispuesto por el decreto 2279 de 1.989; ley 23 de 1.991; Decreto 2651 de 1.991,  y demás normas que lo modifiquen o reglamenten, y su fallo, en derecho,  obligara a las partes. Décima Tercera-. Confidencialidad.  Las partes aquí intervinientes han acordado proteger la información  confidencial suministrada y/o compartida entre las partes derivadas del  presente contrato, y como tal, no debe darse a conocer a ninguna persona ajena  al presente acuerdo. Por Información  Confidencial; se entenderá aquella información relativa al negocio  cualquiera de los intervinientes en este contrato y/o cualquier comunicación  oral o escrita, que otorgue una ventaja competitiva en caso de conocimiento por  terceras personas ajenas a este acuerdo.-Décima Cuarta: Deducciones. Cuando por causa  emanada directa o indirectamente de la relación contractual existan  obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del  Empleador, éste procederá a efectuar las deducciones a que hubiere lugar en  cualquier tiempo y, más concretamente, a la terminación del presente contrato,  así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las  partes que la presente autorización cumple las condiciones de orden escrita  previa, aplicable para cada caso. Para constancia se firma en dos ejemplares del  mismo tenor y valor, en la ciudad y fecha que se indican a continuación.");
//                    }
//
//                    $pdf->Ln(10);
//                    $pdf->SetFont('Times', '', 9);
//                    $pdf->MultiCell(0, 4, $parrafo);
//                    
//                    $fechaMod = explode("-", $fecha);
//                    $año = $fechaMod[2];
//                    $mes = $fechaMod[1];
//                    $dia = $fechaMod[0];
//                    $fechaFinAux = $utilidades->fechatextual($dia, $mes, $año);
//
//                    $pdf->Cell(0, 10, $fechaFinAux, 0, 0, 'R');
//
//                    $pdf->Ln(20);
//                    $pdf->Cell(50, 6, '', 'B', 0, 'L');
//                    $pdf->Cell(75, 6, '', 0, 0, 'L');
//                    //$pdf->Cell(50, 6, '', 0, 0, 'L');
//                    $pdf->Cell(60, 6, '', 'B', 1, 'L');
//                    $pdf->Cell(50, 6, 'El empleador', 0, 0, 'L');
//                    $pdf->Cell(75, 6, '', 0, 0, 'L');
//                    $pdf->Cell(50, 6, 'El trabajador', 0, 1, 'L');
//                    $pdf->Cell(50, 6, '', 0, 0, 'L');
//                    $pdf->Cell(75, 6, '', 0, 0, 'L');
//                    $pdf->Cell(50, 6, 'C.C: ' . $valor['cod_empl'] . ' ', 0, 1, 'L');
//                } else {
//
//                    return "-1";
//                }
                
                //}
                //Fin Creacion Contrato
               
                //Inicio carta informativa
                $pdf->AddPage();
                $fecha = date('d-m-Y');
                $ciduade = 'Cali';

                // foreach ($resulConsulta as $valor) {

                $texto1 = utf8_decode("INFORMACIÓN IMPORTANTE");
                $parrafo = utf8_decode("Se le informa al trabajador contratado que para darle cumplimiento a lo ordenado en el articulo 57 Numerial 7 de C.S.T, al  finalizar la  relacion  contractual que lo une a la empresa, puede solicitar la práctica del examen médico de egreso dentro de los cinco (5) días siguientes a la conclusión de la misma, para lo cual deberá presentarse en la sede de la compañia " . trim(odbc_result($rs_consulta, "nom_empr")) . " a fin de reclamar la  orden  correspondiente para asistir ante el médico que ésta designe. Vencido dicho término,  se  entenderá su renuncia a este derecho, o si entregada la  ordén Usted no concurre a la práctica del referido examen");
                $fecha = date('d-m-Y');

                $pdf->SetFont('Times', 'B', 10);
                $pdf->Cell(0, 20, 'Ciudad y Fecha : ' . $ciduade . ' ' . $fecha . ' ', 0, 0, 'L');
                $pdf->Ln(5);
                $pdf->Cell(0, 20, '' . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . ' ', 0, 0, 'L');
                $pdf->Ln(5);
                $pdf->Cell(0, 20, 'Identificado con la cedula de ciudadania: ' . trim($valor['cod_empl']) . ' ', 0, 0, 'L');
                $pdf->Ln(10);
                $pdf->Cell(0, 20, ' ' . $texto1 . ' ', 0, 0, 'C');
                $pdf->Ln(20);
                $pdf->SetFont('Times');
                $pdf->Write(5, '' . $parrafo . '');
                $pdf->Ln(20);
                $pdf->Cell(0, 20, 'Firma del trabajador enterado:_________________________', 0, 0, 'L');
                $pdf->Ln(5);
                $pdf->Cell(0, 20, 'C.C:' . trim($valor['cod_empl']) . ' ', 0, 0, 'L');
                $pdf->Ln(70);
                //}
                //Fin carta informativa
                
                //Inicio certificado de induccion
                
                if ($empInt == 1) {

                    $imgsrc = "../../libs/imagenes/logos/logo_head1.JPG";
                }

                if ($empInt == 2) {

                    $imgsrc = "../../libs/imagenes/logos/Logo_Tercerizar.png";
                }

                if ($empInt == 3) {
                    $imgsrc = "../../libs/imagenes/logos/logo-vm.png";
                }

                $fecha = date('d-m-Y');
                $ciduade = 'Cali';

                //foreach ($resulConsulta as $valor) {

            $pdf->AddPage();
            $codClie = $resulConsulta[0]['COD_CLIE'];

            if ($idUser == '') {

                $idUser = $valor['COD_EMPL'];
            }

            $municipio = $gestionDatos->consultarMunicipio($empInt, $req, $idUser);
            //$cliente = $gestionDatos->consultarCliente($empInt, $codClie);

            $fecha = date('d-m-Y');

            $pdf->SetFont('Times', 'B', 8);

            $parrafo = utf8_decode("Yo " . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . " Identificado con la cédula de ciudadanía No: " . trim($valor['cod_empl']) . " de " . trim($municipio) . " Certifico que recibí inducción sobre:");

            $linea1 = utf8_decode("1.La labor que voy a desempeñar");
            $linea2 = utf8_decode("2.Riesgos y medidas preventivas a tomar en dicha labor y los elementos de proteccion personal que debo usar.");
            $linea3 = utf8_decode("3.El procedimiento a seguir con los accidentes de trabajo y enfermedades laborales en caso de presentarse.");
            $linea4 = utf8_decode("4.Reglamento de higiene y seguridad industrial y politica integral de gestión.");
            $linea5 = utf8_decode("5.Los servicios y beneficios que presta la EPS(Entidad promotora de salud),ARL(Administradora de riesgos laborales) y la caja de compensación");
            $linea6 = utf8_decode("Recibí copias de afiliación a:");
            
              if ($empInt == 3) {

                $pdf->Image($imgsrc, 10, 8, 15);

            } else {

                $pdf->Image($imgsrc, 10, 8, 33);
            }    

//            $pdf->Image($imgsrc, 10, 8, 33);
            $pdf->Cell(190, 10, 'Proceso', 0, 0, 'C');
//            $pdf->Cell(5, 10, 'Codigo:FO-REC-13', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(190, 10, 'Bienestar y Capacitacion', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(190, 10, 'Certificado de induccion', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, 'Ciudad y Fecha : ' . $ciduade . ' ' . $fecha . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Write(5, '' . $parrafo . '');
            $pdf->Ln();
            $pdf->Cell(0, 6, ' ' . $linea1 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea2 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea3 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea4 . ' ', 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, ' ' . $linea5 . ' ', 0, 0, 'L');
            $pdf->Ln(8);
            $pdf->Cell(0, 6, ' ' . $linea6 . ' ', 0, 0, 'L');
            $pdf->Ln(10);
            $pdf->Cell(35, 3, 'E.P.S:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(20, 3, 'A.R.L:', 0, 0, 'C');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(20, 3, 'A.F.P:', 0, 0, 'C');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(35, 3, 'Carnet de la empresa:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(35, 3, 'Carnet de la A.R.L:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(35, 3, 'Formato bienvenida:', 0, 0, 'L');
            $pdf->Cell(10, 3, 'SI:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 0, 'L');
            $pdf->Cell(5, 3, '', 0, 0, 'L');
            $pdf->Cell(10, 3, 'NO:', 0, 0, 'L');
            $pdf->Cell(5, 3, '', 1, 1, 'L');
            $pdf->Ln(2);
            $pdf->Cell(0, 6, 'Atentamente', 0, 0, 'C');
            $pdf->Ln(12);
            $pdf->Cell(0, 6, '___________________________________', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(0, 6, 'Firma del trabajador', 0, 1, 'C');
            $pdf->Cell(0, 6, 'C.C: ' . $valor['cod_empl'] . ' ', 0, 0, 'C');
                //}
                //Fin certificado de induccion
                //Inicio clausula adicional
                $pdf->AddPage();
                $fecha = date('d-m-Y');
                $ciduade = 'Cali';

                //foreach ($resulConsulta as $valor) {

                $texto1 = utf8_decode("Cláusula adicional al contrato de trabajo suscrito por: " . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . " identidicado con la C.C: " . trim($valor['cod_empl']) . " como trabajador y  " . trim($valor['nom_empr']) . " como empleador por mutuo acuerdo y consentimiento acordamos que:");
                $texto2 = utf8_decode("El trabajador se compromete con la empresa de manera expresa, a no hacer uso personal o para terceras personas que tengan vínculo con la empresa, de los productos de degustación o promoción suministrados por los clientes o por cualquier otra persona, ya que estos deberán ser utilizados para los fines determinados  por la empresa. El incumplimiento de esta prohibición será considerada como un incumplimiento grave de las obligaciones a cargo del trabajador, que conllevaría a la terminación del contrato de trabajo por justa causa, sin lugar a indemnización alguna.");
                $texto3 = utf8_decode("Por lo anterior, el trabajador autoriza de manera expresa a la empresa para descontar de sus salarios,y demás prestaciones sociales que se le adeuden, el valor de los productos de degustación o promoción suministrados que se hubiere utilizado indebidamente.");
                $fecha = date('d-m-Y');

                $pdf->SetFont('Times', 'B', 10);
                $pdf->Cell(0, 20, ' Clausula adicional ', 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->SetFont('Times');
                $pdf->Cell(20, 6, 'Ciudad y Fecha : ' . $ciduade . ' ' . $fecha . ' ', 0, 1, 'L');
                $pdf->Ln(10);
                $pdf->Write(5, '' . $texto1 . '');
                $pdf->Ln(10);
                $pdf->Write(5, '' . $texto2 . '');
                $pdf->Ln(10);
                $pdf->Write(5, '' . $texto3 . '');
                $pdf->Ln(20);
                $pdf->Cell(60, 20, 'Firma del trabajador enterado:', 0, 0, 'L');
                $pdf->Cell(80, 20, 'La empresa', 0, 0, 'R');
                $pdf->Ln(5);
                $pdf->Cell(0, 20, 'C.C:' . trim($valor['cod_empl']) . ' ', 0, 0, 'L');
                $pdf->Ln(50);
                // }
                //Fin clausula adicional
                //Inicio Decreto
                if ($empInt == 1) {

                    $txtEmpresa = "LISTOS S.A.S";
                }

                if ($empInt == 2) {

                    $txtEmpresa = "TERCERIZAR S.A.S";
                }

                if ($empInt == 3) {

                    $txtEmpresa = "VISION Y MARKETING S.A.S";
                }

                //foreach ($resulConsulta as $valor) {

                $fecha = date('d-m-Y');
                $pdf->AddPage();
                $pdf->SetFont('Times', 'B', 12);
                $texto1 = utf8_decode("Señores");

                $pdf->Ln(25);
                $pdf->Cell(35, 6, 'Santiago de cali:', 0, 0, 'L');
                $pdf->Cell(50, 6, '______________________________', 0, 1, 'L');
                $pdf->Ln(5);
                $pdf->Cell(20, 20, ' ' . $texto1 . ' ', 0, 0, 'L');
                $pdf->Ln(5);
                $pdf->Cell(0, 20, ' ' . $txtEmpresa . ' ', 0, 0, 'L');
                $pdf->Ln(20);
                $pdf->SetFont('Times', '', 12);
                $parrafo1 = utf8_decode("Por medio de la presente, y teniendo como soporte el Decreto 1377 de 2013, reglamentario de la Ley 1581 de 2012, autorizo a la firma " . $txtEmpresa . " , como responsable de mis datos personales obtenidos o que llegue a obtener en el futuro a través de sus distintos canales de atención, para que continúe con el tratamiento y manejo de dichos datos.");
                $parrafo2 = utf8_decode("Esta autorizacion permite a " . $txtEmpresa . " , no solo a recolectar y almacenar , sino también a transferir, usar , circular, suprimir, compartir, actualizar, trasmitir, de acuerdo con el procedimiento para el tratamiento de los datos personales sin restriccion o reserva alguna.");
                $parrafo3 = utf8_decode("El alcance de esta autorización comprende la facultad para que " . $txtEmpresa . " le envíe mensajes con contenidos comerciales, notificaciones, información del estado de cuenta, saldos, cuotas pendiens de pago y demas información relativa al portafolio de servicios de la entidad, a través de correo electronico y/o mensajes de texto al móvil.");
                $parrafo4 = utf8_decode("No obstante lo anterior, me reservo el derecho de conocer, actualizar, rectificar y suprimir mis datos personales, a traves de los canales dispuestos por " . $txtEmpresa . " para tal fin.");

                $pdf->MultiCell(0, 5, $parrafo1);
                $pdf->Ln(5);
                $pdf->MultiCell(0, 5, $parrafo2);
                $pdf->Ln(5);
                $pdf->MultiCell(0, 5, $parrafo3);
                $pdf->Ln(5);
                $pdf->MultiCell(0, 5, $parrafo4);
                $pdf->Ln(10);
                $pdf->Cell(0, 20, 'Atentamete:', 0, 0, 'L');
                $pdf->Ln(30);
                $pdf->Cell(0, 20, ' ' . trim($valor['nom_empl']) . " " . utf8_encode(trim($valor['ape_empl'])) . ' ', 0, 0, 'L');
                $pdf->Ln(5);
                $pdf->Cell(0, 20, 'C.C: ' . trim($valor['cod_empl']) . ' ', 0, 0, 'L');
            }
            //Fin Decreto

            $fechaDoc = date('d-m-Y_H-i-s');
            $ruta = "../../temporales/paqueteContrato/paquete" . $fechaDoc . ".pdf";
            $pdf->Output($ruta);
            return $ruta;
        }
    }

}
?>

