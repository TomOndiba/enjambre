<?php
/**
 * Vista que imprime las opciones de operaciones que se pueden realizar para una convocatoria
 */
elgg_load_js('confirmacion');

$guid=$vars['guid'];
$owner=$vars['owner_guid'];
$lista;
$user=elgg_get_logged_in_user_entity();


if(elgg_is_admin_logged_in() || elgg_is_rol_logged_user("coordinador") || $owner== $user->guid){
    $lista.="<li><a data-reveal-id='myModal' onclick='asesorRed({$guid})'>Cambiar Asesor</a></li>";
}
echo <<<HTML
<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default">
    $lista
</ul>
HTML;

