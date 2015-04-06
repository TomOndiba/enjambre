<?php
$guid = $vars['id_conv'];
$guid_inv = $vars['id_inv'];
$guid_linea = $vars['id_linea'];
$convocatoria = new ElggConvocatoria($guid);
$user_guid = elgg_get_logged_in_user_guid();
$url_aceptar = elgg_get_site_url() . 'action/investigaciones/aceptar_invitacion?id_conv=' . $guid.'&id_inv='.$guid_inv.'&id_linea='.$guid_linea;
$url_aceptar_inv = elgg_add_action_tokens_to_url($url_aceptar);
$url_rechazar = elgg_get_site_url() . 'action/investigaciones/rechazar_invitacion?id_conv=' . $guid.'&id_inv='.$guid_inv.'&id_linea='.$guid_linea;
$url_rechazar_inv = elgg_add_action_tokens_to_url($url_rechazar);
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
            <span><?php echo $convocatoria->objeto ?></span>
        </div>
        <div>
            <a class="link-button" href="<?php echo elgg_get_site_url() . "convocatorias/ver_eventos/calendario/" . $convocatoria->guid; ?>">Ver Eventos</a>
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
    
    <?php
    $investigacion=new ElggInvestigacion($guid_inv);
    if($investigacion->elegible=="invitada"){
    ?>
    
    <div class='botones-inscripcion'>
        <div class='inscribir-evaluador-convocatoria'  onclick="window.location = '<?php echo $url_aceptar_inv; ?>'" >
            <div class='icon-aceptar-invitacion-convocatoria'></div>
        </div>
        <div class='inscribir-asesor-convocatoria'  onclick="window.location = '<?php echo $url_rechazar_inv; ?>'">
            <div class='icon-rechazar-invitacion-convocatoria'></div>
        </div>
    </div>
    
    <?php
    }
    ?>
</div>