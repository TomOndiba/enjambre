<?php

$entities = $vars['entities'];
$guid_feria = $vars['guid'];
$tabla_evaluadas = "<table class='tabla-coordinador'>"
                    . "<thead><tr>"
                    . "<th>Investigacion</th>"
                    . "<th>Categoría</th>"
                    . "<th>Puntaje</th>"
                    . "<th colspan='2'>Opciones</th></tr></thead><tbody>";
if (!$entities) {
    echo "<b>No existen investigaciones</b>";
} else {

    $investigaciones=array();
    foreach ($entities as $entity) {

        $inv = array();
        $url = "investigaciones/ver/{$entity->guid}/feria/$guid_feria";
        $params = array(
            'text' => elgg_view('output/longtext', array('value' => $entity->name)),
            'href' => $url,
            'is_trusted' => true,
        );
        $title_link = elgg_view('output/url', $params);
        $inv['title_link'] = $title_link;
        $inv['puntaje_total'] = $entity->puntaje_feria_municipal;
        $categoria=$entity->categoria_inv;
        $inv['categoria']=$categoria;

        $url = elgg_get_site_url() . "action/ferias/quitar_finalista?id_inv=" . $entity->guid . "&id_feria=" . $guid_feria;
        $no_finalista = elgg_add_action_tokens_to_url($url);

        $inv['url'] = $no_finalista;

        array_push($investigaciones, $inv);
    }

    //ordenar las investigaciones de acuerdo a su puntaje en forma descendente
    usort($investigaciones, "cmpPuntajesDesc");
    
    foreach ($investigaciones as $invest) {
        $title_link = $invest['title_link'];
        $categoria=$invest['categoria'];
        $puntaje = $invest['puntaje_total'];
        $no_finalista = $invest['url'];


        $tabla_evaluadas.="<tr>"
                . "<td>{$title_link}</td>"
                . "<td>$categoria</td>"
                . "<td>{$puntaje}</td>"
                . "<td><a href='$no_finalista'>Quitar finalista</a></td></tr>";
    }

    $tabla_evaluadas.="</tbody></table>";

    echo $tabla_evaluadas;
}