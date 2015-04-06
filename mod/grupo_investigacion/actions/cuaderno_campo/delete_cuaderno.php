<?php
/**
 * Action que elimina la iniciativa de investigación y sus bitacoras
 */


$id_grupo=  get_input('id_grupo');
$id_cuaderno=get_input('id');


$cuaderno= new ElggCuadernoCampo($id_cuaderno);
$bitacoras= $cuaderno->getEntitiesFromRelationship("tiene_la_bitacora");

foreach($bitacoras as $bit){
    $bit->delete();
}

$result = $cuaderno->delete();

if ($result) {
	system_message(elgg_echo('cuaderno:ok:delete'));
} else {
	register_error(elgg_echo('cuaderno:error:delete'));
}

forward("/grupo_investigacion/ver_cuadernos/$id_grupo");