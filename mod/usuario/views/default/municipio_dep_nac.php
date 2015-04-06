<?php



$select_departamento = elgg_view('input/dropdown', array(
    'name' => 'dpto_nacimiento',
    'class'=>'select',
    'options_values' => array('Amazonas' => elgg_echo('Amazonas'),
        'Antioquia' => elgg_echo('Antioquia'),
        'Arauca' => elgg_echo('Arauca'),
        'Atlantico' => elgg_echo('Atlantico'),
        'Caldas' => elgg_echo('Caldas'),
        'Caquetá' => elgg_echo('Caquetá'),
        'Casanare' => elgg_echo('Casanare'),
        'Cauca' => elgg_echo('Cauca'),
        'Cesar' => elgg_echo('Cesar'),
        'Chocó' => elgg_echo('Chocó'),
        'Córdoba' => elgg_echo('Córdoba'),
        'Cundinamarca'=>'Cundinamarca',
        'Guainía' => elgg_echo('Guainía'),
        'Guaviare' => elgg_echo('Guaviare'),
        'La Guajira' => elgg_echo('La Guajira'),
        'Magdalena' => elgg_echo('Magdalena'),
        'Meta' => elgg_echo('Meta'),
        'Norte de Santander' => elgg_echo('Norte de Santander'),
        'Putumayo' => elgg_echo('Putumayo'),
        'Quindío' => elgg_echo('Quindío'),
        'Risaralda' => elgg_echo('Risaralda'),
        'San Andrés y Providencia' => elgg_echo('San Andrés y Providencia'),
        'Santander' => elgg_echo('Santander'),
        'Tolima' => elgg_echo('Tolima'),
        'Valle del Cauca' => elgg_echo('Valle del Cauca'),
        'Vaupés' => elgg_echo('Vaupés'),
        'Vichada' => elgg_echo('Vichada'), 
    ),
    'id' => 'dpto',
    'value'=>$vars['departamento_n']
        ));
$select_municipio = elgg_view('input/dropdown', array(
    'name' => 'municipio_nacimiento',
    'class'=>'select',
    'id' => 'munic'
        ));


$departamento_s=  elgg_view('input/hidden', array('id'=>'departamento_usuario','value'=>$vars['departamento_n']));
$municipio_s=  elgg_view('input/hidden', array('id'=>'municipio_usuario','value'=>$vars['municipio_n']));

echo <<<HTML
<div class="div-datos2">
    <label>Dpto. de Nacimiento:</label>$select_departamento 
</div>       
<div class="div-datos2">
    <label>Municipio de Nacimiento:</label>$select_municipio 
</div>   
        $departamento_s
        $municipio_s
            
HTML;
	
