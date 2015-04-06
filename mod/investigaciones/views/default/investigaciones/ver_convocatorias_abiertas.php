<?php

$idGrupo = get_input('id_grupo');
$grupo = new ElggGrupoInvestigacion($idGrupo);
$title = $grupo->name;
$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);

$guid_investigacion=get_input('id_inv');
$investigacion= new ElggInvestigacion($guid_investigacion);


$convocatorias=  elgg_get_convocatorias_abiertas();

$convocatorias_inscritas=array();
$convocatorias1= elgg_get_relationship($investigacion, "preinscrita_a_convocatoria");
$convocatorias_inscritas=array_merge($convocatorias_inscritas, $convocatorias1); 
$convocatorias2= elgg_get_relationship($investigacion, "inscrita_a_convocatoria");
$convocatorias_inscritas=array_merge($convocatorias_inscritas, $convocatorias2);
$convocatorias3= elgg_get_relationship($investigacion, "evaluada_en_convocatoria");
$convocatorias_inscritas=array_merge($convocatorias_inscritas, $convocatorias3);
$convocatorias4= elgg_get_relationship($investigacion, "seleccionada_en_convocatoria");
$convocatorias_inscritas=array_merge($convocatorias_inscritas, $convocatorias4);

$final_convocatorias=array();

foreach ($convocatorias as $conv) {
    if(!in_array($conv, $convocatorias_inscritas)){
        array_push($final_convocatorias, $conv);
    }
}
$options=array();
$options[0]="Seleccionar..";
foreach ($final_convocatorias as $conv){
    $options[$conv->guid]=$conv->name;
}
$params['convocatorias']=$options;
$params['id_investigacion']=$guid_investigacion;
$params['title'] = $title;
$params['grupo'] = array(
    'nombre' => $grupo->name,
    'guid' => $grupo->guid,
    'rol_user' => $rol,
    'descripcion'=>$grupo->description,
);
$content.= elgg_view_form('investigacion/convocatorias_abiertas', null, $params);
echo $content;

