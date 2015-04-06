<?php

/*
 * Vista donde se permite vincular niveles y areas a una feria
 */

$guid = $vars['id'];
$nombre = $vars['nombre'];
$departamento = $vars['departamento'];
$fecha_apertura = $vars['fecha_apertura'];
$fecha_cierre = $vars['fecha_cierre'];
$objetivos=$vars['objetivos'];
$tipo_feria = $vars['tipo_feria'];
$usuario = get_entity(elgg_get_logged_in_user_guid());

$niveles = $vars['niveles'];
$areas = $vars['areas'];

$adm_area = $vars['adm_area'];
$adm_nivel = $vars['adm_nivel'];

//Se listan los niveles asociados a la feria
$nombresN = '';
foreach ($niveles as $n) {
    $vinculo = $n['href'];
    $nomb = $n['nombre'];
    $nombresN.= "<table  class='vertical-table' align='center' width='60%'>"
            ."<tr><th>$nomb</th>"
            ."<td><a href='$vinculo'>Desasociar</a></td></tr>"
            ."</table>";
}

//Se listan lareas asociados a la feria
$nombresA = '';
foreach ($areas as $a) {
    $vinculo = $a['href'];
    $nomb = $a['nombre'];
    $nombresA.="<table  class='vertical-table' align='center' width='60%'>"
            ."<tr><th>$nomb</th>"
            ."<td><a href='$vinculo'>Desasociar</a></td></tr>"
            ."</table>";
}

//
if (empty($niveles)) {
    $nombresN = elgg_echo('nivel:empty:feria');
}
//
if (empty($areas)) {
    $nombresA = elgg_echo('area:empty:feria');
}

//Se cargan los niveles que no pertenecen a esta feria para que se puedan seleccionar.
$niveles_no_feria = elgg_get_niveles_no_asociados_a_feria($guid);
$opciones_niveles = array();
if (!empty($niveles_no_feria)) {
    foreach ($niveles_no_feria as $nx) {
        $opciones_niveles[$nx['nombre']] = $nx['guid'];
    }
}
$niveles_X = elgg_view('input/checkboxes', array('name' => 'niveles_no', 'align' => 'Vertical', 'options' => $opciones_niveles));
if (sizeof($opciones_niveles) < 1) {
    $niveles_X = elgg_echo('feria:niveles:empy');
}

//Se cargan las areas que no pertenecen a esta feria para que se puedan seleccionar.
$areas_no_feria = elgg_get_areas_no_asociadas_a_feria($guid);
$opciones_areas = array();
if (!empty($areas_no_feria)) {
    foreach ($areas_no_feria as $ax) {
        $opciones_areas[$ax['nombre']] = $ax['guid'];
    }
}
$areas_X = elgg_view('input/checkboxes', array('name' => 'areas_no', 'align' => 'Vertical', 'options' => $opciones_areas));
if (sizeof($opciones_areas) < 1) {
    $areas_X = elgg_echo('feria:areas:empy');
}


$id = elgg_view('input/hidden', array('name' => 'guid_feria', 'value' => $guid));

$button = elgg_view('input/submit', array('value' => elgg_echo('Asociar')));


echo <<<HTML
<h2>Área/Nivel Feria</h2>
<div>
    <table  class='vertical-table'>
        <tr><th>Departamento:</th>
            <td>$departamento</td></tr>
       <tr><th>Fecha de apertura de la feria:</th>
            <td>$fecha_apertura</td></tr>
        <tr><th>Fecha de cierre de la feria:</th>
            <td>$fecha_cierre</td></tr>
       <tr><th>Objetivos:</thd>
            <td>$objetivos</td></tr> 
    </table>
        <br><br>
        <div>
        <h3>Niveles Asociados de Feria <div class='contenedor-button'>  <a class='link-button' href='$adm_nivel'>Administrar Niveles</a></div></h3><hr>
        Niveles asociados a esta feria:<br><br>
        $nombresN
        <br><br>
        <h5>Escoja el nivel para asociar</h5>
        <br>
        $niveles_X
        </div>
        
        <br><br>
        $id
       <h3>Areas Asociadas de Feria  <div class='contenedor-button'> <a class='link-button' href='$adm_area'>Administrar Areas</a></div></h3><hr>
        Areas asociadas a esta feria:<br><br>
        $nombresA
        <br><br>
        <h5>Escoja el area para asociar</h5>
        <br>
        $areas_X
        </div>
        
        <br><br>
        $button
HTML;
?>

</div>