<?php

$id_rol = get_input('idRol');
$id_user = get_input('id');

if (elgg_desasignar_rol_usuario($id_rol, $id_user)) {
    system_message("El rol se desasino de manera correcta");
} else {
    system_messages("Error al asignar el rol", "error");
}
set_input("id", $id_user);
echo elgg_view('roles/asignar_roles_usuario');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

