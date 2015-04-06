<?php

/**
 * Vista que imprime en pantalla un item por cada entidad (feria que este disable) existente
 */

$entities = $vars['entities'];
if (sizeof($entities) > 0) {
    foreach ($entities as $entity) {
        $entity_data = array("entity" => $entity);
        echo elgg_view("ferias/lista_inactivas/item_inactivas", $entity_data);
    }
} else {
    echo "No existen Ferias inactivas, por el momento.";
}
?>

