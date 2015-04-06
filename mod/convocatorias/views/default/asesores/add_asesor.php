<?php

$guid_conv = get_input("convocatoria");
$guid = get_input("asesor");

$evaluacion= elgg_get_evaluacion_asesores($guid, $guid_conv);
if(!$evaluacion){
    $evaluacion= new ElggEvaluacionAsesor();
    $evaluacion->owner_guid=$guid_conv;
    $evaluacion->container_guid=$guid;
    $evaluacion->access_id = ACCESS_PUBLIC;
    
    $evaluacion->save();
}else{
    $evaluacion=  get_entity($evaluacion);
}

$params = array('evaluacion'=>$evaluacion);
$form = elgg_view_form('convocatorias/evaluar_asesor', null, $params);
echo $form;
