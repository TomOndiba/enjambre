<?php

elgg_load_css('logged');

$title="Enviar Mensaje";

$id=  get_input('id'); //id del grupo
$miembros= elgg_listar_solicitud_miembro($id);//lista los usuarios que solicitaron pertenecer a un grupo

$grupo = new ElggGrupoInvestigacion($id);
$title = $grupo->name;
$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);
$params['title'] = $title;
$params['grupo'] = array(
    'nombre' => $grupo->name,
    'guid' => $grupo->guid,
    'rol_user' => $rol,
    //'imagen'=>$grupo->getIconURL(),
    'descripcion'=>$grupo->description,
);


$params['rol_user']=$permiso;
//$content = elgg_view('grupo_investigacion/profile/header', $params);

$params['guid']=$grupo->guid;
$content= elgg_view_form("grupo_investigacion/enviarMensaje", NULL, $params);
//$content.= elgg_view('grupo_investigacion/enviar_mensaje', NULL, $params);

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 
