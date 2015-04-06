<?php

$id_inv=  get_input('id_inv');
$id_feria= get_input('id_feria');

$investigacion= new ElggInvestigacion($id_inv);

if($investigacion->addRelationship($id_feria, "evaluada_en_sitio_en")){
     $investigacion->removeRelationship($id_feria, "finalista_en");
    
     system_message(elgg_echo("no:finalista:feria:ok"));
}else{
   
    register_error(elgg_echo("no:finalista:feria:error"));
}

forward("/ferias/investigaciones/$id_feria#finalistas");