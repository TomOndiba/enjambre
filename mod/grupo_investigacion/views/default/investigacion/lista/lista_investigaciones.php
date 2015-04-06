<ul class="lista-cuadernos">
<?php
$entities=$vars['entities'];
$guid=$vars['guid'];
if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No Hay Investigaciones Registradas</h2></div>";
}
else{
foreach($entities as $entity){
    $entity_data= array("entity"=>$entity, "guid"=>$guid);
    echo elgg_view("investigacion/lista/item",$entity_data);
}
}
?>

</ul>