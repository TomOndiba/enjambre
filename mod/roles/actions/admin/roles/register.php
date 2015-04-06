<?php

$nombre_rol = get_input("nombre_rol");
$descripcion= get_input('descripcion');

$rol = new ElggRol();
$rol->title = $nombre_rol;
$rol->description= $descripcion;

$guid_rol = $rol->save();
if ($guid) {
    system_message(elgg_echo("error:existe:rol:create"));
    forward(REFERER);
} else {
    system_message(elgg_echo("okay:rol:create"));
    forward('/roles/');
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

