<?php
elgg_load_library('tidypics:upload');
/**
 * Action que actualiza la información del usuario
 */
$id = get_input('id');
$nombre = get_input('nombres');
$apellidos = get_input('apellidos');
$sexo = get_input('sexo');
$tipo_documento = get_input('tipo_documento');
$numero_documento = get_input('numero_documento');
$pais_nacimiento = get_input('pais_nacimiento');
$departamento = get_input('dpto_nacimiento');
$municipio = get_input('municipio_nacimiento');
$fecha_nacimiento = get_input('fecha_nacimiento');
$barrio = get_input('barrio');
$direccion = get_input('direccion');
$telefono = get_input('telefono');
$celular = get_input('celular');
$institucion = get_input('institucion');
$curso = get_input('curso');
$vive = get_input('vive');
$zona = get_input('zona');
$tiempo_libre = get_input('tiempo_libre');
$universidad = get_input('universidad');
$titulo = get_input('titulo');
$especialidad = get_input('especialidad');
$anio = get_input('anio_grado');
$area_conocimiento = get_input('area_desempenio');
$grupo_etnico = get_input('grupo_etnico');
$email=get_input('email');
//$username_repetido = elgg_existe_username($username);
//$email_repetido = elgg_existe_email($email);

$user = elgg_get_usuario_byId($id);
$usuario = new ElggUsuario($user->guid);
$us = get_entity($id);


//verifica si existe la relación entre el usuario Estudiante y la institución seleccionada, si no es porque la actualizó
//Elimina la relación con la antigua institucion y crea la relación con la nueva institución
if ($user->getSubtype() == "estudiante") {
    if (!check_entity_relationship($user->guid, "estudia_en", $institucion)) {
        $inst = $user->getEntitiesFromRelationship("estudia_en");
        foreach ($inst as $i) {
            $user->removeRelationship($i->guid, "estudia_en");
        }
        $user->addRelationship($institucion, "estudia_en");
    }
}


if ($user->getSubtype() == "maestro") {
    if (!check_entity_relationship($user->guid, "trabaja_en", $institucion)) {
        $inst = $user->getEntitiesFromRelationship("trabaja_en");
        error_log("cantidad: "+ count($inst));
        foreach ($inst as $i) {
            $user->removeRelationship($i->guid, "trabaja_en");
        }
        $user->addRelationship($institucion, "trabaja_en");
    }
}


$user = elgg_get_logged_in_user_entity();
$container_guid = elgg_get_logged_in_user_guid();


if ($usuario->name != $nombre) {
    $usuario->name = $nombre;
   
}
if($usuario->email==""){
   $usuario->email=$email; 
}
 $usuario->save();

//Arreglo con los nombres de los metadatos a actualizar
$nombre_metadato = array('apellidos', 'sexo', 'tipo_documento', 'numero_documento', 'pais_nacimiento', 'departamento_nacimiento',
    'municipio_nacimiento', 'fecha_nacimiento', 'barrio', 'direccion', 'telefono', 'celular', 'curso', 'vive', 'zona', 'tiempo_libre',
    'titulo', 'especialidad', 'universidad', 'anio', 'area_conocimiento', 'grupo_etnico');


//Arreglo con el valor con los que se actualizaran los metadatos
$value_metadato = array($apellidos, $sexo, $tipo_documento, $numero_documento, $pais_nacimiento, $departamento,
    $municipio, $fecha_nacimiento, $barrio, $direccion, $telefono, $celular, $curso, $vive, $zona, $tiempo_libre,
    $titulo, $especialidad, $universidad, $anio, $area_conocimiento, $grupo_etnico);


// recorre el arreglo para verificar si los metadatos coinciden con la información recibida de los campos
// si no es la misma es porque el usuario actualizó, se elimina el metadato y se crea uno nuevo
for ($i = 0; $i < count($nombre_metadato); $i++) {

    if ($usuario->$nombre_metadato[$i] != $value_metadato[$i]) {

        $options = array(
            'guid' => $usuario->guid,
            'metadata_name' => $nombre_metadato[$i],
            'limit' => false
        );
        $g = elgg_delete_metadata($options);

        if (!is_null($value_metadato[$i]) && ($value_metadato[$i] !== '')) {
            create_metadata($usuario->guid, $nombre_metadato[$i], $value_metadato[$i], 'text', $user->guid, ACCESS_PUBLIC);
        }
    }
}

//elgg_trigger_event('profileupdate', $usuario->type, $usuario);

elgg_clear_sticky_form('profile:edit');
system_message(elgg_echo("profile:saved"));





/** Agregar Imagen dee Perfil */
$album = elgg_get_album_perfil($id);
if ($album == null) {
    $album = new TidypicsAlbum();
    $album->owner_guid = $id;
    $album->title = "Fotos De Perfil";
    $album->access_id = ACCESS_PUBLIC;
    $album = $album->saveReturn();
}



    $mimeR = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
	# Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
	if( !in_array( $_FILES['avatar']['type'], $mimeR )&& !empty($_FILES['avatar']['type']) )
	{
            register_error("No se pudo guardar la información; la foto para el Perfil debe ser una Imagen ");
             forward(REFERER);
	}
    


$has_uploaded_icon = (!empty($_FILES['avatar']['type']) && substr_count($_FILES['avatar']['type'], 'image/'));


if ($has_uploaded_icon) {


    $icon_sizes = elgg_get_config('icon_sizes');



    $filehandler = new ElggFile();
    $filehandler->subtype = "image";
    $filehandler->owner_guid = $id;
    $filehandler->container_guid = $album;
    $filehandler->setFilename("profile/{$id}.jpg");
    $filehandler->open("write");
    $filehandler->write(get_uploaded_file('avatar'));
    $filehandler->close();
    $filename = $filehandler->getFilenameOnFilestore();


    $sizes = array('tiny', 'small', 'medium', 'large');

    $thumbs = array();
    foreach ($sizes as $size) {
        $thumbs[$size] = get_resized_image_from_existing_file(
                $filename, $icon_sizes[$size]['w'], $icon_sizes[$size]['h'], $icon_sizes[$size]['square']
        );
    }



    if ($thumbs['tiny']) { // just checking if resize successful
        $thumb = new ElggFile();

        $thumb->owner_guid = $id;

        $thumb->setMimeType('image/jpeg');


        foreach ($sizes as $size) {

            $thumb->setFilename("profile/{$id}{$size}.jpg");
            $thumb->open("write");
            $thumb->write($thumbs[$size]);
            $thumb->close();
        }

        $us->icontime = time();
    }

    
    
    
    $data = array();
foreach ($_FILES['avatar'] as $key=>$value) {
    $data[$key] = $value;
}
$name = htmlspecialchars($_FILES['avatar']['name'], ENT_QUOTES, 'UTF-8', true);
$mime = tp_upload_get_mimetype($name);
$image = new TidypicsImage();
$image->title = $name;

$image->container_guid = $album;
$image->setMimeType($mime);
$image->access_id = ACCESS_PUBLIC ;
$result = $image->saveImg($data);

  
}

 

forward(REFERER);



