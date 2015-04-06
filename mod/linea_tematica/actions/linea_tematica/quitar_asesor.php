<?php

$red = get_input('red');
$asesor = get_input('asesor');
$remove = remove_entity_relationship($asesor, 'administrador_red', $red);
$remove2= remove_entity_relationship($asesor, 'administrador', $red);
if ($remove && $remove2) {
    system_message("Operación realizada correctamente.");
} else {
    register_error("Error al quitar el asesor");
}
forward(REFERRER);
