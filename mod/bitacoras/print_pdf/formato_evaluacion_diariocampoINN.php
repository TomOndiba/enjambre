<?php

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url . '/elgg2/print_pdf/fpdf/fpdf.php');

class formato_evaluacion_diariocampoINN extends FPDF {

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
        $evaluacion = new ElggEvaluacionCompInnovacionInvCuad($guid_ev);

        $this->SetFillColor(181, 181, 181);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 12);

        $this->MultiCell(190, 6, utf8_decode("VALORACIÓN DEL INFORME DE INVESTIGACIÓN Y EL DIARIO DE CAMPO COMPONENTE INNOVACIÓN"), 1, 'C', 'true');

        $this->Cell(77, 6, utf8_decode("Municipio / Departamento:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->municipio_dpto), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(77, 6, utf8_decode("Institución educativa:"), 1);
        $this->SetFont('Arial', '', 11);
        $this->Cell(113, 6, utf8_decode($evaluacion->institucion), 1);

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
        $this->Cell(113, 6, utf8_decode($evaluacion->name_maestroAcomp), 1);

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
        $this->Cell(190, 6, utf8_decode("Tipo de innovación: "), 1);
        $this->Ln();
        $this->SetFont('Arial', '', 11);
        $this->Cell(190, 6, utf8_decode($this->tipo_innovacion($evaluacion->tipo_innovacion)), 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("linea_tematica:  " . get_entity($evaluacion->linea_tematica)->name), 1);


        /**
         * Fundamentación
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Fundamentación (Máximo16 puntos)"), 1, 0, 'C', 'true');

        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Son visibles en el origen del proceso y en los resultados de innovación los fundamentos del conocimiento, la tecnología y el contexto de la innovación presentada (Max 6 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->fundamentos_conocimiento), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_fundamentos_conocimiento), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Se evidencia la propuesta metodologica y los aprendizajes propios de la IEP (situado, colaborativo,  problematizador, por indagacion critica, diálogo de saberes y negociación cultural) (Máx 5 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->propuesta_metodologica), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_propuesta_metodologica), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Existe coherencia en el proceso de investigativo e innovativo entre: las preguntas iniciales formuladas, el problema, y los resultados obtenidos (Máx 5 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->existe_coherencia), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_existe_coherencia), 'R,T,B', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->subtotal_fundamentacion), 'R,T,B', 0, 'C');
        
        /**
         * Tipos y proceso de
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Tipos y proceso de innovación (Máximo 12 puntos)"), 1, 0, 'C', 'true');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Contribuye de forma original y/o novedosa a la solución de un problema en lo tecnológico, social, ambiental y/o pedagógico de acuerdo a los tipos de innovación en los que se inscribió. (Máx 4 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->forma_original), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_forma_original), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Argumenta en forma clara la transformación o modificación en el proceso o procedimiento tecnológico, social, ambiental y/o pedagógico de acuerdo al tipo de innovación que plantea . (Máx 4 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->argumenta_transformacion), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_argumenta_transformacion), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Visibiliza el proceso investigativo mediante el cual se llega a la innovación (Máx. 4 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->proceso_investigativo), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_proceso_investigativo), 'R,T,B', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->subtotal_tipos), 'R,T,B', 0, 'C');
      
        /**
         * Pertinencia e impacto
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Pertinencia e impacto (Máximo 12 puntos)"), 1, 0, 'C', 'true');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("El grado de elaboraboración de la propuesta de innovación permite dar una solución viable y contextualizada al problema de investigación planteado. (Máx 4 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->grado_elaboracion), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_grado_elaboracion), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Con los resultados de la investigación se explica cómo se  generan procesos y procedimientos que impactan y transforman el contexto de su comunidad (Máx 4 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->resultados_investigacion), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_resultados_investigacion), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("La innovación presentada permite ver la evolución y el desarrollo propio de la investigación entre la pregunta planteada y los resultados logrados (Máx 4 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->evolucion_desarrollo), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_evolucion_desarrollo), 'R,T,B', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->subtotal_impacto), 'R,T,B', 0, 'C');
        
        /**
         * PApropiación
         */
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Apropiación (10 puntos)"), 1, 0, 'C', 'true');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("El grupo da cuenta de la dinamica vivida y sus cambios durante el proceso de desarrollo de la investigación y el resultado de innovación (Máx 4 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->dinamica_vivida), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_dinamica_vivida), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("Se hace evidente el empoderamiento social logrado por los actores, las instituciones y las comunidades en el proceso de innovación  (Máx 3 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->social_logrado), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_social_logrado), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Crietrios a valorar"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode("El grupo hace evidente la importancia social y comunitaria de la innovación lograda (Máx 3 puntos)"), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 10, utf8_decode("Comentarios"), 'L,T', 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(115, 8, utf8_decode($evaluacion->importancia_social), 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje: "), 'L,T,B', 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_importancia_social), 'R,T,B', 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Subtotal: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->subtotal_apropiacion), 'R,T,B', 0, 'C');
        //
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(75, 6, utf8_decode("Puntaje Total: "), 'L,T,B', 0, 'C', 'true');
        $this->SetFont('Arial', '', 14);
        $this->Cell(115, 6, utf8_decode($evaluacion->puntaje_total), 'R,T,B', 0, 'C', 'true');
        
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

