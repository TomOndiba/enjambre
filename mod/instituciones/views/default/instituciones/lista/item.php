<?php

$entity = $vars['entity'];
$grupo = new ElggInstitucion($entity->guid);
$var = array('guid' => $grupo->guid,
    'owner_guid' => $grupo->owner_guid);
$title_link = elgg_extract('title', $vars, '');
$url='instituciones/ver/' . $entity->guid;
$absolute_url=  elgg_get_site_url().$url;
if ($title_link === '') {
    if (isset($entity->title)) {
        $text = $entity->title;
    } else {
        $text = $entity->name;
    }
    
    $titulo=  mb_substr(elgg_get_excerpt($text, 100),0,60,'UTF-8');
    $params = array(
        'text' => $titulo,
        'href' => $url,
        'is_trusted' => true,
    );
    $title_link = elgg_view('output/url', $params);
}
$url_icono=$grupo->getIconURL();
$subtittle = elgg_list_entities_from_relationship(array(
        'relationship' => 'es_miembro_de',
	'relationship_guid' => $grupo->guid,
	'inverse_relationship' => true,
	'type' => 'user',
        'size'=>'tiny',
	'limit' => 6,
	'list_type' => 'gallery',
	'gallery_class' => 'elgg-gallery-users',
	'pagination' => false
));
if(!$subtittle){
    $subtittle="<p>La institucion no tiene miembros<p>";
}

//echo elgg_view("instituciones/lista/option", $var);
//echo"</div></div>";
?>
<li>
    <div class="imagen-grupo">
        <a href="<?php echo $absolute_url;?>"> <img src="<?php echo $url_icono;?>"/></a>
    </div>
    <div class="nombre-grupo" data-tooltip="<?php echo $entity->name?>">
        <h4><?php echo $title_link;?></h4>
    </div>
</li>

