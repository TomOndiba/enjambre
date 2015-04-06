<?php

$entities = $vars['entities'];
$guid_conv = $vars['guid'];

if (!empty($entities)) {
    foreach ($entities as $entity) {

        $entity_data = array('entity' => $entity, 'guid' => $guid_conv);
        echo elgg_view("evaluadores_conv/lista/item", $entity_data);
    }
} else {
    echo "<h3>No hay evaluadores preinscritos en la Convocatoria </h3>";
}
?>

