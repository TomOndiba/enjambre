<?php

/**
 * Action que almacena la informacion de diligenciada de la bitacora 7
 * @author DIEGOX_CORTEX
 */
$bitacora = new Elgg_Bitacora7(get_input('bitacora'));
$aspectos = get_input('aspectos', '', false);
$capacidades = get_input('capacidades', '', false);
$cambios = get_input('cambios', '', false);
$caracteristicas = get_input('caracteristicas', '', false);
$t11 = get_input('t11', '', false);
$t12 = get_input('t12', '', false);
$t13 = get_input('t13', '', false);
$t21 = get_input('t21', '', false);
$t22 = get_input('t22', '', false);
$t23 = get_input('t23', '', false);
$t31 = get_input('t31', '', false);
$t32 = get_input('t32', '', false);
$t33 = get_input('t33', '', false);

# to inspect
//$archivo = get_input('archivo', '', false);
//$name = $_FILES['archivo']['name'];
//$error = $_FILES['archivo']['error'];
//$tmp_name = $_FILES['archivo']['tmp_name'];
//$type = $_FILES['archivo']['type'];
//$other_name = "archivo";
//$guid = elgg_upload_file($archivo, $id_file, $name, $error, $tmp_name, $type, $bitacora->guid, $other_name, $bitacora);


$bitacora->aspectos = $aspectos;
$bitacora->capacidades = $capacidades;
$bitacora->cambios = $cambios;
$bitacora->caracteristicas = $caracteristicas;
$bitacora->t11 = $t11;
$bitacora->t12 = $t12;
$bitacora->t13 = $t13;
$bitacora->t21 = $t21;
$bitacora->t22 = $t22;
$bitacora->t23 = $t23;
$bitacora->t31 = $t31;
$bitacora->t32 = $t32;
$bitacora->t33 = $t33;

if($bitacora->save()){
    system_message('La bitacora se ha modifiado exitosamente.', 'success');
}else{
    register_error('No se ha completado la acción, intentelo de nuevo...');
}

forward(REFERER);


