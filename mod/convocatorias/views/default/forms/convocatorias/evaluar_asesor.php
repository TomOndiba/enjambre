<?php

$evaluacion= new ElggEvaluacionAsesor($vars['evaluacion']->guid);
$asesor= $evaluacion->container_guid;
$convocatoria= $evaluacion->owner_guid;

$educacion=elgg_view('input/number', array('id'=>'input1','name' => 'educacion','value'=>$evaluacion->estudios ,'class'=>'suma','required'=>'true',));
$experiencia=  elgg_view('input/number', array('id'=>'input2','name' => 'experiencia' ,'value'=>$evaluacion->experiencia, 'class'=>'suma','required'=>'true', ));
$puntaje_total= elgg_view('input/number', array('id'=>'resultado','name' => 'total', 'value'=>$evaluacion->total, 'id'=>'resultado','readonly'=>'true',));
$as= elgg_view('input/hidden', array('name'=>'asesor', 'value'=>$asesor));
$con= elgg_view('input/hidden', array('name'=>'convocatoria', 'value'=>$convocatoria));
$con.= elgg_view('input/hidden', array('name'=>'evaluacion', 'value'=>$evaluacion->guid));

$button = elgg_view('input/submit', array( 'value' => elgg_echo('Guardar')));
?>
<table class="elgg-table">
    <tr><td>Educacion</td><td><?php echo $educacion;?></td></tr>
    <tr><td>Experiencia</td><td><?php echo $experiencia;?></td></tr>
    <tr><td>Total</td><td><?php echo $puntaje_total;?></td></tr>
</table>
<?php echo $button.$as.$con; ?>