<?php
/**
 * Vista que imprime las opciones de operaciones que se pueden realizar para una convocatoria
 */
elgg_load_js('confirmacion');

$guid=$vars['guid'];
$owner=$vars['owner_guid'];
$lista;
$user=elgg_get_logged_in_user_entity();


$url_editado= elgg_get_site_url()."linea/editar/".$guid;
$url1= elgg_get_site_url()."action/linea_tematica/habilitar?id=".$guid;
$url_hablit= elgg_add_action_tokens_to_url($url1);


if(elgg_is_admin_logged_in() || elgg_is_rol_logged_user("coordinador") || $owner== $user->guid){
    $lista.="<li><a href='$url_hablit'>Activar</a></li>";
}
echo <<<HTML
<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default">
    $lista
</ul>
HTML;

