<?php


$entity = $vars['entity'];
$guid= $vars['guid'];
$investigacion = new ElggInvestigacion($entity->guid);
$var = array('guid' => $investigacion->guid, 'id_grupo'=>$guid,
    'owner_guid' => $investigacion->owner_guid);
$title_link = elgg_extract('title', $vars, '');
$url="investigaciones/ver/{$entity->guid}/grupo/$guid";
if ($title_link === '') {
    if (isset($entity->title)) {
        $text = $entity->title;
    } else {
        $text = $entity->name;
    }
    
    $titulo=  mb_substr(elgg_get_excerpt($text, 100),0,50,'UTF-8');
    $params = array(
        'text' =>$titulo,
        'href' => $url,
        'is_trusted' => true,
    );
    $title_link = elgg_view('output/url', $params);
}

echo "<li><div class='imagen-investigacion'></div>";
    echo "<div class='nombre-cuaderno-list'  data-tooltip='{$entity->name}'><h4>$title_link</h4>";
    echo elgg_view("cuaderno_campo/lista/option", $var);

echo"</div></li>";
