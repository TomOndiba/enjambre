<?php
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js('confirmacion');

$entities = $vars['entities'];
$inv = $vars['container_guid'];
$conv = $vars['guid'];
$cron = "<table class='tabla-coordinador'>";
$cron .="<thead><tr>";
$cron .="<th>Investigación</th>";
$cron .="<th>Tipo</th>";
$cron .="<th>Modalidad</th>";
$cron .="<th>Fecha</th>";
$cron .="<th>Hora</th>";
$cron .="<th>Observaciones Anteriores</th>";
$cron .="<th colspan='4'>Opciones</th>";
$cron .="</tr></thead><tbody>";

foreach ($entities as $entity) {
    $entity_data = array("entity" => $entity, "id_inv" => $inv, "id_conv" => $conv);
    $cron.=elgg_view("asesorias/lista/item", $entity_data);
}

$cron .= "</tbody></table>";

echo $cron;
?>



<div id="myModal3" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="form-asesor-evaluador" id="pop-up-form">
        <div class='titulo-pop-up'>
            <h2><?php echo "Editar Actividad"; ?></h2>
        </div>
        <div class="content-pop-up" id='content-pop-up3'>

        </div>
    </div>
</div>
</div>


<div id="myModal2" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="form-asesor-evaluador" id="pop-up-form">
        <div class='titulo-pop-up'>
            <h2><?php echo "Ver Sala" ?></h2>
        </div>
        <div class="content-pop-up" id='content-pop-up2' style='padding-top: 10px;'>

        </div>
    </div>
</div>

<div id="modalResumen" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="form-asesor-evaluador" id="pop-up-form">
        <div class='titulo-pop-up'>
            <h2>Resumen de Asesoria</h2>
        </div>
        <div class="content-pop-up" id='content-pop-up2' style='padding-top: 10px;'>
            <?php echo elgg_view_form('asesorias/resumen') ?>
        </div>
    </div>
</div>
<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la actividad?</div>
<script>
    function getEditarActividad(guid) {
        var owner = guid;
        elgg.get('ajax/view/asesorias/editar_actividad', {
            timeout: 30000,
            data: {
                owner: owner,
            },
            success: function (result, success, xhr) {
                $('#content-pop-up3').html(result);
            },
        });
    }

    function getAddWebinar(guid, inv, asesoria) {
        var owner = guid;
        var inv = inv;
        var asesoria = asesoria;
        elgg.get('ajax/view/asesorias/agregar_webinar', {
            timeout: 30000,
            data: {
                owner: owner,
                investigacion: inv,
                asesoria: asesoria,
            },
            success: function (result, success, xhr) {
                $('#content-pop-up2').html(result);
            },
        });
    }

    function getViewWebinar(guid) {
        var owner = guid;

        elgg.get('ajax/view/asesorias/ver_webinar', {
            timeout: 30000,
            data: {
                guid: owner,
            },
            success: function (result, success, xhr) {
                $('#content-pop-up2').html(result);
            },
        });
    }


    function loadAsesoria(asesoria, resumen) {
        $("#asesoria").val(asesoria);
        $("#resumen").val(resumen);
    }
</script>
