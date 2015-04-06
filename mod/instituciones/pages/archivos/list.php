<?php
/** Upload a new file 
 *
 * @package ElggRedesTematicas
 */

elgg_load_css('logged');

$id= get_input('id');
$institucion = new ElggInstitucion($id);

$title = $institucion->name;
$user = elgg_get_logged_in_user_entity();

 
 
 $params['guid']=$institucion->guid;
 elgg_load_library('elgg:file');


gatekeeper();
group_gatekeeper();

// create form

//$content = elgg_view('redes_tematicas/profile/header', $params);
$params['autoformacion']="";
$content.= elgg_view('archivos/ver_archivos', $params);

$body = array('izquierda'=>elgg_view('instituciones/profile/menu', array('institucion'=>$institucion)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('institucion'=>$institucion)); 

