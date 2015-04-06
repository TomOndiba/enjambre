<?php

/**
 * Vista que imprime en pantalla un item por cada entidad (convocatoria) existente
 */
$entities = $vars['entities'];
if (!empty($entities)) {
    foreach ($entities as $entity) {
        $entity_data = array("entity" => $entity);
        echo elgg_view("linea_tematica/lista/item", $entity_data);
    }
}  else {
    echo "No hay lineas tematicas registradas.";
}
?>

