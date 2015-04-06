<?php
$algo='';


$id= $vars['guid'];
$options=array('relationship'=>'pertenece_a',
        'relationship_guid'=>$id,
    'inverse_relationship'=> false
        );

$instituciones= elgg_get_entities_from_relationship($options);
$institucion= new ElggInstitucion($instituciones[0]->guid);
$link = "<a href=\"{$institucion->getURL()}\"><b>{$institucion->name}</b></a>";
echo <<<HTML
<div class='grupo-investigacion-miembros box'>
        <div class='tittle-box'>Instituciones</div>
        <div class="img-intitucion-grupo"><a href="{$institucion->getUrl()}"><img src='{$institucion->getIconURL()}'/></a></div>   
        <div class="name-institucion-grupo">{$link}</div>
        </div>
HTML;
