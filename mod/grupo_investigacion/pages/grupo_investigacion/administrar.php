<?php

$title = "Administrar Grupo de Investigación";
$grupos= elgg_listar_grupos_investigacion();

$params = array('grupos'=>$grupos);
$content = elgg_view('grupo_investigacion/administrar', $params);
$vars = array('content' => $content);
$body = elgg_view_layout('one_sidebar', $vars);
echo elgg_view_page($title, $body);
