<?php

/**
 * Action que almacena la informacion de diligenciada de la bitacora 8
 * @author DIEGOX_CORTEX
 */
$bitacora = new Elgg_Bitacora8(get_input('bitacora'));

$ensayo = get_input('ensayo','',false);
$t11 = get_input('t11', '', false);
$t12 = get_input('t12', '', false);
$t13 = get_input('t13', '', false);
$t14 = get_input('t14', '', false);
$t15 = get_input('t15', '', false);
$t21 = get_input('t21', '', false);
$t22 = get_input('t22', '', false);
$t23 = get_input('t23', '', false);
$t24 = get_input('t24', '', false);
$t25 = get_input('t25', '', false);
$t31 = get_input('t31', '', false);
$t32 = get_input('t32', '', false);
$t33 = get_input('t33', '', false);
$t34 = get_input('t34', '', false);
$t35 = get_input('t35', '', false);

$bitacora->ensayo = $ensayo;
$bitacora->t11 = $t11;
$bitacora->t12 = $t12;
$bitacora->t13 = $t13;
$bitacora->t14 = $t14;
$bitacora->t15 = $t15;
$bitacora->t21 = $t21;
$bitacora->t22 = $t22;
$bitacora->t23 = $t23;
$bitacora->t24 = $t24;
$bitacora->t25 = $t25;
$bitacora->t31 = $t31;
$bitacora->t32 = $t32;
$bitacora->t33 = $t33;
$bitacora->t34 = $t34;
$bitacora->t35 = $t35;


if($bitacora->save()){
    system_message('Se ha almacenado con éxito...', 'success');
}else{
    register_error('No se ha completado la acción, intentelo de nuevo...');
}

forward(REFERER);