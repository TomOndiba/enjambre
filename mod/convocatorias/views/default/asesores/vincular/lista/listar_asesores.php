<?php

$entities = $vars['asesores'];
$asignado = $vars['asignado'];
$convocatoria = $vars['convocatoria'];
if (!$entities) {
    echo "No existen asesores preinscritos en la convocatoria";
} else {
    
    foreach ($entities as $entity) {
        $entity_data = array("entity" => $entity, "guid" => $guid_feria);
        echo elgg_view("asesores/vincular/lista/item", $entity_data);
    }
}


