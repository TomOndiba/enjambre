<?php

elgg_load_js("mun-dpto");

$conv_id = $vars['conv_id'];
$conv=  get_entity($conv_id);


$instructions = elgg_echo('help:admin:instruct');
$fecha_input = elgg_view('input/date', array(
    'name' => 'fecha_visita',
        ));
$fecha_text = elgg_echo('visitas:fecha:text');
$dpto_municipio = elgg_view("municipios_departamento");

//$instituciones = elgg_get_lista_instituciones();
$institucion_input=elgg_view('input/dropdown', array(
    'name'=>'institucion', 
    'class'=>'select', 
    'options_values'=>array($vars['guid_inst']=>$vars['nombre_inst'])));


$instituciones_text = elgg_echo('visitas:instituciones:text');

$asunto_input = elgg_view('input/text', array(
    'name' => 'asunto',
        ));
$asunto_text=elgg_echo('visitas:asunto:text');

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


$conv_input = elgg_view('input/hidden',array('name'=>'conv_id','value'=>$conv_id));

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('Guardar'),
        ));


?>
<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Convocatoria: <?php echo $conv->name;?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu", array('guid'=>$conv_id));?>
    </div>
    <div class="contenido-coordinacion">
        <h2>
            Registrar Visita:
        </h2>

<?php

echo <<<HTML
<div>
<label>$fecha_text</label><br />
$fecha_input
</div>

<div>
$dpto_municipio
</div>
        
<div id="instituciones">
<label>$instituciones_text</label>
$institucion_input
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
$conv_input
$button
</div>
HTML;
?>