<?php

$entity = $vars['entity'];
$guid= $vars['guid'];
$cuaderno = new ElggCuadernoCampo($entity->guid);
$var = array('guid' => $cuaderno->guid, 'id_grupo'=>$guid,
    'owner_guid' => $cuaderno->owner_guid);
$title_link = elgg_extract('title', $vars, '');
$url= "grupo_investigacion/ver/{$guid}/cuadernos/{$entity->guid}";

if ($title_link === '') {
    if (isset($entity->title)) {
        $text = $entity->title;
    } else {
        $text = $entity->name;
    }
    
    $titulo=  mb_substr(elgg_get_excerpt($text, 100),0,50,'UTF-8');
  
    $params = array(
        'text' =>$titulo ,
        'href' => $url,
        'is_trusted' => true,
    );
    $title_link = elgg_view('output/url', $params);
}



echo "<li><div class='cuaderno'></div>";
    echo "<div class='nombre-cuaderno-list' data-tooltip='{$entity->name}'><h4>$title_link</h4>";
    echo elgg_view("cuaderno_campo/lista/option", $var);

echo"</div></li>";

