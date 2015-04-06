<?php

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url . '/elgg2/print_pdf/fpdf/fpdf.php');

class listado_fina_inv_feria extends FPDF {

// Cabecera de página
    function Header() {
        $this->SetFillColor(181, 181, 181);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 12);
        //$this->Cell(190, 4, utf8_decode("Inscripcion a Feria No. " . $inscripcion->numero_inscripcion), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->Ln();
    }

// Pie de página
    function Footer() {
// Posición: a 1,5 cm del final
        $this->SetY(-15);
// Arial italic 8
        $this->SetFont('Arial', 'I', 8);
// Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}' . '                                                                   ' . elgg_get_site_url(), 0, 0, 'D');
    }

    function tipo_innovacion($in) {
        $tipo = explode('&', $in);
        $ret = '';
        foreach ($tipo as $t) {
            if (!empty($t)) {
                $ret .= get_entity($t)->title . ' _ ';
            }
        }
        return $ret;
    }

    function datos($guid_ev) {
        $feria = new ElggFeria($guid_ev);

        $evaluacion = '';


        if ($feria->tipo_feria == 'Municipal') {
            $opt = array(
                'relationship' => 'evaluada_en_sitio_en',
                'relationship_guid' => $feria->guid,
                'inverse_relationship' => TRUE,
                'order_by_metadata' => array('name' => 'puntaje_feria_municipal', 'direction' => 'DESC')
            );
            $evaluacion = elgg_get_entities_from_relationship($opt);
        } else {
            $opt = array(
                'relationship' => 'evaluada_en_sitio_en',
                'relationship_guid' => $feria->guid,
                'inverse_relationship' => TRUE,
                'order_by_metadata' => array('name' => 'puntaje_feria_departamental', 'direction' => 'DESC')
            );
            $evaluacion = elgg_get_entities_from_relationship($opt);
        }
        //puntaje_feria_municipal

        $this->SetFillColor(181, 181, 181);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 12);

        $this->MultiCell(190, 6, utf8_decode("REPORTE FINAL DE INVESTIGACIONES EN FERIA " . strtoupper($feria->name)."\n".strtoupper($feria->tipo)), 1, 'C', 'true');


        $this->Cell(120, 6, utf8_decode("Investigación"), 1, 0, 'C', 'true');
        $this->Cell(40, 6, utf8_decode("Categoria"), 1, 0, 'C', 'true');
        $this->Cell(30, 6, utf8_decode("Puntaje"), 1, 0, 'C', 'true');
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        foreach ($evaluacion as $ev) {
            $this->Cell(120, 6, utf8_decode($ev->name), 1);
            $this->Cell(40, 6, utf8_decode($ev->categoria), 1);
            if ($feria->tipo_feria == "Municipal") {
                $this->Cell(30, 6, utf8_decode($ev->puntaje_feria_municipal), 1);
            } else {
                $this->Cell(30, 6, utf8_decode($ev->puntaje_feria_departamental), 1);
            }
            $this->Ln();
        }
    }

    /**
     * T: superior
      R: derecha
      B: inferior
     */
}
?>


