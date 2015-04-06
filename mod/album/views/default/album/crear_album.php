<?php

elgg_load_css('logged');
$id = get_input('id');



//$content = elgg_view('redes_tematicas/profile/header', $params);

$parametros = array('guid' => $id);
$form_params = array('enctype' => 'multipart/form-data');
$content= elgg_view_form('album/crear_album', $form_params, $parametros);
echo $content;
