<?php

elgg_load_js('acciones');

$guid=$vars['guid'];
$owner=$vars['owner_guid'];
$lista;
$user=elgg_get_logged_in_user_entity();

$url = elgg_get_site_url() . "action/grupo_investigacion/eliminar?id=" . $guid;
$href = elgg_add_action_tokens_to_url($url);


if($owner== $user->guid){
    $lista.="<li><a onclick='editar(\"".$guid."\")'>Editar</a></li>";
}
if(elgg_is_rol_logged_user("SuperAdmin")|| elgg_is_rol_logged_user("coordinador")
        || $owner=== $user->guid){
    $lista.='<li><a onclick="confirmar(\''.$href.'\')"><span class=\'elgg-icon elgg-icon-delete \'> </span></a></li>';
}
echo <<<HTML
<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default elgg-menu-grupos">
    $lista
</ul>
HTML;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

