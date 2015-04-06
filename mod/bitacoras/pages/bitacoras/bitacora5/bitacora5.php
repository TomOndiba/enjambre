<?php

/**
 * Page que prepara los datos y redirecciona para el formulario 
 * de crear la botacora5
 * @author DIEGOX_CORTEX
 */
$investigacion = get_entity(get_input('id_inv'));
$grupo = get_entity(get_input('id_group'));
$bitacora = get_input('bit');

$institucion = elgg_get_relationship($grupo, "pertenece_a");


if (empty($bitacora)) {
    $bit_x = new Elgg_Bitacora5();
    $guid = $bit_x->save();
    add_entity_relationship($investigacion->guid, 'tiene_la_bitacora_5', $guid);
} else {
    $bit_5 = new Elgg_Bitacora5($bitacora);
    //Cargo la informacion de los totales que hay registrados
    $info_totales = array('total_totalAp' => $bit_5->total_totalAp, 'total_totalDs' => $bit_5->total_totalDs, 'total_ejecutado' => $bit_5->total_ejecutado, 'total_saldo' => $bit_5->total_saldo);
}
$guid_bit = '';
if (empty($bitacora)) {
    $guid_bit = $guid;
} else {
    $guid_bit = $bitacora;
}
//Obtengo la bitacora 
$bit4 = elgg_get_relationship($investigacion, 'tiene_la_bitacora_4');
//obtengo las actividades relacionadas a la botacora
$actividades_bit4 = elgg_get_actividades_bitacora($bit4[0]->guid);
for ($i = 0; $i < sizeof($actividades_bit4); $i++) {
    //creo los trayectos de la bitacora No5, dependiendo del numero de actividades
    //definidas en la bitacora 4
    $trayecto = new Elgg_Trayecto();
    $trayecto->nombre = "SEGMENTO O TRAYECTO No. " . $i+1;
    $trayecto->owner_guid = $guid_bit;

    $guid_t = $trayecto->save();
}



//Verifico los trayectos asociados a la bitacora 5
$trayectos_b5 = elgg_get_trayectos_bitacora5($guid_bit);
//Cargo la informacion de los trayectos
$info_trayectos = array();
foreach ($trayectos_b5 as $try) {
    $inf = array('nombre' => $try->nombre, 'guid_t' => $try->guid,
        //Insumos
        'insumos_totalAp' => $try->insumos_totalAp, 'insumos_totalDs' => $try->insumos_totalDs,
        'insumos_ejecutado' => $try->insumos_ejecutado, 'insumos_saldo' => $try->insumos_saldo,
        //Papeleria
        'papeleria_totalAp' => $try->papeleria_totalAp, 'papeleria_totalDs' => $try->papeleria_totalDs,
        'papeleria_ejecutado' => $try->papeleria_ejecutado, 'papeleria_saldo' => $try->papeleria_saldo,
        //Transporte
        'transporte_totalAp' => $try->transporte_totalAp, 'transporte_totalDs' => $try->transporte_totalDs,
        'transporte_ejecutado' => $try->transporte_ejecutado, 'transporte_saldo' => $try->transporte_saldo,
        //Correo
        'correo_totalAp' => $try->correo_totalAp, 'correo_totalDs' => $try->correo_totalDs,
        'correo_ejecutado' => $try->correo_ejecutado, 'correo_saldo' => $try->correo_saldo,
        //Materiales
        'materiales_totalAp' => $try->materiales_totalAp, 'materiales_totalDs' => $try->materiales_totalDs,
        'materiales_ejecutado' => $try->materiales_ejecutado, 'materiales_saldo' => $try->materiales_saldo,
        //Refigrerios
        'refirgerios_totalAp' => $try->refirgerios_totalAp, 'refirgerios_totalDs' => $try->refirgerios_totalDs,
        'refirgerios_ejecutado' => $try->refirgerios_ejecutado, 'refirgerios_saldo' => $try->refirgerios_saldo,
        //Subtotales
        'subtotal_totalAp' => $try->subtotal_totalAp, 'subtotal_totalDs' => $try->subtotal_totalDs,
        'subtotal_ejecutado' => $try->subtotal_ejecutado, 'subtotal_saldo' => $try->subtotal_saldo);
    array_push($info_trayectos, $inf);
}





$vars = array('id_inv' => $investigacion->guid,
    'id_group' => $grupo->guid,
    'bit' => $guid_bit,
    'nombre_institucion' => $institucion[0]->name,
    'municipio' => $institucion[0]->departamento . ' / ' . $institucion[0]->municipio,
    'nombre_grupo' => $grupo->name,
    'linea_inv' => get_entity($investigacion->linea_tematica)->name,
    'info_trayectos' => $info_trayectos,
    'info_totales' => $info_totales);

$content = elgg_view_form('bitacoras/bitacora5/bitacora5', array(), $vars);

$grup = new ElggGrupoInvestigacion($grupo->guid);
$body = array('izquierda' => elgg_view('grupo_investigacion/profile/menu', array('grupo' => $grup)), 'derecha' => $content);
echo elgg_view_page($title, $body, "profile", array('grupo' => $grup));


