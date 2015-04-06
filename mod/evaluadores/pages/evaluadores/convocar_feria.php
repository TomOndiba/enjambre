<?php
elgg_load_css("coordinacion");

$title = "Convocar Evaluadores a Feria";

$gui_feria =get_input("id_feria");

$params=array("guid_feria"=>  $gui_feria, 'nombre_feria' => get_entity($gui_feria)->name);

$content = elgg_view('evaluadores/convocar_evaluadores_feria',$params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());

