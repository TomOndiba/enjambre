
<ul>
<?php

$entities=$vars['entities'];
foreach($entities as $entity){
    $entity_data= array("entity"=>$entity);
    echo elgg_view("instituciones/lista/item",$entity_data);
}
?>

</ul>