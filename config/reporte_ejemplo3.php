<?php
// require_once("../../config/conexion.php");
// require('../../public/lib/fpdf186/fpdf.php');

// if (isset($_SESSION["id_usuario"])) {

//     $id_solicitud = isset($_GET['id_solicitud']) ? $_GET['id_solicitud'] : null;

// 	$solicitud = new Solicitud();

// 	$datos = $solicitud->getCertificado($id_solicitud);
//     if(is_array($datos)==true and count($datos)<>0){
//         foreach($datos as $row){
//             $fecha_emi = $row["fecha_emi"];
//             $norma = $row["norma"];
//             $ciu_nom = $row["ciu_nom"];
//             $ciu_apep = $row["ciu_apep"];
//             $ciu_apem = $row["ciu_apem"];
//             $ciu_dni = $row["ciu_dni"];
//             $ruc = $row["ruc"];
//             $raz_social = $row["raz_social"];
//             $direccion = $row["direccion"];
//             $area = $row["area"];
//             $act_eco = $row["act_eco"];
//             $raz_social = $row["raz_social"];
//             $zona = $row["zona_descripcion"] . " (" . $row["zona_cod"] . ")";
//             $compatible = $row["compatible"];
//             $raz_social = $row["raz_social"];
//             $indice = $row["nom_indice"];
//             $cod_ciiu = $row["cod_ciiu"];
//             $ubicacion = $row["ubicacion"];
//             $ubicacion_2 = $row["ubicacion_2"];
//             $corredor_com = $row["corredor_com"];
//             $nom_comercial = $row["nom_comercial"];
//             $estacionamientos = $row["estacionamientos"];
            
//             if($row["observaciones"] != null && $row["observaciones"] != ''){
//                 $observaciones = "\n" . $row["observaciones"];
//             }

//             $fechaOriginal = $row["fecha_emi"];
//             $fechaDateTime = new DateTime($fechaOriginal);
//             $fecha = $fechaDateTime->format('d/m/Y');

//             setlocale(LC_TIME, 'es_ES.utf8', 'es_ES', 'esp');

//             // Obtener partes de la fecha
//             $dia = $fechaDateTime->format('d');
//             $mes = strftime('%B', $fechaDateTime->getTimestamp()); // %B devuelve el nombre completo del mes
//             $año = $fechaDateTime->format('Y');

//             // Formatear en el estilo deseado
//             $fecha_emi = $dia . ' de ' . $mes . ' del ' . $año;

//             $fecha_expira = $dia . ' de ' . $mes . ' del ' . $año+3;

//             $riesgo = $row["riesgo"];
//             $reg_doc = $row["reg_doc"] . " - " . $año;
//             $reg_exp = $row["reg_exp"] . " - " . $año;

//             $id = $row["id_solicitud_2"] . "-" . $año;

//             $ciu = $ciu_nom . " ". $ciu_apep . " " . $ciu_apem;

//             if($row["compatibilidad"] == 1){
//                 $compatibilidad = 'COMPATIBLE CON RESTRICCIONES';
//             }
//             else if($row["compatibilidad"] == 2){
//                 $compatibilidad = 'COMPATIBLE';
//             }
//             else $compatibilidad = 'NO COMPATIBLE';

//             if($row["h_general"] != 0){
//                 $h_g = 'X';
//             }
//             else{
//                 $h_g = ' ';
//             }

//             if($row["h_especial"] != 0){
//                 $h_e = 'X';
//             }
//             else{
//                 $h_e = ' ';
//             }

//             if($row["h_extra"] != 0){
//                 $h_ex = 'X';
//             }
//             else{
//                 $h_ex = ' ';
//             }

//             if($row["norma"] != 0){
//                 $norma = 'X';
//             }
//             else{
//                 $norma = ' ';
//             }
//         }
// 	}

//     $pdf = new FPDF('P','mm','A4');

//     $pdf->AddPage();

//     $pdf->SetFont('Arial','',10);

//     $fontSize=10;

//     $tempFontSize=$fontSize;

//     $pdf->Image('../../public/img/logo_2.jpg',47,8,15,15);

//     $pdf->SetX(37);
//     $pdf->SetFont('helvetica','',6);
//     $pdf->SetFillColor(255, 255, 255);
//     //$pdf->SetTextColor(255, 255, 255);
//     $pdf->SetXY(15,25);
//     $pdf->Multicell(80, 3, utf8_decode("MUNICIPALIDAD PROVINCIAL DE CHICLAYO\nGerencia de Desarrollo Urbano\nSub Gerencia de Obras Privadas\nDepartamento de Estudios y Certificaciones Urbanas"), 0, 'C', true);
//     $pdf->Ln(3);
//     $pdf->SetFont('helvetica','B',8);
//     $pdf->SetX(20);
//     $pdf->Multicell(175, 3, utf8_decode("AÑO DEL BICENTENARIO, DE LA CONSOLIDACIÓN DE NUESTRA INDEPENDENCIA, Y DE LA CONMEMORACIÓN DE LAS HEROICAS BATALLAS DE JUNÍN Y AYACUCHO"), 0, 'C', true);

//     $pdf->Ln(3);
//     $pdf->SetFont('helvetica','B',11);
//     $pdf->SetTextColor(31,56,100);
//     $pdf->SetX(20);
//     $pdf->Multicell(180, 3, utf8_decode("CERTIFICADO DE COMPATIBILIDAD DE USOS Y OTROS Nº 016-2024"), 0, 'C', true);

//     $pdf->Ln(3);
//     $pdf->SetFont('helvetica','',7);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(25);
//     $pdf->Cell(0, 3, utf8_decode("DE ACUERDO A LO SOLICITADO POR: "), 0, 0, 'J', false);

//     $pdf->SetFont('helvetica', 'B', 8);
//     $pdf->SetX(71);
//     $pdf->Cell(0, 3, utf8_decode($ciu), 0, 1, 'J', false);

//     $pdf->Ln(3);
//     $pdf->SetFont('helvetica','B',9);
//     $pdf->SetTextColor(31,56,100);
//     $pdf->SetX(25);
//     $pdf->Cell(0, 3, utf8_decode("REG. DOC. N° " . $reg_doc), 0, 0, 'J', false);
//     $pdf->SetX(145);
//     $pdf->Cell(0, 3, utf8_decode("REG. EXP. N° " . $reg_exp), 0, 0, 'J', false);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','',6);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(25);
//     $pdf->Multicell(165, 3, utf8_decode("LA GERENCIA DE DESARROLLO URBANO A TRAVÉS DE LA SUB GERENCIA DE OBRAS PRIVADAS Y EN COORDINACIÓN CON EL DEPARTAMENTO DE ESTUDIOS Y CERTIFICACIONES URBANAS DE LA MUNICIPALIDAD PROVINCIAL DE CHICLAYO."), 0, 'C', true);

//     $pdf->Ln(3);
//     $pdf->SetFont('helvetica','B',14);
//     $pdf->SetTextColor(31,56,100);
//     $pdf->Cell(0, 3, utf8_decode("C E R T I F I C A"), 0, 0, 'C', false);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','B',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(50);
//     $pdf->Cell(20, 3, utf8_decode("1. DATOS DEL INMUEBLE"), 0, '', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(35);
//     $pdf->Multicell(157, 3, utf8_decode("1.1. UBICACIÓN: el inmueble se ubica en" . $direccion . ", Distrito y Provincia de Chiclayo, Departamento de Lambayeque.\n
//     1.2. DATOS REGISTRALES: El Lote se encuentra inscrito en la P. E. Nº PXXXXXX, Zona Registral Nº II, Sede Chiclayo y cuenta con un área de" . $area . "m2, a favor de " . $ciu), 0, 'J', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','B',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(28);
//     $pdf->Multicell(180, 3, utf8_decode("2. ORDENAMENTO LEGAL:"), 0, '', true);

//     $pdf->SetFont('helvetica', '', 8);
//     $pdf->SetXY(70,101);
//     $pdf->Multicell(120, 3, utf8_decode("con Ordenanza Municipal Nº 033 - 2022-MPCH/A, que aprueba El Plan de Desarrollo Metropolitano Chiclayo - Lambayeque 2022 - 2032 y su reglamentación"), 0, 1, 'J', false);

//     $PosY=$pdf->GetY();

//     $pdf->Ln(3);
//     $pdf->SetFont('helvetica','',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(35);
//     $pdf->Multicell(157, 3, utf8_decode("2.1. ZONIFICACIÓN: El predio se encuentra situado en " . $zona . " siendo compatible con " . $ubicacion_2 . "\n
//     2.2. R.M.-360-2016-VIVIENDA: parámetros para las actividades que según el clasificador industrial internacional uniforme - CIIU serán de cumplimiento obligatorio para los usuarios no domésticos. Establece para dicha actividad su ubicación en zonificación CZ\n\nCódigo CIIU: " . $codigo . ", Índice de Uso: " . $indice), 0, 'J', true);

//     $pdf->Ln(3);
//     $pdf->SetFont('helvetica','',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(35);
//     $pdf->Multicell(157, 3, utf8_decode("2.3. Corredor comercial: " . $corredor_com), 0, 'J', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','B',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(28);
//     $pdf->Multicell(180, 3, utf8_decode("3. 3.	CALIFICACION DE COMPATIBILIDAD:"), 0, '', true);

//     $pdf->Ln(-3);
//     $pdf->SetFont('helvetica', '', 8);
//     $pdf->SetX(93);
//     $pdf->Multicell(96, 3, utf8_decode("De acuerdo a normas de zonificación Urbana, al Cuadro de Compatibilidad de Usos de suelo y reglamentos que lo complementan, se determina: USO " . $compatibilidad . ": para funcionamiento de " . $act_eco), 0, 1, 'J', false);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','B',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(39.5);
//     $pdf->Cell(20, 3, utf8_decode("4. RESTRICCIONES"), 0, '', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(35);
//     $pdf->Multicell(157, 3, utf8_decode("4.1. Horario general: de lunes a domingo de 07:00 am a 11:00 pm. Corresponde a todos los locales comerciales   y de servicios. En las zonas residenciales, este horario podrá ser reducido previo informe del órgano municipal respectivo, en base a la disconformidad de los vecinos\n
//     4.2. Horario de Carga y descarga: dentro del lote comercial: entre las 06:00 am y las 10:00 pm.\n
//     4.3. En locales con Licencia de Funcionamiento definitiva y que no cuenten con espacio necesario para el abastecimiento dentro del lote, se permitirá carga y descarga en vía pública, siempre que se realice con vehículos de transporte de mercancías de pequeña escala y durante 01 hora diaria como máximo. Se prohíbe depositar la mercadería en la vía pública\n
//     4.4. Los restaurantes pueden expender licor solo como acompañamiento de comidas, no siendo viable de ninguna manera que la venta de bebidas alcohólicas resulte su actividad principal."), 0, 'J', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','B',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(39.5);
//     $pdf->Cell(20, 3, utf8_decode("5. OBSERVACIONES"), 0, '', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(35);
//     $pdf->Multicell(157, 3, utf8_decode("La actividad comercial se desarrollará en " . $direccion . "área de " . $area . "m2 con nombre comercial " . $nom_comercial . $observaciones), 0, 'J', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','B',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(35);
//     $pdf->Cell(20, 3, utf8_decode("VIGENCIA:"), 0, '', true);

//     $pdf->SetFont('helvetica','',9);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetX(55);
//     $pdf->Multicell(157, 3, utf8_decode("El presente documento tiene vigencia por 36 meses y caduca el " . $fecha_expira), 0, 'J', true);

//     $pdf->Ln(2);
//     $pdf->SetFont('helvetica','B',8);
//     $pdf->SetTextColor(31,56,100);
//     $pdf->SetX(37);
//     $pdf->Multicell(155, 3, utf8_decode("EL PRESENTE DOCUMENTO NO ACREDITA PROPIEDAD ALGUNA, SOLO ES DE CARÁCTER INFORMATIVO."), 0, 'J', true);

//     $pdf->Ln(4);
//     $pdf->SetFont('helvetica','I',7);
//     $pdf->SetTextColor(0,0,0);
//     $pdf->SetXY(168,270);
//     $pdf->Cell(25, 3, utf8_decode("Chiclayo, " . $fecha_emi . "."), 0, '', true);

//     $pdf->Output();
// }
// else {
// 	header("Location:" . Conectar::ruta() . "view/404");
// }
?>