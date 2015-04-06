<?php
/**
 * Vista que imprime en pantalla un recuadro con la información básica de la convocatoria
 */
$entity = $vars['entity'];
$linea = new ElggRedTematica($entity->guid);
$var = array('guid' => $linea->guid,
    'owner_guid' => $linea->owner_guid);
$title_link = elgg_extract('title', $vars, '');
//$url='convocatorias/detalles/' . $entity->guid;
//$absolute_url=  elgg_get_site_url().$url;
if ($title_link === '') {
    if (isset($entity->title)) {
        $text = $entity->title;
    } else {
        $text = $entity->name;
    }
    $params = array(
        'text' => elgg_get_excerpt($text, 100),
        'href' => $url,
        'is_trusted' => true,
    );
    $title_link = elgg_view('output/url', $params);
}
$asesor= get_entity($linea->owner_guid);
echo "<div class='item-convocatoria'>";
    echo "<h3>$title_link</h3>";
    echo "<div class='menu-item-coordinacion'>".elgg_view("linea_tematica/lista/option", $var)."</div>";
        echo "<div class='subtitulo-convocatoria'><span style='color:black'>Asesor:</span>"
    . "<a href='".  elgg_get_site_url()."profile/{$asesor->username}'>$asesor->name $asesor->apellidos</a><br>"
        . "Descripcion: $linea->description</div>";

echo"</div>";

