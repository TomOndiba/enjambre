<?php

$guid_evento = get_input('guid_evento');
$evento = new ElggEvento($guid_evento);

$user = elgg_get_logged_in_user_entity();

$txt_ins = "";
$sw = $evento->verificarInscripcionUsuario($user->guid);
if (!$sw) {
    $url_ins = elgg_get_site_url() . "action/eventos/inscribirse?id_evento={$guid_evento}";
    $url_inscribirse = elgg_add_action_tokens_to_url($url_ins);
    $txt_ins = "<a class='link-button' href='{$url_inscribirse}'>Inscribirse</a>
         &nbsp;&nbsp;&nbsp;&nbsp";
} else {
    $url_ins = elgg_get_site_url() . "action/eventos/desinscribirse?id_evento={$guid_evento}";
    $url_desinscribirse = elgg_add_action_tokens_to_url($url_ins);
    $txt_ins = "<a class='link-button' href='{$url_desinscribirse}'>Cancelar Inscripcion</a>
         &nbsp;&nbsp;&nbsp;&nbsp";
}

echo <<<HTML


<h2 class="title-legend">{$evento->nombre_evento}</h2>

<b>Tipo evento:</b><br>{$evento->tipo_evento}<br><br>
<b>Fecha inicio:</b><br>{$evento->fecha_inicio}<br><br>
<b>Fecha terminación:</b><br>{$evento->fecha_terminacion}<br><br>
<b>Fecha límite de confirmación:</b><br>{$evento->fecha_limite_confirmacion}<br><br>
<b>Lugar:</b><br>{$evento->lugar}<br><br>
<b>Objetivo:</b><br>{$evento->objetivo}<br><br>
<b>Dirigido a:</b><br>{$evento->dirigido_a}<br><br>
<b>Requisitos:</b><br>{$evento->requisitos_evento}<br><br>
<div class='contenedor-button'>$txt_ins</div>
 

HTML;



