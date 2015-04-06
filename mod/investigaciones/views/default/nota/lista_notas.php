<?php

/** Vista que permite mostrar todas las investigaciones que fueron asignadas al evaluador */

$entities = $vars['entities'];
$tabla_inv = "<ul class='lista-archivos'>";
if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No tiene Notas</h2></div>";
} else {

    foreach ($entities as $entity) {
        
        $user=  elgg_get_usuario_byId($entity->container_guid);

        $imp="Descripción: {$entity->description}<br>"
        . "Creada por: {$user->name}  {$user->apellidos}<br>"
        . "Fecha de Creación: {$entity->time_created}<br>";
        
        echo $imp;
}

}
?>



