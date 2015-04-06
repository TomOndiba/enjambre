<?php

$guid_feria = $vars['guid_feria'];
$feria_input=elgg_view('input/hidden', array('id'=>'feria', 'name'=>'feria', 'value'=>$guid_feria));

$feria=new ElggFeria($guid_feria);

$name = $vars['name']; //municipal, departamental
$name_input=elgg_view('input/hidden', array('id'=>'namee', 'name'=>'namee', 'value'=>$name));

$relacion = $vars['relacion']; //mun, dptal
$relacion_input=elgg_view('input/hidden', array('id'=>'relation', 'name'=>'relation','value'=>$relacion));

$user=  elgg_get_logged_in_user_entity();
$evaluador_input=elgg_view('input/hidden', array('id'=>'evaluador', 'name'=>'evaluador','value'=>$user->guid));

echo $name_input.$relacion_input;
echo $evaluador_input;
echo $feria_input;
?>

<div class='titulo-coordinacion'>
    <h2>Investigaciones asignadas dentro de <?php echo $feria->name?></h2>
</div>

<ul class="tabs-coordinacion">
    <li id="inicial" class="selected"><a id="inicial" href="#inicial" class="ver-lista-investigaciones" name="investigaciones_inicial" rel="nofollow">Evaluación Inicial</a></li>
    <li id="en_sitio"><a href="#en_sitio" id="en_sitio" class="ver-lista-investigaciones" name="investigaciones_en_sitio" title="" rel="nofollow">Evaluación en Sitio</a></li>
</ul>

<div id="ajax-investigaciones1">
</div>