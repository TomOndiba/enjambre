<?php
/**
 * Formulario de registro de visitas
 */
$instructions = elgg_echo('help:admin:instruct');
elgg_load_js("mun-dpto");

$fecha_input = elgg_view('input/date', array(
    'name' => 'fecha_visita',
        ));
$fecha_text = elgg_echo('visitas:fecha:text');

$dpto_municipio = elgg_view("municipios_departamento");


//$instituciones = elgg_get_lista_instituciones();
$institucion_input = elgg_view('input/dropdown', array(
    'name' => 'institucion',
    //'options_values' => $instituciones,
        ));
$instituciones_text = elgg_echo('visitas:instituciones:text');

$interesado_input = elgg_view('input/radio', array(
    'name' => 'interesado',
    'options' => array(elgg_echo('visitas:si') => 'true', elgg_echo('visitas:no') => 'false')
        ));
$interesado_text= elgg_echo('visitas:interesado:text');

$observaciones_input = elgg_view('input/longtext', array(
    'name' => 'observaciones',
        ));
$observaciones_text=elgg_echo('visitas:observaciones:text');

$opt_tipos = array(elgg_echo('visitas:tipo_comunicacion:presencial') => 'presencial',
    elgg_echo('visitas:tipo_comunicacion:online') => 'online');
$tipo_comunicacion_input = elgg_view('input/dropdown', array(
    'name' => 'tipo_comunicacion',
    'options_values' => $opt_tipos
        ));
$tipo_comunicacion_text = elgg_echo('visita:tipo_comunicacion:text');

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('create'),
        ));

echo <<<HTML
<div>
<label>$fecha_text</label><br />
$fecha_input
</div>
<div>
$dpto_municipio
</div>    
<div id='instituciones'>
<label>$instituciones_text</label>
$institucion_input
</div>
<div>
<label>$interesado_text</label><br />
$interesado_input
</div>
<div>
<label>$observaciones_text</label><br />
$observaciones_input
</div>
 
<div>
<label>$tipo_comunicacion_text</label><br />
$tipo_comunicacion_input
</div>
        
<div class="elgg-foot">
$button
</div>
HTML;
?>



