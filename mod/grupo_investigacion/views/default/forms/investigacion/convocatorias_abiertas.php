<?php

elgg_load_js('acciones_investigacion');

$guid_grupo = $vars['grupo']['guid'];
$guid_investigacion=$vars['id_investigacion'];


$grupo=new ElggGrupoInvestigacion($guid_grupo);

$convocatorias=  $vars['convocatorias'];


$convocatoria_input=elgg_view('input/dropdown', array('name'=>'convocatorias', 'class'=>'buscar','id'=>'convocar','align'=>'Vertical', 'options_values'=>$convocatorias));

$x = elgg_view('input/hidden', array('name' => 'id_investigacion','class' => 'investigacion', 'value' => $guid_investigacion));

$y = elgg_view('input/hidden', array('name' => 'id_grupo','class' => 'grupo', 'value' => $guid_grupo));

$params = array();
$content=  elgg_view('investigacion/lista_lineas_convocatoria',$params);

$url = elgg_get_site_url()."investigaciones/ver/$guid_investigacion/grupo/$guid_grupo";

echo <<<HTML
<div class="box contet-grupo-investigacion">
    <h2 class="title-legend">Convocatorias abiertas</h2>
      
       $convocatoria_input
       <br>
       $x
       $y
       $content

</div>

HTML;
?>