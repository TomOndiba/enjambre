<?php
$guid_feria= get_input("feria");
$guid=  get_input("investigacion");
$tipo= get_input("tipo");
$params = array('guid_feria' => $guid_feria, 'investigacion' => $guid, 'tipo_eval'=>$tipo);
$form = elgg_view_form('ferias/evaluadores_aceptados', null, $params);
echo $form;

