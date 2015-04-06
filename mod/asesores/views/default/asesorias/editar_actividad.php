<?php

$id_asesoria=get_input("owner");
$asesoria=  new ElggAsesoria($id_asesoria);
$params = array("id_asesoria" => $id_asesoria, 'nombre'=>$asesoria->title, 'fecha'=>$asesoria->fecha, 
                'tipo'=>$asesoria->tipo, 'modo'=>$asesoria->modo, 'observaciones'=>$asesoria->observaciones);

$content = elgg_view_form('asesorias/editar',null, $params);

echo $content;


