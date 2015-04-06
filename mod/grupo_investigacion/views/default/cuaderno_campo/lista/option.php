<?php

elgg_load_js('confirmacion');

$guid=$vars['guid'];
$guid_grupo=$vars['id_grupo'];
$owner=$vars['owner_guid'];
$lista;
$user=elgg_get_logged_in_user_entity();

$url1= elgg_get_site_url()."action/cuaderno_campo/eliminar?id=".$guid."&id_grupo=".$guid_grupo;
$url_eliminar= elgg_add_action_tokens_to_url($url1);

if(elgg_is_rol_logged_user("SuperAdmin")|| $owner=== $user->guid){
    $lista.='<li><a onclick="confirmar(\''.$url_eliminar.'\')"><span class=\'elgg-icon elgg-icon-delete \'> </span></a></li>';
}
echo <<<HTML
<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default">
    $lista
</ul>
HTML;

