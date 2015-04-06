<?php
elgg_load_js('validarCampos');
elgg_load_js('sumar');


$puntaje_bitacora1=elgg_view('input/number', array('id'=>'input1','name' => 'puntaje_bitacora1', 'class'=>'suma','required'=>'true', 'value'=>$vars['puntaje1']));
$puntaje_bitacora2=  elgg_view('input/number', array('id'=>'input2','name' => 'puntaje_bitacora2' , 'class'=>'suma','required'=>'true', 'value'=>$vars['puntaje2']));
$puntaje_bitacora3=  elgg_view('input/number', array('id'=>'asistentes','name' => 'puntaje_bitacora3' , 'class'=>'suma','required'=>'true', 'value'=>$vars['puntaje3']));
$puntaje_total= elgg_view('input/number', array('id'=>'resultado','name' => 'puntaje_total', 'id'=>'resultado','readonly'=>'true', 'value'=>$vars['puntaje_total']));
$concepto_evaluacion=  elgg_view('input/text', array('id'=>'concepto','name' => 'concepto','required'=>'true', 'value'=>$vars['concepto']));
$observaciones_input= elgg_view('input/longtext', array('name'=>'observacion', 'value'=>$vars['observacion']));
$id_investigacion=  elgg_view('input/hidden', array('name'=>'id_inv', 'value'=>$vars['guid_inv']));
$id_evaluacion= elgg_view('input/hidden', array('name'=>'guid_evaluacion', 'value'=>$vars['guid_evaluacion']));

$button = elgg_view('input/submit', array( 'value' => elgg_echo('Guardar')));


$grupo=$vars['grupo'];
$tabla.="<div><div>"
        . "<label> <center>FORMATO 1     <a href='".$vars['href']."'> <span class='elgg-icon elgg-icon-print-alt '></a> </center></label><br> "
        . "<label> <center>VALORACION DE LOS GRUPOS PROPONENTES INVESTIGACIONES ABIERTAS </center> </label><br>"
        . " <label><center>CONVOCATORIA DEPARTAMENTAL</center></label><br>"
        . "<label>Departamento/Municipio:  </label> ".$vars['departamento']."/".$vars['municipio']."<br> "
        . "<label>Nombre de la Institucion Educativa:  </label>".$vars['institucion']." <br>"
        . "<label>Nombre del Grupo de Investigación:  </label>$grupo<br>"
        . "<label>Pregunta de Investigación:  </label>".$vars['pregunta']."<br>"
        . "<label>Nombre del Valorador:  </label>".$vars['valorador']."<br>"
        . "<label>Área Temática:  </label>".$vars['area']."<br><br>"
        . "<table><tr><th colspan='2'><center><label>Aspectos por Valorar:</label> </center></th> <th> <center> <label>Puntaje </label> </center> </th></tr>"
        . "<tr><td colspan='2'>Bitacora No. 1 del Grupo de Investigación y registro No.1 del Maestro(a). Estar en la Onda de Ondas: Se presenta con claridad la forma de organización del Grupo,"
        . " sus roles y el proceso desarrollado para ello.(Califique de 1 al 10)</td><td>".$puntaje_bitacora1."</td></tr>"
        . "<tr><td colspan='2'>Bitacora No. 2 del Grupo de Investigación y registro No.2 del Maestro(a). Perturbación de la Onda: Se presenta el proceso de formulación y selección de la pregunta."
        . "La Pregunta de Investigación es clara y Coherente.(Califique de 1 al 10)</td><td>".$puntaje_bitacora2."</td></tr>"
        . "<tr><td colspan='2'>Bitacora No. 3 del Grupo de Investigación y registro No.3 del Maestro(a). Superposición de la Onda: La Descripción y Justificación del problema de investigación es clara y coherente con la pregunta."
        . "La reflexión del maestro(a) da cuenta del proceso realizado.(Califique de 1 al 10)</td><td> ".$puntaje_bitacora3."</td></tr>"
        . "<td colspan='2'>Puntaje Total(máximo 30 puntos: </td><td>".$puntaje_total."</td></tr></table>"
        . "<label> Concepto de Evaluación:".$concepto_evaluacion.$id_investigacion.$id_evaluacion."<br>"
        . "<label> Observacion:</label> Sugerencias que contribuyan al mejoramiento del proceso pedagógico de formación del grupo. <br>".$observaciones_input."</div></div>"
        . "<div class='elgg-foot' align='center'>$button</div>";


echo $tabla;