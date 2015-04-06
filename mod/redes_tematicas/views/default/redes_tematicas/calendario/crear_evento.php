<?php

echo elgg_view("vistas/js_timer");
$grupo = get_input('owner');
$params['entity']=$grupo;
$params['evento']=  get_input('evento');
$params['class'] = 'formulario-evento';
//$content = elgg_view('grupo_investigacion/profile/header', $params);
$content.= elgg_view_form('eventos/crear_evento', null,$params);
echo $content;
