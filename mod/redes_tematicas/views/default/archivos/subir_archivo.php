<?php
elgg_load_library('elgg:file');
$grupo = get_input('owner');
$autoformacion= get_input('autoformacion');
$form_vars = array('enctype' => 'multipart/form-data');
$file = new FilePluginFile();
$body_vars = file_prepare_form_vars($file);
$body_vars['container_guid'] = $grupo;
$body_vars['autoformacion']=$autoformacion;
$content= elgg_view_form('file/upload', $form_vars, $body_vars);
echo $content;