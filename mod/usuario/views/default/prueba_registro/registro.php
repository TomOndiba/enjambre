<?php

$form_vars = array('enctype' => 'multipart/form-data',);
$content= elgg_view_form('registro_total', $form_vars, $body_vars);
echo $content;