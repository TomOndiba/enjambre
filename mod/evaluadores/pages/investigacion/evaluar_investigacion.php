<?php

$guid_inv=  get_input('guid');
$investigacion=new ElggInvestigacion($guid_inv);

// Busca la relacion del grupo con la investigacion  para enviar datos al formulario de registro y actualización
$grupo= elgg_get_relationship_inversa($investigacion,"tiene_la_investigacion");

if(check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $guid_inv)){
// Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
$institucion=  elgg_get_relationship($grupo[0], "pertenece_a");

}

// Busca la pregunta de investigacion  para enviar datos al formulario de registro y actualización
$pregunta=elgg_get_pregunta_investigacion($guid_inv);

// Busca si existe la relación entre la investigación y la evaluacion para obtener el id de la evaluación.
$evaluaciones= elgg_get_relationship($investigacion,"tiene_la_evaluacion");


// Busca la relacion de la investigacion con la convocatoria y la linea para saber el nombre de la linea tematica
$convocatoria= elgg_get_relationship($investigacion, "inscrita_a_convocatoria");
$linea= elgg_get_relationship($investigacion, "inscrita_a_".$convocatoria[0]->guid."_con_linea_tematica");


if(!empty($evaluaciones[0])){
$user=  elgg_get_usuario_byId($evaluaciones[0]->owner_guid);
}
else
    $user= elgg_get_logged_in_user_entity ();
        

$valorador=$user->name." ".$user->apellidos;
 
//Para crear la url de imprimir

$url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $evaluaciones[0]->guid. '&bit=90&grupo='.$grupo[0]->guid.'&inst='.$institucion[0]->guid.'&inv='.$guid_inv.'&valorador='.$valorador.'&area='.$linea[0]->name;
$url_print = elgg_add_action_tokens_to_url($url1);



$params = array ('guid_evaluacion'=>$evaluaciones[0]->guid, 'guid_inv'=>$guid_inv,'grupo'=>$grupo[0]->name, 'institucion'=>$institucion[0]->name, 'departamento'=>$institucion[0]->departamento, 
    'municipio'=>$institucion[0]->municipio, 'pregunta'=>$pregunta, 'valorador'=>$valorador, 'area'=>$linea[0]->name, 'puntaje1'=>$evaluaciones[0]->puntaje_bitacora1, 'puntaje2'=>$evaluaciones[0]->puntaje_bitacora2,
    'puntaje3'=>$evaluaciones[0]->puntaje_bitacora3, 'concepto'=>$evaluaciones[0]->concepto, 'observacion'=>$evaluaciones[0]->observacion,'href'=>$url_print);

$content= elgg_view_form('investigacion/evaluar_investigacion', NULL, $params);

$vars = array('content'=>$content);
$body= elgg_view_layout('one_column', $vars);
echo elgg_view_page($title, $body);


