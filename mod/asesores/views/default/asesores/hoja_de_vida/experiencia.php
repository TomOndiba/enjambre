<?php
$user = elgg_get_logged_in_user_entity();
$guid = elgg_get_hoja_de_vida($user->guid);
if (!$guid) {
    $h = new ElggHojaDeVida();
    $guid = $h->save();
}
$hoja = get_entity($guid);
$est = elgg_get_json($hoja->experiencia)[0];
$estudios = elgg_depurar_array_experiencia($est);
$contenido = "<div id='estudios-realizados'>";
$content = "";
$i = 0;
$size = count($estudios);
$titulo = elgg_view_title("Experiencia");
$content.=$titulo."<table class='tabla-coordinador' id='tabla-estudios'><thead><tr><th>Universidad</th><th>Actividad</th><th>Tiempo Completo</th><th>Medio Tiempo</th><th>Catedral</th><th>Otro</th><th>Desde</th><th>Hasta</th><th>Opciones</th></tr></thead>";
for ($i; $i < $size; $i++) {
    $array = array("tc", "mt", "cat", "otro");
    $radios = "";
    foreach ($array as $data) {
        if ($data == $estudios[$i]["tipo"]){
            $radios.="<td><input type='radio' name='radio-tipo{$i}' value='{$data}' checked><br></td>";
        }
        else{
            $radios.="<td><input type='radio' name='radio-tipo{$i}' value='{$data}'><br></td>";
        }
    }
    $universidad = elgg_view('input/text', array('name' => 'clase', "id" => 'universidad' . $i, 'value' => "{$estudios[$i]['universidad']}", 'readonly' => 'true'));
    $actividad = elgg_view('input/text', array('name' => 'actividad', "id" => 'actividad' . $i, 'value' => "{$estudios[$i]['actividad']}", 'readonly' => 'true'));
    $desde = "<input type='date' value='{$estudios[$i]['desde']}' name='desde' id='desde-exp{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $hasta = "<input type='date' value='{$estudios[$i]['hasta']}' name='hasta' id='hasta-exp{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $opciones = "<ul class='opciones-tabla'><li><a class='borrar-experiencia' id='{$i}'>Borrar</a></li><li><a class='editar-experiencia' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row-experiencia{$i}'><td>{$universidad}</td><td>{$actividad}</td>$radios<td>{$desde}</td><td>{$hasta}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$button="<a id='agregar-experiencia' class='link-button'>Agregar Nuevo</a><br>";
$ultimo = elgg_view('input/hidden', array("id" => 'ultimo-experiencia', 'value' => "$i"));
$contenido.= $content . $ultimo . "</div><div class='contenedor-button'>".$button."</div>";
$estu = elgg_get_json($hoja->experiencia_docente)[0];
$estudios = elgg_depurar_array_experiencia_docente($estu);
$contenido .= "<div id='estudios-realizados'>";
$titulo = elgg_view_title("Experiencia Docente");
$content= "";
$i = 0;
$size = count($estudios);
$content.=$titulo."<table class='tabla-coordinador' id='tabla-exp-docente'><thead><tr><th>Entidad</th><th>Cargo</th><th>Desde</th><th>Hasta</th><th>Opciones</th></tr></thead>";
for ($i; $i < $size; $i++) {
    $entidad = elgg_view('input/text', array('name' => 'entidad', "id" => 'entidad' . $i, 'value' => "{$estudios[$i]['entidad']}", 'readonly' => 'true'));
    $cargo = elgg_view('input/text', array('name' => 'cargo', "id" => 'cargo' . $i, 'value' => "{$estudios[$i]['cargo']}", 'readonly' => 'true'));
    $desde = "<input type='date' value='{$estudios[$i]['desde']}' name='desde' id='desde{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $hasta = "<input type='date' value='{$estudios[$i]['hasta']}' name='hasta' id='hasta{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $opciones = "<ul class='opciones-tabla'><li><a class='borrar-exp-docente' id='{$i}'>Borrar</a></li><li><a class='editar-experiencia-docente' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row-exp-docente{$i}'><td>{$entidad}</td><td>{$cargo}</td><td>{$desde}</td><td>{$hasta}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$ultimo_exp = elgg_view('input/hidden', array("id" => 'ultimo-exp-docente', 'value' => "$i"));
$contenido.= $content . $ultimo_exp . "</div><br>";
$button="<a id='agregar-exp-docente' class='link-button'>Agregar Nuevo</a>";
$button_guardar = "<a id='guardar-experiencia' class='link-button'>Guardar</a>";
echo $contenido;
echo "<div class='contenedor-button'>".$button_guardar." &nbsp;".$button."</div>";
