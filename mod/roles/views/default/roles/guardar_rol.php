<?php

$id_rol = get_input('rol');
$id_user = get_input('user');
$rol= new ElggRol($id_rol);
if($rol->title=="coordinador"){
    $relaciones=get_entity_relationships($id_user,false);
    foreach($relaciones as $relacion){
        if($relacion->relationship=='trabaja_en' || $relacion->relationship=='estudia_en'){
          delete_relationship($relacion->id);
        }       
    }
}
if (elgg_asignar_rol_usuario($id_rol, $id_user)) {
    system_message("El rol fue asignado correctamente");
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

