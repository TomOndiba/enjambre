<?php

$user_guid = elgg_get_logged_in_user_guid();


$puntaje1 = get_input('puntaje_bitacora1');
$puntaje2 = get_input('puntaje_bitacora2');
$puntaje3 = get_input('puntaje_bitacora3');
$puntaje_total = get_input('puntaje_total');
$concepto = get_input('concepto');
$observacion = get_input('observacion');

$guid_inv = get_input('id_inv');

$guid_evaluacion = (int) get_input('guid_evaluacion');


$evaluacion = new ElggEvaluacion($guid_evaluacion);


//Para el registro de una evaluacion
if (empty($guid_evaluacion)) {

    $evaluacion->title = "Evaluacion de la Investigacion" . $guid_investigacion;
    $evaluacion->owner_guid = $user_guid;
    $evaluacion->container_guid = $user_guid;
    $evaluacion->access_id = ACCESS_LOGGED_IN;
    $evaluacion->puntaje_bitacora1 = $puntaje1;
    $evaluacion->puntaje_bitacora2 = $puntaje2;
    $evaluacion->puntaje_bitacora3 = $puntaje3;
    $evaluacion->puntaje_total = $puntaje_total;
    $evaluacion->concepto = $concepto;
    $evaluacion->observacion = $observacion;

    $guid = $evaluacion->save();

    $investigacion = get_entity($guid_inv);

    if ($concepto == "Aprobado") {
        $investigacion->elegible='true';
        $investigacion->save();
    }


    $investigacion->addRelationship($guid, "tiene_la_evaluacion");


    $convocatoria = elgg_get_relationship($investigacion, "inscrita_a_convocatoria");
    $linea = elgg_get_relationship($investigacion, "inscrita_a_" . $convocatoria[0]->guid . "_con_linea_tematica");
    

    if ($investigacion->addRelationship($convocatoria[0]->guid, "evaluada_en_convocatoria")) {
        if ($investigacion->addRelationship($linea[0]->guid, "evaluada_en_" . $convocatoria[0]->guid . "_con_linea_tematica")) {
            system_message(elgg_echo("evaluacion:investigacion:ok"));

            $investigacion->removeRelationship($convocatoria[0]->guid, "inscrita_a_convocatoria");
            $investigacion->removeRelationship($linea[0]->guid, "inscrita_a_" . $convocatoria[0]->guid . "_con_linea_tematica");
        } else {
            $investigacion->removeRelationship($convocatoria[0]->guid, "evaluada_en_convocatoria");
            register_error(elgg_echo("evaluacion:investigacion:error"));
        }
    } else {
        register_error(elgg_echo("evaluacion:investigacion:error"));
    }



    if ($guid)
        system_message(elgg_echo('guardo:evaluacion:ok'));
    else
        system_message(elgg_echo('guardo:evaluacion:error'));
}

//Para la actualizacion de una evaluacion
else {


//Arreglo con los nombres de los metadatos a actualizar
    $nombre_metadato = array('puntaje_bitacora1', 'puntaje_bitacora2', 'puntaje_bitacora3', 'puntaje_total', 'concepto', 'observacion');

//Arreglo con el valor con los que se actualizaran los metadatos
    $value_metadato = array($puntaje1, $puntaje2, $puntaje3, $puntaje_total, $concepto, $observacion);

// recorre el arreglo para verificar si los metadatos coinciden con la información recibida de los campos
// si no es la misma es porque el usuario actualizó, se elimina el metadato y se crea uno nuevo
    for ($i = 0; $i < count($nombre_metadato); $i++) {

        if ($evaluacion->$nombre_metadato[$i] != $value_metadato[$i]) {

            $options = array(
                'guid' => $evaluacion->guid,
                'metadata_name' => $nombre_metadato[$i],
                'limit' => false
            );
            $g = elgg_delete_metadata($options);


            if (!is_null($value_metadato[$i]) && ($value_metadato[$i] !== '')) {
                create_metadata($evaluacion->guid, $nombre_metadato[$i], $value_metadato[$i], 'text', $user_guid, ACCESS_PUBLIC);
            }
        }
    }
    system_message(elgg_echo('guardo:evaluacion:ok'));
}

forward(REFERER);
