<?php

/**
 * Action que elimina una subcategoria de innovacion
 */
$user_guid = elgg_get_logged_in_user_entity();
$sub_id = get_input("id");
$sub_nom=  get_input("nombre");

$subcat = new ElggSubcategoria($sub_id);

$result = $subcat->delete(); // elimina el área de feria

if ($result) {
	system_message(elgg_echo('subcategoria:ok:delete'), 'success');
} else {
	register_error(elgg_echo('subcategoria:error:delete'), 'error');
}

forward("/subcategorias/listar");