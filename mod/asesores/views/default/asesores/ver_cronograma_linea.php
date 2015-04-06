<?php

elgg_load_library('asesores');
elgg_load_js('pagination/investigaciones');
elgg_load_js("reveal2");
elgg_load_css('reveal');
/**
 * Vista donde se administran las líneas temáticas del asesor
 * @author DIEGOX_CORTEX
 */
$linea = elgg_get_entities_from_relationship(array(
            'relationship' => 'administrador_red',
            'relationship_guid' => $user->guid,
        ))[0];

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;

$id_conv = $vars["id_red"];
$url = elgg_get_site_url();
$volver = "<div class='titulo-coordinacion'><h2>Cronograma de Red: $linea->name</h2></div>";
$volver.= "<a href='{$url}asesores/misLineas'>Volver a Investigaciones de Linea</a>";
if (!$ajax) {
    echo $volver . '<br>';
    echo "{$reg}<hr/>{$txt}<hr/>";
    echo "<div class='contenedor-button'>"
    . '<a class="link-button" href="#" data-reveal-id="myModal" onclick=\'getCrearNuevaAsesoria("' . $linea->guid . '")  \'>Registrar Actividad</a> '
    . "</div>";
    echo "<div id='paginable'>";
    echo elgg_get_asesorias_red($limit, 0, $linea->guid);
    echo "</div>";
} else {
    $lista = elgg_get_asesorias_red($limit, $offset, $linea->guid);
    echo $lista;
}
?>


<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="form-asesor-evaluador" id="pop-up-form">
        <div class='titulo-pop-up'>
            <h2>Registrar Nueva Actividad</h2>
        </div>
        <div class="content-pop-up" id='content-pop-up'>

        </div>
    </div>
</div>
<script>
    function getCrearNuevaAsesoria(guid_red){
        var red = guid_red;
        elgg.get('ajax/view/asesorias/crear_asesoria_red', {
            timeout: 30000,
            data: {
                red: red
            },
            success: function (result, success, xhr) {
                $('#content-pop-up').html(result);
            },
        });
    }
</script>
