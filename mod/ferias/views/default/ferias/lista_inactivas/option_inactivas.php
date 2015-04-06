<?php
/**
 * Vista que imprime las opciones de operaciones que se pueden realizar para una feria inactiva
 */

elgg_load_js('confirmacion');

$guid=$vars['guid'];
$owner=$vars['owner_guid'];
$lista;
$user=elgg_get_logged_in_user_entity();


$url1= elgg_get_site_url()."action/ferias/activar_feria?id=".$guid;
$url_eliminar= elgg_add_action_tokens_to_url($url1);


if(elgg_is_admin_logged_in() || elgg_is_rol_logged_user("coordinador") || $owner== $user->guid){
    $lista.="<a href='$url_eliminar'>Activar</a>";    
}

echo <<<HTML
<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default">
    $lista
</ul>
HTML;

