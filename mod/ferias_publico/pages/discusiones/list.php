<?php
/** Upload a new file 
 *
 * @package ElggRedesTematicas
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

$content.= elgg_view('discusiones/ver_discusiones', $params);

$body = array('izquierda'=>elgg_view('ferias_publico/profile/menu', array('feria'=>$feria)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('feria'=>$feria)); 

