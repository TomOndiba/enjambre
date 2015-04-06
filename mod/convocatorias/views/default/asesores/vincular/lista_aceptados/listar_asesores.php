<?php

$entities = $vars['asesores'];
$asignado = $vars['asignado'];
$convocatoria = $vars['convocatoria'];
if (!$entities) {
    echo "No existen asesores aceptados en la convocatoria";
} else {
    
    foreach ($entities as $entity) {
        $entity_data = array("entity" => $entity, "guid" => $convocatoria);
        echo elgg_view("asesores/vincular/lista_aceptados/item", $entity_data);
    }
}


