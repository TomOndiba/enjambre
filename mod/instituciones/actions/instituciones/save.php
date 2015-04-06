<?php

$nombre = get_input('nombre');
$direccion = get_input('direccion');
$telefono = get_input('telefono');
$director = get_input('director');
$email = get_input('email');
$web = get_input('website');
$departamento = get_input("departamento");
$munip = get_input("municipio");
$tipo_institucion=  get_input('tipo_institucion');
$corregimiento=get_input('corregimiento');
$municipio= mb_strtoupper($munip, "utf-8"); 

$group_guid = (int) get_input('guid');
$is_new_group = $group_guid == 0;
$old_owner_guid = $is_new_group ? 0 : $institucion->owner_guid;

if($is_new_group && elgg_existe_institucion($nombre)){
    register_error(elgg_echo("Ya existe una Institución registrada con ese nombre, Intente con otro Nombre")); 
   forward(REFERER);
}

if ($is_new_group && !elgg_existe_institucion($nombre)) {
    $institucion = new ElggInstitucion();
    $institucion->name = $nombre;
    $institucion->direccion = $direccion;
    $institucion->telefono = $telefono;
    $institucion->director = $director;
    $institucion->website = $web;
    $institucion->email = $email;
    $institucion->departamento = $departamento;
    $institucion->municipio = $municipio;
    $institucion->corregimiento=$corregimiento;
    $institucion->tipo_institucion=$tipo_institucion;
    $institucion->owner_guid = elgg_get_logged_in_user_guid();
    $guid = $institucion->save();
    
    
} else {

    $institucion = new ElggInstitucion($group_guid);

    if ($institucion->name != $nombre) {
        $institucion->name = $nombre;
        $institucion->save();
    }


    //Arreglo con los nombres de los metadatos a actualizar
    $nombre_metadato = array('direccion', 'telefono', 'director', 'email', 'website', 'departamento',
        'municipio', 'corregimiento', 'tipo_institucion');


//Arreglo con el valor con los que se actualizaran los metadatos
    $value_metadato = array($direccion, $telefono, $director, $email, $web, $departamento,
        $municipio,$corregimiento, $tipo_institucion);


// recorre el arreglo para verificar si los metadatos coinciden con la información recibida de los campos
// si no es la misma es porque el usuario actualizó, se elimina el metadato y se crea uno nuevo
    for ($i = 0; $i < count($nombre_metadato); $i++) {

        if ($institucion->$nombre_metadato[$i] != $value_metadato[$i]) {

            $options = array(
                'guid' => $institucion->guid,
                'metadata_name' => $nombre_metadato[$i],
                'limit' => false
            );
            $g = elgg_delete_metadata($options);

            if (!is_null($value_metadato[$i]) && ($value_metadato[$i] !== '')) {
                create_metadata($institucion->guid, $nombre_metadato[$i], $value_metadato[$i], 'text',  elgg_get_logged_in_user_guid(), ACCESS_PUBLIC);
            }
        }
    }
    
      $guid = $institucion->save();
}





 $mimeR = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
	# Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
	if( !in_array( $_FILES['icon']['type'], $mimeR )&& !empty($_FILES['icon']['type']) )
	{
            register_error("Para la Foto de la Institución, el archivo seleccionado debe ser una Imagen ");
             forward(REFERER);
	}
        
        
        
$has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));


if ($has_uploaded_icon) {

    $icon_sizes = elgg_get_config('icon_sizes');

    $prefix = "instituciones/" . $institucion->guid;

    $filehandler = new ElggFile();
    $filehandler->owner_guid = $institucion->owner_guid;
    $filehandler->setFilename($prefix . ".jpg");
    $filehandler->open("write");
    $filehandler->write(get_uploaded_file('icon'));
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

        $thumb->owner_guid = $institucion->owner_guid;

        $thumb->setMimeType('image/jpeg');


        foreach ($sizes as $size) {

            $thumb->setFilename("{$prefix}{$size}.jpg");
            $thumb->open("write");
            $thumb->write($thumbs[$size]);
            $thumb->close();
        }

        $institucion->icontime = time();
    }
}




// @todo Remove this when #4683 fixed
if ($must_move_icons) {
    $filehandler = new ElggFile();
    $filehandler->setFilename('groups');
    $filehandler->owner_guid = $old_owner_guid;
    $old_path = $filehandler->getFilenameOnFilestore();

    $sizes = array('', 'tiny', 'small', 'medium', 'large');

    if ($has_uploaded_icon) {
        // delete those under old owner
        foreach ($sizes as $size) {
            unlink("$old_path/{$group_guid}{$size}.jpg");
        }
    } else {
        // move existing to new owner
        $filehandler->owner_guid = $institucion->owner_guid;
        $new_path = $filehandler->getFilenameOnFilestore();

        foreach ($sizes as $size) {
            rename("$old_path/{$group_guid}{$size}.jpg", "$new_path/{$group_guid}{$size}.jpg");
        }
    }
}



if ($guid) {
    system_message(elgg_echo("ok:institucion:create"));
    forward('/instituciones/ver/' . $guid);
    
} else if (!$is_new_group) {
    system_message(elgg_echo("ok:institucion:update"));
    forward('/instituciones/ver/' . $group_guid);
} else {
    system_message(elgg_echo("error:existe:institucion:create"));
    forward(REFERER);
}