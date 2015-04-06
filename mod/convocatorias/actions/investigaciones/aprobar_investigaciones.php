<?php

$id_inv=  get_input('id_inv');
$id_conv= get_input('id_conv');
$id_linea=get_input('id_linea');

$investigacion= new ElggInvestigacion($id_inv);


  if($investigacion->addRelationship($id_conv, "inscrita_a_convocatoria")){
    if($investigacion->addRelationship($id_linea, "inscrita_a_".$id_conv."_con_linea_tematica")){
        system_message(elgg_echo("inscripcion:convocatoria:ok"));
        
        $investigacion->removeRelationship($id_conv, "preinscrita_a_convocatoria");
        $investigacion->removeRelationship($id_linea,"preinscrita_a_".$id_conv."_con_linea_tematica");
        
    }else{
        $investigacion->removeRelationship($id_conv, "inscrita_a_convocatoria");
        register_error(elgg_echo("inscripcion:convocatoria:error"));
    }
  }else{
      register_error(elgg_echo("inscripcion:convocatoria:error"));
  }

forward(REFERER);