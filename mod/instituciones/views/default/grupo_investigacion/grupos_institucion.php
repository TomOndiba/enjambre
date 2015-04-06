<?php

$id= $vars['guid_institucion'];
$options=array('relationship'=>'pertenece_a',
        'relationship_guid'=>$id,
    'inverse_relationship'=> true
        );
$gruposInvestigacion= elgg_get_entities_from_relationship($options);

$text="";


if (!$entities) {
    $text.= "<div class='mensaje-vacio'><h2>No Hay Grupos de Investigación que pertenezcan a esta Institución</h2></div>";
}
else{
foreach($gruposInvestigacion as $grupo){
    $grupo= new ElggGrupoInvestigacion($grupo->guid);
    $link = "<a href=\"{$grupo->getURL()}\"><b>{$grupo->name}</b></a>";
    $text.="<div class='item-list-grupos-left'>"
            . "<div class='imagen-item-list-grupo-left'><img src='{$grupo->getIconURL()}'/></div>"
            . "<div class='header-item-list-grupo-left'>$link</div>";
    $text.="</div>";
} 
}
echo $text;
