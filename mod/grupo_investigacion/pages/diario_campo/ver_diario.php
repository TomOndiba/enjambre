<?php
elgg_load_css('logged');


$grupo= new ElggGrupoInvestigacion(get_input('id'));

$guid=  get_input('id_cuaderno');

$diario= elgg_get_diario_campo($guid);
$content.= elgg_view('diario_campo/ver_diario', array('diario'=>$diario, 'etapa'=>"cero"));

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 
