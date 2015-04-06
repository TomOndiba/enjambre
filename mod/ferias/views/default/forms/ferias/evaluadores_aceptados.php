<?php

$feria = $vars['guid_feria'];
$obj_feria=new ElggFeria($feria);
$tipo_feria=$obj_feria->tipo_feria;

if($tipo_feria=='Municipal'){
    $rel="mun";
}else if($tipo_feria=='Departamental'){
    $rel="dptal";
}
$investigacion = $vars['investigacion'];
$tipo_eval=$vars['tipo_eval'];

$value = '';
$evaluadores = elgg_get_evaluadores_aceptados_feria(get_entity($feria));
if($tipo_eval=="inicial"){
    $evaluador_investigacion = elgg_get_relationship_inversa(get_entity($investigacion), 'es_evaluador_inicial_'.$rel.'_de')[0];
}else if($tipo_eval=="en sitio"){
    $evaluador_investigacion = elgg_get_relationship_inversa(get_entity($investigacion), 'es_evaluador_en_sitio_'.$rel.'_de')[0];
}

$eval = get_entity($evaluador_investigacion->guid);
$info = "";

if ($eval) {
    $info = "<a><img src='{$eval->getIconURL()}' width='32'></img>{$evaluador_investigacion->name} {$evaluador_investigacion->apellidos}</a>";
} else {
    $info = "No tiene evaluador $tipo_eval asignado";
}
$info_evaluador = "<div><span>Evaluador $tipo_eval asignado</span><br>$info<hr></div><br>";
$contenido = $info_evaluador;

foreach ($evaluadores as $evaluador) {
    if ($evaluador->guid != $eval->guid) {
        $ev = get_entity($evaluador->guid);
        $contenido.="<input type='radio' name='evaluador' value='{$evaluador->guid}'><a><img src='{$ev->getIconURL()}' width='32'></img>{$evaluador->name} {$evaluador->apellidos}</a><br>";
    }
}
$feria_input = elgg_view('input/hidden', array('name' => 'guid_feria', 'value' => $feria));
$tipo_input = elgg_view('input/hidden', array('name' => 'tipo_eval', 'value' => $tipo_eval));
$investigacion_input = elgg_view('input/hidden', array('name' => 'investigacion', "id" => 'investigacion', 'value' => $investigacion));
$button = elgg_view('input/submit', array('id' => 'aceptar', 'value' => elgg_echo('Aceptar')));
echo <<<HTML
<div>
$feria_input $tipo_input  $investigacion_input
</div>
<div>
$contenido
   </div>        
<div class="elgg-foot" align="center">
    $button
</div>
HTML;
?>


