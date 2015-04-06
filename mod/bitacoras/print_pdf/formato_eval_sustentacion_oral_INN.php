<?php

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url . '/elgg2/print_pdf/fpdf/fpdf.php');

class formato_eval_sustentacion_oral_INN extends FPDF {

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

    function datos($guid_ev) {
        $evaluacion = new ElggEvalSustentacionOral_inn($guid_ev);

        $this->SetFillColor(181, 181, 181);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 12);

        $this->MultiCell(190, 6, utf8_decode("VALORACIÓN DE LA SUSTENTACIÓN ORAL DE LA INVESTIGACIÓN (Categoría Innovación)"), 1, 'C', 'true');

        $this->Cell(77, 6, utf8_decode("Municipio / Departamento:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->municipio_dpto), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(77, 6, utf8_decode("Nombre del grupo de investigación:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->name_grupo), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(77, 6, utf8_decode("Nombre de la investigación:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->name_inv), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(77, 6, utf8_decode("Nombre del Maestro(a) acompañante:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->name_maestro), 1);        
        
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(77, 6, utf8_decode("Nombre del valorador:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->name_eval), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(77, 6, utf8_decode("Profesión: "), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->profesion_eval), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(77, 6, utf8_decode("Institución: "), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->institucion_eval), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Categoria: "), 1);
        $this->Ln();
        $this->SetFont('Arial', '', 11);
        $this->Cell(190, 6, utf8_decode($evaluacion->categoria), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Linea Tematica:  " . get_entity($evaluacion->linea_tematica)->name), 1);


        /**
         * APROPIACION
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Apropiación de la investigación y la innovación (Máximo 12 puntos)"), 1, 0, 'C', 'true');

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Crietrios a valorar"), 1, 0, 'C');
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
        //
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Presenta con claridad la pregunta, el problema de investigación y la ruta de indagación recorrida para llegar a los resultados (Máximo 3 puntos)"), 1);
        $this->SetY(88);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 12, utf8_decode($evaluacion->puntaje_presenta_claridad), 1, 0, 'C');
        //
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Explica y argumenta los fundamentos conceptuales que direccionan su investigación y son la base de la innovación (Máximo 3 puntos)"), 1);
        $this->SetY(100);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 12, utf8_decode($evaluacion->puntaje_explica_fundamentos), 1, 0, 'C');
        //
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Muestra el proceso metodológico y las evidencias del desarrollo de la investigación que llevaron a obtener la innovación (Máximo 3 puntos)"), 1);
        $this->SetY(112);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 12, utf8_decode($evaluacion->puntaje_innovacion_lograda), 1, 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->subtotal_apropiacion), 'R,T,B', 0, 'C');
        //
        //
        
        /**
         * RUTA_INDAGACION
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Capacidades y habilidades (Máximo 6 puntos)"), 1, 0, 'C', 'true');
//
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Crietrios a valorar"), 1, 0, 'C');
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
        //
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Se hacen evidentes las capacidades cognitivas, afectivas, calorativas, volitivas y habilidades argumentativas, comunicativas, de indagación y de trabajo en grupo (Máximo 6 puntos)"), 1);
        $this->SetY(142);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 18, utf8_decode($evaluacion->puntaje_evidentes_capacidades), 1, 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->subtotal_capacidades), 'R,T,B', 0, 'C');
        //
        //
        
        /**
         * Puesto
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Stand o Puesto (máximo 2 puntos)"), 1, 0, 'C', 'true');

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Crietrios a valorar"), 1, 0, 'C');
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
        //
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Hace evidente el diseño investigativo así como el uso de los recursos de propagación y apropiación (Máximo 2 puntos)"), 1);
        $this->SetY(178);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 12, utf8_decode($evaluacion->puntaje_diseño_investigativo), 1, 0, 'C');
//        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->subtotal_puesto), 'R,T,B', 0, 'C');
        //
        //
        /**
         *Puntaje total
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Puntaje total: (Máximo 20 puntos) "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->puntaje_total), 'R,T,B', 0, 'C', 'true');
        //
        //
      
        /**
         * Observaciones
         */
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(190, 6, utf8_decode("Observaciones: Sugerencias que contribuyan al mejoramiento del proceso investigativo pedagógico de formación y socialización de los resultados del grupo"), 1);
        $this->MultiCell(190, 6, utf8_decode($evaluacion->obs), 1);
    }

    /**
     * T: superior
      R: derecha
      B: inferior
     */
}

?>
