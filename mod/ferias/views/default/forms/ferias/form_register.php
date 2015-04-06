<style>
    .thumb{ 
        display: inline-block;
        margin:5px;
        background-color: ghostwhite;
    }

    .thumb>img{
        height: 105px;
        border:none;
    }
</style>
<?php
/**
 * Formulario que permite registrar una feria
 */
elgg_load_js('validaCampos1');
elgg_load_js("mun-dpto");
elgg_load_js("tipo-feria");


$instructions = elgg_echo('ferias:admin:instruct');

$nombre_input = elgg_view('input/text', array('name' => 'nombre','required'=>'true',));
$descripcion_input=elgg_view('input/longtext', array('name' => 'descripcion'));
$objetivos_input = elgg_view('input/longtext', array('name' => 'objetivos'));
$contacto_input = elgg_view('input/longtext', array('name' => 'contacto'));
$fecha_inicio_feria_input = elgg_view('input/date', array('id'=>'fecha_inicio_feria', 'name' => 'fecha_inicio_feria','required'=>'true',));
$fecha_fin_feria_input = elgg_view('input/date', array('id'=>'fecha_fin_feria', 'name' => 'fecha_fin_feria','required'=>'true',));
$fecha_inicio_inscripciones_input = elgg_view('input/date', array('id'=>'fecha_inicio_inscripciones', 'name' => 'fecha_inicio_inscripciones','required'=>'true',));
$fecha_fin_inscripciones_input = elgg_view('input/date', array('id'=>'fecha_fin_inscripciones', 'name' => 'fecha_fin_inscripciones','required'=>'true',));
$valor_inscripciones_input = elgg_view('input/number', array('name' => 'valor_inscripcion','required'=>'true',));
$fecha_montaje_input = elgg_view('input/date', array('id'=>'fecha_montaje', 'name' => 'fecha_montaje','required'=>'true',));
$hora_montaje_input = elgg_view('input/dropdown', array('name'=>'hora_montaje', 'required'=>'true','options' => array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', 
                                                '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', 
                                                '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23'),));
$minutos_montaje_input = elgg_view('input/dropdown', array('name'=>'minutos_montaje', 'required'=>'true','options' => array('00' => '00', '15' => '15', '30' => '30', '45' => '45'),));
$fecha_desmontaje_input = elgg_view('input/date', array('id'=>'fecha_desmontaje', 'name' => 'fecha_desmontaje','required'=>'true',));
$hora_desmontaje_input = elgg_view('input/dropdown', array('name'=>'hora_desmontaje', 'required'=>'true','options' => array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', 
                                                '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', 
                                                '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23'),));
$minutos_desmontaje_input = elgg_view('input/dropdown', array('name'=>'minutos_desmontaje', 'required'=>'true','options' => array('00' => '00', '15' => '15', '30' => '30', '45' => '45'),));
$tipo_input = elgg_view('input/radio', array('options' => array('Institucional' => 'Institucional',
                                                                'Municipal'=>'Municipal',
                                                                'Departamental' => 'Departamental',
                                                                'Nacional' => 'Nacional'), 
                                              'name' => 'tipo', 'id' => 'tipo', 'required'=>'true'));
$premios_input=  elgg_view('input/file', array('name'=>'premios'));
$actividades_input=  elgg_view('input/file', array('name'=>'actividades'));
$formas_participacion_input= elgg_view('input/checkboxes', array('id'=>'formas_participacion','name'=>'formas_participacion','options' => array('Expositor' => 'Expositor', 'Ponente'=> 'Ponente', 'Cartelista' => 'Cartelista'),));
$requisitos_input=  elgg_view('input/file', array('name'=>'requisitos'));
$max_inscritos_input = elgg_view('input/number', array('name' => 'max_inscritos'));
$publico_invitado_input=  elgg_view('input/file', array('name'=>'publico_invitado'));
$costos_organizadores_input=  elgg_view('input/file', array('name'=>'costos_organizadores'));
$parametros_puesto_input=  elgg_view('input/file', array('name'=>'parametros_puesto'));
$herramientas_input=  elgg_view('input/file', array('name'=>'herramientas'));
$proceso_valoracion_input=  elgg_view('input/file', array('name'=>'proceso_valoracion'));
$agenda_feria_input=  elgg_view('input/file', array('name'=>'agenda_feria'));
$reglamento_feria_input=  elgg_view('input/file', array('name'=>'reglamento_feria'));

$button = elgg_view('input/submit', array('id'=>'aceptar', 'value' => elgg_echo('Aceptar')));

?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Registrar Nueva Feria</h2>
        </div>

    <div>
        <label>Seleccione una imagen para la Feria</label><br>
        <label class="lbl-button">
            <span>Seleccione aquí la imagen</span><?php echo elgg_view("input/file", array('name' => 'icon', 'id'=>'files'));?>
        </label>
    </div>
<?php

echo <<<HTML
<div id="dialog" title="Fecha inválida">
  <p>
<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div><br>$instructions</div><br>
<div>
    <label>Nombre:</label>$nombre_input
</div>
<div>
    <label>Descripción:</label>$descripcion_input
</div>
<div>
    <label>Objetivos:</label>$objetivos_input
</div>
<div>
    <label>Correos de contacto con Comité Organizador:</label>$contacto_input
</div>
<div>
    <label>Fecha de inicio de la feria:</label>$fecha_inicio_feria_input
</div>
<div>
    <label>Fecha de fin de la feria:</label>$fecha_fin_feria_input
</div>
<div>
    <label>Fecha de inicio de inscripciones:</label>$fecha_inicio_inscripciones_input
</div>
<div>
    <label>Fecha de fin de inscripciones:</label>$fecha_fin_inscripciones_input
</div> 
<div>
    <label>Valor de la inscripción:</label>$valor_inscripciones_input
</div>
<div>
    <label>Fecha y hora de montaje de los puestos y muestras:</label>$fecha_montaje_input $hora_montaje_input:$minutos_montaje_input
</div>
<div>
    <label>Fecha y hora de desmontaje de los puestos y muestras:</label>$fecha_desmontaje_input $hora_desmontaje_input:$minutos_desmontaje_input 
</div>
<div>
   <br> <label>Tipo de feria:</label>$tipo_input
</div>
<div id="ajax-tipo-feria">
</div>
<div>
    <label>Formas de participación:</label>$formas_participacion_input
</div>
<div>
    <label>Capacidad máxima de inscritos:</label>$max_inscritos_input
</div>
<div>
    <label>Premios o distinciones con que se galardonan a los expositores:</label>$premios_input
</div>
<div>
    <label>Actividades principales y complementarias:</label>$actividades_input
</div>
<div>
    <label>Requisitos para participar:</label>$requisitos_input
</div> 
<div>
    <label>Público invitado:</label>$publico_invitado_input
</div>
<div>
    <label>Costos que asumen los organizadores:</label>$costos_organizadores_input
</div>
<div>
    <label>Parámetros del puesto:</label>$parametros_puesto_input
</div>
<div>
    <label>Herramientas para las presentaciones:</label>$herramientas_input
</div>
<div>
    <label>Proceso de valoración:</label>$proceso_valoracion_input
</div> 
<div>
    <label>Agenda de la feria:</label>$agenda_feria_input
</div>
<div>
    <label>Reglamento de la feria:</label>$reglamento_feria_input
</div>
<div class="elgg-foot" align="center">
$button
</div>
HTML;
?>

</div>