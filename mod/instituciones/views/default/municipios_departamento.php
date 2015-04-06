<?php

$select_departamento = elgg_view('input/dropdown', array(
    'name' => 'departamento',
    'class'=>'select',
    'options_values' => array('Amazonas' => elgg_echo('Amazonas'),
        'Antioquia' => elgg_echo('Antioquia'),
        'Arauca' => elgg_echo('Arauca'),
        'Atlantico' => elgg_echo('Atlantico'),
        'Bogotá D. C.'=>elgg_echo('Bogotá D. C.'),
        'Bolívar'=>elgg_echo('Bolívar'),
        'Boyacá'=>elgg_echo('Boyacá'),
        'Caldas' => elgg_echo('Caldas'),
        'Caquetá' => elgg_echo('Caquetá'),
        'Casanare' => elgg_echo('Casanare'),
        'Cauca' => elgg_echo('Cauca'),
        'Cesar' => elgg_echo('Cesar'),
        'Chocó' => elgg_echo('Chocó'),
        'Córdoba' => elgg_echo('Córdoba'),
        'Cundinamarca'=>elgg_echo('Cundinamarca'),
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
    'id' => 'departamentos',
    'value'=>$vars['departamento_ins']
        ));
$select_municipio = elgg_view('input/dropdown', array(
    'name' => 'municipio',
    'class'=>'select',
    'id' => 'municipios'
        ));



$departamento_s=  elgg_view('input/hidden', array('id'=>'departamento','value'=>$vars['departamento_ins']));
$municipio_s=  elgg_view('input/hidden', array('id'=>'municipio','value'=>$vars['municipio_ins']));
$institucion= elgg_view('input/hidden', array('id'=>'institucion','value'=>$vars['institucion']));



echo <<<HTML
<div class="div-datos2">
    <label>Departamento: </label>$select_departamento 
</div>       
<div class="div-datos2">
    <label>Municipio: </label>$select_municipio 
</div>  

        $departamento_s
        $municipio_s
        $institucion
       
            
HTML;
	
