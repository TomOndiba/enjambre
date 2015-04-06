<?php
/**
 * Vista que imprime en pantalla un item por cada entidad (convocatoria) existente
 */

$entities=$vars['entities'];


if(sizeof($entities)!=0){
foreach($entities as $entity){
    $entity_data= array("entity"=>$entity);
    echo elgg_view("convocatorias/lista/item",$entity_data);
}

}
else{
   echo "<br><span class='titulo-list-inicio'>No Hay Convocatorias Registradas</span><br><br>";
}

?>

