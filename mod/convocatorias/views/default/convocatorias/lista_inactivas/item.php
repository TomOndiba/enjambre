<?php
/**
 * Vista que imprime en pantalla un recuadro con la información básica de la convocatoria
 */
$entity = $vars['entity'];
//$convocatoria = new ElggConvocatoria($entity->guid);
$convocatoria = get_entity($entity->guid);
$var = array('guid' => $convocatoria->guid,
    'owner_guid' => $convocatoria->owner_guid);
$title_link = elgg_extract('title', $vars, '');
$url='convocatorias/detalles/' . $entity->guid;
$absolute_url=  elgg_get_site_url().$url;
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

echo "<div class='item-convocatoria'>";
    echo "<h3>$title_link</h3>";
    echo "<div class='menu-item-coordinacion'>".elgg_view("convocatorias/lista_inactivas/option", $var)."</div>";
        echo "<div class='subtitulo-convocatoria'>$convocatoria->tipo_convocatoria <br>"
        . "Apertura: $convocatoria->fecha_apertura &nbsp; &nbsp; Cierre: $convocatoria->fecha_cierre</div>";

echo"</div>";

