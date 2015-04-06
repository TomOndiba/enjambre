<?php
/**
 * Eliminar las relaciones existentes entre una convocatoria y unas líneas temáticas dadas
 */

$id_convocatoria=get_input('id');
$linea=get_input('linea');

$convocatoria= new ElggConvocatoria($id_convocatoria);

if(!$convocatoria->removeRelationship($linea, 'tiene_la_línea_temática')){
    register_error(elgg_echo("convocatoria:error:delete:rel_lin_conv"));
    forward(REFERER);
}else{
    system_message(elgg_echo("convocatoria:ok:delete:rel_lin_conv"));
    forward('/convocatorias/lineas/'.$id_convocatoria);
}
