<?php
$guid = elgg_get_logged_in_user_entity()->guid;
$site_url=  elgg_get_site_url();
$url_recibidos=$site_url."mensajes/";
$url_redactar=$site_url."mensajes/redactar";
$mensajes = elgg_get_entities_from_metadata(array(
    'type' => 'object',
    'subtype' => 'messages',
    'metadata_name_value_pair' => array(
        array('name' => 'fromId', 'value' => $guid),
        array('name' => 'hiddenFrom', 'value' => '0'),
    ),
    'limit' => 10,
    'offset' => 0
        ));

$count_mensajes = elgg_get_entities_from_metadata(array(
    'type' => 'object',
    'subtype' => 'messages',
    'metadata_name_value_pair' => array(
        array('name' => 'fromId', 'value' => $guid),
        array('name' => 'hiddenFrom', '0'),
    ),
    'count' => true,
        ));
?>
<div class="contenedor-mensajes">
    <div class="titulo-mensajes">
        <div class="titulo">
            <h2>Mensajes Enviados</h2>
        </div>
        <div class="opciones-titulo">
            <div onclick="cargarAnterior()" id="anterior"></div>
            <div onclick="cargarSiguiente()" id="siguiente"></div>
            <div onclick="eliminarMensajes()" id="eliminar"></div>
        </div>
    </div>
    <div class="opciones-inbox">
        <a href='<?php echo $url_recibidos;?>'>Mensajes Recibidos</a>
        <a href='<?php echo $url_redactar;?>'> Redactar Mensaje</a>
    </div>
    <div class="lista-mensajes">
        <?php echo elgg_view_form('mensajes/lista_enviados', null, array('mensajes' => $mensajes)); ?>
    </div>
</div>
<script>
    var total =<?php echo $count_mensajes ?>;
    var numeroPaginas = Math.ceil(total / 10);
    var paginaActual = 0;
    deshabilitarSiguiente();
    deshabilitarAnterior();

    function cargarSiguiente() {
        paginaActual = paginaActual + 1;
        deshabilitarSiguiente();
        deshabilitarAnterior();
        cargarPaginaMensajes();
    }

    function cargarAnterior() {
        paginaActual = paginaActual  -1;
        deshabilitarSiguiente();
        deshabilitarAnterior();
        cargarPaginaMensajes();
    }


    function deshabilitarSiguiente() {
        if (numeroPaginas == paginaActual +1 || numeroPaginas==0) {
            $("#siguiente").hide();
        } else {
            $("#siguiente").show();
        }
    }
    function deshabilitarAnterior() {
        if (0 == paginaActual) {
            $("#anterior").hide();
        } else {
            $("#anterior").show();
        }
    }

    function eliminarMensajes() {
        $('#boton-eliminar-mensajes').click();
    }

    function cargarPaginaMensajes() {
        elgg.get('ajax/view/mensajes/pagina_mensajes_enviados', {
            timeout: 30000,
            data: {
                pagina: paginaActual,
            },
            success: function(result, success, xhr) {
                $('.lista-mensajes').html(result);
            },
        });
    }
</script>
