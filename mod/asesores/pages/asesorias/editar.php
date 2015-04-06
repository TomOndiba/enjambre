<?php

elgg_load_css('reveal');
elgg_load_css("coordinacion");
$title = "Asesoria de investigaciones";
$id_asesoria = get_input("guid_asesoria");
$asesoria=  new ElggAsesoria($id_asesoria);
$params = array("id_asesoria" => $id_asesoria, 'nombre'=>$asesoria->title, 'fecha'=>$asesoria->fecha, 
                'tipo'=>$asesoria->tipo, 'modo'=>$asesoria->modo, 'observaciones'=>$asesoria->observaciones);
$content = elgg_view_form('asesorias/editar', null, $params);
$body = array('content' => $content);

echo elgg_view_page($title, $body, "asesores", array());

