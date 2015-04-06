<?php

$user = elgg_get_logged_in_user_entity();
$guid = elgg_get_hoja_de_vida($user->guid);
if (!$guid) {
    $h = new ElggHojaDeVida();
    $guid=$h->save();
}
$hoja = get_entity($guid);
$ponencias = elgg_get_json($hoja->ponencias)[0];
$estudios= elgg_depurar_array_ponencias($ponencias);
$contenido = "<div id='estudios-realizados'>";
$content = "";
$i = 0;
$size= count($estudios);
$titulo = elgg_view_title("Ponencias");
$content.="{$titulo}<table class='tabla-coordinador' id='tabla-ponencias'><thead><tr><th>Nombre de la Ponencia</th><th>Evento</th><th>Ciudad</th><th>Tipo</th><th>Fecha</th><th>Opciones</th></tr></thead>";
for($i;$i<$size;$i++){
    $options = array("Nacional","Internacional","Colectiva");
    $cad_tipo="<select id='tipo{$i}' readonly>";
    foreach($options as $option){
        if($option==$estudios[$i]["tipo"]){
            $selected=" selected";
        }
        $cad_tipo.="<option value='{$option}' {$selected}>{$option}</option>";
        $selected="";
    }
    $cad_tipo.="</select>";
    $nombre = elgg_view('input/text', array('name' => 'nombre', "id" => 'nombre' . $i, 'value' => "{$estudios[$i]['nombre']}", 'readonly' => 'true'));
    $evento = elgg_view('input/text', array('name' => 'evento', "id" => 'evento' . $i, 'value' => "{$estudios[$i]['evento']}", 'readonly' => 'true'));
    $ciudad = elgg_view('input/text', array('name' => 'ciudad', "id" => 'ciudad' . $i, 'value' => "{$estudios[$i]['ciudad']}", 'readonly' => 'true')); 
    $fecha = "<input type='date' value='{$estudios[$i]['fecha']}' name='fecha' id='fecha{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $opciones="<ul class='opciones-tabla'><li><a class='borrar-ponencia' id='{$i}'>Borrar</a></li><li><a class='editar-ponencia' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row-ponencia{$i}'><td>{$nombre}</td><td>{$evento}</td><td>{$ciudad}</td><td>{$cad_tipo}</td><td>{$fecha}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$ultimo = elgg_view('input/hidden', array("id" => 'ultimo-ponencia', 'value' => "$i"));
$button.="<a id='agregar-ponencia' class='link-button'>Agregar Nuevo</a><br>";
$contenido.= $content . $ultimo . "</div><br><div class='contenedor-button'>".$button."</div>";


$estu = elgg_get_json($hoja->publicaciones)[0];
$estudios = elgg_depurar_array_publicaciones($estu);
$contenido .= "<div id='publicaciones'>";
$titulo = elgg_view_title("Publicaciones");
$content= "";
$i = 0;
$size = count($estudios);
$content.=$titulo."<table class='tabla-coordinador' id='tabla-publicaciones'><thead><tr><th>Titulo de la Publicacion</th><th>Editorial</th><th>Ciudad</th><th>Fecha</th><th>ISBN</th><th>ISSN</th><th>Indexada</th><th>Opciones</th></tr></thead>";
for ($i; $i < $size; $i++) {
    $titulo = elgg_view('input/text', array('name' => 'titulo', "id" => 'titulo' . $i, 'value' => "{$estudios[$i]['titulo']}", 'readonly' => 'true'));
    $editorial = elgg_view('input/text', array('name' => 'editorial', "id" => 'editorial' . $i, 'value' => "{$estudios[$i]['editorial']}", 'readonly' => 'true'));
    $ciudad = elgg_view('input/text', array('name' => 'ciudad', "id" => 'ciudad' . $i, 'value' => "{$estudios[$i]['ciudad']}", 'readonly' => 'true'));
    $fecha = "<input type='date' value='{$estudios[$i]['fecha']}' name='fecha' id='fecha{$i}'  class='elgg-input-date popup_calendar' readonly>";
    $isbn = elgg_view('input/text', array('name' => 'isbn', "id" => 'isbn' . $i, 'value' => "{$estudios[$i]['isbn']}", 'readonly' => 'true'));
    $issn = elgg_view('input/text', array('name' => 'issn', "id" => 'issn' . $i, 'value' => "{$estudios[$i]['issn']}", 'readonly' => 'true'));
    $indexada = elgg_view('input/text', array('name' => 'indexada', "id" => 'indexada' . $i, 'value' => "{$estudios[$i]['indexada']}", 'readonly' => 'true'));
    $opciones = "<ul class='opciones-tabla'><li><a class='borrar-publicacion' id='{$i}'>Borrar</a></li><li><a class='editar-publicacion' id='{$i}'>Editar</a></li></ul>";
    $content.="<tr id='row-publicacion{$i}'><td>{$titulo}</td><td>{$editorial}</td><td>{$ciudad}</td><td>{$fecha}</td><td>{$isbn}</td><td>{$issn}</td><td>{$indexada}</td><td>{$opciones}</td></tr>";
}
$content.="</table>";
$ultimo_exp = elgg_view('input/hidden', array("id" => 'ultimo-publicacion', 'value' => "$i"));
$button="<a id='agregar-publicacion' class='link-button'>Agregar Nuevo</a><br>";
$contenido.= $content . $ultimo_exp . "</div><br>";
$button_guardar = "<a id='guardar-ponencias' class='link-button'>Guardar</a>";
echo $contenido;
echo "<div class='contenedor-button'>".$button_guardar." &nbsp;".$button."</div>";

