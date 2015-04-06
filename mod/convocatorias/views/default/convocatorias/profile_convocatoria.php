<?php
/**
 * Vista que muestra la información detallada de una convocatoria
 */
$guid = $vars['id'];
$nombre = $vars['nombre'];
$departamento = $vars['departamento'];
$convenio = $vars['convenio'];
$fecha_apertura = $vars['fecha_apertura'];
$fecha_cierre = $vars['fecha_cierre'];
$fecha_pub_resultados = $vars['fecha_pub_resultados'];
$hora_cierre = $vars['hora_cierre'];
$proceso_pedagogico = $vars['proceso_pedagogico'];
$requisitos = $vars['requisitos'];
$no_aplica = $vars['no_aplica'];
$tipo_convocatoria = $vars['tipo_convocatoria'];
$objetivos = $vars['objetivos'];
$publico = $vars['publico'];
$criterios = $vars['criterios'];
$especial = $vars['especial'];
$usuario = get_entity(elgg_get_logged_in_user_guid());




?>
<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Convocatoria: <?php echo $nombre;?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu", array('guid'=>$guid));?>
    </div>
    <div class="contenido-coordinacion">
        <h2>
            Información de la Convocatoria:
        </h2>
        <?php
        echo <<<HTML

    <table class='vertical-table'>
         <tr><th>Tipo de Convocatoria:</th>
            <td>$tipo_convocatoria</td></tr>
        <tr><th>Departamento:</th>
            <td>$departamento</td></tr>
            <tr><th>Tipo de convocatoria:</th>
            <td>$especial</td></tr>
       <tr><th>Convenio:</th>
            <td>$convenio</td></tr> 
        <tr><th>Fecha de apertura de la convocatoria:</th>
            <td>$fecha_apertura</td></tr>
        <tr><th>Fecha de cierre de la convocatoria:</th>
            <td>$fecha_cierre</td></tr>
        <tr><th>Hora cierre:</th>
            <td>$hora_cierre</td></tr>
        <tr><th>Fecha de publicación de resultados:</th>
            <td>$fecha_pub_resultados</td></tr>
       <tr><th> Objetivos de la Convocatoria:</th>
            <td>$objetivos</td></tr> 
        <tr><th>Dirigido a:</th>
            <td>$publico</td></tr>
        <tr><th>Proceso Pedagogico de la Convocatoria:</th>
            <td>$proceso_pedagogico</td></tr>    
        <tr><th>Requisitos: </th>
            <td>$requisitos</td></tr> 
        <tr><th>No Aplica para Selección:</th>
            <td>$no_aplica</td></tr>           
        <tr><th>Criterios de Evaluación  y Selección:</th>
            <td>$criterios</td></tr>
    </table>
HTML;
        ?>

    </div>
</div>   