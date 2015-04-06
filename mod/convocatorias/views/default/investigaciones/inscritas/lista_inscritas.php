<?php

$entities = $vars['entities'];
$guid_linea = $vars['guid'];
$guid_conv = $vars['id_conv'];
$tabla_inscritas = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th>Evaluador</th><th>Opciones</th></tr></thead><tbody>";
if (!$entities) {
    echo "<br><b>No existen Investigaciones</b>";    
} else {
    foreach ($entities as $entity) {
      
        $url="investigaciones/ver/{$entity->guid}/convocatoria/$guid_conv";
        $params = array(
            'text' => elgg_view('output/longtext',array('value'=>$entity->name)),
            'href' => $url,
            'is_trusted' => true,
        );
        $title_link = elgg_view('output/url', $params);
        
        //Obtener el evaluador asignado
        $evaluadores_aceptados = elgg_get_relationship_inversa($entity, 'es_evaluador_de');
        
        if(sizeof($evaluadores_aceptados)>0){
          $name= "Cambiar Evaluador";
        }
        else{            
          $name= "Asignar Evaluador";
        }
        
        $asignar_eval = "<div align='center'><a id='asignar' data-reveal-id='myModal' onclick=abrirform({$entity->guid});>{$name}</a></div>";
        $tabla_inscritas.="<tr>"
                . "<td>{$title_link}</td>"
                . "<td>{$evaluadores_aceptados[0]->name} {$evaluadores_aceptados[0]->apellidos}</td>"
                . "<td> $asignar_eval</td>"
                . "</tr>";
    }
    $tabla_inscritas.="</tbody></table>";
    echo "<br>".$tabla_inscritas;
}
?>
<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
                <div class="form-asesor-evaluador" id="pop-up-form">
                    <div class='titulo-pop-up'>
                        <h2>Seleccionar Evaluador</h2>
                    </div>
                    <div class="content-pop-up" id='content-pop-up'>
                        
                    </div>
                </div>
</div>