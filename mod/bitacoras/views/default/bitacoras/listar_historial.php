<?php

$anotations=$vars['anotations'];
$page=$vars['page'];
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

$boton='<a href="' . $site_url . 'grupo_investigacion/ver/'.$grupo[0]->guid.'/cuadernos/'.$cuaderno[0]->guid.'" > Volver Bitacoras</a>';

$list= "<div class='box'>{$boton} <br><br> <h2 class='title-legend'> Historial de {$page->title}</h2> <ul class='elgg-list elgg-list-annotation elgg-annotation-list'>";

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
         . ' <a href="' . $site_url . 'grupo_investigacion/bitacoras/ver_anotacion_historial/' . $anot->id . '/'.$page->guid.'" >'. $page->title.'</a></h3>'
         . "<span class='elgg-subtext'> Revisión de hace $date creada por $editor_link</span>"
         . "</div></div></div></li>";
   
   
     
    
}

$list.="</ul></div>";

echo $list;