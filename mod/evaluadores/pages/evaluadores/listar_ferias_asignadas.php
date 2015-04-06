<?php
//elgg_load_js("investigaciones-evaluador-feria");
//elgg_load_js("investigaciones-evaluador");

//$params = array ();
//$content= elgg_view('investigaciones_feria_asignadas/ver_investigaciones_tipo_feria', $params);
//$vars = array('content'=>$content);
//$body= elgg_view_layout('one_column', $vars);
//echo elgg_view_page($title, $body);

elgg_load_css("coordinacion");
$title = "Evaluacion de Ferias:investigaciones asignadas";
$content= elgg_view('investigaciones_feria_asignadas/ver_ferias_evaluador', array());
$body = array('content' => $content);

echo elgg_view_page($title, $body, "evaluadores", array());

