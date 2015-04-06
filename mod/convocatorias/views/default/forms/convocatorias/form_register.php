<?php
/**
 * Formulario que permite registrar una convocatoria
 */
elgg_load_js('validaCampos');
elgg_load_js('timer');

$instructions = elgg_echo('convocatorias:admin:instruct');

$tipo_input = elgg_view('input/radio', array('options' => array('Proyectos abiertos' => 'Proyectos abiertos', 
                                                                'Proyectos preestructurados' => 'Proyectos preestructurados', 
                                                                'Proyectos abiertos y preestructurados'=>'Proyectos abiertos y preestructurados'), 
                                              'name' => 'proyectos',));
$nombre_input = elgg_view('input/text', array('name' => 'nombre','required'=>'true',));
$departamento_input = elgg_view('input/dropdown', array(
    'name' => 'departamento', 'value'=>'Norte de Santander',
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
        ));//elgg_view('input/text', array('name' => 'departamento','required'=>'true',));
$convenio_input = elgg_view('input/text', array('name' => 'convenio','required'=>'true',));
$fecha_apertura_input = elgg_view('input/date', array('id'=>'fecha_apertura', 'name' => 'fecha_apertura','required'=>'true',));
$fecha_cierre_input = elgg_view('input/date', array('id'=>'fecha_cierre', 'name' => 'fecha_cierre','required'=>'true',));

$hora_input = elgg_view('input/dropdown', array('name'=>'hora', 'required'=>'true','options' => array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', 
                                                '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', 
                                                '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23'),));
$minutos_input = elgg_view('input/dropdown', array('name'=>'minutos', 'required'=>'true','options' => array('00' => '00', '15' => '15', '30' => '30', '45' => '45'),));
$fecha_resultados_input = elgg_view('input/date', array('id'=>'fecha_resultados', 'name' => 'fecha_resultados','required'=>'true',));
$proceso_pedagogico_input = elgg_view('input/longtext', array('name' => 'proceso_pedagogico'));
$especial_input = elgg_view('input/checkbox', array('name'=>'especial', 'required'=>'true', 'value'=>'true'));
$requisitos = elgg_view('input/longtext', array('name' => 'requisitos'));
$objetivos_input = elgg_view('input/longtext', array('name' => 'objetivos_inv'));
$publico_input = elgg_view('input/longtext', array('name' => 'publico'));
$requisitos = elgg_view('input/longtext', array('name' => 'requisitos'));
$criterios_input = elgg_view('input/longtext', array('name' => 'criterios'));
$presupuesto_input = elgg_view('input/number', array('name' => 'presupuesto'));
$no_aplica=elgg_view('input/longtext', array('name'=>'no_aplica'));

$button = elgg_view('input/submit', array('id'=>'aceptar', 'value' => elgg_echo('Aceptar')));
?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Registrar Nueva Convocatoria</h2>
        </div>

    
<?php

echo <<<HTML
<div id="dialog" title="Fecha inválida">
  <p>
<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div><br>$instructions</div><br>
<div>
    <label>Tipo de convocatoria:</label><br>$tipo_input
</div>
<div>
   <br />  <label>Nombre:</label>$nombre_input
</div>
<div>
    <br /><label>Departamento:</label>$departamento_input
</div>
<div>
<br /><p>$especial_input Convocatoria especial</p>
</div>
<div>
    <br /><label>Convenio:</label>$convenio_input
</div>
        
<div>
    <br /><label>Objetivos de la Convocatoria: </label> $objetivos_input
</div>
     
 <div>
    <br /><label>Dirigido a:</label>$publico_input
</div>       
     
   <div>
    <br /><label>Proceso Pedagogico de la Convocatoria:</label>$proceso_pedagogico_input
</div>      
        
<div>
   <br /> <label>Fecha de apertura de la convocatoria:</label>$fecha_apertura_input
</div>
<div>
   <br /> <label>Fecha de cierre de la convocatoria:</label>$fecha_cierre_input
</div>
<div>
   <br /> <label>Hora de cierre de la convocatoria (HH:mm, formato de 24 horas):</label>$hora_input:$minutos_input
</div>
<div>
   <br /> <label>Fecha de publicación de resultados:</label>$fecha_resultados_input
</div>
<div>
  <br />  <label>Presupuesto:</label>$presupuesto_input
</div>

<div>
   <br /> <label>Requisitos para participar en la Convocatoria:</label>$requisitos
</div>

<div>
   <br /> <label>No Aplica para Selección: </label>$no_aplica
</div>
        
<div>
   <br /> <label>Criterios de Evaluación y Selección:</label>$criterios_input
</div>
<div class="elgg-foot" align="center">
$button
</div>
HTML;
?>

</div