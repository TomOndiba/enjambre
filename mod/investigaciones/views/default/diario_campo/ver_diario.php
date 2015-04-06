<?php
$guid = get_input('diario');
$diario = get_entity($guid);
$cuaderno = get_entity($diario->owner_guid);
$etapa = get_input('etapa');
$offset = get_input('offset');
$tipo = get_input("tipo");
$limit = 1;
$site_url= elgg_get_site_url();

elgg_load_js("reveal2");
elgg_load_css('reveal');






$content = "<div id='notas-ajax'>";
echo $lista;
$notas = elgg_get_notas($diario->guid, $offset, $limit, $etapa, $tipo);
$imp = "";
foreach ($notas as $nota) {
    $creacion = elgg_get_friendly_time($nota->time_created);
    $owner = elgg_get_usuario_byId($nota->container_guid);
    $imp.= "<div class='nota-diario'>"
            . "<div><a href='{$site_url}profile/{$owner->username}'><img src='{$owner->getIconURL()}'/></a></div>"
            . "<div><a href='{$site_url}profile/{$owner->username}'>{$owner->name} {$owner->apellidos}</a><br>{$nota->description}. "
            . "<br><b>{$creacion}</b></div></div>";
    $comentarios = elgg_view('comentarios/comentarios', array('guid' => $nota->guid));
}

echo elgg_view('input/hidden', array('value' => $etapa, 'id' => "etapa"));
echo elgg_view('input/hidden', array('value' => $guid, 'id' => "falta"));

$boton = '<div class="contenedor-button"> <a class="link-button" href="#" data-reveal-id="myModal" onclick=\' getAgregarNota("' . $diario->guid . '","' . $etapa . '","' . $tipo . '")  \'>Agregar Nota</a></div>';
$content.= $imp . $comentarios. "</div>";
echo $content;
?>
<script>
    function getAgregarNota(guid, etapa, tipo) {
        var diario = guid;
        var etapa = etapa;
        var tipo = tipo;

        elgg.get('ajax/view/nota/agregar_nota', {
            timeout: 30000,
            data: {
                diario: diario,
                etapa: etapa,
                tipo: tipo,
            },
            success: function(result, success, xhr) {
                $('.pop-up-diario').html(result);
            },
        });
    }
</script>

