<?php
/**
 * Vista que muestra la información detallada de una feria
 */
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
$hora_montaje_puestos = $vars['hora_montaje_puestos'];
$fecha_desmontaje_puestos = $vars['fecha_desmontaje_puestos'];
$hora_desmontaje_puestos = $vars['hora_desmontaje_puestos'];
$tipo_feria = $vars['tipo_feria'];
$departamento = $vars['departamento'];
$municipios = $vars['municipios'];
$institucion = $vars['institucion'];
$formas_participacion = $vars['formas_participacion'];
$max_inscritos = $vars['max_inscritos'];
$usuario = get_entity(elgg_get_logged_in_user_guid());
$premios = $vars['premios_distinciones'];
$actividades = $vars['actividades'];
$requisitos_participacion = $vars['requisitos_participacion'];
$publico_invitado = $vars['publico_invitado'];
$costos_organizadores = $vars['costos_organizadores'];
$parametros_puestos = $vars['parametros_puestos'];
$herramientas_presentaciones = $vars['herramientas_presentaciones'];
$proceso_valoracion = $vars['proceso_valoracion'];
$agenda_feria = $vars['agenda_feria'];
$reglamento_feria = $vars['reglamento_feria'];



$url = elgg_get_site_url();
$investigaciones_preinscritas = $url . "ferias/investigaciones/$guid";

if (!empty($premios)) {
    $url_premios = "<a href='" . $url . "file/download/$premios'>Descargar</a>";
} else {
    $url_premios = "";
}
if (!empty($actividades)) {
    $url_actividades = "<a href='" . $url . "file/download/$actividades'>Descargar</a>";
} else {
    $url_actividades = "";
}
if (!empty($requisitos_participacion)) {
    $url_requisitos = "<a href='" . $url . "file/download/$requisitos_participacion'>Descargar</a>";
} else {
    $url_requisitos = "";
}
if (!empty($publico_invitado)) {
    $url_publico = "<a href='" . $url . "file/download/$publico_invitado'>Descargar</a>";
} else {
    $url_publico = "";
}
if (!empty($costos_organizadores)) {
    $url_costos = "<a href='" . $url . "file/download/$costos_organizadores'>Descargar</a>";
} else {
    $url_costos = "";
}
if (!empty($parametros_puestos)) {
    $url_parametros = "<a href='" . $url . "file/download/$parametros_puestos'>Descargar</a>";
} else {
    $url_parametros = "";
}
if (!empty($herramientas_presentaciones)) {
    $url_herramientas = "<a href='" . $url . "file/download/$herramientas_presentaciones'>Descargar</a>";
} else {
    $url_herramientas = "";
}
if (!empty($proceso_valoracion)) {
    $url_valoracion = "<a href='" . $url . "file/download/$proceso_valoracion'>Descargar</a>";
} else {
    $url_valoracion = "";
}
if (!empty($agenda_feria)) {
    $url_agenda = "<a href='" . $url . "file/download/$agenda_feria'>Descargar</a>";
} else {
    $url_agenda = "";
}
if (!empty($reglamento_feria)) {
    $url_reglamento = "<a href='" . $url . "file/download/$reglamento_feria'>Descargar</a>";
} else {
    $url_reglamento = "";
}

if ($tipo_feria != 'Nacional'){
        if ($tipo_feria == 'Departamental'){
        $municipios = "<tr><th>Departamento:</th>
            <td>$departamento</td></tr>";
        } else if ($tipo_feria == 'Municipal') {
        $municipios = "<tr><th>Departamento:</th>
            <td>$departamento</td></tr>
        <tr><th>Municipios:</th>
                    <td>$municipios</td></tr>";
        } else if ($tipo_feria == 'Institucional') {
        $municipios = " <tr><th>Departamento:</th>
            <td>$departamento</td></tr>
        <tr><th>Municipio:</th>
                    <td>$municipios</td></tr>"
        . "<tr>"
        . "<th>Institución</th>"
        . "<td>$institucion</td>"
        . "</tr>"
. "</tr>";
}}
?>
<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Feria: <?php echo $nombre; ?></h2>
            </div>
            <div class="menu-coordinacion">
                <?php echo elgg_view("ferias/menu", array('guid' => $guid)); ?>
    </div>
    <div class="contenido-coordinacion">
        <h2>
            Información de la Feria:
        </h2>
        <?php
        echo <<<HTML
<div><hr></div>
<div>
    <table  class='vertical-table'>
        <tr><th>Descripción:</th>
            <td>$descripcion</td></tr>
       <tr><th>Objetivos:</th>
            <td>$objetivos</td></tr>
        <tr><th>Correos de contacto Comité Organizador:</th>
            <td>$correos_contacto</td></tr>
        <tr><th>Fecha de inicio de la feria:</th>
            <td>$fecha_inicio_feria</td></tr>
       <tr><th>Fecha de fin de la feria:</thd>
            <td>$fecha_fin_feria</td></tr> 
        <tr><th>Fecha de inicio de inscripciones:</th>
            <td>$fecha_inicio_inscripciones</td></tr>
       <tr><th>Fecha de fin de inscripciones:</th>
            <td>$fecha_fin_inscripciones</td></tr>
        <tr><th>Valor de la inscripción:</th>
            <td>$valor_inscripcion</td></tr>
        <tr><th>Fecha y hora de montaje de puesto y muestras:</th>
            <td>$fecha_montaje_puestos &nbsp;&nbsp; $hora_montaje_puestos</td></tr>
       <tr><th>Fecha y hora de desmontaje de puesto y muestras:</thd>
            <td>$fecha_desmontaje_puestos &nbsp;&nbsp; $hora_desmontaje_puestos</td></tr> 
       <tr><th>Tipo de feria:</th>
            <td>$tipo_feria</td></tr>       
        $municipios
        <tr><th>Formas de participación:</th>
            <td>$formas_participacion</td></tr>
        <tr><th>Capacidad máxima de inscritos:</th>
            <td>$max_inscritos</td></tr>
        <tr><th>Premios o distinciones con que se galardonan a los expositores:</th>
            <td>$url_premios</td></tr>
        <tr><th>Actividades principales y complementarias:</th>
            <td>$url_actividades</td></tr>
        <tr><th>Requisitos para participar:</th>
            <td>$url_requisitos</td></tr>
        <tr><th>Público invitado:</th>
            <td>$url_publico</td></tr>
        <tr><th>Costos que asumen los organizadores:</th>
            <td>$url_costos</td></tr>
        <tr><th>Parámetros del puesto:</th>
            <td>$url_parametros</td></tr>
        <tr><th>Herramientas para las presentaciones:</th>
            <td>$url_herramientas</td></tr>
        <tr><th>Proceso de valoración:</label><br /></th>
            <td>$url_valoracion</td></tr>
        <tr><th>Agenda de la feria:</th>
            <td>$url_agenda</td></tr>
        <tr><th>Reglamento de la feria:</th>
            <td>$url_reglamento</td></tr>
    </table>
        
HTML;
        ?>

    </div>
</div>