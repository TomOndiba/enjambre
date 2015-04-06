<?php

/**
 * Clase que referencia el formato de la evaluacion de infome y diario ad eacmo componente investigacion
 * @author DIEGOX_CORTEX
 */

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url . '/elgg2/print_pdf/fpdf/fpdf.php');

class formato_eval_informeinv_cuadcampoINN_inv extends FPDF {

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
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}' . '                                                                   '.elgg_get_site_url(), 0, 0, 'D');
    }

    function datos($guid_ev) {
        
        $evaluacion = new ElggEvaluarInformeInvCuadCampoINN_inv($guid_ev);

        $this->SetFillColor(181, 181, 181);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 12);

        $this->MultiCell(190, 6, utf8_decode("VALORACIÓN DEL INFORME DE INVESTIGACIÓN Y EL DIARIO DE CAMPO COMPONENTE DE INVESTIGACIÓN"), 1, 'C', 'true');

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
         * COHERENCIA
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Coherencia (Máximo 16 puntos)"), 1, 0, 'C', 'true');

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Crietrios a valorar"), 1, 0, 'C');
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
        //
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Se evidencia el trabajo colaborativo del grupo de investigación en el diseño y desarrollo del proyecto (Máximo 8 puntos)"), 1);
        $this->SetY(88);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 12, utf8_decode($evaluacion->puntaje_trabajo_colaborativo), 1, 0, 'C');
//        //
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Existe claridad en la relación de la pregunta, el planteamiento del problema de investigación, la metodología planteada y los resultados de la investigación (Máximo 8 puntos). "), 1);
        $this->SetY(100);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 18, utf8_decode($evaluacion->puntaje_claridad_pregunta), 1, 0, 'C');
////        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->subtotal_coherencia), 'R,T,B', 0, 'C');
////        //
////        //
////        
        /**
         * RUTA_INDAGACION
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Ruta de indagación (Máximo 30 puntos)"), 1, 0, 'C', 'true');

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Crietrios a valorar"), 1, 0, 'C');
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
        //
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Se presenta con claridad el diseño metodológico, los instrumentos y herramientas utilizados, la población abordada, las evidencias y la sistematización de del proceso (Máximo 10 puntos)"), 1);
        $this->SetY(136);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 18, utf8_decode($evaluacion->puntaje_diseño_metodologico), 1, 0, 'C');
        //
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Los conceptos que orientan la investigación están argumentados y se evidencia la apropiación de los mismos (Máximo 10 puntos)"), 1);
        $this->SetY(154);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 12, utf8_decode($evaluacion->puntaje_conceptos_investigacion), 1, 0, 'C');
        //
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Los resultados son claros, se presentan como producto del proceso de investigación y tienen utilidad para su contexto (Máximo 10 puntos)"), 1);
        $this->SetY(166);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 12, utf8_decode($evaluacion->puntaje_resultados_claros), 1, 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->subtotal_ruta), 'R,T,B', 0, 'C');
        //
        //
        
        /**
         * FUENTES
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Fuentes (Máximo 5 puntos)"), 1, 0, 'C', 'true');

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Crietrios a valorar"), 1, 0, 'C');
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
//        //
        $this->Ln();
        $this->MultiCell(115, 6, utf8_decode("Se citan en forma adecuada las referencias bibliográficas y virtuales utilizadas para la realización de la investigación, así como los pie de foto, cuadros y gráficos (Máximo 5 puntos)"), 1);
        $this->SetY(196);
        $this->SetX(125);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 18, utf8_decode($evaluacion->puntaje_forma_adecuada), 1, 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->subtotal_fuentes), 'R,T,B', 0, 'C');
        //
        //
        /**
         *Puntaje total
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 6, utf8_decode("Puntaje Total: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(75, 6, utf8_decode($evaluacion->puntaje_total), 'R,T,B', 0, 'C', 'true');
        //
        //
        
        /**
         * Firma del Evaluador
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 12, utf8_decode("Firma del evaluador: "), 1, 0, 'L');

        /**
         * Observaciones
         */
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(190, 6, utf8_decode("Observaciones: Sugerencias que contribuyan al mejoramiento del proceso pedagógico de formación, investigación y socialización de los resultados"), 1);
        $this->MultiCell(190, 6, utf8_decode($evaluacion->observaciones), 1);
    }

    /**
     * T: superior
      R: derecha
      B: inferior
     */
}

?>