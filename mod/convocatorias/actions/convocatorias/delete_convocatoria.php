<?php
/**
 * Eliminar una convocatoria a partir de su id
 */

$id_convocatoria=get_input('id');

$convocatoria= new ElggConvocatoria($id_convocatoria);

//se buscan los eventos pertenecientes a dicha convocatoria para ser eliminados
$eventos= $convocatoria->getEntitiesFromRelationship("tiene_el_evento");

foreach($eventos as $ev){
    $ev->disable();
}

$result = $convocatoria->delete();

if ($result) {
	system_message(elgg_echo('convocatoria:ok:delete'));
} else {
	register_error(elgg_echo('convocatoria:error:delete'));
}

forward("/convocatorias/listado/");