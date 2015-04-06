<?php

$guid_convocatoria=  get_input('id_convocatoria');
$guid_linea_ant=  get_input('id_linea_ant');
$guid_linea_nueva=  get_input('lineas');
$guid_investigacion=  get_input('id_investigacion');

$relacion="preinscrita_a_".$guid_convocatoria."_con_linea_tematica";

$investigacion=new ElggInvestigacion($guid_investigacion);

if($investigacion->removeRelationship($guid_linea_ant, $relacion)){
    if($investigacion->addRelationship($guid_linea_nueva, $relacion)){
        system_message(elgg_echo("cambio:linea:investigacion:ok"));
    }else{
        $investigacion->addRelationship($guid_linea_nueva, $relacion);
        register_error(elgg_echo("cambio:linea:investigacion1:error"));
    }
}else{
    register_error(elgg_echo("cambio:linea:investigacion2:error"));
}

forward(REFERER);

