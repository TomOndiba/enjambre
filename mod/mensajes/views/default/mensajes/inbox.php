<?php
$guid = elgg_get_logged_in_user_entity()->guid;
$site_url = elgg_get_site_url();
$url_enviados = $site_url . "mensajes/enviados";
$url_redactar = $site_url . "mensajes/redactar";
$mensajes = elgg_get_entities_from_metadata(array(
    'type' => 'object',
    'subtype' => 'messages',
    'metadata_name_value_pair' => array(
        array('name' => 'toId', 'value' => $guid),
        array('name' => 'hiddenTo', 'value' => '0'),
    ),
    'limit' => 10,
    'offset' => 0
        ));

$count_mensajes = elgg_get_entities_from_metadata(array(
    'type' => 'object',
    'subtype' => 'messages',
    'metadata_name_value_pair' => array(
        array('name' => 'toId', 'value' => $guid),
        array('name' => 'hiddenTo', 'value' => '0'),
    ),
    'count' => true,
        ));
?>
<div class="contenedor-mensajes">
    <div class="titulo-mensajes">
        <div class="titulo">
            <h2>Bandeja de Entrada</h2>
        </div>
        <div class="opciones-titulo">
            <div data-tooltip="Ver la Anterior página de mensajes" onclick="cargarAnterior()" id="anterior"></div>
            <div data-tooltip="Ver Siguiente página de mensajes" onclick="cargarSiguiente()" id="siguiente"></div>
            <div data-tooltip="Eliminar Mensajes Seleccionados" onclick="eliminarMensajes()" id="eliminar"></div>
        </div>
    </div>
    <div class="opciones-inbox">
        <a href='<?php echo $url_enviados; ?>'>Mensajes Enviados</a>
        <a href='<?php echo $url_redactar; ?>'> Redactar Mensaje</a>
    </div>
    <div class="lista-mensajes">
        <?php echo elgg_view_form('mensajes/lista', null, array('mensajes' => $mensajes)); ?>
    </div>
</div>

<script>
    var total =<?php echo $count_mensajes ?>;
    var numeroPaginas = Math.ceil(total / 10);
    var paginaActual = 0;
    var existeSigPag = true;
    deshabilitarSiguiente();
    deshabilitarAnterior();

    function cargarSiguiente() {
        paginaActual = paginaActual + 1;
        deshabilitarSiguiente();
        deshabilitarAnterior();
        cargarPaginaMensajes();
    }

    function cargarAnterior() {
        paginaActual = paginaActual + -1;
        deshabilitarSiguiente();
        deshabilitarAnterior();
        cargarPaginaMensajes();
    }

    function deshabilitarSiguiente() {
        if (numeroPaginas == paginaActual + 1) {
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
        elgg.get('ajax/view/mensajes/pagina_mensajes', {
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
