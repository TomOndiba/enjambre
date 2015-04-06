<?php
$mensaje = $vars['mensaje'];
$guid = elgg_get_logged_in_user_entity()->guid;
$site_url = elgg_get_site_url();
$url_recibidos = $site_url . "mensajes/";
$url_redactar = $site_url . "mensajes/redactar";
$url_enviados = $site_url . "mensajes/enviados";
$time = $mensaje->time_created;
if ($mensaje->readYet == 0) {
    $options = array(
        'guid' => $mensaje->guid,
        'metadata_name' => "readYet",
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
    create_metadata($mensaje->guid, "readYet", 1, 'integer', $mensaje->guid, ACCESS_PUBLIC);
}
$fecha = date("Y-m-d H:i:s", $time);
$emisor = get_entity($mensaje->fromId);
$url = elgg_get_site_url() . "profile/{$emisor->username}";
$url_emisor = "<a href='{$url}'>{$emisor->name} {$emisor->apellidos}</a>";
elgg_update_user_mensajes($guid);
?>
<div class="contenedor-mensajes">
    <div class="titulo-mensajes">
        <div class="titulo">
            <h2>Mensaje:</h2>
        </div>
        <div class="opciones-titulo">
            <div onclick="eliminarMensajes()" data-tooltip="Eliminar Mensaje" id="eliminar"></div>
        </div>
    </div>
    <div class="opciones-inbox">
        <a href='<?php echo $url_recibidos; ?>'>Mensajes Recibidos</a>
        <a href='<?php echo $url_enviados; ?>'>Mensajes Enviados</a>
        <a href='<?php echo $url_redactar; ?>'> Redactar Mensaje</a>
    </div>
    <div class="lista-mensajes">
        <div class="titulo-de-mensaje"><?php echo $mensaje->title ?></div>
        <div class="info-de-mensaje"><span>Enviado por:</span><?php echo " " . $url_emisor ?>,<?php echo " " . $fecha ?></div>
        <div class="contenido-de-mensaje"><?php echo $mensaje->description; ?></div>
    </div>
</div>

