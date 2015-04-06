<?php

$options = array(
	'type' => 'user',
	'limit' => 40,
);
$entities = elgg_get_entities($options);
$resultado="";
$i=0;
foreach($entities as $entity){
    if($i==15){
        break;
    }
    $usuario= new ElggUser($entity->guid);
    $resultado.="<li class='item-galeria-imagenes'><img src='{$usuario->getIconURL()}' title='$usuario->name' style='height:94%; margin:3%; border-radius:5px;'></img></li>";
    $i++;    
    }
echo $resultado;