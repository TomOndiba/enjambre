<?php

/**
 * 
 * @author Eika Parra
 */

require_once (elgg_get_plugins_path() . 'bitacoras/print_pdf/fpdf/fpdf.php');
//$url = $_SERVER['DOCUMENT_ROOT'];
//require_once('/var/www/html/elgg2/print_pdf/fpdf/fpdf.php');
//require_once($url.'/elgg2/print_pdf/fpdf/fpdf.php');

class imprimirPDF extends FPDF {

// Cabecera de página
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(238, 188, 6);
        $this->Cell(0, 0,"", 0, 0, 'I');
        $this->Ln(5);
    }

// Pie de página
    function Footer() {
// Posición: a 1,5 cm del final
        $this->SetY(-15);
// Arial italic 8
        $this->SetFont('Arial', 'I', 8);
// Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}' . '                                                                    '.  elgg_get_site_url(), 0, 0, 'D');
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
        $w = array(40, 20, 20, 40, 20, 40);
// Cabeceras
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(234, 243, 243); //Letra color blanco
        #EAF3F3
        for ($i = 0; $i < count($header); $i++) {

            $this->Cell($w[$i], 6, $header[$i], 0, 0, 'C');
        }
        $this->Ln();
// Datos
        foreach ($data as $row) {
            $this->SetFont('Arial', '', 10);
            $this->Cell($w[0], 6, $row[0], 0, 0, 'C');
            $this->Cell($w[1], 6, $row[1], 0, 0, 'C');
            $this->Cell($w[2], 6, $row[2], 0, 0, 'C');
            $this->Cell($w[3], 6, $row[3], 0, 0, 'C');
            $this->Cell($w[4], 6, $row[4], 0, 0, 'I');
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[5], 6, $row[5], 0, 0, 'L');
            $this->Ln();
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Una tabla más completa
    function pintarTable($header, $data, $w) {
        
     
        
        error_log(sizeof($w)."---".$w[0].", ".$w[1].", ".$w[2].", ".$w[3]);
// Anchuras de las columnas
        
// Cabeceras
        
//        $this->SetXY(10,17);
        $this->SetX(15);
        $this->SetFont('Arial', 'B', 9);
        $this->SetFillColor(22, 127, 146); //Fondo verde de celda
      
        for ($i = 0; $i < count($header); $i++){
            $this->Cell($w[$i], 6, utf8_decode($header[$i]), 1, 0, 'L', true);
        }
          $this->Ln();
// Datos
        $this->SetFont('Arial', '', 9);
        $this->SetFillColor(234, 243, 243); //Letra color blanco);//Fondo verde de celda
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera=false;
      
        foreach ($data as $row) {
             $this->SetX(15);
            for($i=0; $i<count($row); $i++){
            $long=strlen($row[$i]);
            
//            if($long>=$w[$i]){
//            $this->MultiCell($w[$i], 6,utf8_decode($row[$i]), 1, 0, 'L', $bandera);   
//            }
//            else{
            $this->Cell($w[$i], 6,utf8_decode($row[$i]), 1, 0, 'L', $bandera);
//            }
//            $this->Cell($w[$i],6,wordwrap(utf8_decode($row[$i]), 20, "\n"),0,0, 'C');
            }
            $this->Ln();
            $bandera=!$bandera;
        }
// Línea de cierre
//        $this->Cell(array_sum($w), 0, '', 'T');
    }
    
    
    
    //***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
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