<?php

elgg_load_css("logged");


$content .= elgg_view('faqs/ver_categorias', array());
$body = array('content'=>$content);
echo elgg_view_page($title, $body, "lista", array()); 