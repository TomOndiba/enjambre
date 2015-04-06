<?php
$entities=$vars['entities'];
foreach($entities as $entity){
    $entity_data= array("entity"=>$entity);
    echo elgg_view("grupo_investigacion/miembros/lista/item",$entity_data);
}
?>