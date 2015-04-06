<?php

$entities = $vars['entities'];



if (!$entities) {
    echo "<br><br><br><br><center><b>No existen resultados que coincidan con la búsqueda realizada</b></center><br><br>";
} else {
    
    foreach ($entities as $entity) {

        $entity_data = array("entity" => $entity);
        echo elgg_view("busqueda/item", $entity_data);
    }
}

