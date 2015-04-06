<?php
$id_conv = get_input("id");
elgg_load_css('logged');
$title = "Convocatoria";
$params = array('id_conv'=> $id_conv);
$content = elgg_view('convocatorias/ver_convocatoria', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());

