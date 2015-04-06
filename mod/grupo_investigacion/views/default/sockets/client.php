<?php

$mc = new Memcached();
$mc->addServer(elgg_get_url_server(), 11211);
$count_mensajes = elgg_get_mensajes_usuario();
$count_notificaciones = elgg_get_total_notificaciones();
$notificaciones = array("mensajes" => $count_mensajes, "notificaciones" => $count_notificaciones);
for ($i = 1000000; $i < 1100000; $i++) {
    if ($mc->add($i, $notificaciones, time()-10)) {
        error_log("creado:$i");
    }
}
//for ($i = 1000000; $i < 1100000; $i++) {
//    if ($mc->delete($i)) {
//        error_log("borrado:$i");
//    }
//}