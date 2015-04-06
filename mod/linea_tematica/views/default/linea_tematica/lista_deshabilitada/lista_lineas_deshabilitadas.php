<?php

/**
 * Vista que imprime en pantalla un item por cada entidad (convocatoria) existente
 */

$entities = $vars['entities'];
if (sizeof($entities) > 0) {
    
    foreach ($entities as $entity) {
        $entity_data = array("entity" => $entity);
        echo elgg_view("linea_tematica/lista_deshabilitada/item_deshabilitado", $entity_data);
    }
} else {
    echo "No hay líneas temáticas inactivas registradas, por el momento.";
}
?>

