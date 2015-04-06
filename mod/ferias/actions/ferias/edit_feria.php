<?php
/**
 * Editar la información de una feria de acuerdo a los datos modificados en un formulario
 */
$id = get_input('id');
$nombre = get_input('nombre');
$descripcion = get_input('descripcion'); 
$objetivos = get_input('objetivos'); 
$contacto = get_input('contacto'); 
$fecha_inicio_feria = get_input('fecha_inicio_feria'); 
$fecha_fin_feria = get_input('fecha_fin_feria'); 
$fecha_inicio_inscripciones = get_input('fecha_inicio_inscripciones'); 
$fecha_fin_inscripciones = get_input('fecha_fin_inscripciones');
$valor_inscripcion = get_input('valor_inscripcion'); 
$fecha_montaje = get_input('fecha_montaje'); 
$hora_montaje = get_input('hora_montaje'); 
$minutos_montaje = get_input('minutos_montaje'); 
$fecha_desmontaje = get_input('fecha_desmontaje');
$hora_desmontaje = get_input('hora_desmontaje'); 
$minutos_desmontaje = get_input('minutos_desmontaje'); 
$formas_participacion = get_input('formas_participacion'); 
$max_inscritos = get_input('max_inscritos');
$formas="";
if(isset($formas_participacion) && !empty($formas_participacion)){
    foreach ($formas_participacion as $forma){
        $formas.=$forma.", ";
    }
}
$usuario = elgg_get_logged_in_user_entity();

$feria_ant = new ElggFeria($id);

//Arreglo con los nombres de los metadatos a actualizar
$nombre_metadato = array('descripcion', 'objetivos', 'correos_contacto','fecha_inicio_feria', 'fecha_fin_feria', 'fecha_inicio_inscripciones', 
                        'fecha_fin_inscripciones', 'valor_inscripcion', 'fecha_montaje_puestos', 'hora_montaje_puestos', 'fecha_desmontaje_puestos', 
                        'hora_desmontaje_puestos', 'formas_participacion', 'max_inscritos');
$feria_ant->name = $nombre;
//Arreglo con el valor con los que se actualizaran los metadatos
$value_metadato = array($descripcion ,$objetivos,$contacto,$fecha_inicio_feria ,$fecha_fin_feria,$fecha_inicio_inscripciones,
                        $fecha_fin_inscripciones,$valor_inscripcion,$fecha_montaje, $hora_montaje.":".$minutos_montaje,
                        $fecha_desmontaje,$hora_desmontaje.":".$minutos_desmontaje, $formas, $max_inscritos);

for ($i = 0; $i < count($nombre_metadato); $i++) {

    if ($feria_ant->$nombre_metadato[$i] != $value_metadato[$i]) {

        $options = array(
            'guid' => $feria_ant->guid,
            'metadata_name' => $nombre_metadato[$i],
            'limit' => false
        );
        $g = elgg_delete_metadata($options);

        if (!is_null($value_metadato[$i]) && ($value_metadato[$i] !== '')) {
            create_metadata($feria_ant->guid, $nombre_metadato[$i], $value_metadato[$i], 'text', $usuario->guid, ACCESS_PUBLIC);
        }
    }
}




$premios=get_input('premios', '', false);
$id_file=get_input('premios_file_guid');
$name=$_FILES['premios']['name'];
$error=$_FILES['premios']['error'];
$tmp_name=$_FILES['premios']['tmp_name'];
$type=$_FILES['premios']['type'];
$other_name="premios_distinciones";
elgg_upload_file($premios, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$actividades=get_input('actividades', '', false);
$id_file=get_input('actividades_file_guid');
$name=$_FILES['actividades']['name'];
$error=$_FILES['actividades']['error'];
$tmp_name=$_FILES['actividades']['tmp_name'];
$type=$_FILES['actividades']['type'];
$other_name="actividades";
elgg_upload_file($actividades, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$requisitos=get_input('requisitos', '', false);
$id_file=get_input('requisitos_file_guid');
$name=$_FILES['requisitos']['name'];
$error=$_FILES['requisitos']['error'];
$tmp_name=$_FILES['requisitos']['tmp_name'];
$type=$_FILES['requisitos']['type'];
$other_name="requisitos_participacion";
elgg_upload_file($requisitos, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$publico_invitado=get_input('publico_invitado', '', false);
$id_file=get_input('publico_file_guid');
$name=$_FILES['publico_invitado']['name'];
$error=$_FILES['publico_invitado']['error'];
$tmp_name=$_FILES['publico_invitado']['tmp_name'];
$type=$_FILES['publico_invitado']['type'];
$other_name="publico_invitado";
elgg_upload_file($publico_invitado, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$costos_organizadores=get_input('costos_organizadores', '', false);
$id_file=get_input('costos_file_guid');
$name=$_FILES['costos_organizadores']['name'];
$error=$_FILES['costos_organizadores']['error'];
$tmp_name=$_FILES['costos_organizadores']['tmp_name'];
$type=$_FILES['costos_organizadores']['type'];
$other_name="costos_organizadores";
elgg_upload_file($costos_organizadores, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$parametros_puesto=get_input('parametros_puesto', '', false);
$id_file=get_input('parametros_file_guid');
$name=$_FILES['parametros_puesto']['name'];
$error=$_FILES['parametros_puesto']['error'];
$tmp_name=$_FILES['parametros_puesto']['tmp_name'];
$type=$_FILES['parametros_puesto']['type'];
$other_name="parametros_puestos";
elgg_upload_file($parametros_puesto, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$herramientas=get_input('herramientas', '', false);
$id_file=get_input('herramientas_file_guid');
$name=$_FILES['herramientas']['name'];
$error=$_FILES['herramientas']['error'];
$tmp_name=$_FILES['herramientas']['tmp_name'];
$type=$_FILES['herramientas']['type'];
$other_name="herramientas_presentaciones";
elgg_upload_file($herramientas, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$proceso_valoracion=get_input('proceso_valoracion', '', false);
$id_file=get_input('proceso_file_guid');
$name=$_FILES['proceso_valoracion']['name'];
$error=$_FILES['proceso_valoracion']['error'];
$tmp_name=$_FILES['proceso_valoracion']['tmp_name'];
$type=$_FILES['proceso_valoracion']['type'];
$other_name="proceso_valoracion";
elgg_upload_file($proceso_valoracion, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$agenda_feria=get_input('agenda_feria', '', false);
$id_file=get_input('agenda_file_guid');
$name=$_FILES['agenda_feria']['name'];
$error=$_FILES['agenda_feria']['error'];
$tmp_name=$_FILES['agenda_feria']['tmp_name'];
$type=$_FILES['agenda_feria']['type'];
$other_name="agenda_feria";
elgg_upload_file($agenda_feria, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);

$reglamento_feria=get_input('reglamento_feria', '', false);
$id_file=get_input('reglamento_file_guid');
$name=$_FILES['reglamento_feria']['name'];
$error=$_FILES['reglamento_feria']['error'];
$tmp_name=$_FILES['reglamento_feria']['tmp_name'];
$type=$_FILES['reglamento_feria']['type'];
$other_name="reglamento_feria";
elgg_upload_file($reglamento_feria, $id_file, $name, $error, $tmp_name, $type, $id, $other_name, $feria_ant);


elgg_clear_sticky_form('profile:edit');
if($feria_ant->save()){
    //Subiendo el icono de la feria...

    $has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));
    

    if ($has_uploaded_icon) {

        $icon_sizes = elgg_get_config('icon_sizes');
       
        $prefix = "ferias_publico/" . $feria_ant->guid;

        $filehandler = new ElggFile();
        $filehandler->owner_guid = $feria_ant->owner_guid;
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

            $thumb->owner_guid = $feria_ant->owner_guid;

            $thumb->setMimeType('image/jpeg');


            foreach ($sizes as $size) {

                $thumb->setFilename("{$prefix}{$size}.jpg");
                $thumb->open("write");
                $thumb->write($thumbs[$size]);
                $thumb->close();
            }

            $group->icontime = time();

            
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
            $filehandler->owner_guid = $group->owner_guid;
            $new_path = $filehandler->getFilenameOnFilestore();

            foreach ($sizes as $size) {
                rename("$old_path/{$group_guid}{$size}.jpg", "$new_path/{$group_guid}{$size}.jpg");
            }
        }
    }
    system_message(elgg_echo("feria:edit:saved"));
    forward('/ferias/listado');
}else{
    register_error(elgg_echo("feria:error:edit"));
    forward(REFERER);
}



