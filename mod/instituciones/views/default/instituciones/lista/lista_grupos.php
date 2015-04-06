<ul class='list-usuarios'>
<?php

$entities=$vars['entities'];
if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No Hay Grupos de Investigación que pertenezcan a esta Institución</h2></div>";
}
else{
     echo "<ul class='list-usuarios'>";
foreach($entities as $entity){
    $entity_data= array("entity"=>$entity);
    echo elgg_view("instituciones/lista/item_grupos",$entity_data);
}
 echo "</ul>";
}
?>

</ul>
