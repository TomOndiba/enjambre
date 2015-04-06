<?php


$params=array("id_conv"=>  get_input("guid_conv"), "id_inv"=> get_input("guid_inv"));
$content = elgg_view_form('asesorias/registrar',null, $params);

echo $content;


