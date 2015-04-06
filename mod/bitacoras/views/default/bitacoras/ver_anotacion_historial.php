<?php


$id=$vars['anotacion'];
if(!$id){
 $id=get_input('anotacion');
}

$anotation=  elgg_get_annotation_from_id($id);

$page_in=get_input('bitacora',$vars['page']->guid);
$page=  get_entity($page_in);

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

if($cuaderno[0]->getSubtype()=="cuaderno_campo"){
$boton='<a href="' . $site_url . 'grupo_investigacion/ver/'.$grupo[0]->guid.'/cuadernos/'.$cuaderno[0]->guid.'" > Volver Bitacoras</a>';
}
$list= "<div class='box'> {$boton}  <br><br><h2 class='title-legend'> Anotación de {$page->title}</h2>";
$list.= "<div class='text-anotacion'><br>{$anotation->value}<br></div>";

echo $list;