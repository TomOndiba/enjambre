<?php

elgg_load_css('logged');

$idGrupo = get_input('id_grupo');
$grupo = new ElggGrupoInvestigacion($idGrupo);
$title = $grupo->name;
$user = elgg_get_logged_in_user_entity();
$rol = elgg_get_rol_en_grupo_investigacion($grupo, $user);

$guid_investigacion=get_input('id_investigacion');
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

$params['buttons'] = array();
$permiso=$rol;
if (!$rol && $user) {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/join?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Unirse');
    array_push($params['buttons'], $array);
} else if ($rol == 'request') {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/cancelrequest?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Cancelar Solicitud');
    array_push($params['buttons'], $array);
    $permiso=false;
} else if ($rol == "admin") {
    $sol = elgg_get_site_url() . "grupo_investigacion/administrar_roles/" . $grupo->guid;
    $array = array('href' => $sol,
        'value' => 'Administar Roles');
    array_push($params['buttons'], $array);
    $sol = elgg_get_site_url() . "grupo_investigacion/solicitudes/" . $grupo->guid;
    $array2=array('href' => $sol,
        'value' => 'Solicitudes');;
     array_push($params['buttons'], $array2);
}

if ($rol == "editor" || $rol == "leer") {
    $sol = elgg_get_site_url() . "action/grupo_investigacion/abandonar_grupo?id_grupo=" . $grupo->guid;
    $solicitud = elgg_add_action_tokens_to_url($sol);
    $array = array('href' => $solicitud,
        'value' => 'Abandonar Grupo');
    array_push($params['buttons'], $array);
}
$params['rol_user']=$permiso;
//$content = elgg_view('grupo_investigacion/profile/header', $params);


$content.= elgg_view_form('investigacion/convocatorias_abiertas', null, $params);

$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo)); 


