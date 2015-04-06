<?php

/**
 * Clase que referencia la Bitácora No. 3, para imprimirla en PDF.
 * @author DIEGOX_CORTEX
 */
require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url.'/elgg2/print_pdf/fpdf/fpdf.php');

class Bitacora3 extends FPDF {

// Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(238, 188, 6);
        $this->Cell(0, 0, 'BITACORA No. 3. EL PROBLEMA DE INVESTIGACION', 0, 0, 'I');
        $this->Ln(5);
    }

// Pie de página
    function Footer() {
// Posición: a 1,5 cm del final
        $this->SetY(-15);
// Arial italic 8
        $this->SetFont('Arial', 'I', 8);
// Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}' . '                                                                    '.elgg_get_site_url(), 0, 0, 'D');
    }

    function SetCol($col) {
// Establecer la posición de una columna dada
        $this->col = $col;
        $x = 10 + $col * 65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

}
//FIN CLASS FPDF
?>


