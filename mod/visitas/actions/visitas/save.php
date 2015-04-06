<?php
/**
 * Action que recibe los datos de la visita y
 * los inserta en la base de datos
 */


$visita = new ElggVisita();
$visita->fecha_visita = get_input('fecha_visita');
$visita->departamento = get_input('departamento');
$visita->municipio = get_input('municipio');
$buscar = get_input('institucion');
$institucion = new ElggInstitucion($buscar);
$visita->interesado = (get_input('interesado') == 'true')? 'si':'no';
$visita->observaciones = get_input('observaciones');
$visita->tipo_comunicacion = get_input('tipo_comunicacion');

$guid = $visita->save();
if(!$guid){
    register_error(elgg_echo('visitas:error:no_save'));
   
}else{
   if($visita->addRelationship($institucion->guid, 'visito'))
   system_message(elgg_echo('visitas:status:save'));
  
}
forward('visitas/');