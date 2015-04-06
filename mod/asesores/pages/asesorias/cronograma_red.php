<?php

elgg_load_css('reveal');
elgg_load_css("coordinacion");
$title = "Asesoria de investigaciones";
$params=array("id_red"=>  get_input("guid_red"), "id_inv"=> get_input("guid_inv"));
$content = elgg_view('asesorias/cronograma_red', $params);
$body = array('content' => $content);

echo elgg_view_page($title, $body, "asesores", array());

