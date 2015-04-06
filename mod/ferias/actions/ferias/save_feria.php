<?php

elgg_make_sticky_form('groups');

/**
 * Guarda en base de datos una nueva feria de acuerdo a los datos recibidos de un formulario
 */
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
$departamento = get_input('departamentos');
$tipo = get_input('tipo');
$munis = "";

if ($tipo == 'Municipal') {
    $municipios = get_input('municipios');

    if (sizeof($municipios) > 0) {
        foreach ($municipios as $muni) {
            $munis.=$muni . ", ";
        }
    }
} else if ($tipo == 'Institucional') {
    $munis = get_input('municipio');
    $inst = get_input('institucion');
    error_log("llega inst -> $inst");
}
$formas_participacion = get_input('formas_participacion');
$max_inscritos = get_input('max_inscritos');
$premios = get_input('premios');
$actividades = get_input('actividades');
$requisitos = get_input('requisitos');
$publico_invitado = get_input('publico_invitado');
$costos_organizadores = get_input('costos_organizadores');
$parametros_puesto = get_input('parametros_puesto');
$herramientas = get_input('herramientas');
$proceso_valoracion = get_input('proceso_valoracion');
$agenda_feria = get_input('agenda_feria');
$reglamento_feria = get_input('reglamento_feria');
$formas = "";
foreach ($formas_participacion as $forma) {
    $formas.=$forma . ", ";
}

$old_owner_guid = $is_new_group ? 0 : $group->owner_guid;
$new_owner_guid = (int) get_input('owner_guid');




if (elgg_existe_entity($nombre, "feria")) {
    register_error(elgg_echo("Ya existe una Feria registrada con ese nombre"));
    forward(REFERER);
}

$feria = new ElggFeria();
$feria->name = $nombre;
$feria->descripcion = $descripcion;
$feria->objetivos = $objetivos;
$feria->correos_contacto = $contacto;
$feria->fecha_inicio_feria = $fecha_inicio_feria;
$feria->fecha_fin_feria = $fecha_fin_feria;
$feria->fecha_inicio_inscripciones = $fecha_inicio_inscripciones;
$feria->fecha_fin_inscripciones = $fecha_fin_inscripciones;
$feria->valor_inscripcion = $valor_inscripcion;
$feria->fecha_montaje_puestos = $fecha_montaje;
$feria->hora_montaje_puestos = $hora_montaje . "." . $minutos_montaje;
$feria->fecha_desmontaje_puestos = $fecha_desmontaje;
$feria->hora_desmontaje_puestos = $hora_desmontaje . ":" . $minutos_desmontaje;
$feria->tipo_feria = $tipo;
$feria->departamento = $departamento;
$feria->municipios = $munis;
$feria->institucion = $inst;
$feria->formas_participacion = $formas;
$feria->max_inscritos = $max_inscritos;
$feria->consecutivo_inscripcion = 0;
$feria->estado = "activada";


if ($tipo == 'Municipal') {
    $feria->participo_en_departamental = 'false';
}

$guid_feria = $feria->save();
if (!$guid_feria) {
    register_error(elgg_echo("feria:error:create"));
    forward(REFERER);
} else {
    $premios = get_input('premios', '', false);
    $name = $_FILES['premios']['name'];
    $error = $_FILES['premios']['error'];
    $tmp_name = $_FILES['premios']['tmp_name'];
    $type = $_FILES['premios']['type'];
    $other_name = "premios_distinciones";
    elgg_upload_file($premios, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $actividades = get_input('actividades', '', false);
    $name = $_FILES['actividades']['name'];
    $error = $_FILES['actividades']['error'];
    $tmp_name = $_FILES['actividades']['tmp_name'];
    $type = $_FILES['actividades']['type'];
    $other_name = "actividades";
    elgg_upload_file($actividades, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $requisitos = get_input('requisitos', '', false);
    $name = $_FILES['requisitos']['name'];
    $error = $_FILES['requisitos']['error'];
    $tmp_name = $_FILES['requisitos']['tmp_name'];
    $type = $_FILES['requisitos']['type'];
    $other_name = "requisitos_participacion";
    elgg_upload_file($requisitos, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $publico_invitado = get_input('publico_invitado', '', false);
    $name = $_FILES['publico_invitado']['name'];
    $error = $_FILES['publico_invitado']['error'];
    $tmp_name = $_FILES['publico_invitado']['tmp_name'];
    $type = $_FILES['publico_invitado']['type'];
    $other_name = "publico_invitado";
    elgg_upload_file($publico_invitado, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $costos_organizadores = get_input('costos_organizadores', '', false);
    $name = $_FILES['costos_organizadores']['name'];
    $error = $_FILES['costos_organizadores']['error'];
    $tmp_name = $_FILES['costos_organizadores']['tmp_name'];
    $type = $_FILES['costos_organizadores']['type'];
    $other_name = "costos_organizadores";
    elgg_upload_file($costos_organizadores, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $parametros_puesto = get_input('parametros_puesto', '', false);
    $name = $_FILES['parametros_puesto']['name'];
    $error = $_FILES['parametros_puesto']['error'];
    $tmp_name = $_FILES['parametros_puesto']['tmp_name'];
    $type = $_FILES['parametros_puesto']['type'];
    $other_name = "parametros_puestos";
    elgg_upload_file($parametros_puesto, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $herramientas = get_input('herramientas', '', false);
    $name = $_FILES['herramientas']['name'];
    $error = $_FILES['herramientas']['error'];
    $tmp_name = $_FILES['herramientas']['tmp_name'];
    $type = $_FILES['herramientas']['type'];
    $other_name = "herramientas_presentaciones";
    elgg_upload_file($herramientas, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $proceso_valoracion = get_input('proceso_valoracion', '', false);
    $name = $_FILES['proceso_valoracion']['name'];
    $error = $_FILES['proceso_valoracion']['error'];
    $tmp_name = $_FILES['proceso_valoracion']['tmp_name'];
    $type = $_FILES['proceso_valoracion']['type'];
    $other_name = "proceso_valoracion";
    elgg_upload_file($proceso_valoracion, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $agenda_feria = get_input('agenda_feria', '', false);
    $name = $_FILES['agenda_feria']['name'];
    $error = $_FILES['agenda_feria']['error'];
    $tmp_name = $_FILES['agenda_feria']['tmp_name'];
    $type = $_FILES['agenda_feria']['type'];
    $other_name = "agenda_feria";
    elgg_upload_file($agenda_feria, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    $reglamento_feria = get_input('reglamento_feria', '', false);
    $name = $_FILES['reglamento_feria']['name'];
    $error = $_FILES['reglamento_feria']['error'];
    $tmp_name = $_FILES['reglamento_feria']['tmp_name'];
    $type = $_FILES['reglamento_feria']['type'];
    $other_name = "reglamento_feria";
    elgg_upload_file($reglamento_feria, $id_file, $name, $error, $tmp_name, $type, $guid_feria, $other_name, $feria);

    //Subiendo el icono de la feria...





    $mimeR = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
    # Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
    if (!in_array($_FILES['icon']['type'], $mimeR) && !empty($_FILES['icon']['type'])) {
        register_error("Para el Ícono de la Feria,el archivo seleccionado debe ser una Imagen ");
        forward(REFERER);
    }

    $has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));


    if ($has_uploaded_icon) {

        $icon_sizes = elgg_get_config('icon_sizes');

        $prefix = "ferias_publico/" . $feria->guid;

        $filehandler = new ElggFile();
        $filehandler->owner_guid = $feria->owner_guid;
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

            $thumb->owner_guid = $feria->owner_guid;

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


    //según el tipo de feria
    if ($tipo == 'Institucional') {
        system_message(elgg_echo("feria:ok:create"));
        forward('/ferias/detalles/' . $guid_feria);
    }
    if ($tipo == 'Nacional') {
        system_message(elgg_echo("feria:ok:create"));
        forward('/ferias/detalles/' . $guid_feria);
    }
    if ($tipo == "Municipal") {
        $url = elgg_get_site_url();
        //buscar instituciones de cada municipio seleccionado
        foreach ($municipios as $muni) {

            $instituciones = elgg_get_instituciones_municipio($muni, $departamento);
            //para cada institución se envian notificaciones al usuario propietario y al correo de la institución
            foreach ($instituciones as $institucion) {
                if (!empty($institucion->email)) {
                    messages_send('Se ha abierto una nueva feria municipal', 'Se ha dado apertura a una nueva feria <b><i>'
                            . $feria->name . '</i></b> en el municipio de ' . $muni . ' al cual pertenece su institución '
                            . $institucion->name . ". Para más información ingrese <a href='$url" . "ferias/detalles/$guid_feria'>"
                            . "aquí</a>.", $institucion->owner_guid, 0, false);

                    elgg_enviar_correo($institucion->email, 'Se ha abierto una nueva feria municipal', 'Se ha dado apertura a una nueva feria <b><i>' . $feria->name . '</i></b> en el municipio de ' . $muni .
                            ' al cual pertenece su institución ' . $institucion->name . " Para más información ingrese"
                            . " <a href='$url" . "ferias/detalles/$guid_feria'>aquí</a>.");
                }
                //se buscan los grupos pertenecientes a la institución
                $grupos = elgg_get_relationship_inversa($institucion, "pertenece_a");

                //para cada grupo de investigación se envía notificacion interna y correo al propietario 
                foreach ($grupos as $grupo) {
                    if (!empty($owner->email)) {
                        messages_send('Se ha abierto una nueva feria municipal', 'Se ha dado apertura a una nueva feria <b><i>'
                                . $feria->name . '</i></b> en el municipio de ' . $muni . ' al cual pertenece su grupo ' . $grupo->name
                                . ". Para más información ingrese <a href='$url" . "ferias/detalles/$guid_feria'>aquí</a>."
                                , $grupo->owner_guid, 0, false);

                        $owner = get_entity($grupo->owner_guid);
                        elgg_enviar_correo($owner->email, 'Se ha abierto una nueva feria municipal', 'Se ha '
                                . 'dado apertura a una nueva feria <b><i>' . $feria->name . '</i></b> en el municipio de ' . $muni
                                . ' al cual pertenece su grupo ' . $grupo->name . ". Para más información ingrese "
                                . "<a href='$url" . "ferias/detalles/$guid_feria'>aquí</a>.");
                    }
                }
            }
        }
        system_message(elgg_echo("feria:ok:create"));
        forward('/ferias/detalles/' . $guid_feria);
    } else if ($tipo == "Departamental") {
        //direccionar a página donde se listen las ferias municipales disponibles
        system_message(elgg_echo("feria:ok:create"));
        forward('/ferias/ver_municipales_disponibles/' . $guid_feria);
    }
}