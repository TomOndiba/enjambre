<?php

elgg_load_css('logged');

$clave= get_input("clave");

$title = "Resultados de la búsqueda";

$params=array("clave"=>$clave);
$content = elgg_view('busqueda/resultados', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());

