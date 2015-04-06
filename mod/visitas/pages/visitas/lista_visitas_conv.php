<?php
elgg_load_css("coordinacion");
elgg_load_css('bitacoras');
elgg_load_css('lista_item');
elgg_load_js('js.listar.visitas');
$conv_id = get_input("id_conv");
$convocatoria = new ElggConvocatoria($conv_id);


//$lista = elgg_get_visitas_convocatoria($conv_id);
//$sitio = elgg_get_site_url()."visitas/registrar/{$conv_id}";
//$content .= "<div class='contenedor-button'><a href='$sitio' class=\"link-button\">Registrar Visita</a></div>";
$content .= elgg_view('visitas/lista_conv',array('lista'=>$lista,'id_conv'=>$conv_id));


$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());