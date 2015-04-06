<?php

/**
 * Action que recibe los datos de un usuario y luego procede a registrarlo
 */
elgg_make_sticky_form('register');

$nombre = get_input('nombres');
$apellidos = get_input('apellidos');
$sexo = get_input('sexo');
$tipo_documento = get_input('tipo_documento');
$numero_documento = get_input('numero_documento');
$fecha_nacimiento = get_input('fecha_nacimiento');
$institucion = get_input('institucion');
$email = get_input('email');
$username = get_input('nombre_usuario');
$password = get_input('password', null, false);
$password2 = get_input('password2', null, false);
$tipo_usuario = get_input('tipo_usuario');
$curso = get_input('curso');
$grupo_etnico = get_input('grupo_etnico');

error_log("curso" . $curso);

$usuario = new ElggUsuario();
$usuario->name = $nombre;
$usuario->apellidos = $apellidos;
$usuario->sexo = $sexo;
$usuario->tipo_documento = $tipo_documento;
$usuario->numero_documento = $numero_documento;
$usuario->fecha_nacimiento = $fecha_nacimiento;
$usuario->curso = $curso;
$usuario->grupo_etnico = $grupo_etnico;
$usuario->email = $email;
$usuario->username = $username;
$usuario->password =  md5($password);
$usuario->access_id = ACCESS_PUBLIC;
$usuario->owner_guid = 0; // Users aren't owned by anyone, even if they are admin created.
$usuario->container_guid = 0; // Users aren't contained by anyone, even if they are admin created.
$usuario->language = "es";

//busca por un metadato si existe un usuario con el mismo numero de cedula
$existe_usuario = elgg_existe_usuario($numero_documento, "estudiante");
//Validaciones 
//$error = elgg_validar_campos($username, $password, $password2, $institucion, $email);
$username_repetido = elgg_existe_username($username);
$email_repetido = elgg_existe_email($email);
$access_status = access_get_show_hidden_status();
access_show_hidden_entities(true);
if ($existe_usuario) {
    system_messages(elgg_echo('usuario:repetido'), 'error');
    forward(REFERER);
} elseif ($email_repetido && $email != "") {
    system_messages(elgg_echo('email:repetido'), 'error');
    forward(REFERER);
} elseif ($username_repetido) {
    system_messages(elgg_echo('username:repetido'), 'error');
    forward(REFERER);
} else {
    $guid = $usuario->save_estudiante();
    $usuario->addRelationship($institucion, "estudia_en");
    elgg_asignar_rol_new_usuario($guid, "Estudiante");
    set_user_notification_setting($usuario->getGUID(), 'email', true);
    elgg_crear_admin($guid);
    $site = elgg_get_site_url();
    $site_entity = elgg_get_site_entity();

    $usuario->addFriend(33);
    $soporte = new ElggUsuario(33);
    $soporte->addFriend($usuario->guid);

    if ($guid) {
        system_messages("El estudiante $usuario->name $usuario->name fue registrado correctamente en el sistema", 'success');
    } else {
        register_error(elgg_echo("registerbad"));
        system_messages(elgg_echo('registro:invalido'), 'error');
    }
}
forward(REFERER);










