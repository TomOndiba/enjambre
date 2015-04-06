<?php
/*
 * Vista donde se permite vincular patrocinadores a una feria
 */

$guid = $vars['id'];
$nombre = $vars['nombre'];
$descripcion = $vars['descripcion'];
$objetivos = $vars['objetivos'];
$correos_contacto = $vars['correos_contacto'];
$fecha_inicio_feria = $vars['fecha_inicio_feria'];
$usuario = get_entity(elgg_get_logged_in_user_guid());

$patrocinadores_asociados = $vars['patro'];

$adm_patro = $vars['$adm_patro'];

//Se listan los patrocinadores asociados a la feria
$nombresN = '';
foreach ($patrocinadores_asociados as $p) {
    $vinculo = $p['href'];
    $nomb = $p['nombre'];
    $site_url = elgg_get_site_url();
    $url = $site_url . "photos/thumbnail/{$p['logo']}/small/";
    $nombresN.= "<table  class='vertical-table' align='center' width='60%'>"
            ."<tr><th><img width='50' src='$url'> $nomb</th>"
            ."<td><a href='$vinculo'>Desasociar</a></td></tr>"
            ."</table>";
}

//
if (empty($patrocinadores_asociados)) {
    $nombresN = elgg_echo('patrocinadores:list:empy:asociados');
}

//Se cargan los patrocinadores que no pertenecen a esta feria para que se puedan seleccionar.
$patrocinadores_no_feria = elgg_get_patrociandores_no_asociados_a_feria($guid);
$opciones_patro = array();
if (!empty($patrocinadores_no_feria)) {
    foreach ($patrocinadores_no_feria as $px) {
        $opciones_patro[$px['nombre']] = $px['guid'];
    }
}
$patrones_X = elgg_view('input/checkboxes', array('name' => 'patrocinadores_no', 'align' => 'Vertical', 'options' => $opciones_patro));
if (sizeof($patrones_X) < 1) {
    $patrones_X = elgg_echo('feria:niveles:empy');
}

$id = elgg_view('input/hidden', array('name' => 'guid_feria', 'value' => $guid));

$button = elgg_view('input/submit', array('value' => elgg_echo('Asociar')));


echo <<<HTML
<div><hr></div>
<div>
    <table  class='vertical-table' align='center' width='60%'>
        <tr><th>Descripcion:</th>
            <td>$descripcion</td></tr>
       <tr><th>Objetivos:</th>
            <td>$objetivos</td></tr>
        <tr><th>Correos de contactos:</th>
            <td>$correos_contacto</td></tr>
       <tr><th>Fecha de inicio de Feria:</thd>
            <td>$fecha_inicio_feria</td></tr> 
    </table>
        <br><br>
        <div>
        <h3>Patrocinadores Asociados de Feria </h3>
        <div class='contenedor-button'> <a class='link-button' href='$adm_patro'>Administrar Patrocinadores</a></div><hr>
        <br>Patrocinadores asociados a esta feria:<br><br>
        $nombresN
        <br><br>
        <h5>Escoja el patrocinadore para asociar</h5>
        <br>
        $patrones_X
        </div>
        
        <br><br>
        $id
        </div>
        
        <br><br>
        $button
HTML;
?>

