<?php

/**
 * Page que recupera informacion y redirecciona a ver el listado de faqs
 * @author DIEGOX_CORTEX
 */
$category = get_input('category');

elgg_load_css("coordinacion");
$params = array('categoria' => $category);
$content .= elgg_view('faqs/list_faq', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());