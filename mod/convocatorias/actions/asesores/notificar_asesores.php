<?php

$conv = get_input("id_conv");
$convocatoria= new ElggConvocatoria($conv);
$asesores_vinculados=  elgg_get_asesores_asignados_convocatoria($convocatoria->guid);
$asesores_no_vinculados= elgg_get_asesores_no_asignados_convocatoria($convocatoria->guid);
elgg_notificar_asesores_convocatoria($asesores_vinculados,$asesores_no_vinculados);
system_messages("notificacion:asesor:convocatoria", "success");
forward("/convocatorias/detalles/{$conv}");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

