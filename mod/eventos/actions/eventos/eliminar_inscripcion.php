<?php

$guid_user= elgg_get_logged_in_user_entity();
$guid_evento= get_input("id_evento");
$evento = new ElggEvento($guid_evento);
$retorno=$evento->eliminarInscripcion($guid_user->guid);
if($retorno){
    system_message(elgg_echo("ok:desinscripcion:eventos"));
}else{
    system_message(elgg_echo("error:desinscripcion:eventos"));
}
forward(REFERER);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

