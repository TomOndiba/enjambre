<?php

/**
 * Action que crea una nueva iniciativa de investigación y lo relaciona con un Grupo de Investigación
 */
$guid_grupo = get_input('id_grupo');
$nombre = get_input('nombre');
$user = elgg_get_logged_in_user_guid();
$grupo_inv = new ElggGrupoInvestigacion($guid_grupo);

$cuaderno = new ElggCuadernoCampo();
$cuaderno->name = $nombre;
$cuaderno->owner_guid = $user;
$guid = $cuaderno->save();
if ($guid) {
    $diario = new ElggDiarioCampo();
    $diario->owner_guid = $guid;
    $guid_diario = $diario->save();
    $cuaderno_nota = new ElggCuadernoNota();
    $cuaderno_nota->owner_guid = $guid;
    $cuaderno_nota->container_guid = $user;
    $cuaderno_nota->save();

    # Crear Bitacora 1
    $bitacorauno = new BitacoraUno();
    $bitacorauno->owner_guid = $guid;
    $bitacorauno->save();

    # Crear Bitacora 2
    $bitacorados = new BitacoraDos();
    $bitacorados->owner_guid = $guid;
    $bitacorados->save();

    # Crear Bitacora 3
    $bitacoratres = new BitacoraTres();
    $bitacoratres->owner_guid = $guid;
    $bitacoratres->save();
    if($grupo_inv->addRelationship($guid, "tiene_cuaderno_campo")) {
        forward('/grupo_investigacion/ver_cuaderno/' . $guid_grupo . "/" . $guid);
    }else{
        register_error("Ha ocurrido un error realizando el proceso");
        forward(REFERER);
    }
}
