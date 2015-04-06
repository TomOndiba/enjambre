<?php

$tipo_documento = get_input('tipo_documento');
$numero_documento = get_input('numero_documento');
$usuario = elgg_get_datos_usuario_registro($numero_documento, $tipo_documento);
while ($row = mysql_fetch_array($usuario)) {
    $nombres = $row['col26'] . " " . $row['col27'];
    $apellidos = $row['col24'] . " " . $row['col25'];
    $username = elgg_get_new_username($nombres, $apellidos);
    $gener = strtolower($row['col28']);
    $munic = mb_strtolower($row['col4'], "UTF-8");
    $genero = ucwords($gener);
    $grado = ucwords(strtolower($row['col12']));
    $nombre = str_replace("¿", "Ñ", $row['col5']);
    $municipio = ucwords($munic);
    $retorno = array('nombre' => $row['col26'] . " " . $row['col27'], 'apellidos' => $row['col24'] . " " . $row['col25'], 'tipoDocumento' => $row['col23'], 'numeroDocumento' => $row['col22'], 'sexo' => $genero,
        'username' => $username, "password" => $row['col22'], "departamento" => 'Norte de Santander', "municipio" => $municipio, "mun" => $row['col4'], "institucion" => $nombre, "grado" => $grado);
}

if (elgg_existe_documento($numero_documento)) {
    $msj = "Existe un usuario registrado con el documento $tipo_documento <b>$numero_documento</b> ";
    echo json_encode(array('user' => false, 'mensaje' => $msj));
} else if (!$retorno) {
    $msj = "No se ha encontrado un estudiante registrado con el documento $tipo_documento con el número <b>$numero_documento</b>. Verifique los datos e intente nuevamente.";
    echo json_encode(array('user' => false, 'mensaje' => $msj));
} else {
    echo json_encode(array('user' => $retorno));
}
