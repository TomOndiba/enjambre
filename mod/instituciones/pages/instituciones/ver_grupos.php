<?php

elgg_load_css('logged');
$idGrupo = get_input('id');
$institucion = new ElggInstitucion($idGrupo);
$title = $institucion->name;

$content.= elgg_view('instituciones/ver_grupos', array('id_institucion'=>$idGrupo));
$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 


