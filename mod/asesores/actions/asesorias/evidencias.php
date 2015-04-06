<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

elgg_load_library('tidypics:upload');
$inv = get_input('id_inv');
$ase = get_entity(get_input('ases'));

$archivo = get_input('archivo2', '', false);
$name = $_FILES['archivo2']['name'];
$error = $_FILES['archivo2']['error'];
$tmp_name = $_FILES['archivo2']['tmp_name'];
$type = $_FILES['archivo2']['type'];
$other_name = "archivo2";
elgg_upload_fileS($archivo, $id_file, $name, $error, $tmp_name, $type,  $ase->guid, $other_name, $ase, $ase->guid);


system_message("Archivos subidos", 'success');
forward(REFERER);
