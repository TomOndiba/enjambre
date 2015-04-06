<?php
/**
 * History of revisions of a page
 *
 * @package ElggPages
 */
elgg_load_css('logged');

$page_guid = get_input('guid');
$page=  get_entity($page_guid);
$anotations = elgg_get_annotations(array(
		'guid' => $page_guid,
		'annotation_name' => 'bitacora',
		'limit' => 20,
		'order_by' => "n_table.time_created desc"
));


$site_url=  elgg_get_site_url();

$cuaderno = elgg_get_entities_from_relationship(array(
    'relationship' => 'tiene_la_bitacora',
    'relationship_guid' => $page->guid,
    'inverse_relationship'=>true,
        ));


$grupo=elgg_get_entities_from_relationship(array(
    'relationship' => 'tiene_cuaderno_campo',
    'relationship_guid' => $cuaderno[0]->guid,
    'inverse_relationship'=>true,
        ));



$list= "<br> <h2 class='title-legend'> Historial de {$page->title}</h2> <ul class='elgg-list elgg-list-annotation elgg-annotation-list'>";

foreach ($anotations as $anot){
    $editor = get_entity($anot->owner_guid);
    $editor_link = elgg_view('output/url', array(
    'href' => "profile/$editor->username",
    'text' => $editor->name,
    'is_trusted' => true,
        ));

    $date = elgg_view_friendly_time($anot->time_created);
    $page_icon = elgg_view('bitacoras/icon', array('annotation' => $anot, 'size' => 'small'));
   
    $list.="<li class='elgg-item'>"
         . "<div class='elgg-image-block clearfix'>"
         . "<div class='elgg-image'>{$page_icon} </div>"
         . "<div class='elgg-body'><div class='mbn'><h3>"
         . '<div onclick=\' verAnotacionHistorial(' . $anot->id . ',' . $page_guid . ') \'>'. $page->title.'</div></h3>'
         . "<span class='elgg-subtext'> Revisión de hace $date creada por $editor_link</span>"
         . "</div></div></div></li>";
   
   
     
    
}

$list.="</ul>";

echo $list;



