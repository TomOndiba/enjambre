<?php

$red = get_input('red');
$asesor = get_input('asesor');
$create_relation = add_entity_relationship($asesor, 'administrador_red', $red);
$create_relation_2 = add_entity_relationship($asesor, 'administrador', $red);
if ($create_relation && $create_relation_2) {
    system_message("Red asignada a asesor correctamente");
} else {
    register_error("Error al asignar el asesor");
}

forward(REFERRER);
