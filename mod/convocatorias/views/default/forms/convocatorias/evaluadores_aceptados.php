<?php

$convocatoria = $vars['guid_conv'];
$investigacion = $vars['investigacion'];
$value = '';
$evaluadores = elgg_get_evaluadores_aceptados(get_entity($convocatoria));
$evaluador_investigacion = elgg_get_relationship_inversa(get_entity($investigacion), 'es_evaluador_de')[0];
$eval = get_entity($evaluador_investigacion->guid);
$site_url= elgg_get_site_url();
$info = "";
if ($eval) {
    $info = "<a href='{$site_url}profile/{$eval->username}'><img src='{$eval->getIconURL()}' width='32' /><span>{$evaluador_investigacion->name} {$evaluador_investigacion->apellidos}</span></a>";
} else {
    $info = "No tiene evaluador Asignado";
}
$info_evaluador = "<div><div class='subtitulo-form'>Evaluador Asignado</div><div class='info-evaluador-form'>$info</div></div>";
$contenido = $info_evaluador;
$contenido.="<br><div class='subtitulo-form'>Cambiar de Evaluador</div>";
$contenido.="<div class='lista-evaluadores-inscritos'>"
        . "<span>Seleccione el evaluador que se asignara a la investigación.<br><br></span>";
foreach ($evaluadores as $evaluador) {
    if ($evaluador->guid != $eval->guid) {
        $ev = get_entity($evaluador->guid);
        $contenido.="<div class='item-evaluacion search-item' data-name='{$evaluador->name} {$evaluador->apellidos}' ><input type='radio' name='evaluador'  value='{$evaluador->guid}' ><a href='{$site_url}profile/{$ev->username}'><div class='row'><img src='{$ev->getIconURL()}' width='30' /></div><div class='row' style='margin-left:10px;font-weight:700;'><span>{$ev->name} {$ev->apellidos}</span></div></a></div>";
    }
}
$contenido.="</div>";
$convocatoria_input = elgg_view('input/hidden', array('name' => 'guid_conv', 'value' => $convocatoria));
$investigacion_input = elgg_view('input/hidden', array('name' => 'investigacion', "id" => 'investigacion', 'value' => $investigacion));
$button = elgg_view('input/submit', array('id' => 'aceptar', 'value' => elgg_echo('Aceptar')));

echo <<<HTML
<div>
$convocatoria_input  $investigacion_input
</div>
<div>
$contenido
   </div>        
<div class="elgg-foot" align="center">
    $button
</div>
HTML;
?>

<script>
</script>
