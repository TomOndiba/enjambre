<?php
/**
 * Vista que imprime las opciones de operaciones que se pueden realizar para una feria
 */
elgg_load_js('confirmacion');

$guid=$vars['guid'];
$owner=$vars['owner_guid'];
$lista;
$user=elgg_get_logged_in_user_entity();

$url_editado = elgg_get_site_url()."ferias/edit/".$guid;

$url1= elgg_get_site_url()."action/ferias/eliminar?id=".$guid;
$url_eliminar= elgg_add_action_tokens_to_url($url1);

$url2 = elgg_get_site_url()."action/ferias/desactivar_feria?id_feria=".$guid;
$url_desactivar = elgg_add_action_tokens_to_url($url2);

//$ferias_desactivadas = elgg_get_list_feriasDesactivadas();
//
//


if(elgg_is_admin_logged_in() || elgg_is_rol_logged_user("coordinador") || $owner== $user->guid){
    $lista.="<a href='$url_desactivar'>Desactivar</a>&nbsp;";
    $lista.="&nbsp;<a href='$url_editado'>Editar</a>";
}
//if(elgg_is_admin_logged_in()|| elgg_is_rol_logged_user("coordinador")|| $owner=== $user->guid){
//    $lista.='<li><a href='.$url_eliminar.'>Eliminar</a></li>';
//}
echo <<<HTML
<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default">
    $lista
</ul>
HTML;

