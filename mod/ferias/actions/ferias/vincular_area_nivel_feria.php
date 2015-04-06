<?php

/* 
 *Action que permite realizar la vinculación de áreas y niveles a una feria.
 */

$guid_feria = get_input('guid_feria');
$niveles = get_input('niveles_no');
$areas = get_input('areas_no');

$feria = new ElggFeria($guid_feria);

$valorN = 0;
$valorA = 0;

if(sizeof($niveles)>0){
    foreach ($niveles as $n){
        $feria->addRelationship($n, 'tiene_el_nivel');
        $valorN = $valorN+1;
    }    
}

if(sizeof($areas)>0){
    foreach ($areas as $a){
        $feria->addRelationship($a, 'tiene_el_area');
        $valorA = $valorA+1;
    }
}

if($valorN == sizeof($niveles) || $valorA == sizeof($areas)){
    system_message(elgg_echo('feria:asociacion:ok'), 'success');
    forward(elgg_get_site_url()."ferias/asociar/{$guid_feria}");
}else{
    register_error(elgg_echo('feria:asociacion:fail'));
}
