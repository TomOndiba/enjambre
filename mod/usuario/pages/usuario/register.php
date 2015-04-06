<?php
/**
 * Page que redirecciona a registrar usuario
 */

//melany

elgg_load_css("inicio");

$evento= get_input("evento");
$id_conv=  get_input("id_conv");
$title = "Registrar Usuario";
elgg_load_js('mostrarcampos');

$instituciones= elgg_get_institucion();

$params = array('id_conv'=>$id_conv, 'evento'=>$evento, 'instituciones'=>$instituciones);
$content = elgg_view_form('usuario/register', NULL, $params);

$body = array('content' => $content);
echo elgg_view_page($title, $body, "registro", array());




