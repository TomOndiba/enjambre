<?php

$guid = get_input('id');
$usuario = elgg_get_usuario_by_ID($guid);

$buttons = elgg_view('input/submit', array(
    'value' => elgg_echo('Agregar Rol'),
    'id' => "buttonagregarrol"
        ));
$datos = "";
$body;
if ($usuario) {
    $title = $usuario['nombre'] . ' ' . $usuario['apellidos'];
    $roles = elgg_get_roles_usuario($usuario['guid']);
    $body.= "<p>".elgg_echo("instruccion:asignar:rol")."<p>";
    foreach ($roles as $rol) {
        $datos .= '<tr><td>' . $rol['nombre'] . '</td>'
                . '<td><a onclick="desasignarRol(' . $rol['guid'] . ')" href="#">Quitar</a></td></tr>';
    }
    $tablaroles = '<table class="elgg-table-alt">
    <thead>
        <tr>
            <th>Rol</th><th>Opciones</th>
        </tr>
   </thead>
   <tbody>' .
            $datos . '
   </tbody>
   </table> 
   </br>';
   
    $body.= $tablaroles;
    $body.= '<div align="right"> ' . $buttons . '</div>' .
        ' <div id="seleccion_roles"></div>';
} else {
    $body = "El usuario, no se encuentra registrado en el sistema.";
}

echo elgg_view_module($title, $title, $body);

