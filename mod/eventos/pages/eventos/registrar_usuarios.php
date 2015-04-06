<?php



$guid=  get_input('id_evento');
$guid_conv= get_input('id_conv');

elgg_load_css("coordinacion");


$params = array('evento'=>$guid, 'id_conv'=>$guid_conv);
$content .= elgg_view('eventos/registrar_usuarios', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());


