<?php

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url . '/elgg2/print_pdf/fpdf/fpdf.php');

class formato_inscripcion_feria_1 extends FPDF {

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
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}' . '                                                                    '.elgg_get_site_url(), 0, 0, 'D');
    }

    function TablaDeDatosInstitucion($guid_inscripcion) {
        $inscripcion = new ElggFormInscripcionFeria($guid_inscripcion);
        $this->SetFillColor(181, 181, 181);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 12);

        $this->Cell(190, 4, utf8_decode("Inscripcion a Feria No. " . $this->numero($inscripcion->numero_inscripcion)), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->Cell(190, 6, utf8_decode("Información de la institución a la que pertenece el grupo"), 1, 1, 'C', 'true'); //Aqui va el Label
//$this->Ln();
        $this->Cell(72, 6, utf8_decode("Tipo de Feria"), 1); //Aqui va el Label
        $this->SetFont('Arial', '', 11);
        $this->Cell(118, 6, utf8_decode($inscripcion->tipo_feria), 1); //Aqui va la variable
        $this->SetFont('Arial', 'B', 12);
        $this->Ln();
        $this->Cell(72, 6, utf8_decode("Nombre de la institución educativa"), 1); //Aqui va el Label
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(118, 6, utf8_decode($inscripcion->nombre_institucion), 1); //Aqui va la variable
        $this->SetFont('Arial', 'B', 12);
        $this->MultiCell(190, 6, utf8_decode("Nombre del rector o representante legal de la institución"), 1, 'J'); //Aqui va el Label
//        $this->SetY(32);
//        $this->SetX(82);
//        $this->SetFont('Arial', '', 12);
        $this->Cell(190, 6, utf8_decode($inscripcion->rector_institucion), 1); //Aqui va la variable
//        //$this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Ln();
        $this->MultiCell(190, 6, utf8_decode('Municipio y departamento (para invitados internacionales, nombre del país de origen y programa que representa)'), 1, 'J'); //Aqui va la variable
//        $this->SetY(44);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(190, 12, utf8_decode($inscripcion->municipio_dpto), 1, 'J'); //Aqui va la variable
//        $this->Ln(24);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(72, 6, utf8_decode("Dirección"), 1); //Aqui va el Label
//        $this->SetY(68);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 11);
        $this->Cell(118, 6, utf8_decode($inscripcion->direccion_institucion), 1, 'J'); //Aqui va la variable
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(72, 6, utf8_decode("Telefono"), 1); //Aqui va el Label
//        $this->SetY(74);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 11);
        $this->Cell(118, 6, utf8_decode($inscripcion->telefono_institucion), 1); //Aqui va la variable
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(72, 6, utf8_decode("Correo"), 1); //Aqui va el Label
//        $this->SetY(80);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 12);
        $this->Cell(118, 6, utf8_decode($inscripcion->email_institucion), 1); //Aqui va la variable
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Información del grupo de investigación"), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->MultiCell(190, 7, utf8_decode("Nombre del grupo de investigación"), 1, 'C'); //Aqui va el Label
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(190, 7, utf8_decode($inscripcion->nombre_grupo), 1, 'C'); //Aqui va la variable        
        $header = array(utf8_decode('Nombre'), utf8_decode('Documento'), utf8_decode('Grado'), utf8_decode('Edad'), utf8_decode('Fecha Nacimiento'), utf8_decode('E-mail'));
        $data = $this->datos_estudiantes($inscripcion->estudiantes_grupo);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Estudiantes que asisitirán a la feria"), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->estudianteTable($header, $data);
        $data2 = $this->datos_maestros($inscripcion->maestros_grupo);
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Maestros que asisitirán a la feria"), 1, 1, 'C', 'true'); //Aqui va el Label
        $header2 = array(utf8_decode('Nombre'), utf8_decode('Asignatura'), utf8_decode('Teléfono'), utf8_decode('E-mail'));
        $this->maestro_table($header2, $data2);
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Nivel de participación de los grupos de investigación"), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->SetFont('Arial', '', 12);
        $this->Cell(190, 6, utf8_decode(get_entity($inscripcion->nivel_feria)->title), 1, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Categorías de las investigaciones que participan en la feria"), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->SetFont('Arial', '', 12);
        $this->Cell(190, 6, utf8_decode($inscripcion->categorias_feria), 1, 1, 'C');
        if ($inscripcion->categorias_feria == "Innovación") {
            $this->Cell(190, 6, utf8_decode("Subategorías de innovación en las que participa en la feria"), 1, 1, 'C', 'true'); //Aqui va el Label
            $this->SetFont('Arial', '', 12);
            $this->Cell(190, 6, utf8_decode(get_entity($inscripcion->subcategorias_innovacion)->title), 1, 1, 'C');
        }
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Formas de participación"), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->SetFont('Arial', '', 12);
        $this->Cell(190, 6, utf8_decode($inscripcion->formas_participacion), 1, 1, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Información de la investigación"), 1, 1, 'C', 'true'); //Aqui va el Label
        $this->MultiCell(190, 6, utf8_decode('Título de la investigación'), 1, 'C');
//        $this->SetY(177);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(190, 6, utf8_decode($inscripcion->titulo_investigacion), 1, 'J');
        $this->SetFont('Arial', 'B', 12);
        $this->MultiCell(190, 6, utf8_decode('Perturbación de la onda (Pregunta de investigación)'), 1, 'C');
//        $this->SetY(183);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(190, 10, utf8_decode($inscripcion->perturbacion_onda), 1, 'J');
        $this->SetFont('Arial', 'B', 12);
        $this->MultiCell(190, 6, utf8_decode('Superposición de las ondas (Problema de investigación)'), 1, 'C');
//        $this->SetY(195);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(190, 12, utf8_decode($inscripcion->superposicion_onda), 1, 'J');
        $this->SetFont('Arial', 'B', 12);
        $this->MultiCell(190, 9, utf8_decode('Trayectorias de indagación: (descripciòn de la metodología'), 1, 'C');
//        $this->SetY(207);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(190, 12, utf8_decode($inscripcion->trayectoria_indagacion), 1, 'J');
        $this->SetFont('Arial', 'B', 12);
        $this->MultiCell(190, 9, utf8_decode('Breve resumen de las conclusiones o los resultados de la investigación'), 1, 'C');
        $this->SetFont('Arial', '', 10);
//        $this->Ln();
        $this->MultiCell(190, 12, utf8_decode($inscripcion->resumen_conclusiones), 1);
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Información de la línea de investigación"), 1, 1, 'C', 'true');
        $this->SetFont('Arial', '', 12);
        $this->Cell(80, 6, utf8_decode('Línea de investigación a la que pertenece'), 1, 'J');
        $this->SetFont('Arial', '', 10);
        $this->Cell(110, 6, utf8_decode($inscripcion->linea_tematica), 1);
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->Cell(190, 6, utf8_decode('Nombre del asesor de línea temática en el programa'), 1, 0, 'C');
//        $this->SetY(10);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->Cell(190, 6, utf8_decode($inscripcion->nombre_asesor), 1, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(190, 6, utf8_decode('Área temática de la feria a la que se inscribe'), 1, 'C');
//        $this->SetY(22);
//        $this->SetX(82);
        //$this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(190, 6, utf8_decode(get_entity($inscripcion->area_feria)->title), 1, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 6, utf8_decode("Información de la exposición"), 1, 1, 'C', 'true');
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(190, 8, utf8_decode('Materiales para ambientar el puesto (enumere los insumos, las pruebas y los materiales que van a mostrar, al igual que los equipos que transportará para ello)'), 1, 'J');
//        $this->SetY(40);
//        $this->SetX(82);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(190, 15, utf8_decode($inscripcion->materiales), 1);
        $this->MultiCell(190, 15, utf8_decode('Firma del responsable del grupo:'), 1, 'J');
        $this->MultiCell(190, 8, utf8_decode('Nota1: Para que la inscripción sea efectiva se debe anexar el informe de la investigación y entregar, en el momento de la acreditación en la feria, los diarios o cuadernos de campo. '
                        . 'Nota 2: La firma del formato de inscripción implica la aceptación del reglamento de participación, montaje y valoración. Bajo ningún concepto se puede modificar la planilla de inscripción.'), 1, 'J');
    }

    function numero($numer) {
        return str_pad($numer, 4, "0", STR_PAD_LEFT);
    }

// Una tabla más completa
    function estudianteTable($header, $data) {
// Anchuras de las columnas
        $w = array(40, 40, 20, 10, 40, 40);
// Cabeceras
        $this->SetFont('Arial', 'B', 12);
        for ($i = 0; $i < count($header); $i++) {

            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
// Datos
        if (sizeof($data) > 6) {
            foreach ($data as $row) {
                $this->SetFont('Arial', '', 10);
                $this->Cell($w[0], 6, utf8_decode($row[0]), 1, 0, 'C');
                $this->Cell($w[1], 6, utf8_decode($row[1]), 1, 0, 'C');
                $this->Cell($w[2], 6, utf8_decode($row[2]), 1, 0, 'C');
                $this->Cell($w[3], 6, utf8_decode($row[3]), 1, 0, 'C');
                $this->Cell($w[4], 6, utf8_decode($row[4]), 1, 0, 'I');
                $this->SetFont('Arial', '', 8);
                $this->Cell($w[5], 6, utf8_decode($row[5]), 1, 0, 'L');
                $this->Ln();
            }
        } else {
            $this->SetFont('Arial', '', 10);
            $this->Cell($w[0], 6, utf8_decode($data[0]), 1, 0, 'C');
            $this->Cell($w[1], 6, utf8_decode($data[1]), 1, 0, 'C');
            $this->Cell($w[2], 6, utf8_decode($data[2]), 1, 0, 'C');
            $this->Cell($w[3], 6, utf8_decode($data[3]), 1, 0, 'C');
            $this->Cell($w[4], 6, utf8_decode($data[4]), 1, 0, 'I');
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[5], 6, utf8_decode($data[5]), 1, 0, 'L');
            $this->Ln();
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function maestro_table($header, $data) {
// Anchuras de las columnas
        $w = array(50, 60, 30, 50);
// Cabeceras
        $this->SetFont('Arial', 'B', 12);
        for ($i = 0; $i < count($header); $i++) {

            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
// Datoserror_lo
        if (sizeof($data) > 4) {
            foreach ($data as $row) {
                $this->SetFont('Arial', '', 10);
                $this->Cell($w[0], 6, utf8_decode($row[0]), 1, 0, 'C');
                $this->Cell($w[1], 6, utf8_decode($row[1]), 1, 0, 'C');
                $this->Cell($w[2], 6, utf8_decode($row[2]), 1, 0, 'C');
                $this->SetFont('Arial', '', 8);
                $this->Cell($w[3], 6, utf8_decode($row[3]), 1, 0, 'L');
                $this->Ln();
            }
        } else {
            $this->SetFont('Arial', '', 10);
            $this->Cell($w[0], 6, utf8_decode($data[0]), 1, 0, 'C');
            $this->Cell($w[1], 6, utf8_decode($data[1]), 1, 0, 'C');
            $this->Cell($w[2], 6, utf8_decode($data[2]), 1, 0, 'C');
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[3], 6, utf8_decode($data[3]), 1, 0, 'L');
            $this->Ln();
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    function datos_estudiantes($guids) {
        $ret = array();
        if (sizeof($guids) > 1) {
            $guids_es = explode('-', $guids);
            if (sizeof($guids_es)) {
                foreach ($guids_es as $ge) {
                    if (!empty($ge)) {
                        $estudiante = get_entity($ge);
                        $fecha = $estudiante->fecha_nacimiento;
                        list($Y, $m, $d) = explode("-", $fecha);
                        $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

                        $ret = array($estudiante->name . ' ' . $estudiante->apellidos, $estudiante->numero_documento, $estudiante->curso, $edad, $fecha, $estudiante->email);
                    }
                }
            }
        } else {
            $estudiante = get_entity($guids);
            $fecha = $estudiante->fecha_nacimiento;
            list($Y, $m, $d) = explode("-", $fecha);
            $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

            $ret = array($estudiante->name . ' ' . $estudiante->apellidos, $estudiante->numero_documento, $estudiante->curso, $edad, $fecha, $estudiante->email);
        }
        return $ret;
    }

    function datos_maestros($guids) {
        $ret = array();
        if (sizeof($guids) > 1) {
            $guids_es = explode('-', $guids);
            if (sizeof($guids_es)) {
                foreach ($guids_es as $ge) {
                    if (!empty($ge)) {
                        $maestro = get_entity($ge);
                        $ret = array($maestro->name . ' ' . $maestro->apellidos, $maestro->area_conocimiento, $maestro->telefono, $maestro->email);
                    }
                }
            }
        } else {
            $maestro = get_entity($guids);
            $ret = array($maestro->name . ' ' . $maestro->apellidos, $maestro->area_conocimiento, $maestro->telefono, $maestro->email);
        }
        return $ret;
    }

}

?>
