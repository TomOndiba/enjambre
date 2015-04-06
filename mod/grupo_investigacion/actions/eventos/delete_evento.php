<?php

/**
 * Action que elimina un evento de un grupo de investigacion
 * @author DIEGOX_CORTEX
 */

$guid_ev = get_input('id');

error_log("ELIMINANDO $guid_ev");

forward(REFERER);