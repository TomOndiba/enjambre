<?php
/**
 * Formulario que permite editar los datos de una feria
 */
elgg_load_js('validaCampos1');

$guid = $vars['id'];
$nombre = $vars['nombre'];
$descripcion = $vars['descripcion'];
$objetivos = $vars['objetivos'];
$correos_contacto = $vars['correos_contacto'];
$fecha_inicio_feria = $vars['fecha_inicio_feria'];
$fecha_fin_feria = $vars['fecha_fin_feria'];
$fecha_inicio_inscripciones = $vars['fecha_inicio_inscripciones'];
$fecha_fin_inscripciones = $vars['fecha_fin_inscripciones'];
$valor_inscripcion = $vars['valor_inscripcion'];
$fecha_montaje_puestos = $vars['fecha_montaje_puestos'];
$hora_montaje_puestos = explode(":", $vars['hora_montaje_puestos']);
$fecha_desmontaje_puestos = $vars['fecha_desmontaje_puestos'];
$hora_desmontaje_puestos = explode(":", $vars['hora_desmontaje_puestos']);
$formas_participacion = $vars['formas_participacion'];
if(!empty($formas_participacion)){
    $formas_participacion_text = "<br>Actualmente se aceptan: ".$formas_participacion;
}
$max_inscritos = $vars['max_inscritos'];
$usuario = get_entity(elgg_get_logged_in_user_guid());
$premios=$vars['premios_distinciones'];
$actividades=$vars['actividades'];
$requisitos_participacion=$vars['requisitos_participacion'];
$publico_invitado=$vars['publico_invitado'];
$costos_organizadores=$vars['costos_organizadores'];
$parametros_puestos=$vars['parametros_puestos'];
$herramientas_presentaciones=$vars['herramientas_presentaciones'];
$proceso_valoracion=$vars['proceso_valoracion'];
$agenda_feria=$vars['agenda_feria'];
$reglamento_feria=$vars['reglamento_feria'];

$url=elgg_get_site_url();

if(!empty($premios)){
    $premios_input="<a href='".$url."file/download/$premios'>Descargar</a>";
    $premios_input.=  elgg_view('input/file', array('name'=>'premios'));
    $premios_input.= elgg_view('input/hidden', array('name' => 'premios_file_guid', 'value' => $premios));
}else{
    $premios_input=  elgg_view('input/file', array('name'=>'premios'));
}
if(!empty($actividades)){
    $actividades_input="<a href='".$url."file/download/$actividades'>Descargar</a>";
    $actividades_input.=  elgg_view('input/file', array('name'=>'actividades'));
    $actividades_input.= elgg_view('input/hidden', array('name' => 'actividades_file_guid', 'value' => $actividades));
}else{
    $actividades_input=  elgg_view('input/file', array('name'=>'actividades'));
}
if(!empty($requisitos_participacion)){
    $requisitos_input="<a href='".$url."file/download/$requisitos_participacion'>Descargar</a>";
    $requisitos_input.=  elgg_view('input/file', array('name'=>'requisitos'));
    $requisitos_input.= elgg_view('input/hidden', array('name' => 'requisitos_file_guid', 'value' => $requisitos_participacion));
}else{
    $requisitos_input=  elgg_view('input/file', array('name'=>'requisitos'));
}
if(!empty($publico_invitado)){
    $publico_invitado_input="<a href='".$url."file/download/$publico_invitado'>Descargar</a>";
    $publico_invitado_input.=  elgg_view('input/file', array('name'=>'publico_invitado'));
    $publico_invitado_input.= elgg_view('input/hidden', array('name' => 'publico_file_guid', 'value' => $publico_invitado));
}else{
    $publico_invitado_input=  elgg_view('input/file', array('name'=>'publico_invitado'));
}
if(!empty($costos_organizadores)){
    $costos_organizadores_input="<a href='".$url."file/download/$costos_organizadores'>Descargar</a>";
    $costos_organizadores_input.=  elgg_view('input/file', array('name'=>'costos_organizadores'));
    $costos_organizadores_input.= elgg_view('input/hidden', array('name' => 'costos_file_guid', 'value' => $costos_organizadores));
}else{
    $costos_organizadores_input=  elgg_view('input/file', array('name'=>'costos_organizadores'));  
}
if(!empty($parametros_puestos)){
    $parametros_puesto_input="<a href='".$url."file/download/$parametros_puestos'>Descargar</a>";
    $parametros_puesto_input.=  elgg_view('input/file', array('name'=>'parametros_puesto'));
    $parametros_puesto_input.= elgg_view('input/hidden', array('name' => 'parametros_file_guid', 'value' => $parametros_puestos));
}else{
    $parametros_puesto_input=  elgg_view('input/file', array('name'=>'parametros_puesto'));  
}
if(!empty($herramientas_presentaciones)){
    $herramientas_input="<a href='".$url."file/download/$herramientas_presentaciones'>Descargar</a>";
    $herramientas_input.=  elgg_view('input/file', array('name'=>'herramientas'));
    $herramientas_input.= elgg_view('input/hidden', array('name' => 'herramientas_file_guid', 'value' => $herramientas_presentaciones));
}else{
    $herramientas_input=  elgg_view('input/file', array('name'=>'herramientas'));   
}
if(!empty($proceso_valoracion)){
    $proceso_valoracion_input="<a href='".$url."file/download/$proceso_valoracion'>Descargar</a>";
    $proceso_valoracion_input.=  elgg_view('input/file', array('name'=>'proceso_valoracion'));
    $proceso_valoracion_input.= elgg_view('input/hidden', array('name' => 'proceso_file_guid', 'value' => $proceso_valoracion));
}else{
    $proceso_valoracion_input=  elgg_view('input/file', array('name'=>'proceso_valoracion'));
}
if(!empty($agenda_feria)){
    $agenda_feria_input="<a href='".$url."file/download/$agenda_feria'>Descargar</a>";
    $agenda_feria_input.=  elgg_view('input/file', array('name'=>'agenda_feria'));
    $agenda_feria_input.= elgg_view('input/hidden', array('name' => 'agenda_file_guid', 'value' => $agenda_feria));
}else{
    $agenda_feria_input=  elgg_view('input/file', array('name'=>'agenda_feria'));
}
if(!empty($reglamento_feria)){
    $reglamento_feria_input="<a href='".$url."file/download/$reglamento_feria'>Descargar</a>";
    $reglamento_feria_input.=  elgg_view('input/file', array('name'=>'reglamento_feria'));
    $reglamento_feria_input.= elgg_view('input/hidden', array('name' => 'reglamento_file_guid', 'value' => $reglamento_feria));
}else{
    $reglamento_feria_input=  elgg_view('input/file', array('name'=>'reglamento_feria'));  
}

$guid_input = elgg_view('input/hidden', array('name' => 'id','value'=>$guid));
$nombre_input = elgg_view('input/text', array('name' => 'nombre','required'=>'true', 'value'=>$nombre));
$descripcion_input=elgg_view('input/longtext', array('name' => 'descripcion', 'value'=>$descripcion));
$objetivos_input = elgg_view('input/longtext', array('name' => 'objetivos', 'value'=>$objetivos));
$contacto_input = elgg_view('input/longtext', array('name' => 'contacto', 'value'=>$correos_contacto));
$fecha_inicio_feria_input = elgg_view('input/date', array('id'=>'fecha_inicio_feria', 'value'=>$fecha_inicio_feria, 'name' => 'fecha_inicio_feria','required'=>'true',));
$fecha_fin_feria_input = elgg_view('input/date', array('id'=>'fecha_fin_feria', 'value'=>$fecha_fin_feria, 'name' => 'fecha_fin_feria','required'=>'true',));
$fecha_inicio_inscripciones_input = elgg_view('input/date', array('id'=>'fecha_inicio_inscripciones', 'value'=>$fecha_inicio_inscripciones, 'name' => 'fecha_inicio_inscripciones','required'=>'true',));
$fecha_fin_inscripciones_input = elgg_view('input/date', array('id'=>'fecha_fin_inscripciones', 'value'=>$fecha_fin_inscripciones, 'name' => 'fecha_fin_inscripciones','required'=>'true',));
$valor_inscripciones_input = elgg_view('input/number', array('name' => 'valor_inscripcion','required'=>'true', 'value'=>$valor_inscripcion));
$fecha_montaje_input = elgg_view('input/date', array('id'=>'fecha_montaje', 'name' => 'fecha_montaje','required'=>'true', 'value'=>$fecha_montaje_puestos,));
$hora_montaje_input = elgg_view('input/dropdown', array('name'=>'hora_montaje', 'value'=>$hora_montaje_puestos[0], 'required'=>'true','options' => array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', 
                                                '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', 
                                                '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23'),));
$minutos_montaje_input = elgg_view('input/dropdown', array('name'=>'minutos_montaje', 'value'=>$hora_montaje_puestos[1], 'required'=>'true','options' => array('00' => '00', '15' => '15', '30' => '30', '45' => '45'),));
$fecha_desmontaje_input = elgg_view('input/date', array('id'=>'fecha_desmontaje', 'value'=>$fecha_desmontaje_puestos, 'name' => 'fecha_desmontaje','required'=>'true',));
$hora_desmontaje_input = elgg_view('input/dropdown', array('name'=>'hora_desmontaje', 'value'=>$hora_desmontaje_puestos[0], 'required'=>'true','options' => array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', 
                                                '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', 
                                                '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23'),));
$minutos_desmontaje_input = elgg_view('input/dropdown', array('name'=>'minutos_desmontaje', 'value'=>$hora_desmontaje_puestos[1], 'required'=>'true','options' => array('00' => '00', '15' => '15', '30' => '30', '45' => '45'),));
$tipo_input = elgg_view('input/radio', array('options' => array('Institucional'=>'Institucional',
                                                                'Municipal'=>'Municipal',
                                                                'Departamental' => 'Departamental',
                                                                'Nacional'=>'Nacional'),  
                                              'name' => 'tipo', 'required'=>'true', 'value'=>$tipo_feria));
$formas_participacion_input= elgg_view('input/checkboxes', array('id'=>'formas_participacion', 'value'=>$formas_participacion,'name'=>'formas_participacion','options' => array('Expositor' => 'Expositor', 'Ponente'=> 'Ponente', 'Cartelista' => 'Cartelista'),));
$max_inscritos_input = elgg_view('input/number', array('name' => 'max_inscritos', 'value'=>$max_inscritos));


$button = elgg_view('input/submit', array('id'=>'guardar', 'value' => elgg_echo('Aceptar')));

?>
<div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2> Editar Feria</h2>
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
<div><br>$instructions</div>
<div>$guid_input
    <label>Nombre:</label><br />$nombre_input<br><br>
</div>
<div>
    <label>Descripción:</label><br />$descripcion_input<br><br>
</div>
<div>
    <label>Objetivos:</label><br />$objetivos_input<br><br>
</div>
<div>
    <label>Correos de contacto con Comité Organizador:</label><br />$contacto_input<br><br>
</div>
<div>
    <label>Fecha de inicio de la feria:</label><br />$fecha_inicio_feria_input<br><br>
</div>
<div>
    <label>Fecha de fin de la feria:</label><br />$fecha_fin_feria_input<br><br>
</div>
<div>
    <label>Fecha de inicio de inscripciones:</label><br />$fecha_inicio_inscripciones_input<br><br>
</div>
<div>
    <label>Fecha de fin de inscripciones:</label><br />$fecha_fin_inscripciones_input<br><br>
</div> 
<div>
    <label>Valor de la inscripción:</label><br />$valor_inscripciones_input<br><br>
</div>
<div>
    <label>Fecha y hora de montaje de los puestos y muestras:</label><br />$fecha_montaje_input $hora_montaje_input: $minutos_montaje_input<br><br>
</div>
<div>
    <label>Fecha y hora de desmontaje de los puestos y muestras:</label><br />$fecha_desmontaje_input $hora_desmontaje_input:$minutos_desmontaje_input <br><br>
</div>
<div>
    <label>Formas de participación:</label><br>$formas_participacion_text<br>$formas_participacion_input<br><br>
</div>
<div>
    <label>Capacidad máxima de inscritos:</label><br />$max_inscritos_input<br><br>
</div>
<div>
    <label>Premios o distinciones con que se galardonan a los expositores:</label><br />$premios_input
</div>
<div>
    <label>Actividades principales y complementarias:</label><br />$actividades_input
</div>
<div>
    <label>Requisitos para participar:</label><br />$requisitos_input
</div> 
<div>
    <label>Público invitado:</label><br>$publico_invitado_input
</div>
<div>
    <label>Costos que asumen los organizadores:</label><br />$costos_organizadores_input
</div>
<div>
    <label>Parámetros del puesto:</label><br />$parametros_puesto_input
</div>
<div>
    <label>Herramientas para las presentaciones:</label><br />$herramientas_input
</div>
<div>
    <label>Proceso de valoración:</label><br />$proceso_valoracion_input
</div> 
<div>
    <label>Agenda de la feria:</label><br />$agenda_feria_input
</div>
<div>
    <label>Reglamento de la feria:</label><br />$reglamento_feria_input
</div>
<div class="elgg-foot" align="center">
$button
</div>
HTML;
?>
</div>