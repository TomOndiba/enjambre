<?php



elgg_load_css('logged');

gatekeeper();

$user = elgg_get_logged_in_user_entity();
if (!$user) {
	register_error(elgg_echo("profile:notfound"));
	forward();
}

// create form
$form_vars = array('enctype' => 'multipart/form-data');



// check if logged in user can edit this profile
if (!$user->canEdit()) {
	register_error(elgg_echo("profile:noaccess"));
	forward();
}

elgg_set_context('profile_edit');

$title = elgg_echo('profile:edit');


if($user->getSubtype()==='estudiante'){
    $institucion=$user->getEntitiesFromRelationship('estudia_en', false);
}  
else{
   $institucion=$user->getEntitiesFromRelationship ('trabaja_en', false);
}
   $munic=mb_strtolower($institucion[0]->municipio, "UTF-8");
   $municipio=  ucwords($munic);
   
   $name_inst=$nombre = str_replace("¿", "Ñ", $institucion[0]->name);
   
   
    
$params = array('entity' => $user, 'tipo_usuario'=>$user->getSubtype(), 'id'=>$user->guid, 'nombres'=>$user->name,'apellidos'=>$user->apellidos,
                'sexo'=>$user->sexo, 'tipo_d'=>$user->tipo_documento, 'numero'=>$user->numero_documento, 
                'fecha_n'=>$user->fecha_nacimiento, 'pais_n'=>$user->pais_nacimiento, 'departamento_n'=>$user->departamento_nacimiento,
                'municipio_n'=>$user->municipio_nacimiento, 'barrio'=>$user->barrio, 'direccion'=>$user->direccion,  'telefono'=>$user->telefono,'celular'=>$user->celular,
                'curso'=>$user->curso, 'vive'=>$user->vive, 'zona'=>$user->zona, 'tiempo_libre'=>$user->tiempo_libre,
                'universidad'=>$user->universidad, 'titulo'=>$user->titulo, 'especialidad'=>$user->especialidad, 'anio'=>$user->anio,'area'=>$user->area_conocimiento,'vars' => $body_vars,
                'departamento_inst'=>$institucion[0]->departamento, 'municipio_inst'=>$municipio, 'nombre_inst'=>$name_inst, 'guid_inst'=>$institucion[0]->guid,
                'grupo_etnico'=>$user->grupo_etnico, 'email'=>$user->email);

            
$content = elgg_view_form('usuario/update', $form_vars, $params);

$body = array('izquierda' => elgg_view('profile/menu', array('user' => $user)), 'derecha' => $content);

echo elgg_view_page($user->name, $body, "profile", array('user' => $user));