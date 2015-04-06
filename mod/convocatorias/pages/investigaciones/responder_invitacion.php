<?php
$id_conv = get_input("id_conv");
$id_inv = get_input("id_inv");
$id_linea = get_input("id_linea");
elgg_load_css('logged');
$title = "Convocatoria";
$params = array('id_conv'=> $id_conv, 'id_inv'=>$id_inv, 'id_linea'=>$id_linea);
$content = elgg_view('investigaciones/responder_invitacion', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "lista", array());


