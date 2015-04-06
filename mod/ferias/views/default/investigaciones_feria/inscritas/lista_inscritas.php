<?php

$entities = $vars['entities'];
$guid_feria = $vars['guid'];
$feria= new ElggFeria($guid_feria);
$tabla_inscritas = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th colspan='2'>Opciones</th></tr></thead><tbody>";
if (!$entities) {
    echo "<b>No existen investigaciones</b>";
} else {
    foreach ($entities as $entity) {
        
        $url="investigaciones/ver/{$entity->guid}/feria/$guid_feria";
        $params = array(
            'text' => elgg_view('output/longtext',array('value'=>$entity->name)),
            'href' => $url,
            'is_trusted' => true,
         );
        $title_link = elgg_view('output/url', $params);
        
        $url1 = elgg_get_site_url() . "action/ferias/acreditar?id_inv=" . $entity->guid . "&id_feria=" . $guid_feria;
        $url_aprobar = elgg_add_action_tokens_to_url($url1);
        $inscripcion=  elgg_get_relationship($entity, "inscrita_en_".$guid_feria."_con");
        $url2 = elgg_get_site_url() . "action/bitacoras/print?id=" . $inscripcion[0]->guid . '&bit=92';
        $url_formato = elgg_add_action_tokens_to_url($url2);
        
        $tabla_inscritas.="<tr>"
                . "<td>{$title_link}</td>"
                . "<td><a href='$url_formato'>Formato de Inscripción</a></td>"
                . "<td><a href='$url_aprobar'>Acreditar</a></td>"
                . "</tr>";
    }
    $tabla_inscritas.="</tbody></table>";
    
    echo $tabla_inscritas;
    
}