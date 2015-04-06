<?php
$investigacion = get_input('investigacion');
$red = get_input('red');
if(!$red){
    register_error("Debe seleccionar una red");
}
if(!$investigacion){
    register_error("Debe seleccionar una investigacion");
}
$redes_atigunas = elgg_get_relationship(get_entity($investigacion), 'pertenece_a_red');
if (sizeof($redes_atigunas) > 0) {
    foreach ($asesores_aceptados as $eva) {
        remove_entity_relationship($investigacion, 'pertenece_a_red', $eva->guid);
    }
}
$create_relation = add_entity_relationship($investigacion, 'pertenece_a_red', $red);
if($create_relation){
    system_messages("Se ha asignado la red correctamente a la investigación");
}
