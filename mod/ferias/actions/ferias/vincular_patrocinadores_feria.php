<?php

/* 
 *Action que permite realizar la vinculación de patrocinadores a una feria.
 */

$guid_feria = get_input('guid_feria');
$patrocinadores = get_input('patrocinadores_no');
$feria = new ElggFeria($guid_feria);

$valorP = 0;

if(sizeof($patrocinadores)>0){
    foreach ($patrocinadores as $p){
        $feria->addRelationship($p, 'tiene_el_patrocinador');
        $valorP = $valorP+1;
    }    
}

if($valorP == sizeof($patrocinadores)){
    system_message(elgg_echo('patrocinadores:asociacion:ok'), 'success');
    forward(elgg_get_site_url()."ferias/asociar_patro/{$guid_feria}");
}else{
    register_error(elgg_echo('feria:asociacion:fail'));
}

