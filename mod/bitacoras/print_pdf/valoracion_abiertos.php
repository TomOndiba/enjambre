<?php

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
////require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url.'/elgg2/print_pdf/fpdf/fpdf.php');

class valoracion_abiertos extends FPDF {

// Cabecera de página
    function Header() {
        //Define tipo de letra a usar, Arial, Negrita, 15
        $this->SetFont('Arial', 'B', 14);

        /* Líneas paralelas
         * Line(x1,y1,x2,y2)
         * El origen es la esquina superior izquierda
         * Cambien los parámetros y chequen las posiciones
         * */
        $this->Line(10, 10, 195, 10);
        $this->Line(10, 26, 195, 26);

        /* Explicaré el primer Cell() (Los siguientes son similares)
         * 30 : de ancho
         * 25 : de alto
         * ' ' : sin texto
         * 0 : sin borde
         * 0 : Lo siguiente en el código va a la derecha (en este caso la segunda celda)
         * 'C' : Texto Centrado
         * $this->Image('images/logo.png', 152,12, 19) Método para insertar imagen
         *     'images/logo.png' : ruta de la imagen
         *     152 : posición X (recordar que el origen es la esquina superior izquierda)
         *     12 : posición Y
         *     19 : Ancho de la imagen (w)
         *     Nota: Al no especificar el alto de la imagen (h), éste se calcula automáticamente
         * */

        //$this->Cell(30,25,'',0,0,'C',$this->Image('/var/www/html/elgg2/print_pdf/Colciencias.jpg', 152,12, 19));
        //$this->Cell(111,25,'ALGÚN TÍTULO DE ALGÚN LUGAR',0,0,'C', $this->Image('images/logoIzquierda.png',20,12,20));		
        $this->SetFillColor(255, 255, 148);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(185, 5, utf8_decode("FORMATO 1:"), 0, 'C', TRUE);
        $this->MultiCell(185, 5, utf8_decode("VALORACIÓN DE LOS GRUPOS PROPONENTES INVESTIGACIONES ABIERTAS CONVOCATORIA DEPARTAMENTAL"), 0, 'C', true);
        //$this->Cell(40,25,'',0,0,'C',$this->Image('/var/www/html/elgg2/print_pdf/Ondas.png', 175, 12, 19));
        //Se da un salto de línea de 25
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

    function TablaDeDatos($valores) {
        $this->Cell(70, 7, utf8_decode("Departamento / Municipio:"), 1); //Aqui va el Label
        $this->MultiCell(115, 7, utf8_decode($valores[0]), 1); //Aqui va la variable
        $this->Cell(70, 7, utf8_decode("Nombre de la institución Educativa "), 1); //Aqui va el Label
        $this->MultiCell(115, 7, utf8_decode($valores[1]), 1); //Aqui va la variable
        $this->Cell(70, 7, utf8_decode("Nombre del grupo de investigación "), 1); //Aqui va el Label
        $this->MultiCell(115, 7, utf8_decode($valores[2]), 1); //Aqui va la variable
        $this->Cell(70, 7, utf8_decode("Pregunta de investigación "), 1); //Aqui va el Label
        $this->MultiCell(115, 7, utf8_decode($valores[3]), 1); //Aqui va la variable
        $this->Cell(70, 7, utf8_decode("Nombre del valorador "), 1); //Aqui va el Label
        $this->MultiCell(115, 7, utf8_decode($valores[4]), 1); //Aqui va la variable
        $this->MultiCell(185, 7, utf8_decode("Area Temática: ".$valores[5]), 1); //Aqui va el Label Finaal
    }

    function TablaDePuntajes($valores) {
        $this->SetFillColor(255, 255, 148);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(115, 7, utf8_decode("Aspectos por valorar"), 1, 0, 'C', true); //Aqui va el Label       
        $this->Cell(70, 7, utf8_decode("Puntaje"), 1, 0, 'C', true); //Aqui va la variable 
        $this->Ln();
        $tot = $valores[0]+$valores[1]+$valores[2];
        $this->MultiCell(115, 7, utf8_decode("Bitácora 1 del Grupo de Investigación y registro No. 1 del maestro (a). Estar en la Onda de Ondas: Se presenta con claridad la forma de organización del grupo, sus roles y el proceso desarrollado para ello. (califique de 1 a 10)"), 1, 'J');
        $this->SetY(89);
        $this->SetX(125);
        $this->Cell(70, 28, utf8_decode("$valores[0]"), 1, 0, 'C'); //Aqui va la variable 
        $this->Ln();
        $this->MultiCell(115, 7, utf8_decode("Bitácora No. 2 del grupo de investigación, Registro No. 2 del maestro (a) Perturbación de la Onda: Se presenta el proceso de formulación y selección  de la pregunta.La pregunta de investigación es clara y coherente (califique de 1 a 10)"), 1, 'J');
        $this->SetY(117);
        $this->SetX(125);
        $this->Cell(70, 35, utf8_decode("$valores[1]"), 1, 0, 'C'); //Aqui va la variable
        $this->Ln();
        $this->MultiCell(115, 7, utf8_decode("Bitácora No. 3 del grupo de investigación, Registro No. 3 del maestro (a) Superposición de la Onda: La descripción y justificación del problema de investigación es clara y coherente con la pregunta. La reflexión del maestro (a) da cuenta del proceso realizado (califique de  1 a 10)"), 1, 'J');
        $this->SetY(152);
        $this->SetX(125);
        $this->Cell(70, 35, utf8_decode("$valores[2]"), 1, 0, 'C'); //Aqui va la variable
        $this->Ln();
        $this->Cell(115, 7, utf8_decode("Puntaje total (máximo 30 puntos): "), 1, 0, 'L'); //Aqui va el Label 
        $this->Cell(70, 7, utf8_decode($tot), 1, 0, 'C'); //Aqui va la variable 
        $this->Ln();
        $this->MultiCell(185, 15, utf8_decode("Firma del valorador"), 1); //Aqui va la variable
        $this->MultiCell(185, 7, utf8_decode("Observaciones: Sugerencias que contribuyan al mejoramiento del proceso pedagógico de formación del grupo.\n"."\n".strip_tags($valores[3])), 1,'J');
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