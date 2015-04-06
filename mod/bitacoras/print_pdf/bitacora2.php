<?php

/**
 * Clase que referencia la Bitácora No. 2, para imprimirla en PDF.
 * @author DIEGOX_CORTEX
 */

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
//require_once($url.'/elgg2/print_pdf/fpdf/fpdf.php');
//require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');

class Bitacora2 extends FPDF {

// Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(238, 188, 6);
        $this->Cell(0, 0, 'BITACORA No. 2. LA PREGUNTA', 0, 0, 'I');
        $this->Ln(5);
    }

// Pie de página
    function Footer() {
// Posición: a 1,5 cm del final
        $this->SetY(-15);
// Arial italic 8
        $this->SetFont('Arial', 'I', 8);
// Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}'.'                                                                    '.elgg_get_site_url(), 0, 0, 'D');
        
    }

    function SetCol($col) {
// Establecer la posición de una columna dada
        $this->col = $col;
        $x = 10 + $col * 65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }



// Una tabla más completa
    function estudianteTable($header, $data) {
// Anchuras de las columnas
        $w = array(40, 30, 30, 30, 30, 35);
// Cabeceras
        for ($i = 0; $i < count($header); $i++){
            
            $this->Cell($w[$i], 6, $header[$i], 0, 0, 'C');
        }
        $this->Ln();
// Datos
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 0, 0,'C');
            $this->Cell($w[1], 6, $row[1], 0, 0,'C');
            $this->Cell($w[2], 6, $row[2], 0, 0,'C');
            $this->Cell($w[3], 6, $row[3], 0, 0,'C');
            $this->Cell($w[4], 6, $row[4], 0, 0,'C');
            $this->Cell($w[5], 6, $row[5], 0, 0,'C');
            $this->Ln();
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    
    // Una tabla más completa
    function MaestroTable($header, $data) {
// Anchuras de las columnas
        $w = array(99, 70);
// Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 6, $header[$i], 0, 0, 'I');
        $this->Ln();
// Datos
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 0, 0,'C');
            $this->Cell($w[1], 6, $row[1], 0, 0,'C');
            $this->Ln();
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }


}

//// Creación del objeto de la clase heredada
//$pdf = new imprimirPDF(10);
//$pdf->AliasNbPages();
//$pdf->AddPage();
//$pdf->SetFont('Arial', '', 12);
//$pdf->SetTextColor(0,0,0);
//$pdf->Cell(0, 10, 'PARA REALIZAR EN LA LIBRETA DE APUNTES Y REGISTRAR EN EL SIGEON', 0, 1);
//$pdf->Cell(0, 10, $pdf->guid, 0, 1);
//$pdf->Output();
?>
