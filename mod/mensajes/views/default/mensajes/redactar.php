<?php
$site_url = elgg_get_site_url();
$url_enviados = $site_url . "mensajes/enviados";
$url_recibidos = $site_url . "mensajes/";
?>

<div class="contenedor-mensajes">
    <div class="titulo-mensajes">
        <div class="titulo">
            <h2>Mensajes Enviados</h2>
        </div>
    </div>
    <div class="opciones-inbox">
        <a href='<?php echo $url_enviados; ?>'>Mensajes Enviados</a>
        <a href='<?php echo $url_recibidos; ?>'> Mensajes recibidos</a>
    </div>
    <div class="redactar-mensaje">
        <?php echo elgg_view_form('mensajes/redactar_mensaje', null, array()); ?>
    </div>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

