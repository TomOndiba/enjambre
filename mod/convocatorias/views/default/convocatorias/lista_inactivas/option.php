<?php
/**
 * Vista que imprime las opciones de operaciones que se pueden realizar para una convocatoria inactiva
 */
elgg_load_js('confirmacion');

$guid=$vars['guid'];
$owner=$vars['owner_guid'];
$lista;
$user=elgg_get_logged_in_user_entity();


$url1= elgg_get_site_url()."action/convocatorias/habilitar?id=".$guid;

$url_activar= elgg_add_action_tokens_to_url($url1);



if(elgg_is_admin_logged_in() || elgg_is_rol_logged_user("coordinador") ){
    $lista.="<li><a href='$url_activar'>Habilitar</a></li>";
}

echo <<<HTML
<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default">
    $lista
</ul>
HTML;

