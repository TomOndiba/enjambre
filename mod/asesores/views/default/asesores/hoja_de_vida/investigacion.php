<?php
$user = elgg_get_logged_in_user_entity();
$guid = elgg_get_hoja_de_vida($user->guid);
if (!$guid) {
    $h = new ElggHojaDeVida();
    $guid = $h->save();
}
$hoja = get_entity($guid);
$est = elgg_get_json($hoja->investigacion)[0];
$estudios = elgg_depurar_array_investigaciones($est);
$contenido = "<div id='estudios-realizados'>";
$content = "";
$i = 0;
$size = count($estudios);
$titulo = elgg_view_title("Investigaciones");
$content.=$titulo."<table class='tabla-coordinador' id='tabla-investigaciones'><thead><tr><th>Titulo</th><th>Entidad Patrocinadora</th><th>Fecha Fin</th><th>Opciones</th></tr></thead>";
for ($i; $i < $size; $i++) {
    $titulo = elgg_view('input/text', array('name' => 'clase', "id" => 'titulo' . $i, 'value' => "{$estudios[$i]['titulo']}", 'readonly' => 'true'));
    $entidad_patrocinadora = elgg_view('input/text', array('name' => 'entidad_patrocinadora', "id" => 'entidad_patrocinadora' . $i, 'value' => "{$estudios[$i]['entidad_patrocinadora']}", 'readonly' => 'true'));
    $fecha_fin = "<input type='date' value='{$estudios[$i]['fecha_fin']}' name='fecha_fin' id='fecha_fin{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $opciones = "<ul class='opciones-tabla'><li><a class='borrar-investigacion' id='{$i}'>Borrar</a></li><li><a class='editar-investigacion' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row-investigacion{$i}'><td>{$titulo}</td><td>{$entidad_patrocinadora}</td><td>{$fecha_fin}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$button="<a id='agregar-investigacion' class='link-button' >Agregar Nuevo</a><br>";
$ultimo = elgg_view('input/hidden', array("id" => 'ultimo-investigacion', 'value' => "$i"));
$contenido.= $content . $ultimo . "</div><div class='contenedor-button'>".$button."</div>";
$estu = elgg_get_json($hoja->pertenencia)[0];
$estudios = elgg_depurar_array_pertenencia_grupos($estu);
$contenido .= "<div id='estudios-realizados'>";
$titulo = elgg_view_title("Pertenencia a Grupos de Investigacion");
$content= "";
$i = 0;
$size = count($estudios);
$content.=$titulo."<table class='tabla-coordinador' id='tabla-pertenencia'><thead><tr><th>Nombre del Grupo</th><th>Categoria del Grupo</th><th>Pertenece desde</th><th>Opciones</th></tr></thead>";
for ($i; $i < $size; $i++) {
    $nombre = elgg_view('input/text', array('name' => 'nombre', "id" => 'nombre' . $i, 'value' => "{$estudios[$i]['nombre']}", 'readonly' => 'true'));
    $categoria = elgg_view('input/text', array('name' => 'categoria', "id" => 'categoria' . $i, 'value' => "{$estudios[$i]['categoria']}", 'readonly' => 'true'));
    $fecha_fin = "<input type='date' value='{$estudios[$i]['fecha_fin_pertenencia']}' name='fecha_fin_pertenencia' id='fecha_fin_pertenencia{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $opciones = "<ul class='opciones-tabla'><li><a class='borrar-pertenencia' id='{$i}'>Borrar</a></li><li><a class='editar-pertenencia' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row-pertenencia{$i}'><td>{$nombre}</td><td>{$categoria}</td><td>{$fecha_fin}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$ultimo_exp = elgg_view('input/hidden', array("id" => 'ultimo-pertenencia', 'value' => "$i"));
$button="<a id='agregar-pertenencia' class='link-button'>Agregar Nuevo</a>";
$contenido.= $content . $ultimo_exp . "</div><br>";
$button_guardar = "<a id='guardar-investigacion' class='link-button'>Guardar</a>";
echo $contenido;
echo "<div class='contenedor-button'>".$button_guardar." &nbsp;".$button."</div>";
