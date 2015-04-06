<?php


elgg_load_css('logged');
$id = get_input('id');
$grupo = new ElggGrupoInvestigacion($id);
$title = $grupo->name;


$content.= elgg_view('grupo_investigacion/profile/informacion_grupo', array('grupo'=>$grupo));

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 