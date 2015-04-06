<?php

/**
 * Obtiene todas las instituciones registradas
 * 
 * @return array
 */
function elgg_get_institucion() {
    $options = array(
        'type' => 'group',
        'subtype' => 'institucion'
    );

    $retorno = array();
    $instituciones = elgg_get_entities($options);
    foreach ($instituciones as $institucion) {
        $inst = array('guid_inst' => $institucion->guid, 'nombre_inst' => $institucion->name);
        array_push($retorno, $inst);
    }
    return $retorno;
}

/**
 * Verifica si existe un usuario registrado con un numero de documento
 * @param type $numero_documento
 * @param type $user
 * @return boolean
 */
function elgg_existe_usuario($numero_documento, $user) {
    $options = array(
        'type' => 'user',
        'subtype' => $user,
        'metadata_name' => 'numero_documento',
        'metadata_value' => $numero_documento,
    );
    
    $usuario = elgg_get_entities_from_metadata($options);
    
    if ($usuario) {        
        return true;
    }
    return false;
}

/**
 * Verifica si existe un usuario registrado con un numero de documento
 * @param type $numero_documento
 * @param type $user
 * @return boolean
 */
function elgg_existe_documento($numero_documento) {
    $options = array(
        'type' => 'user',
        'metadata_name' => 'numero_documento',
        'metadata_value' => $numero_documento,
    );

    $usuario = elgg_get_entities_from_metadata($options);
    if ($usuario) {
        return true;
    }
    return false;
}

/**
 * Verifica si ya existe un usuario registrado con el username
 * @param type $username
 * @return boolean
 */
function elgg_existe_username($username) {

    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'user',
        'joins' => array("JOIN {$db_prefix}users_entity us on us.guid = e.guid"),
        'wheres' => array("us.username= '$username'"),
    );

    $usuario = elgg_get_entities_from_metadata($options);

    if ($usuario) {
        return true;
    }
    return false;
}

/**
 * Obtiene el usuario por el ID
 * @param type $guid
 * @return  ElggUsuario
 */
function elgg_get_usuario_byId($guid) {

    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'user',
        'joins' => array("JOIN {$db_prefix}users_entity us on us.guid = e.guid"),
        'wheres' => array("us.guid=$guid"),
    );

    $usuario = elgg_get_entities($options);

    return $usuario[0];
}

/**
 * Verifica que no haya registrado un usuario con el mismo email
 * @param type $email
 * @return boolean
 */
function elgg_existe_email($email) {

    $db_prefix = get_config('dbprefix');
    $options = array(
        'type' => 'user',
        'joins' => array("JOIN {$db_prefix}users_entity us on us.guid = e.guid"),
        'wheres' => array("us.email= '$email'"),
    );

    $usuario = elgg_get_entities_from_metadata($options);

    if ($usuario) {
        return true;
    }
    return false;
}

/**
 * Valida campos vacios, campos iguales y tamanio de los campos
 * @param type $username
 * @param type $password
 * @param type $password2
 * @param type $institucion
 * @param type $address
 * @return  String
 */
function elgg_validar_campos($username, $password, $password2, $institucion, $address) {

    $error = "";
    if ($password == "" || $password2 == "") {
        $error = system_messages(elgg_echo('registro:EmptyPassword'), "error");
    }

    if ($institucion == "") {
        $error = system_messages(elgg_echo('registro:EmptyInstitucion'), "error");
    }

    if (strcmp($password, $password2) != 0) {
        $error = system_messages(elgg_echo('registro:PasswordMismatch'), "error");
    }

    if (strlen($password) < 6) {
        $error = system_messages(elgg_echo('registro:passwordMinima'), "error");
    }


    if (strlen($username) < 4) {
        $error = system_messages(elgg_echo('registro:usernameMinima'), "error");
    }


    //Validaciones de email
    if (!is_email_address($address)) {
        $error = system_messages(elgg_echo('registration:notemail'), "error");
    }



    //Validaciones de username


    $blacklist = '/[' .
            '\x{0080}-\x{009f}' . // iso-8859-1 control chars
            '\x{00a0}' . // non-breaking space
            '\x{2000}-\x{200f}' . // various whitespace
            '\x{2028}-\x{202f}' . // breaks and control chars
            '\x{3000}' . // ideographic space
            '\x{e000}-\x{f8ff}' . // private use
            ']/u';

    if (
            preg_match($blacklist, $username)
    ) {
        // @todo error message needs work

        $error = system_message(elgg_echo('registro:usernameInvalido'), "error");
    }

    // Belts and braces
    // @todo Tidy into main unicode
    $blacklist2 = '\'/\\"*& ?#%^(){}[]~?<>;|¬`@-+=';
    $contiene = 0;
    for ($n = 0; $n < strlen($blacklist2); $n++) {
        if (strpos($username, $blacklist2[$n]) !== false) {
            $contiene = 1;
        }
    }

    if ($contiene == 1) {

        $error = system_message(elgg_echo('registro:usernameInvalido'), "error");
    }



    return $error;
}

/**
 * Función que verifica la edad del usuario logueado para cargar el css de acuerdo a la edad
 * @return int 1 si la edad del usuario es menor a 13 o 2 si no lo es
 */
function elgg_age_user($user) {

    $fecha = $user->fecha_nacimiento;
    list($Y, $m, $d) = explode("-", $fecha);
    $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

    if ($edad < 13) {
        return 1;
    }

    return 2;
}

/**
 * Función que devuelve la edad del usuario
 * @return int Edad del usuario
 */
function elgg_get_edad($user) {

    $fecha = $user->fecha_nacimiento;
    list($Y, $m, $d) = explode("-", $fecha);
    $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

    return $edad;
}

/**
 * Función que devuelve la edad del usuario
 * @param sttring con la fecha de nacimiento
 * @return int Edad del usuario
 */
function elgg_get_edad_ByfechaNac($fecha_nacimiento) {
    
    list($Y, $m, $d) = explode("-", $fecha_nacimiento);
    $edad = ( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );

    return $edad;
}

/**
 * Funcion que deveulve los amigos de un usuario
 * @param type $user -> usuario que busca a amigos 
 * @return type array
 */
function elgg_get_amigos($limit, $offset, $user) {

    $query = array('type' => 'user');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'profile/lista/lista_amigos', 'guid' => $user, 'relacion' => 'friend');
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}

function elgg_get_solicitudes_amigos($limit, $offset, $user) {
    $query = array('type' => 'user');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'profile/lista/lista_solicitudes', 'guid' => $user, 'relacion' => 'request_friend', 'inverse'=>'true');
    $content = elgg_list_paginable_entities_relationships($options);
    echo $content;
}
function elgg_get_mensajes_usuario() {
    $user = elgg_get_logged_in_user_guid();
    $mensajes = elgg_get_entities_from_metadata(array(
        'type' => 'object',
        'subtype' => 'messages',
        'metadata_name_value_pair' => array(
            array('name' => 'toId', 'value' => $user),
            array('name' => 'hiddenTo', 'value' => '0'),
            array("name" => 'readYet', 'value' => '0')
        ),
        'count' => true
    ));
    return $mensajes;
}

function elgg_get_total_notificaciones() {
    $user = elgg_get_logged_in_user_guid();
    $notificaciones = elgg_get_entities_from_metadata(array(
        'type' => 'object',
        'subtype' => 'notification',
        'metadata_name_value_pair' => array(
            array('name' => 'to_guid', 'value' => $user),
            array('name' => 'read', 'value' => '0'),
        ),
        'count' => true
    ));
    return $notificaciones;
}

/**
 * Funcion que consulta en la tabla X de la base de datos la informacion 
 * del estudiante segun el documento de identidad
 * @param type $documento -> documento de identidad que desea publicar
 * @param type $tipo_documento ->tipo de documento de identidad que desea publicar
 * @return array -> con la informacion si lo encuentra o null si no encuentra resultados.
 */
function elgg_get_datos_usuario_registro($documento, $tipo_documento) {


    $conexion = mysql_connect("bd.enjambre.co", "root", "elgg2014");
    mysql_select_db("enjambre", $conexion);
    mysql_query("SET NAMES 'utf8'");
    $sql = "SELECT * FROM elgg_estudiante_2 where col22='$documento'&& col23='$tipo_documento'";
    $result = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
    return $result;
}

function elgg_crear_admin($guid) {
    $conexion = mysql_connect("bd.enjambre.co", "root", "elgg2014");
    mysql_select_db("enjambre", $conexion);
    mysql_query("SET NAMES 'utf8'");
    $sql = "UPDATE elgg_users_entity SET admin='yes' WHERE guid=$guid";
    $result = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
}

function elgg_get_new_username($nombres, $apellidos) {
    // Separamos los Nombres
    list($pri_nombre, $seg_nombre) = explode(" ", $nombres);
    // Separamos los Apellidos
    list($pri_apellido, $seg_apellido) = explode(" ", $apellidos);
    // Ticket de Condicion
    $username_encontrado = false;
    $reglas = 0;
    // Mientras Encontremos un UserName
    while (!$username_encontrado) {
        // Comenzamos con las Reglas
        switch ($reglas) {
            // Primer Nombre y Primer Apellido
            case 0:
                $username = cortar_string($pri_nombre . $pri_apellido, 12);
                $reglas++;
                $username_encontrado = !elgg_existe_username($username);
                break;

            // Primer Nombre Segundo Nombre Primer Apellido
            case 1:
                $username = cortar_string($seg_nombre . $pri_apellido, 12);
                $reglas++;
                $username_encontrado = !elgg_existe_username($username);
                break;
            // Primer Nombre Primer Apellido Segundo Apellido
            case 2:
                $username = cortar_string($pri_nombre . $seg_apellido, 12);
                $reglas++;
                $username_encontrado = !elgg_existe_username($username);
                break;
            case 4:
                $username = cortar_string($pri_nombre . $seg_nombre, 12);
                $reglas++;
                $username_encontrado = !elgg_existe_username($username);
                break;
            case 5:
                $username = cortar_string($pri_apellido . $seg_apellido, 12);
                $reglas++;
                $username_encontrado = !elgg_existe_username($username);
                break;
            // Regla de Numeros Al Azar
            default:
                $username = cortar_string($pri_nombre . $pri_apellido, 10) . rand(0, 99);
                $username_encontrado = !elgg_existe_username($username);
            // No Aumentamos la $reglas++ ya que esta es la ultima regla, de nombres con un numero al azar
        }

        if ($username_encontrado) {
            // Encontramos el Nick
            // Insertamos en la BD
            // o lo retornamos en la Funcion
            return normaliza($username);
        }
    }
}

function cortar_string($s, $t) {
    return( substr($s, 0, $t) );
}

function normaliza($cadena) {
    $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
    $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
    $texto = str_replace($no_permitidas, $permitidas, $cadena);
    return $texto;
}

function elgg_enviar_correo($email_usuario, $asunto, $mensaje) {
    $mail = new PHPMailer();
    $mail->From = "comunidadvirtual@enjambre.gov.co";
    $mail->Subject = $asunto;
    $mail->FromName = "Comunidad Enjambre";
    $mail->addAddress($email_usuario);
    $mail->isSMTP();
    $mail->Body = elgg_view("usuario/enviar_mensaje", array("mensaje" => $mensaje));
    $mail->isHTML(true);
    if (!$mail->Send()) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
    } else {
        error_log("Message sent successfully!");
    }
}

function elgg_add_user_notification($guid) {
    
    $mc = new Memcached();
    $mc->addServer(elgg_get_url_server(), 11211);
    $notificaciones = $mc->get($guid);
    if ($notificaciones) {
        $not = $notificaciones['notificaciones'];
        $not++;
        $notificaciones['notificaciones'] = $not;
        $mc->set($guid, $notificaciones);
    } else {
        $mc->add($guid, $notificaciones, 60 * 60);
    }
}

function elgg_add_user_mensajes($guid) {
    $mc = new Memcached();
    $mc->addServer(elgg_get_url_server(), 11211);
    $notificaciones = $mc->get($guid);
    if ($notificaciones) {
        $not = $notificaciones['mensajes'];
        $not++;
        $notificaciones['mensajes'] = $not;
        $mc->set($guid, $notificaciones);
    } else {
        $mc->add($guid, $notificaciones, 60 * 60);
    }
}

function elgg_update_user_mensajes($guid) {
    $mc = new Memcached();
    $mc->addServer(elgg_get_url_server(), 11211);
    $notificaciones = $mc->get($guid);
    if ($notificaciones) {
        $not = elgg_get_mensajes_usuario();
        $notificaciones['mensajes'] = $not;
        $mc->set($guid, $notificaciones);
    } else {
        $mc->add($guid, $notificaciones, 60 * 60);
    }
}

function elgg_get_mensajes_user($guid) {
    $mc = new Memcached();
    $mc->addServer(elgg_get_url_server(), 11211);
    $notificaciones = $mc->get($guid);
    return $notificaciones['mensajes'];
}

function elgg_get_notificaciones_user($guid) {
    $mc = new Memcached();
    $mc->addServer(elgg_get_url_server(), 11211);
    $notificaciones = $mc->get($guid);
    return $notificaciones['notificaciones'];
}

function elgg_reset_notificaciones($guid) {
    $mc = new Memcached();
    $mc->addServer(elgg_get_url_server(), 11211);
    $notificaciones = $mc->get($guid);
    if ($notificaciones) {
        $notificaciones['notificaciones'] = 0;
        $mc->set($guid, $notificaciones);
    } else {
        $mc->add($guid, $notificaciones, 60 * 60);
    }
}

function elgg_reset_mensajes($guid) {
    $mc = new Memcached();
    $mc->addServer(elgg_get_url_server(), 11211);
    $notificaciones = $mc->get($guid);
    if ($notificaciones) {
        $notificaciones['mensajes'] = 0;
        $mc->set($guid, $notificaciones);
    } else {
        $mc->add($guid, $notificaciones, 60 * 60);
    }
}

function microtime_float() {
    list($useg, $seg) = explode(" ", microtime());
    return ((float) $useg + (float) $seg);
}


function elgg_get_url_server(){
    $url= elgg_get_site_url();
    return explode( '/', $url)[2];
}