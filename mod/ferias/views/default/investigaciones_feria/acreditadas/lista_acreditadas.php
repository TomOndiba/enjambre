<?php

$entities = $vars['entities'];
$guid_feria = $vars['guid'];
$feria=new ElggFeria($guid_feria);
$tabla_acreditadas = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th colspan='2'>Opciones</th></tr></thead><tbody>";
echo "<div style='display:none;' id='dialog_eval' title='Asignar Evaluador'><p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span></p></div>";
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
        $asignar_eval = "<br><div align='center'><a id='asignar' onclick=abrirform({$entity->guid});>Asignar Evaluador Inicial</a></div>";
        
        if($feria->tipo_feria=='Departamental'){
            $inscripcion=  elgg_get_relationship($entity, "inscrita_en_".$guid_feria."_con");
            $url2 = elgg_get_site_url() . "action/bitacoras/print?id=" . $inscripcion[0]->guid . '&bit=92';
            $url_formato = elgg_add_action_tokens_to_url($url2);
            $formato= "<td><a href='$url_formato'>Formato de Inscripción</a></td>";
        }
        
        $tabla_acreditadas.="<tr>"
                . "<td>{$title_link}</td>"
                . "$formato"
                . "<td>$asignar_eval</td>";
    }
    $tabla_acreditadas.="</tbody></table>";
    
    echo $tabla_acreditadas;
    
}