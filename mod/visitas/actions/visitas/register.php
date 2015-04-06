<?php

$visita = new ElggVisitaConvocatoria();
$visita->fecha_visita = get_input('fecha_visita');
$visita->departamento = get_input('departamento');
$visita->municipio = get_input('municipio');
$buscar = get_input('institucion');
$institucion = new ElggInstitucion($buscar);
$visita->asunto = get_input('asunto');
$visita->observaciones = get_input('observaciones');
$visita->tipo_comunicacion = get_input('tipo_comunicacion');
$conv_id = get_input('conv_id');
$visita->container_guid =   $conv_id;

$guid = $visita->save();
if(!$guid){
    register_error(elgg_echo('visitas:error:no_save'));
    
}else{
   if($visita->addRelationship($institucion->guid, 'visito'))
   system_message(elgg_echo('visitas:status:save'));
}
forward("visitas/listar/{$conv_id}");



