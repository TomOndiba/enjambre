<?php //


$title = "Usuario";
admin_gatekeeper();
set_context('admin');
$documento= get_input('id');
$params= array('documento'=>$documento);
echo $documento;
$usuario= elgg_get_usuario($documento);

echo elgg_view('roles/asignar_roles_usuario',$params);

$title=$documento.' - '.$usuario['nombre'].' '.$usuario['apellidos'];
echo elgg_view_module($title, $title, $body);



