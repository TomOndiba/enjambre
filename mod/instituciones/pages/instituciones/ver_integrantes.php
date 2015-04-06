<?php
elgg_load_css('logged');

$idGrupo = get_input('id');
$institucion = new ElggInstitucion($idGrupo);
$title = $institucion->name;
$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_en_grupo_investigacion($institucion, $user);
$params['title'] = $title;
$params['institucion'] = array(
    'nombre' => $institucion->name,
    'guid' => $institucion->guid,
  
);

echo "<input type='hidden' value=$institucion->guid id='institucion'>";
$content.= elgg_view('instituciones/ver_integrantes', array('institucion'=>$institucion->guid));
$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 

