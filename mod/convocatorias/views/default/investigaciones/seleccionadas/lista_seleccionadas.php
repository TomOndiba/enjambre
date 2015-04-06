<?php

$entities = $vars['entities'];
$guid_linea = $vars['guid'];
$guid_conv = $vars['id_conv'];
$tabla_seleccionadas = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th colspan='2'>Opciones</th></tr></thead><tbody>";
echo "<div style='display:none;' id='acta' title='Acta de Seleccion'><p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span></p></div>";
if(!$entities){
    echo "<br><b>No existen Investigaciones</b>";
}else{
    
    foreach ($entities as $entity) {
        
        
        $url="investigaciones/ver/{$entity->guid}";
        $params = array(
        'text' => elgg_view('output/longtext',array('value'=>$entity->name)),
        'href' => $url,
        'is_trusted' => true,
         );
        $title_link = elgg_view('output/url', $params);
        
        
        $asesor=elgg_exite_asesor_asignado($entity->guid);
        if ($asesor) {
            $class = "success";
            $text_link= "Cambiar Asesor";
        } else {
            $class = "error";
            $text_link= "Asignar Asesor";
        }
        $asignar_asesor = "<div align='center'><a id='asignar' data-reveal-id='myModal'  onclick=abrirformasesor({$entity->guid});>Asignar Asesor</a></div>";
        $acta_seleccion ="<div align='center'><a data-reveal-id='myModal-acta' onclick=abrirformActa({$entity->guid});>Generar Acta</a></div>";
        $tabla_seleccionadas.="<tr>"
                . "<td>{$title_link}</td>"
                . "<td>$asignar_asesor</td>"
                . "<td>$acta_seleccion</td>"
                . "</tr>";
    }
    $tabla_seleccionadas.="</tbody></table>";
    
    echo "<br>".$tabla_seleccionadas;
}
?>
<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
                <div class="form-asesor-evaluador" id="pop-up-form">
                    <div class='titulo-pop-up'>
                        <h2>Seleccionar Asesor</h2>
                    </div>
                    <div class="content-pop-up" id='content-pop-up'>
                        
                    </div>
                </div>
</div>

<div id="myModal-acta" class="reveal-modal">
    <div class="close-reveal-modal"></div>
                <div class="form-asesor-evaluador" id="pop-up-form">
                    <div class='titulo-pop-up'>
                        <h2>Generar Acta</h2>
                    </div>
                    <div class="content-pop-up" id='content-pop-up-asesor'>
                        
                    </div>
                </div>
</div>