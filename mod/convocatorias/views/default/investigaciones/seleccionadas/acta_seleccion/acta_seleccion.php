<?php

$guid_conv= get_input("convocatoria");
$guid=  get_input("investigacion");
$params = array('guid_conv' => $guid_conv, 'investigacion' => $guid);
$form = elgg_view_form('acta_de_seleccion/acta_de_seleccion', null, $params);
echo $form;