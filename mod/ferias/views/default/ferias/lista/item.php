<?php
/**
 * Vista que imprime en pantalla un recuadro con la información básica de la feria
 */
$entity = $vars['entity'];
$feria = new ElggFeria($entity->guid);
$var = array('guid' => $feria->guid,
    'owner_guid' => $feria->owner_guid);
$title_link = elgg_extract('title', $vars, '');
$url='ferias/detalles/' . $entity->guid;
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
    echo "<div class='menu-item-coordinacion'>".elgg_view("ferias/lista/option", $var)."</div>";
        echo "<div class='subtitulo-convocatoria'>$feria->tipo_feria</br>"
        . "Inicia: $feria->fecha_inicio_feria &nbsp; &nbsp; Termina: $feria->fecha_fin_feria</div>";

echo"</div>";

