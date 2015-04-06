<?php

elgg_load_js('mun-dpto');


$visita = new ElggVisitaConvocatoria($vars['id_visita']);
$inst_visitada = elgg_get_institucion_visitada($vars['id_visita']);
$instructions = elgg_echo('help:admin:instruct');
$fecha_input = elgg_view('input/date', array(
    'name' => 'fecha_visita',
    'value' => $visita->fecha_visita,
        ));
$fecha_text = elgg_echo('visitas:fecha:text');

$dpto_text = elgg_echo('visitas:dpto:text');
$dpto_input = elgg_view('input/text', array(
    'name'=>'departamento',  
    'value'=>$visita->departamento,
    'readonly'=>true,
    ));

$municipio_text = elgg_echo('visitas:municipio:text');
$municipio_input = elgg_view('input/text', array(
    'name'=>'municipio',  
    'value'=>$visita->municipio,
    'readonly'=>true,
    ));

/*
$instituciones = elgg_get_lista_instituciones();
$institucion_input = elgg_view('input/dropdown', array(
    'name' => 'institucion',
    'class'=>'select',
    'options_values' => $instituciones,
        ));
 * 
 */
$institucion_input=elgg_view('input/text', array(
    'name'=>'institucion',  
    'value'=>$inst_visitada->name,
    'readonly'=>true,
    ));
    
$instituciones_text = elgg_echo('visitas:instituciones:text');

$asunto_input = elgg_view('input/text', array(
    'name' => 'asunto',
    'value'=>$visita->asunto,
        ));
$asunto_text=elgg_echo('visitas:asunto:text');

$observaciones_input = elgg_view('input/longtext', array(
    'name' => 'observaciones',
    'value'=> $visita->observaciones,
        ));
$observaciones_text=elgg_echo('visitas:observaciones:text');

$opt_tipos = array(elgg_echo('visitas:tipo_comunicacion:presencial') => 'presencial',
    elgg_echo('visitas:tipo_comunicacion:online') => 'online');
$tipo_comunicacion_input = elgg_view('input/dropdown', array(
    'name' => 'tipo_comunicacion',
    'options_values' => $opt_tipos,
    'value' => $visita->tipo_comunicacion
        ));
$tipo_comunicacion_text = elgg_echo('visita:tipo_comunicacion:text');

$id_visita_input = elgg_view('input/hidden',array('name'=>'id_visita','value'=>$vars['id_visita']));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Guardar'),
        ));

echo <<<HTML
<div>
<label>$dpto_text</label><br />
$dpto_input
</div>

<div>
<label>$municipio_text</label><br />
$municipio_input
</div>        
   
<div>
<label>$instituciones_text</label>
$institucion_input
</div>    

<div>
<label>$fecha_text</label><br />
$fecha_input
</div>        
        
<div>
<label>$asunto_text</label><br />
$asunto_input
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
$id_visita_input 
$button
</div>
HTML;
?>
