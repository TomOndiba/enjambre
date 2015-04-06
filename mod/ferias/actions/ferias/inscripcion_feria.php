<?php

/**
 * Action que permite realizar la inscripción a una feria
 */
//Llegada de datos de la feria
$id_feria = get_input('guid_feria');
$tipo_feria = get_input('tipo_feria');
$niveles_f = get_input('niveles');
$categoria_f = get_input('categoria');
$categorias_invs = get_input('subcategorias');
$forma_participacion = get_input('participacionF');
$areas_feria = get_input('areasF');
$materiales = get_input('materiales');

//Llegan datos de la investigacion
$guid_investigacion = get_input('guid_inv');
$estudiantes_investigacion = get_input('estudiantes');
$maestros_investigacion = get_input('maestros');
$titulo_inv = get_input('titulo_inv');
$pregunta_inv = get_input('pregunta_inv');
$problema_inv = get_input('problema_inv');
$metodologia_inv = get_input('metodologiaInv');
$resumen_inv = get_input('resumenInv');
$linea_feria_registrada = get_input('linea_tematica');
$linea_feria_seleccionada_pres = get_input('lineas_pre');
$linea_feria_seleccionada_abierta = get_input('lineas_open');
$nombre_asesor = get_input('asesor_inv');

//Llegan datos del grupo 
$guid_grupo = get_input('guid_grupo');
$nombre_grupo = get_input('name_grupo');
$nombre_institucion = get_input('nobre_col');
$nombre_rector = get_input('rector_col');
$municipio_inst = get_input('municipio_col');
$direccion_inst = get_input('direccion_col');
$email_inst = get_input('email_col');
$telefono_ins = get_input('telefono_col');



if (sizeof($areas_feria) < 1) {
    register_error(elgg_echo('ferias:inscripcion:areas:empy'), 'error');
    forward(REFERER);
}
if (sizeof($niveles_f) < 1) {
    register_error(elgg_echo('ferias:inscripcion:niveles:empy'), 'error');
    forward(REFERER);
}
if (sizeof($forma_participacion) < 1) {
    register_error(elgg_echo('ferias:inscripcion:participacion:empy'), 'error');
    forward(REFERER);
}
if (empty($metodologia_inv)) {
    register_error(elgg_echo('ferias:inscripcion:metodologia:empy'), 'error');
    forward(REFERER);
}
if (empty($resumen_inv)) {
    register_error(elgg_echo('ferias:inscripcion:resumen:empy'), 'error');
    forward(REFERER);
}
if (empty($materiales)) {
    register_error(elgg_echo('ferias:inscripcion:materiales:empy'), 'error');
    forward(REFERER);
}
if (sizeof($estudiantes_investigacion) < 1) {
    register_error(elgg_echo('ferias:inscripcion:estudiantes:empy'), 'error');
    forward(REFERER);
}
if (sizeof($maestros_investigacion) < 1) {
    register_error(elgg_echo('ferias:inscripcion:maestros:empy'), 'error');
    forward(REFERER);
}
if ($categoria_f == 'Innovación' && sizeof($categorias_invs) < 1) {
    register_error(elgg_echo('ferias:inscripcion:subcategorias:empy'), 'error');
    forward(REFERER);
}

//Validaciones pertinentes
$linea_tematica = '';
if (!empty($linea_feria_registrada)) {
    $linea_tematica = $linea_feria_registrada;
} else if (!empty($linea_feria_seleccionada_pres)) {
    $linea_tematica = $linea_feria_seleccionada_pres;
} else if (!empty($linea_feria_seleccionada_abierta)) {
    $linea_tematica = $linea_feria_seleccionada_abierta;
}

$forma_de_participacion = '';
foreach ($forma_participacion as $f) {
    $forma_de_participacion.=$f . '-';
}

$estudiantes_participacin = '';
if (sizeof($estudiantes_investigacion) > 1) {
    foreach ($estudiantes_investigacion as $e) {
        $estudiantes_participacin .= $e . '-';
    }
} else {
    $estudiantes_participacin = $estudiantes_investigacion;
}

$maestros_participacion = '';
if (sizeof($maestros_investigacion) > 1) {
    foreach ($maestros_investigacion as $m) {
        $maestros_participacion .= $m . '-';
    }
} else {
    $maestros_participacion = $maestros_investigacion;
}

$subcategorias = '';

if ($categoria_f == 'Innovación') {
    $subcategorias = $categorias_invs;
}

//REgistro de inscripcion
$inscripcion_a_feria = new ElggFormInscripcionFeria();

$inscripcion_a_feria->title = 'inscripcion_' . $id_feria;
$inscripcion_a_feria->tipo_feria = $tipo_feria;
$inscripcion_a_feria->nombre_institucion = $nombre_institucion;
$inscripcion_a_feria->rector_institucion = $nombre_rector;
$inscripcion_a_feria->municipio_dpto = $municipio_inst;
$inscripcion_a_feria->direccion_institucion = $direccion_inst;
$inscripcion_a_feria->telefono_institucion = $telefono_ins;
$inscripcion_a_feria->email_institucion = $email_inst;
$inscripcion_a_feria->nombre_grupo = $nombre_grupo;
$inscripcion_a_feria->estudiantes_grupo = $estudiantes_participacin;
$inscripcion_a_feria->maestros_grupo = $maestros_participacion;
$inscripcion_a_feria->nivel_feria = $niveles_f;
$inscripcion_a_feria->categorias_feria = $categoria_f;
$inscripcion_a_feria->formas_participacion = $forma_de_participacion;
$inscripcion_a_feria->titulo_investigacion = $titulo_inv;
$inscripcion_a_feria->perturbacion_onda = $pregunta_inv;
$inscripcion_a_feria->superposicion_onda = $problema_inv;
$inscripcion_a_feria->trayectoria_indagacion = $metodologia_inv;
$inscripcion_a_feria->resumen_conclusiones = $resumen_inv;
$inscripcion_a_feria->linea_tematica = get_entity($linea_tematica)->name;
$inscripcion_a_feria->nombre_asesor = $nombre_asesor;
$inscripcion_a_feria->area_feria = $areas_feria;
$inscripcion_a_feria->materiales = $materiales;
$inscripcion_a_feria->subcategorias_innovacion = $subcategorias;

$feria = get_entity($id_feria);
$numero = $feria->consecutivo_inscripcion;
$numer = $numero + 1;
$feria->consecutivo_inscripcion = $numer;
$feria->save();

$inscripcion_a_feria->numero_inscripcion = $numer;

$result = $inscripcion_a_feria->save();

if ($result) {
    //Subir el informe de investigación
    $informe_investigacion = get_input('informe_investigacion', '', false);
    $name = $_FILES['informe_investigacion']['name'];
    $error = $_FILES['informe_investigacion']['error'];
    $tmp_name = $_FILES['informe_investigacion']['tmp_name'];
    $type = $_FILES['informe_investigacion']['type'];
    $other_name = "informe_investigacion";
    elgg_upload_file($informe_investigacion, $id_file, $name, $error, $tmp_name, $type, $result, $other_name, $inscripcion_a_feria);

    //subir el escrito del profesor
    $escrito_prof = get_input('escrito_profesor');
    $name = $_FILES['escrito_profesor']['name'];
    $error = $_FILES['escrito_profesor']['error'];
    $tmp_name = $_FILES['escrito_profesor']['tmp_name'];
    $type = $_FILES['escrito_profesor']['type'];
    $other_name = "escrito_profesor";
    elgg_upload_file($escrito_prof, $id_file, $name, $error, $tmp_name, $type, $result, $other_name, $inscripcion_a_feria);

    //subir la presentacion
    $presentacion = get_input('presentacion');
    $name = $_FILES['presentacion']['name'];
    $error = $_FILES['presentacion']['error'];
    $tmp_name = $_FILES['presentacion']['tmp_name'];
    $type = $_FILES['presentacion']['type'];
    $other_name = "presentacion";
    if (!empty($name)) {
        elgg_upload_file($presentacion, $id_file, $name, $error, $tmp_name, $type, $result, $other_name, $inscripcion_a_feria);
    }

    $investigacion = get_entity($guid_investigacion);
    $feria = get_entity($id_feria);

    $grupo = elgg_get_relationship_inversa($investigacion, 'tiene_la_investigacion'); // consulta el grupo relacionado con la investigacion para saber el Guid del Maestro que lo creó

    $user = elgg_get_usuario_byId($grupo[0]->owner_guid);
    $institucion = elgg_get_relationship($grupo[0], "pertenece_a");

    $user1 = elgg_get_usuario_byId($institucion[0]->owner_guid);
    $url_feria = elgg_get_site_url() . "feria/ver/$id_feria";
    $numero_inscripcion = str_pad($inscripcion_a_feria->numero_inscripcion, 4, "0", STR_PAD_LEFT);

    $t_f = '';
    if ($feria->tipo_feria == 'Municipal') {
        add_entity_relationship($guid_investigacion, 'inscrita_en_' . $id_feria . '_con', $inscripcion_a_feria->guid);
        add_entity_relationship($guid_investigacion, 'inscrita_en', $id_feria);

        $subject = elgg_echo('feria:inscripction:subject:inscOk');
        if (!empty($user->email)) {
            $result = messages_send($subject, elgg_echo('feria:inscripcion:ok1') . "$investigacion->name" . elgg_echo('feria:inscripcion:ok2') . "<a href='$url_feria'>" . $feria->name . "</a>" . elgg_echo('feria:inscripcion:ok1.5') . $numero_inscripcion, $grupo[0]->owner_guid, 0, $reply);
            elgg_enviar_correo($user->email, $subject, elgg_echo('feria:inscripcion:ok1') . "$investigacion->name" . elgg_echo('feria:inscripcion:ok2') . "<a href='$url_feria'>" . $feria->name . "</a>");
        }

        if (!empty($institucion[0]->email)) {
            $result1 = messages_send($subject, elgg_echo('feria:inscripcion:ok1') . "$investigacion->name" . elgg_echo('feria:inscripcion:ok2') . "<a href='$url_feria'>" . $feria->name . "</a>", $institucion[0]->owner_guid, 0, $reply);
            elgg_enviar_correo($institucion[0]->email, $subject, elgg_echo('feria:inscripcion:ok1') . "$investigacion->name" . elgg_echo('feria:inscripcion:ok2') . "<a href='$url_feria'>" . $feria->name . "</a>" . "con número de inscripción " . $numero_inscripcion);
        }
    } else {
        add_entity_relationship($guid_investigacion, 'inscrita_en_' . $id_feria . '_con', $inscripcion_a_feria->guid);
        $investigacion->addRelationship($id_feria, "acreditada_en");
        $investigacion->addRelationship($id_feria, "participa_en_departamental");

        $subject = "Investigación acreditada en Feria Departamental";
        $mensaje = " Cordial Saludo, Nos permitimos informarle que la inscripción No." . $numero_inscripcion . " de la Investigación <b>" . $investigacion->name .
                "</b> perteneciente al grupo " . $grupo[0]->name . " ha sido exitosa y ahora es participante de la feria <a href='$url_feria'>" . $feria->name . "</a>.";
        if (!empty($user->email)) {
            $result = messages_send($subject, $mensaje, $grupo[0]->owner_guid, 0, $reply);
            elgg_enviar_correo($user->email, $subject, $mensaje);
        }
        $mensaje1 = " Cordial Saludo, Nos permitimos informarle que la inscripción No." . $numero_inscripcion . " de la Investigación <b>" . $investigacion->name .
                "</b> perteneciente al grupo " . $grupo[0]->name . " de su institución " . $institucion[0]->name .
                ",ha sido exitosa y ahora es participante de la feria <a href='$url_feria'>" . $feria->name . "</a>.";
        if (!empty($institucion[0]->email)) {
            $result1 = messages_send($subject, $mensaje1, $institucion[0]->owner_guid, 0, $reply);
            elgg_enviar_correo($institucion[0]->email, $subject, $mensaje1);
        }
    }

    system_message(elgg_echo('feria:action:inscripcion:ok'), 'success');
    forward("investigaciones/ver/{$guid_investigacion}/grupo/{$guid_grupo}");
} else {
    register_error(elgg_echo('feria:action:inscripcion:fail'), 'error');
    forward(REFERER);
}

