<?php

$user = elgg_get_logged_in_user_entity();
$guid = elgg_get_hoja_de_vida($user->guid);
if (!$guid) {
    $h = new ElggHojaDeVida();
    $guid=$h->save();
}
$hoja = get_entity($guid);
$est = elgg_get_json($hoja->estudios_terminados)[0];
$estudios= elgg_depurar_array_estudios_terminados($est);
$contenido = "<div id='estudios-realizados'>";
$content = "";
$i = 0;
$size= count($estudios);
$content.="<table class='tabla-coordinador' id='tabla-estudios'><thead><tr><th>Clase</th><th>Institucion</th><th>Ciudad</th><th>Fecha</th><th>Resolucion</th><th>Opciones</th></tr></thead>";
for($i;$i<$size;$i++){
    $clase = elgg_view('input/text', array('name' => 'clase', "id" => 'clase' . $i, 'value' => "{$estudios[$i]['clase']}", 'readonly' => 'true'));
    $institucion = elgg_view('input/text', array('name' => 'institucion', "id" => 'institucion' . $i, 'value' => "{$estudios[$i]['institucion']}", 'readonly' => 'true'));
    $ciudad = elgg_view('input/text', array('name' => 'ciudad', "id" => 'ciudad' . $i, 'value' => "{$estudios[$i]['ciudad']}", 'readonly' => 'true'));
    $fecha = "<input type='date' value='{$estudios[$i]['fecha']}' name='fecha' id='fecha{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $resolucion = elgg_view('input/text', array('name' => 'resolucion', "id" => 'resolucion' . $i, 'value' => "{$estudios[$i]['resolucion']}", 'readonly' => 'true'));
    $opciones="<ul class='opciones-tabla'><li><a class='borrar' id='{$i}'>Borrar</a></li><li><a class='editar' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row{$i}'><td>{$clase}</td><td>{$institucion}</td><td>{$ciudad}</td><td>{$fecha}</td><td>{$resolucion}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$ultimo = elgg_view('input/hidden', array("id" => 'ultimo', 'value' => "$i"));
$contenido.= $content . $ultimo . "</div><br>";
$button.="<a id='agregar-estudios' class='link-button'>Agregar Nuevo</a><br>";
$button_guardar = "<a id='guardar' class='link-button'>Guardar</a>";
echo $contenido;
echo "<div class='contenedor-button'>".$button_guardar." &nbsp;".$button."</div>";

