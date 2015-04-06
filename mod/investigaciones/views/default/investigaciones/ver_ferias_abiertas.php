<?php

elgg_load_css('logged');
$guid_inv = get_input('id_inv');
$guid_group = get_input('id_grupo');
$title = get_entity($guid_group)->name;
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);
$grupo = get_entity($guid_group);



$ferias_abiertas = elgg_get_ferias_abiertas();
error_log("FERIAS -> ".sizeof($ferias_abiertas));
$optionsFeria = array();
if (sizeof($ferias_abiertas) > 0) {
    $optionsFeria[0] = "Seleccionar..";
    foreach ($ferias_abiertas as $fr) {
        if ($fr->tipo_feria == 'Municipal') {
            $optionsFeria[$fr->guid] = $fr->name;
        }
    }
}

$params['grupo'] = array(
    'nombre' => $grupo->name,
    'guid' => $grupo->guid,
    'rol_user' => $rol,
    'descripcion'=>$grupo->description,
);

$params['ferias'] = $optionsFeria;
$params['id_investigacion'] = $guid_inv;
$params['title'] = $title;
$params['guid_grupo'] = $guid_group;
$content.= elgg_view_form('investigacion/ferias_abiertas', null, $params);
echo $content;

