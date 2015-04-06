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
$email = get_input('email');
$username = get_input('nombre_usuario');
$password = get_input('password', null, false);
$password2 = get_input('password2', null, false);

$usuario = new ElggUsuario();
$usuario->name = $nombre;
$usuario->apellidos = $apellidos;
$usuario->sexo = $sexo;
$usuario->tipo_documento = $tipo_documento;
$usuario->numero_documento = $numero_documento;
$usuario->fecha_nacimiento = $fecha_nacimiento;
$usuario->email = $email;
$usuario->username = $username;
$usuario->password = md5($password);
$usuario->access_id = ACCESS_PUBLIC;
$usuario->owner_guid = 0; // Users aren't owned by anyone, even if they are admin created.
$usuario->container_guid = 0; // Users aren't contained by anyone, even if they are admin created.
$usuario->language = "es";

//busca por un metadato si existe un usuario con el mismo numero de cedula
$existe_usuario = elgg_existe_usuario($numero_documento, 0);
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
    elgg_asignar_rol_new_usuario($guid, "Asesor");
    if (add_entity_relationship($guid, "asesor_convocatoria", get_input('convocatoria'))) {
        system_message("El usuario fue registrad correctamente como asesor.");
    }else{
        register_error("Error al registrar el asesor.");
    }
}
forward(REFERER);










