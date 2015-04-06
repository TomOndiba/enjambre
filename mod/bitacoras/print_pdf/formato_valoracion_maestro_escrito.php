<?php

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url . '/elgg2/print_pdf/fpdf/fpdf.php');

class formato_valoracion_maestro_escrito extends FPDF {

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
        $evaluacion = new ElggEvalMaestroEscrito($guid_ev);

        $this->SetFillColor(181, 181, 181);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 12);

        $this->MultiCell(190, 6, utf8_decode("VALORACIÓN PONENCIA DEL MAESTRO(A) (ESCRITO)"), 1, 'C', 'true');

        $this->Cell(75, 6, utf8_decode("Municipio / Departamento:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(115, 6, utf8_decode($evaluacion->municipio_dpto), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Institución educativa:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(115, 6, utf8_decode($evaluacion->institucion), 1);
//
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Nombre del Maestro:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(115, 6, utf8_decode($evaluacion->name_maestro), 1);
//
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Nombre del grupo de investigación"), 1);
        $this->SetFont('Arial', '', 11);
  
        $this->Cell(115, 6, utf8_decode($evaluacion->name_grupo), 1);
//
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Nombre de la ponencia"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(115, 6, utf8_decode($evaluacion->name_ponencia), 1);
//
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Nombre del valorador:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(115, 6, utf8_decode($evaluacion->name_eval), 1);
//
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Profesión: "), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(115, 6, utf8_decode($evaluacion->profesion_eval), 1);
//
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Institución: "), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(115, 6, utf8_decode($evaluacion->institucion_eval), 1);


        /**
         * Aspectos valoracion y puntajes  
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Hace visible en sus reflexiones y elaboraciones  su apropiación de la Investigación como Estrategia Pedagógica  y su procesos como acompañante coinvestigador (3 puntos máximo)"), 1);
//
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->visible_reflexiones), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_visible_reflexiones), 'R,T,B', 0, 'C');
        //

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Da cuenta de propuetsas para transformar su práctica pedagógica a partir de la apropiación de la investigación como estrategia pedagógica. (3 puntos máximo)"), 1);
//
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->practica_pedagogica), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_practica_pedagogica), 'R,T,B', 0, 'C');
        //

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Evidencia en su presentación los aprendizajes propios de la IEP (situado, colaborativo, problematizador e indagación crítica, dialogo de saberes y negociación cultural) en el proceso de los niños(as) y en el propio (2 puntos máximo)"), 1);
//
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->aprendizajes_propios), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_aprendizajes_propios), 'R,T,B', 0, 'C');
        //

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("La reflexión presentada hace evidente los aprendizajes logrados, los problemas encontrados y las propuestas para el mejoramiento de su práctica y su posicionamiento como maestro (a) investigador. (2 puntos máximo)"), 1);
//
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->reflexion_presentada), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_reflexion_presentada), 'R,T,B', 0, 'C');
        //

        
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("TOTAL (Máximo 10 puntos): "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_total), 'R,T,B', 0, 'C', 'true');
        
        /**
         * Firma del Evaluador
         */
//        $this->Ln();
//        $this->SetFont('Arial', 'B', 12);
//        $this->Cell(190, 12, utf8_decode("Firma del evaluador: "), 1, 0, 'L');

        /**
         * Observaciones
         */
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(190, 6, utf8_decode("Observaciones: "), 1);
        $this->MultiCell(190, 6, utf8_decode($evaluacion->obs), 1);
    }

    /**
     * T: superior
      R: derecha
      B: inferior
     */
}

?>