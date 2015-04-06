<?php

/**
 * Vista que permite visualizar los datos agregados de la hoja de vida del asesor
 * @author DIEGOX_CORTEX
 */

$id_user = $vars['id_user'];
$user = get_entity($id_user);
$guid = elgg_get_hoja_de_vida($user->guid);
$hoja = get_entity($guid);

$contenido_inicial = "<center><h1>HOJA DE VIDA</h1>"
        . "<li class='item-usuario'>"
        . "<a><img src='{$user->getIconURL()}' /></a><div><div><a><span class='name-usuario'>{$user->name} {$user->apellidos}</span></a></div>"
        . "</li></center><br><br>";

/**
 * Obtengo los estudios almacenados en la hoja de vida
 */
$cursos = elgg_get_json($hoja->cursos_terminados)[0];
$cursos_print = elgg_depurar_array_cursos_terminados($cursos);

$contenido_cursos = "<h2><center>Cursos y Diplomados<hr></center></h2><div id='cursos_terminados'><br>";
$content_cursos = "";
$i = 0;
$size_cursos = count($cursos_print);

/**
 * Imprimo los estudios en una tabla
 */
$content_cursos.="<table class='tabla-coordinador' id='tabla-estudios'><thead><tr><th>Nombre</th><th>Institucion</th><th>Fecha</th><th>Ciudad</th><th>Intensidad Horaria</th></tr></thead>";
for ($i = 0; $i < $size_cursos; $i++) {
    $nombre = $cursos_print[$i]['nombre'];
    $institucion = $cursos_print[$i]['institucion'];
    $fecha = $cursos_print[$i]['fecha'];
    $ciudad = $cursos_print[$i]['ciudad'];
    $intensidad = $cursos_print[$i]['intensidad'];
    $content_cursos.="<tr id='row{$i}'><td>{$nombre}</td><td>{$institucion}</td><td>{$fecha}</td><td>{$ciudad}</td><td>{$intensidad}</td></tr>";
}
$content_cursos.="</table>";

$contenido_cursos .= $content_cursos . "</div><br><br>";



/**
 * Obtengo los estudios almacenados en la hoja de vida
 */
$contenido_estudios = "<h2><center>Estudios Terminados<hr></center></h2>";

$estudios = elgg_get_json($hoja->estudios_terminados)[0];
$estudios_print = elgg_depurar_array_estudios_terminados($estudios);

$contenido_estudios .= "<div id='estudios-realizados'>";
$content_estudios = "";

$size_estudios = count($estudios_print);

$content_estudios.="<table class='tabla-coordinador' id='tabla-estudios'><thead><tr><th>Clase</th><th>Institucion</th><th>Ciudad</th><th>Fecha</th><th>Resolucion</th></tr></thead>";
for ($i = 0; $i < $size_estudios; $i++) {
    $clase = $estudios_print[$i]['clase'];
    $institucion = $estudios_print[$i]['institucion'];
    $ciudad = $estudios_print[$i]['ciudad'];
    $fecha = $estudios_print[$i]['fecha'];
    $resolucion = $estudios_print[$i]['resolucion'];

    $content_estudios.="<tr id='row{$i}'><td>{$clase}</td><td>{$institucion}</td><td>{$ciudad}</td><td>{$fecha}</td><td>{$resolucion}</td></tr>";
}
$content_estudios.="</table>";
$contenido_estudios .= $content_estudios . "</div><br><br>";

/**
 * Obtengo la experiencia almacenada en la hoja de vida
 */
$experiencia = elgg_get_json($hoja->experiencia)[0];
$experiencia_print = elgg_depurar_array_experiencia($experiencia);

$contenido_experiencia = "<h2><center>Experiencia<hr></center></h2>"
        . "<div id='estudios-realizados'>";

$content_experiencia = "";

$size_experiencia = count($experiencia_print);
$content_experiencia.= "<table class='tabla-coordinador' id='tabla-estudios'><thead><tr><th>Universidad</th><th>Actividad</th><th>Tiempo Completo</th><th>Medio Tiempo</th><th>Catedral</th><th>Otro</th><th>Desde</th><th>Hasta</th></tr></thead>";
for ($i = 0; $i < $size_experiencia; $i++) {
    $array = array("tc", "mt", "cat", "otro");
    $radios = "";
    foreach ($array as $data) {
        if ($data == $experiencia_print[$i]["tipo"]) {
            $radios.= "<td><center>SI</center></td>";
        } else {
            $radios .="<td></td>";
        }
    }
    $universidad = $experiencia_print[$i]['universidad'];
    $actividad = $experiencia_print[$i]['actividad'];
    $desde = $experiencia_print[$i]['desde'];
    $hasta = $experiencia_print[$i]['hasta'];

    $content_experiencia.="<tr id='row-experiencia{$i}'><td>{$universidad}</td><td>{$actividad}</td>$radios<td>{$desde}</td><td>{$hasta}</td></tr>";
}
$content_experiencia .= "</table>";
$contenido_experiencia .= $content_experiencia . "</div><br><br>";

/**
 * Imprimo la investigacion almacenada en la hojad de vida
 */
$contenido_investigacion = "<h2><center>Investigación<hr></center></h2>";

$investigacion = elgg_get_json($hoja->investigacion)[0];
$investigacion_print = elgg_depurar_array_investigaciones($investigacion);

$contenido_investigacion .= "<div id='estudios-realizados'>";
$content_investigacion = "";

$size_investigacion = count($investigacion_print);
$content_investigacion.= "<table class='tabla-coordinador' id='tabla-investigaciones'><thead><tr><th>Titulo</th><th>Entidad Patrocinadora</th><th>Fecha Fin</th></tr></thead>";
for ($i = 0; $i < $size_investigacion; $i++) {
    $titulo = $investigacion_print[$i]['titulo'];
    $entidad_patrocinadora = $investigacion_print[$i]['entidad_patrocinadora'];
    $fecha_fin = $investigacion_print[$i]['fecha_fin'];

    $content_investigacion.="<tr id='row-investigacion{$i}'><td>{$titulo}</td><td>{$entidad_patrocinadora}</td><td>{$fecha_fin}</td></tr>";
}
$content_investigacion .= "</table>";
$contenido_investigacion .= $content_investigacion . "</div><br><br>";

/**
 * Imprimo la pertenencoia a grupos de investigacion
 */
$pertenencia = elgg_get_json($hoja->pertenencia)[0];
$pertenencia_print = elgg_depurar_array_pertenencia_grupos($pertenencia);

$contenido_pertenencia .= "<h2><center>Pertenencia a Grupos de Investigacion</center><hr></h2><div id='estudios-realizados'>";

$content_pertenencia = "";

$size_pertenencia = count($pertenencia_print);
$content_pertenencia.= "<table class='tabla-coordinador' id='tabla-pertenencia'><thead><tr><th>Nombre del Grupo</th><th>Categoria del Grupo</th><th>Pertenece desde</th></tr></thead>";
for ($i = 0; $i < $size_pertenencia; $i++) {
    $nombre = $pertenencia_print[$i]['nombre'];
    $categoria = $pertenencia_print[$i]['categoria'];
    $fecha_fin = $pertenencia_print[$i]['fecha_fin_pertenencia'];

    $content_pertenencia.="<tr id='row-pertenencia{$i}'><td>{$nombre}</td><td>{$categoria}</td><td>{$fecha_fin}</td></tr>";
}
$content_pertenencia.="</table>";
$contenido_pertenencia .= $content_pertenencia . "</div><br><br>";

/**
 * Imprimo las pnencias almacenadas en la hoja de vida
 */
$ponencias = elgg_get_json($hoja->ponencias)[0];
$ponencias_print = elgg_depurar_array_ponencias($ponencias);

$contenido_ponencias = "<h2><center>Ponencias<hr></center></h2><div id='estudios-realizados'>";

$content_ponencias = "";

$size_ponencias = count($ponencias_print);
$content_ponencias.="<table class='tabla-coordinador' id='tabla-ponencias'><thead><tr><th>Nombre de la Ponencia</th><th>Evento</th><th>Ciudad</th><th>Tipo</th><th>Fecha</th></tr></thead>";
for ($i = 0; $i < $size_ponencias; $i++) {
    $options = array("Nacional", "Internacional", "Colectiva");
    $cad_tipo = "";
    foreach ($options as $option) {
        if ($option == $ponencias_print[$i]["tipo"]) {
            $cad_tipo = " $option";
        }
    }
    $nombre = $ponencias_print[$i]['nombre'];
    $evento = $ponencias_print[$i]['evento'];
    $ciudad = $ponencias_print[$i]['ciudad'];
    $fecha = $ponencias_print[$i]['fecha'];

    $content_ponencias.="<tr id='row-ponencia{$i}'><td>{$nombre}</td><td>{$evento}</td><td>{$ciudad}</td><td>{$cad_tipo}</td><td>{$fecha}</td><td>{$opciones}</td></tr>";
}
$content_ponencias .= "</table>";
$contenido_ponencias .= $content_ponencias . "</div><br><br>";

/**
 * Imprimo las publicaciones almacenadas en la hoja de vida
 */
$publicaciones = elgg_get_json($hoja->publicaciones)[0];
$publicaciones_print = elgg_depurar_array_publicaciones($publicaciones);

$contenido_publicaciones .= "<h2><center>Publicaciones<hr></center></h2><div id='publicaciones'>";

$content_publicaciones = "";

$size_publicaciones = count($publicaciones_print);
$content_publicaciones.= "<table class='tabla-coordinador' id='tabla-publicaciones'><thead><tr><th>Titulo de la Publicacion</th><th>Editorial</th><th>Ciudad</th><th>Fecha</th><th>ISBN</th><th>ISSN</th><th>Indexada</th></tr></thead>";
for ($i = 0; $i < $size_publicaciones; $i++) {
    $titulo = $publicaciones_print[$i]['titulo'];
    $editorial = $publicaciones_print[$i]['editorial'];
    $ciudad = $publicaciones_print[$i]['ciudad'];
    $fecha = $publicaciones_print[$i]['fecha'];
    $isbn = $publicaciones_print[$i]['isbn'];
    $issn = $publicaciones_print[$i]['issn'];
    $indexada = $publicaciones_print[$i]['indexada'];

    $content_publicaciones.="<tr id='row-publicacion{$i}'><td>{$titulo}</td><td>{$editorial}</td><td>{$ciudad}</td><td>{$fecha}</td><td>{$isbn}</td><td>{$issn}</td><td>{$indexada}</td></tr>";
}
$content_publicaciones.="</table>";
$contenido_publicaciones .= $content_publicaciones . "</div><br><br>";

//Imprimo imagen del usuario
echo $contenido_inicial;
//Imprimo los cursos del asesor
echo $contenido_cursos;
//Imprimo los estudios del asesor
echo $contenido_estudios;
//Imprimo la experiencia del asesor;
echo $contenido_experiencia;
//Imprimo la experiencia en investigacion del asesor
echo $contenido_investigacion;
//Imprimo la pertenencia del asesor a grupos de investigacion
echo $contenido_pertenencia;
//Imprimo las ponencias que ha tenido el asesor
echo $contenido_ponencias;
//Imprimo las publicaciones que ha hecho el asesor
echo $contenido_publicaciones;