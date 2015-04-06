<?php

$guid_evento = get_input('guid_evento');
$evento = elgg_get_evento($guid_evento);

//url para eliminar el archivo
$url = elgg_get_site_url() . "action/eventos/eliminar_evento?id_evento=" . $guid_evento;
$url_el = elgg_add_action_tokens_to_url($url);

if ($evento->owner_guid == elgg_get_logged_in_user_guid()) {
    $editar = '<a class="row" data-tooltip="Editar Evento" onclick=\'editarEvento(' . $guid_evento . ')  \'><div class="icon-editar-2 row"></div></a>';
    $eliminar = "<a class='row' data-tooltip='Eliminar Evento' onclick=\"confirmar('{$url_el}')\"><div class='icon-eliminar-2 row'></div></a>";
}
echo elgg_view('vistas/js');
echo <<<HTML
<div id="ver-evento">
<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Evento?</div>
<h2 class="title-legend">{$evento->nombre_evento}</h2>
<div class='iconos-eventos' style='display:inline-block; margin-top: 20px;'>$editar $eliminar</div>
<label>Lugar:</label><br>{$evento->lugar}<br><br>
<label>Fecha de Inicio:</label><br>{$evento->fecha_inicio}<br><br>
<label>Hora Inicio:</label><br>{$evento->hora}<br><br>
<label>Fecha de Fin:</label><br>{$evento->fecha_terminacion}<br><br>
<label>Hora Fin:</label><br>{$evento->horaFin}<br><br>
</div>
HTML;
?>
<script>
    function editarEvento(guid){
        
       elgg.get('ajax/view/grupo_investigacion/calendario/crear_evento', {
            timeout: 30000,
            data: {
                evento: guid,
            },
            success: function(result, success, xhr) {
                $('#myModalEv').html(result);
            },
        });
    }
</script>