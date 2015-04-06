<?php
$guid = get_input('id_conv');
$convocatoria = new ElggConvocatoria($guid);
$user_guid = elgg_get_logged_in_user_guid();
$style_asesor = "";
$style_evaluador = "";
if (elgg_es_asesor($user_guid)) {
    if (!check_entity_relationship(elgg_get_logged_in_user_guid(), 'asesor', $guid)
            && !check_entity_relationship(elgg_get_logged_in_user_guid(), 'inscripcion_asesor', $guid)) {
        $url_asesor = elgg_get_site_url() . 'action/asesores/inscripcion_convocatoria?guid=' . $guid;
        $url_inscripcion_asesor = elgg_add_action_tokens_to_url($url_asesor);
    } else {
        $style_asesor = 'display:none;';
    }
} else {
    $style_asesor = 'display:none;';
}
if (elgg_es_evaluador($user_guid)) {
    if (!elgg_es_evaludor_convocatoria($guid, elgg_get_logged_in_user_guid())) {
        $url_evaluador = elgg_get_site_url() . 'action/evaluadores/inscripcion_evaluador_convocatoria?id_conv=' . $guid;
        $url_inscripcion_evaluador = elgg_add_action_tokens_to_url($url_evaluador);
    } else {
        $style_evaluador = 'display:none;';
    }
} else {
    $style_evaluador = 'display:none;';
}
?>
<div class="informacion-convocatoria">
    <div class="titulo-info-convocatoria">
        <div><h2>Convocatoria</h2></div>
    </div>

    <div class="contenido-info-convocatoria">
        <div class="item-info-convocatoria">
            <h2>Nombre de Convocatoria:</h2>
            <br><span class='nombre-convocatoria'><?php echo $convocatoria->name ?></span>
        </div>
        <div class="item-info-convocatoria">
            <h2>Objetivo:</h2>
            <span><?php echo $convocatoria->objetivos ?></span>
        </div>
        <div>
            <a class="link-button" href="<?php echo elgg_get_site_url()."convocatorias/ver_eventos/calendario/".$convocatoria->guid; ?>">Ver Eventos</a>
        </div>
    </div>
    <div class='fecha-info-convocatoria'>
        <span class='titulo-fecha'>Fecha de Inicio:</span><br>
        <span><?php echo $convocatoria->fecha_apertura; ?></span><br><br>
        <span class='titulo-fecha'>Fecha de Cierre:</span><br>
        <span><?php echo $convocatoria->fecha_cierre; ?></span><br><br>
        <span class='titulo-fecha'>Publicación Resultados:</span><br>
        <span><?php echo $convocatoria->fecha_pub_resultados; ?></span><br>
    </div>
    <div class='botones-inscripcion'>
        <div class='inscribir-evaluador-convocatoria'  onclick="window.location = '<?php echo $url_inscripcion_evaluador; ?>'" >
            <div class='icon-inscripcion-evaluador-convocatoria' style="<?php echo $style_evaluador;?>"></div>
        </div>
        <div class='inscribir-asesor-convocatoria'  onclick="window.location = '<?php echo $url_inscripcion_asesor; ?>'">
            <div class='icon-inscripcion-asesor-convocatoria' style="<?php echo $style_asesor;?>"></div>
        </div>
    </div>
</div>