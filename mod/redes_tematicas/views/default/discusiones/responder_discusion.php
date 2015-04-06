<?php
$guid_annotation= get_input("annotation");

echo elgg_view('input/longtext', array('name' => 'respuesta','id'=>'respuesta', 'class'=>'input-responder-foro','title'=>$guid_annotation, 'value' => $value, "placeholder"=>'Escribe tu Comentario'));

