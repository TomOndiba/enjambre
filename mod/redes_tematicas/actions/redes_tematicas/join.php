<?php
/**
 * Action que crea la relacion "peticionUnirse" del usuario a la red tematica
 */

$user_guid = elgg_get_logged_in_user_entity();
$id_red = get_input("id");


$user= new ElggUser($user_guid->guid);
$owner = get_entity($id_red);

//$nuevoUsuario->;
if($user->addRelationship($id_red , "peticionUnirse")){
    system_message("add:red:ok");
    
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
//                    if ($subtype == "grupo_investigacion") {
//                        error_log("INGRESAz");
//                        $objeto = "al grupo";
//                        $url = "grupo_investigacion/solicitudes/";
//                        $options_integrantes = array(
//                            'relationship' => 'es_miembro_de',
//                            'relationship_guid' => $owner->guid,
//                            'inverse_relationship' => true);
////                        $entities = elgg_get_entities_from_relationship($options_integrantes);
//                    } else if ($subtype == "institucion") {
//                        $objeto = "a la institución";
//                        $url = "instituciones/solicitudes/";
//                        $options_integrantes = array(
//                            'relationship' => 'estudia_en',
//                            'relationship_guid' => $owner->guid,
//                            'inverse_relationship' => true);
////                        $estudiantes = elgg_get_entities_from_relationship($options_integrantes);
//                        $options_integrantes = array(
//                            'relationship' => 'trabaja_en',
//                            'relationship_guid' => $owner->guid,
//                            'inverse_relationship' => true);
////                        $profesor = elgg_get_entities_from_relationship($options_integrantes);
////                        $entities = array_merge($estudiantes, $profesor);
//                    } else
                     if ($subtype == "red_tematica") {
                        $objeto = "a la red temática";
                        $url = "redes_tematicas/solicitudes/";
                        $options_integrantes = array(
                            'relationship' => 'es_miembro_de',
                            'relationship_guid' => $owner->guid,
                            'inverse_relationship' => true);
//                        $entities = elgg_get_entities_from_relationship($options_integrantes);
                    }
//                    foreach ($entities as $entity) {
//                        if ($entity->guid != $user->guid) {
                            error_log("CREANDO");
                            $site_url = elgg_get_site_url();
                            $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                            $urlResult = "{$site_url}{$url}{$owner->guid}";
                            $mensaje = "<div id='item-notification' name='{$urlResult}' style='z-index:100'>{$urlUser} ha solicitado unirse $objeto <a href='{$site_url}{$url}$owner->guid'>{$owner->name}</a>: {$message_content}</div>";
                            add_new_notification($owner->owner_guid, $user->guid, "post", $guid, $mensaje);
//                        }
//                    }
                } else {
                    $site_url = elgg_get_site_url();
                    $urlResult = "{$site_url}live_notifications/{$result}";
                    $urlUser = "<a href='{$site_url}profile/{$user->username}'>{$user->name}</a>";
                    $mensaje = "<div id='item-notification' name='{$urlResult}'>{$urlUser} ha publicado tú muro: {$message_content}</div>";
                    add_new_notification($owner->guid, $user->guid, "post", $result, $mensaje);
                }
            }
        } 
}else{
    register_error("add:red:error");
}
  
 forward("/redes_tematicas/ver/".$id_red);