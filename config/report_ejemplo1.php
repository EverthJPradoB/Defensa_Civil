<?php

require_once("../public/fpdf/fpdf.php");

class PDF extends FPDF
{
    // Cabecera de página


    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Establecer una fuente más pequeña y centrada
$pdf->SetFont('Times', '', 9);
$titulo = "ANEXO 1
 SOLICITUD DE INSPECCIÓN TÉCNICA DE SEGURIDAD EN EDIFICACIONES - ITSE Y DE
 EVALUACIÓN DE CONDICIONES DE SEGURIDAD EN ESPECTÁCULOS PÚBLICOS DEPORTIVOS Y NO
 DEPORTIVOS - ECSE";

$linea = iconv('UTF-8', 'windows-1252', $titulo);

// Establecer interlineado ajustando la posición Y manualmente
$interlineado = 5;
$posY = $pdf->GetY();
foreach (explode("\n", $linea) as $linea) {
    $pdf->SetY($posY);
    $pdf->Cell(0, $interlineado, $linea, 0, 1, 'C'); // 'C' centra el texto
    $posY += $interlineado;
}

$interlineado = 8;

$pdf->Cell(50, 10, 'Celda Adicional', 1);

$pdf->Cell(100, $interlineado, "I.- INFORMACION GENERAL", 0, 1, 'C'); // 'C' centra el texto

$pdf->SetX(37);
$pdf->SetFont('helvetica', '', 6);
$pdf->SetFillColor(255, 255, 255);
//$pdf->SetTextColor(255, 255, 255);
$pdf->SetXY(15, 25);
$pdf->Multicell(80, 3, utf8_decode("MUNICIPALIDAD PROVINCIAL DE CHICLAYO\nGerencia de Desarrollo Urbano\nSub Gerencia de Obras Privadas\nDepartamento de Estudios y Certificaciones Urbanas"), 0, 'C', true);
$pdf->Ln(3);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetX(20);
$pdf->Multicell(175, 3, utf8_decode("AÑO DEL BICENTENARIO, DE LA CONSOLIDACIÓN DE NUESTRA INDEPENDENCIA, Y DE LA CONMEMORACIÓN DE LAS HEROICAS BATALLAS DE JUNÍN Y AYACUCHO"), 0, 'C', true);


$pdf->Ln(3);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetTextColor(31, 56, 100);
$pdf->SetX(20);
$pdf->Multicell(180, 3, utf8_decode("CERTIFICADO DE COMPATIBILIDAD DE USOS Y OTROS Nº 016-2024"), 0, 'C', true);

$pdf->Ln(3);
$pdf->SetFont('helvetica', '', 7);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(25);
$pdf->Cell(0, 3, utf8_decode("DE ACUERDO A LO SOLICITADO POR: "), 0, 0, 'J', false);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetX(71);
$pdf->Cell(0, 3, utf8_decode("hola"), 0, 1, 'J', false);

$pdf->Ln(3);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetTextColor(31, 56, 100);
$pdf->SetX(25);
$pdf->Cell(0, 3, utf8_decode("REG. DOC. N° " . 125), 0, 0, 'J', false);
$pdf->SetX(145);

$pdf->Output();