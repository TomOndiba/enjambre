<?php

$guid_grupo=  get_input('id_grupo');


$guid_investigacion=  get_input('id_investigacion');
$guid_convocatoria=  get_input('convocatorias');
$guid_linea_tematica=  get_input('lineas');


$investigacion= new ElggInvestigacion($guid_investigacion);

if($investigacion->addRelationship($guid_convocatoria, "preinscrita_a_convocatoria")){
    if($investigacion->addRelationship($guid_linea_tematica, "preinscrita_a_".$guid_convocatoria."_con_linea_tematica")){
        system_message(elgg_echo("inscripcion:convocatoria:ok"));
        $investigacion->linea_tematica=$guid_linea_tematica;
        $investigacion->save();
        forward("investigaciones/ver/$guid_investigacion/grupo/$guid_grupo");
    }else{
        $investigacion->removeRelationship($guid_convocatoria, "preinscrita_a_convocatoria");
        register_error(elgg_echo("inscripcion:convocatoria:error"));
        forward(REFERER);
    }
}else{
    register_error(elgg_echo("inscripcion:convocatoria:error"));
    forward(REFERER);
}