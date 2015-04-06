<?php

$sql = "SELECT DISTINCT col5, col4 FROM elgg_estudiante_2";
$conexion = mysql_connect("172.18.21.231", "root", "elgg2014");
mysql_select_db("comunidad", $conexion);
mysql_query("SET NAMES 'utf8'");
$result = mysql_query($sql);
$i = 1;
while ($row = mysql_fetch_row($result)) {
    if ($row[0] !== "" &&$row[1] !== "") {
        $institucion = new ElggInstitucion();
        $nombre=  str_replace("¿", "Ñ", $row[0]);
        $institucion->name = $nombre;
        $institucion->departamento = "Norte de Santander";
        $institucion->municipio = $row[1];
        $institucion->save();
    }
} 
//for ($i = 0; $i < $archivo->countRows(); $i++) {
//    $sql = "INSERT INTO elgg_estudiante (nombre, apellido, num_doc, genero, grado, municipio, institucion, tipo_doc)  VALUES ";
//    $nombre = $arreglo[$i]['NOMBRE1'] . " " . $arreglo[$i]["NOMBRE2"];
//    $apellido = $arreglo[$i]['APELLIDO1'] . " " . $arreglo[$i]['APELLIDO2'];
//    $documento = $arreglo[$i]['DOC'];
//    $genero = $arreglo[$i]["GENERO"];
//    $grado = $arreglo[$i]["GRADO"];
//    $municipio = $arreglo[$i]["JERARQUIA"];
//    $institucion = $arreglo[$i]["INSTITUCION"];
//    $tipo_doc = explode(":", $arreglo[$i]["TIPODOC"])[0];
//    $sql.= "('$nombre','$apellido','$documento','$genero','$grado','$municipio', '$institucion','$tipo_doc')";
//    mysql_query($sql);
//    error_log("Guardado hasta la posicion $i");
//}
//
//


