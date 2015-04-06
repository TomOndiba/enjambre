<?php

/**
 * Page que prepara los datos y redirecciona al formula que gestiona la informacion
 * de la bitacora 5.1
 * @author DIEGOX_CORTEX
 */
$bit = get_input('bit');
$investigacion = get_entity(get_input('id_inv'));
$grupo = get_entity(get_input('id_group'));

$institucion = elgg_get_relationship($grupo, "pertenece_a");


$guid_bit = '';
if (empty($bit)) {
    $bitacora5_1 = new Elgg_Bitacora5_1();
    $guid = $bitacora5_1->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_5.1', $guid);
    $guid_bit = $guid;
} else {
    $guid_bit = $bit;
    $bitacora51 = new Elgg_Bitacora5_1($bit);
}

$rubros = elgg_get_rubros_bitacora51($guid_bit);
$info_rubros = array();
foreach ($rubros as $rubro) {
    $rub_x = array('guid' => $rubro->guid,'nombre' => $rubro->nombre, 'descripcion_gasto' => $rubro->descripcion_gasto, 'valor_unit' => $rubro->valor_unit,
        'valor_tot_rub' => $rubro->valor_tot_rub, 'valor_total' => $rubro->valor_total);
    array_push($info_rubros, $rub_x);
}


elgg_load_css('logged');


$vars = array('id_inv' => $investigacion->guid,
    'id_group' => $grupo->guid,
    'bit' => $guid_bit,
    'nombre_institucion' => $institucion[0]->name,
    'municipio' => $institucion[0]->departamento . ' / ' . $institucion[0]->municipio,
    'nombre_grupo' => $grupo->name,
    'linea_inv' => get_entity($investigacion->linea_tematica)->name,
    'info_rubros' => $info_rubros);

$content = elgg_view_form('bitacoras/bitacora5_1/bitacora5_1', array(), $vars);

$grup = new ElggGrupoInvestigacion($grupo->guid);
$body = array('izquierda' => elgg_view('grupo_investigacion/profile/menu', array('grupo' => $grup)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('grupo' => $grup));

