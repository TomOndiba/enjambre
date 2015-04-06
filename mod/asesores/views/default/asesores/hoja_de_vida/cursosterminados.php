<?php

$user = elgg_get_logged_in_user_entity();
$guid = elgg_get_hoja_de_vida($user->guid);
$hoja = get_entity($guid);
$est = elgg_get_json($hoja->cursos_terminados)[0];
$estudios= elgg_depurar_array_cursos_terminados($est);
$contenido = "<div id='cursos_terminados'>";
$content = "";
$i = 0;
$size= count($estudios);
$content.="<table class='tabla-coordinador' id='tabla-estudios'><thead><tr><th>Nombre</th><th>Institucion</th><th>Fecha</th><th>Ciudad</th><th>Intensidad Horaria</th><th>Opciones</th></tr></thead>";
for($i;$i<$size;$i++){
    $nombre = elgg_view('input/text', array('name' => 'clase', "id" => 'nombre' . $i, 'value' => "{$estudios[$i]['nombre']}", 'readonly' => 'true'));
    $institucion = elgg_view('input/text', array('name' => 'institucion', "id" => 'institucion' . $i, 'value' => "{$estudios[$i]['institucion']}", 'readonly' => 'true'));
    $fecha = "<input type='date' value='{$estudios[$i]['fecha']}' name='fecha' id='fecha{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $ciudad = elgg_view('input/text', array('name' => 'ciudad', "id" => 'ciudad' . $i, 'value' => "{$estudios[$i]['ciudad']}", 'readonly' => 'true'));
    $intensidad = elgg_view('input/text', array('name' => 'intensidad', "id" => 'intensidad' . $i, 'value' => "{$estudios[$i]['intensidad']}", 'readonly' => 'true'));
    $opciones="<ul class='opciones-tabla'><li><a class='borrar' id='{$i}'>Borrar</a></li><li><a class='editar-cursos' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row{$i}'><td>{$nombre}</td><td>{$institucion}</td><td>{$fecha}</td><td>{$ciudad}</td><td>{$intensidad}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$ultimo = elgg_view('input/hidden', array("id" => 'ultimo', 'value' => "$i"));
$contenido.= $content . $ultimo . "</div><br>";
$button.="<a class='link-button' id='agregar-cursos'>Agregar Nuevo</a>";
$button_guardar = "<a class='link-button' id='guardar-cursos'>Guardar</a>";
echo $contenido;
echo "<div class='contenedor-button'>".$button_guardar." &nbsp;".$button."</div>";

