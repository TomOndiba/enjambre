<?php

$usuario = $vars['guid'];

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Inscribirme')
 ));
$lineasTematicas= elgg_get_lineas_tematicas();

foreach ($lineasTematicas as $linea){
    $options_select[$linea->name]=$linea->guid;
}

$select_lineas=elgg_view('input/checkboxes', array('name'=>'lineas', 'id'=>'convocar', 	'align' => 'horizontal', 'options'=>$options_select));
$user=elgg_view('input/hidden', array('name'=>'guid', 'value'=>$usuario));



echo <<<HTML
<div class="form-nuevo-album">
    <h2 class="title-legend">Inscripción como Asesor</h2>
<div>
       <label>Lineas Tematicas a las que desea inscribirse:</label><br />$select_lineas  $user
</div>
<div class="contenedor-button">$button</div>
</div>
HTML;
?>