<?php

$entities = $vars['entities'];
$guid_red=$vars['red'];

if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No existen integrantes</h2></div>";
} else {
    echo "<ul class='list-usuarios'>";
    
 
    
    
    foreach ($entities as $entity) {

        $entity_data = array("entity" => $entity);
        echo elgg_view("redes_tematicas/integrantes/item", $entity_data);
    }
    echo "</ul>";
}
