<?php

elgg_load_js('acciones_investigacion');



$guid_grupo = $vars['grupo']['guid'];
$guid_investigacion = $vars['id_investigacion'];

$ferias = $vars['ferias'];

$ferias_input = elgg_view('input/dropdown', array('name' => 'ferias', 'class' => 'cargar-feria', 'id' => 'inc_feria', 'align' => 'Vertical', 'options_values' => $ferias));

$x = elgg_view('input/hidden', array('name' => 'id_investigacion', 'class' => 'investigacion', 'value' => $guid_investigacion));

$y = elgg_view('input/hidden', array('name' => 'id_grupo', 'class' => 'grupo', 'value' => $guid_grupo));

$params = array();
$content = elgg_view('investigacion/lista_lineas_convocatoria', $params);

$url = elgg_get_site_url() . "investigaciones/ver/$guid_investigacion/grupo/$guid_grupo";


echo <<<HTML
<div class="box contet-grupo-investigacion">
    <h2 class="title-legend">Ferias Abiertas</h2>      
       $ferias_input
       <br>
       $x
       $y
       $content


</div>

HTML;
?>
