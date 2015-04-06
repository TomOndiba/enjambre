<?php

$fecha_inicio = get_input("fecha_inicio");
$fecha_fin = get_input("fecha_fin");
$lugar = get_input("lugar");
$nombre = get_input("nombre_evento");
$hora = get_input("hora");
$hora2 = get_input("hora2");

$guid_evento = (int) get_input('evento');
$guid = (int) get_input("guid");
$owner = get_entity($guid);
$user = elgg_get_logged_in_user_entity();
//si se va a crear evento
if ($guid) {
    $evento = new ElggEvento();
    $evento->container_guid = $guid;
    $evento->owner_guid = $user->guid;
} else { //Editar Evento
    $evento = new ElggEvento($guid_evento);
}

$evento->nombre_evento = $nombre;
$evento->lugar = $lugar;
$evento->fecha_inicio = $fecha_inicio;
$evento->hora = $hora;
$evento->horaFin = $hora2;
$evento->fecha_terminacion = $fecha_fin;
$guid = $evento->saveEventoGrupo();


if (!$guid_evento) {
    system_message(elgg_echo("evento:ok:create"));

    if ($owner) {
            $options = array(
                'annotations_name' => 'messageboard',
                'guid' => $owner->getGUID(),
                'reverse_order_by' => true,
                'limit' => 1
            );
            $mensaje = "";
            if ($user->guid != $owner->guid) {
                 
                if ($owner->type == "group") {
                    
                    $subtype = $owner->getSubtype();
                    if ($subtype == "grupo_investigacion") {
                        $objeto = "del grupo";
                        $url = "grupo_investigacion/ver/";
                        $options_integrantes = array(
                            'relationship' => 'es_miembro_de',
                            'relationship_guid' => $owner->guid,
                            'inverse_relationship' => true);
                        $entities = elgg_get_entities_from_relationship($options_integrantes);
                    } else if ($subtype == "institucion") {
                        $objeto = "de la institución";
                        $url = "instituciones/ver/";
                        $options_integrantes = array(
                            'relationship' => 'estudia_en',
                            'relationship_guid' => $owner->guid,
                            'inverse_relationship' => true);
                        $estudiantes = elgg_get_entities_from_relationship($options_integrantes);
                        $options_integrantes = array(
                            'relationship' => 'trabaja_en',
                            'relationship_guid' => $owner->guid,
                            'inverse_relationship' => true);
                        $profesor = elgg_get_entities_from_relationship($options_integrantes);
                        $entities = array_merge($estudiantes, $profesor);
                    } else if ($subtype == "red_tematica") {
                        $objeto = "de la red temática";
                        $url = "redes_tematicas/ver/";
                        $options_integrantes = array(
                            'relationship' => 'es_miembro_de',
                            'relationship_guid' => $owner->guid,
                            'inverse_relationship' => true);
                        $entities = elgg_get_entities_from_relationship($options_integrantes);
                    }
                    foreach ($entities as $entity) {
                        if ($entity->guid != $user->guid) {
                            error_log("CREANDO");
                            $site_url = elgg_get_site_url();
                            $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                            $urlResult = "{$site_url}{$url}{$owner->guid}/calendario";
                            $mensaje = "<div id='item-notification' name='{$urlResult}' style='z-index:100'>{$urlUser} ha creado un evento $objeto <a href='{$site_url}{$url}$owner->guid'>{$owner->name}</a>: {$message_content}</div>";
                            add_new_notification($entity->guid, $user->guid, "post", $guid, $mensaje);
                        }
                    }
                } else {
                    $site_url = elgg_get_site_url();
                    $urlResult = "{$site_url}live_notifications/{$result}";
                    $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                    $mensaje = "<div id='item-notification' name='{$urlResult}'>{$urlUser} ha publicado tú muro: {$message_content}</div>";
                    add_new_notification($owner->guid, $user->guid, "post", $result, $mensaje);
                }
            }
        } 
    
} else if ($guid_evento) {
    system_message(elgg_echo("EL evento se actualizó correctamente"));
} else {
    register_error(elgg_echo("evento:error:create"));
}

forward(REFERER);
