<?php

$idUser = get_input('id_user');
$rol = get_input('id_rol');
$idGrupo = get_input('id_grupo');
$rolAntiguo = get_input('id_rol_antiguo');
$options = array(
    'type' => 'user',
    'guid' => $idUser,
);
$user = elgg_get_entities($options);
$grupo = new ElggGrupoInvestigacion($idGrupo);
$operacion = elgg_set_rol_grupo_investigacion($grupo, $user[0], $rol, $rolAntiguo);
if ($operacion) {
    $miembrosGrupo = elgg_get_miembros_grupo_investigacion($grupo);
    $params['title'] = $title;
    $params['grupo'] = array(
        'nombre' => $grupo->name,
        'guid' => $grupo->guid,
        'rol_user' => $rol,
    );
    $params['miembros'] = $miembrosGrupo;
    $params['ajax']=1;
    $content.=elgg_view('grupo_investigacion/roles/admin_roles', $params);
    
    echo $content;
    system_messages(elgg_echo('registro_grupo:correcto'), 'success');
} else {
    system_messages(elgg_echo('registro_grupo:correcto'), 'error');
}
