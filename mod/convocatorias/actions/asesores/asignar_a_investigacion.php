<?php

$investigacion = get_input('investigacion');
$asesor = get_input('asesor');
if(!$asesor){
    register_error("Debe seleccionar un asesor");
}
if(!$investigacion){
    register_error("Debe seleccionar una investigacion");
}
$asesores_aceptados = elgg_get_relationship_inversa(get_entity($investigacion), 'es_asesor_de');
if (sizeof($asesores_aceptados) > 0) {
    foreach ($asesores_aceptados as $eva) {
        remove_entity_relationship($eva->guid, 'es_asesor_de', $investigacion);
    }
}
$create_relation = add_entity_relationship($asesor, 'es_asesor_de', $investigacion);
if($create_relation){
    system_messages("Se ha asignado el asesor correctamente");
}


