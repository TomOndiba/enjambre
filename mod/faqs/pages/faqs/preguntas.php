<?php

elgg_load_css("inicio");
$content= elgg_view('faqs/ver_categorias', array());
error_log("aca llega");
$body = array('content'=>$content);
echo elgg_view_page($title, $body, "preguntas", array()); 