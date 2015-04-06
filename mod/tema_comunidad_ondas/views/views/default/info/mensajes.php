<?php

$tiempo_inicio = microtime_float();
$mensajes_usuario = elgg_get_mensajes_user(elgg_get_logged_in_user_guid());
$notificaciones= elgg_get_notificaciones_user(elgg_get_logged_in_user_guid());
$tiempo_fin = microtime_float();
$tiempo = $tiempo_fin - $tiempo_inicio;
//error_log("tiempo: $tiempo");
$tiempo_inicio = microtime_float();
elgg_get_mensajes_usuario();
elgg_get_total_notificaciones();
$tiempo_fin = microtime_float();
$tiempo = $tiempo_fin - $tiempo_inicio;
//error_log("tiempo2: $tiempo");
echo json_encode(array('mensajes'=>$mensajes_usuario,'notificaciones'=>$notificaciones));

