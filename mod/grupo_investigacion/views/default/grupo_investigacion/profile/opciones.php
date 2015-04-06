<?php
elgg_load_js('acciones');
$grupo = $vars['grupo'];
$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);
$rol_comunidad=  elgg_is_rol_logged_user("SuperAdmin");
$list = "";
$permiso = $rol;
$params['buttons'] = array();
if (!$rol && $user) {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/join?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Unirse');
    $params['buttons']['unirse'] = $solicitud;
} else if ($rol == 'request') {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/cancelrequest?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Cancelar Solicitud');
    $params['buttons']['cancelar'] = $solicitud;
    $permiso = false;
} else if ($rol == "admin") {
    $sol = elgg_get_site_url() . "grupo_investigacion/administrar_roles/" . $grupo->guid;
    $array = array('href' => $sol,
        'value' => 'Administar Roles');
    $sol = elgg_get_site_url() . "grupo_investigacion/solicitudes/" . $grupo->guid;
    $array2 = array('href' => $sol,
        'value' => 'Solicitudes');
    $params['buttons']['solicitudes'] = $sol;
}
if ($rol == "editor" || $rol == "leer") {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/abandonar_grupo?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Abandonar Grupo');
    $params['buttons']['abandonar'] = $solicitud;
}
$botones = $params['buttons'];
if (!$rol && !$rol_comunidad && !check_entity_relationship($user->guid, "usuario_desactivado_de", $grupo->guid)) {
    $list.="<li><a href='{$botones["unirse"]}' title='Unirse'><div class='icon-unirse' data-tooltip='Unirse al Grupo'></div></a></li>";
} else if ($rol == 'leer' && !check_entity_relationship($user->guid, "usuario_desactivado_de", $grupo->guid)) {
    $list.="<li><a href='{$botones["abandonar"]}' title='Abandonar Grupo'><div class='icon-abandonar' data-tooltip='Abandonar Grupo'></div></a></li>";
} else if ($rol == 'request') {
    $list.="<li><a href='{$botones["cancelar"]}'><div class='icon-cancelar' data-tooltip='Cancelar Solicitud'></div></a></li>";
}
if ($rol == 'admin' || $rol_comunidad) {
    $url = elgg_get_site_url() . "action/grupo_investigacion/desactivar_grupo?guid=" . $grupo->guid;
    $href = elgg_add_action_tokens_to_url($url);
    $solicitudes = elgg_get_site_url() . "grupo_investigacion/solicitudes/" . $grupo->guid;
    $list.="<li><a href='".elgg_get_site_url()."grupo_investigacion/editar/".$grupo->guid."' ><div class='icon-editar' data-tooltip='Editar Grupo'></div></a></li>";
    $list.="<li><a href='{$solicitudes}' ><div class='icon-administrar' data-tooltip='Administrar Solicitudes'></div></a></li>";
    $list.="<li><a onclick='confirmarDesactivar(\"".$href."\")'><div class='icon-eliminar' data-tooltip='Desactivar Grupo'></div></a></li>";
    
    }
?><ul>
    <?php
    echo '<div style="display:none;" id="dialog-confirm-desactivar" title="Confirmación"> Está seguro de Desactivar el Grupo de Investigación?</div>';
    echo $list;
    ?>
</ul>