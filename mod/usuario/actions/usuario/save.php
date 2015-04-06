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
$grupo_etnico=get_input('grupo_etnico');
$evento = get_input('event');
$id_conv = get_input('id_conv');

$usuario = new ElggUsuario();
$usuario->name = $nombre;
$usuario->apellidos = $apellidos;
$usuario->sexo = $sexo;
$usuario->tipo_documento = $tipo_documento;
$usuario->numero_documento = $numero_documento;
$usuario->fecha_nacimiento = $fecha_nacimiento;
$usuario->grupo_etnico= $grupo_etnico;
$usuario->email = $email;
$usuario->username = $username;

$usuario->password = md5($password);
$usuario->access_id = ACCESS_PUBLIC;
$usuario->owner_guid = 0; // Users aren't owned by anyone, even if they are admin created.
$usuario->container_guid = 0; // Users aren't contained by anyone, even if they are admin created.
$usuario->language = "es";

//busca por un metadato si existe un usuario con el mismo numero de cedula
$existe_usuario = elgg_existe_usuario($numero_documento, $tipo_usuario);


//Validaciones 
//$error = elgg_validar_campos($username, $password, $password2, $institucion, $email);
$username_repetido = elgg_existe_username($username);
$email_repetido = elgg_existe_email($email);



$access_status = access_get_show_hidden_status();
access_show_hidden_entities(true);


if ($existe_usuario) {
    system_messages(elgg_echo('usuario:repetido'), 'error');
    
} elseif ($email_repetido) {
    system_messages(elgg_echo('email:repetido'), 'error');
//} elseif (!empty($error)) {
//    system_messages($error, 'error');
} elseif ($username_repetido) {
    system_messages(elgg_echo('username:repetido'), 'error');
} else {

    access_show_hidden_entities($access_status);

    $guid = "";

    if ($tipo_usuario == 'Estudiante') {
        $guid = $usuario->save_estudiante();
        $usuario->addRelationship($institucion, "estudia_en");
        elgg_asignar_rol_new_usuario($guid, "Estudiante");
    } else {
        $guid = $usuario->save_maestro();
        $usuario->addRelationship($institucion, "trabaja_en");
        elgg_asignar_rol_new_usuario($guid, "Profesor");
    }
    $result1 = create_metadata($guid, 'validated', false, '', 0, ACCESS_PUBLIC, false);
    $code = uservalidationbyemail_generate_code($guid, $usuario->email);
    $site = elgg_get_site_url();
    $site_entity = elgg_get_site_entity();
    elgg_crear_admin($guid);
    $mensaje = "Hola {$usuario->name}&nbsp;{$usuario->apellidos}, <br> <p> Usted se ha registrado correctamente en nuestra <strong>Comunidad Enjambre</strong>.</p>"
            . "<p>Para completar su registro y habilitar su cuenta, hacer clic en el siguiente enlace. </p><br>"
            . "<a href='{$site}uservalidationbyemail/confirm?u={$usuario->guid}&c=$code'> Activar Cuenta </a>";
    elgg_enviar_correo($usuario->email, "Activar Cuenta de Usuario", $mensaje);
    
    
    $usuario->addFriend(33);
    $soporte=new ElggUsuario(33);
    $soporte->addFriend($usuario->guid);
    
    
    
    if ($guid) {

        if (!empty($evento)) {

            $new_user = get_entity($guid);
            if ($new_user && $admin && elgg_is_admin_logged_in()) {
                $new_user->makeAdmin();
            }
            elgg_clear_sticky_form('useradd');

            $new_user->admin_created = TRUE;
            // @todo ugh, saving a guid as metadata!
            $new_user->created_by_guid = elgg_get_logged_in_user_guid();

            $subject = elgg_echo('useradd:subject');
            $body = elgg_echo('useradd:body', array(
                $name,
                elgg_get_site_entity()->name,
                elgg_get_site_entity()->url,
                $username,
                $password,
            ));

//            notify_user($new_user->guid, elgg_get_site_entity()->guid, $subject, $body);

            system_message(elgg_echo("adduser:ok", array(elgg_get_site_entity()->name)));


            if ($usuario->addRelationship($evento, "asistió_al_evento")) {
                system_messages(elgg_echo('registro:asistente:correcto'), 'success');
                forward('/eventos/listar_asistentes/' . $evento . '/' . $id_conv);
            } else {
                system_messages(elgg_echo('registro:asistente:invalido'), 'error');
            }
        } else {
            system_messages(elgg_echo('registro:correcto'), 'success');
            forward(elgg_get_site_url());
        }
    } else {
        forward(REFERER);
        register_error(elgg_echo("registerbad"));
        system_messages(elgg_echo('registro:invalido'), 'error');
    }
}
