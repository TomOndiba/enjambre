<?php

elgg_load_css("coordinacion");
$title = "Convocar Evaluadores";

$gui_conv =get_input("id_conv");

$params=array("id"=>  $gui_conv, 'nombre_conv' => get_entity($gui_conv)->name);

$content = elgg_view('evaluadores/convocar_evaluadores',$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());
