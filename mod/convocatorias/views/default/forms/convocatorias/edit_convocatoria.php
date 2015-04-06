<?php
/**
 * Formulario que permite editar los datos de una convocatoria
 */
elgg_load_js('validaCampos');
$id = elgg_view('input/hidden', array('name' => 'id', 'value' => $vars['ide'],));
$tipo_input = elgg_view('input/hidden', array('name' => 'proyectos', 'value' => $vars['tipo']));
$nombre_input = elgg_view('input/text', array('name' => 'nombre', 'required' => 'true', 'value' => $vars['nombre'],));
$departamento_input = elgg_view('input/dropdown', array(
    'name' => 'departamento', 'value' => $vars['dpto'],
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
        ));
$convenio_input = elgg_view('input/text', array('name' => 'convenio', 'required' => 'true', 'value' => $vars['convenio'],));
$presupuesto_input = elgg_view('input/number', array('name' => 'presupuesto', 'required' => 'true', 'value' => $vars['presupuesto'],));
$fecha = $vars['f_apertura'];
$fecha_apertura_input = elgg_view('input/date', array('name'=>'fecha_apertura','id' => 'fecha_apertura', 'value' => $vars['f_apertura']));
$fecha_cierre_input = elgg_view('input/date', array('id' => 'fecha_cierre', 'name' => 'fecha_cierre', 'required' => 'true', 'value' => $vars['f_cierre'],));

$hora = split(":", $vars['h_cierre']);
$hora_input = elgg_view('input/dropdown', array('value' => $hora[0], 'name' => 'hora', 'required' => 'true', 'options' => array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05',
        '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14',
        '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23'),));
$minutos_input = elgg_view('input/dropdown', array('value' => $hora[1], 'name' => 'minutos', 'required' => 'true', 'options' => array('00' => '00', '15' => '15', '30' => '30', '45' => '45'),));

$fecha_resultados_input = elgg_view('input/date', array('id' => 'fecha_resultados', 'name' => 'fecha_resultados', 'required' => 'true', 'value' => $vars['f_pubresultados'],));
$proceso_pedagogico_input = elgg_view('input/longtext', array('name' => 'proceso_pedagogico', 'value' => $vars['proceso_pedagogico'],));
$requisitos = elgg_view('input/longtext', array('name' => 'requisitos', 'value' => $vars['requisitos'],));
$no_aplica = elgg_view('input/longtext', array('name' => 'no_aplica', 'value' => $vars['no_aplica'],));
$objetivos_input = elgg_view('input/longtext', array('name' => 'objetivos_inv', 'value' => $vars['objetivos'],));
$publico_input = elgg_view('input/longtext', array('name' => 'publico', 'value' => $vars['publico'],));
$criterios_input = elgg_view('input/longtext', array('name' => 'criterios', 'value' => $vars['criterios_revision_seleccion'],));

$button = elgg_view('input/submit', array('id' => 'guardar', 'value' => elgg_echo('Aceptar')));
?>
<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2> Editar Convocatoria</h2>
    </div>


    <?php
    echo <<<HTML
<div id="dialog" title="Fecha inválida">
  <p>
<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div><br>$instructions</div>
<div>
    <label>Tipo de convocatoria:</label>  {$vars['tipo']}<br>$tipo_input
</div>
<div>
    <label>Nombre:</label><br />$nombre_input
</div>
<div>
    <label>Departamento:</label><br />$departamento_input
</div>
<div>
    <label>Convenio:</label><br />$convenio_input
</div>
<div>
    <label>Objetivos de la Convocatoria: </label> $objetivos_input
</div>
     
 <div>
    <label>Dirigido a:</label>$publico_input
</div>      
<div>
    <label>Proceso Pedagogico de la Convocatoria:</label>$proceso_pedagogico_input
</div>      
        
<div>
    <label>Fecha de apertura de la convocatoria:</label>$fecha_apertura_input
</div>
<div>
   <label>Fecha de cierre de la convocatoria:</label>$fecha_cierre_input
</div>
<div>
    <label>Hora de cierre de la convocatoria (HH:mm, formato de 24 horas):</label>$hora_input:$minutos_input
</div>
<div>
   <label>Fecha de publicación de resultados:</label>$fecha_resultados_input
</div>
<div>
  <label>Presupuesto:</label>$presupuesto_input
</div>
<div>
  <label>Requisitos para participar en la Convocatoria:</label>$requisitos
</div>

<div>
  <label>No Aplica para Selección: </label>$no_aplica
</div>
        
<div>
   <br /> <label>Criterios de Evaluación y Selección:</label>$criterios_input
</div>
<div class="elgg-foot" align="center">
$button
$id
</div>
HTML;
    ?>

</div>