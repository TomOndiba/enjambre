<?php

$entities = $vars['entities'];
$guid_feria = $vars['guid'];


if (!empty($entities)) {

    foreach ($entities as $entity) {
        $entity_data = array("entity" => $entity, "guid" => $guid_feria);
        echo elgg_view("evaluadores_feria/lista/item", $entity_data);
    }
} 
else{
    echo "<h3>No hay Evaluadores preinscritos en la Feria </h3>";
}
?>

