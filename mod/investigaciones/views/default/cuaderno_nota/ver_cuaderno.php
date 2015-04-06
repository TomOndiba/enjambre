<?php
elgg_load_js("ajax_notas");
elgg_load_js("reveal2");
elgg_load_css('reveal');
$etapa = get_input("etapa");
$ajax = get_input('ajax');
$offset = get_input('offset');
$limit = 1;
$guid = get_input('cuaderno');
$user = elgg_get_logged_in_user_guid();
$cuaderno_nota = elgg_get_cuaderno_nota($user, $guid);
echo elgg_view('input/hidden', array('value' => $etapa, 'id' => "etapa"));
$content = "<div id='notas-ajax'>";
$prox_offset = $offset + $limit;
if ($prox_offset < elgg_get_total_notas($cuaderno_nota->guid, $etapa)) {
    $ver_mas = "<a title='{$prox_offset}' name='{$cuaderno_nota->guid}' id='ver-mas-notas'>Siguiente</a>";
}

$notas = elgg_get_notas($cuaderno_nota->guid, $offset, $limit, $etapa);
$imp = "";

foreach ($notas as $nota) {
    $creacion = elgg_get_friendly_time($nota->time_created);
    $user = elgg_get_usuario_byId($nota->container_guid);

    $imp.= "<div class='nota-cuaderno'>{$nota->description}. "
            . "<br><b>{$creacion}</b></div>";
}
$content.= $imp . "</div>";
echo $content;
?>

<script>

    function getAgregarNota(guid, etapa) {
        var diario = guid;
        var etapa = etapa;
        elgg.get('ajax/view/nota/agregar_nota', {
            timeout: 30000,
            data: {
                diario: diario,
                etapa: etapa,
            },
            success: function(result, success, xhr) {
                $('.pop-up-cuaderno').html(result);
            },
        });
    }
</script>

