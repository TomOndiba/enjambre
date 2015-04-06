<?php
/** Upload a new file 
 *
 * @package ElggFerias
 */

elgg_load_css('logged');

$id= get_input('id');
$feria = new ElggFeria($id);

$title = $feria->name;
$user = elgg_get_logged_in_user_entity();


 $params['guid']=$feria->guid;
 elgg_load_library('elgg:file');


gatekeeper();
group_gatekeeper();

// create form

//$content = elgg_view('redes_tematicas/profile/header', $params);
$params['autoformacion']="";
$content.= elgg_view('archivos/ver_archivos', $params);

$body = array('izquierda'=>elgg_view('ferias_publico/profile/menu', array('feria'=>$feria)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('feria'=>$feria)); 

