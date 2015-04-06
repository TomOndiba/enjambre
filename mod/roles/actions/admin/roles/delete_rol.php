<?php

$id_rol=get_input('id');

$rol= new ElggRol($id_rol);
$result = $rol->delete();

if ($result) {
	system_message(elgg_echo('rol:ok:delete'));
} else {
	register_error(elgg_echo('rol:error:delete'));
}

forward("/roles/");