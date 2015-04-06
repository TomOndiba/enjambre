<?php

$entities = $vars['entities'];
$guid_linea = $vars['guid'];
$guid_conv = $vars['id_conv'];
$tabla_preseleccionadas = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th>Concepto</th><th>Opciones</th></tr></thead><tbody>";

if (!$entities) {
 echo "<br><b>No hay Investigaciones</b>";    
} else {
    foreach ($entities as $entity) {
        
        //para generar el link que permite ver las investigaciones
        
        $url="investigaciones/ver/{$entity->guid}";
        $params = array(
        'text' => elgg_view('output/longtext',array('value'=>$entity->name)),
        'href' => $url,
        'is_trusted' => true,
         );
        $title_link = elgg_view('output/url', $params);
        
        
        // Busca la relacion del grupo con la investigacion  para enviar datos al formulario de registro y actualización
        $grupo= elgg_get_relationship_inversa($entity,"tiene_la_investigacion");

        // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
        $institucion=  elgg_get_relationship($grupo[0], "pertenece_a");
        $evaluaciones= elgg_get_relationship($entity,"tiene_la_evaluacion");
        $linea= elgg_get_relationship($entity, "inscrita_a_".$guid_conv."_con_linea_tematica");
        
                if(!empty($evaluaciones[0])){
        $user=  elgg_get_usuario_byId($evaluaciones[0]->owner_guid);
        }
        else
            $user= elgg_get_logged_in_user_entity ();


        $valorador=$user->name." ".$user->apellidos;
        
        //Url que permite ver la evaluacion
        $url_ver_evaluacion= elgg_get_site_url() . "action/bitacoras/print?id=" . $evaluaciones[0]->guid. '&bit=90&grupo='.$grupo[0]->guid.'&inst='.$institucion[0]->guid.'&inv='.$entity->guid.'&valorador='.$valorador.'&area='.$linea[0]->name;
        $url_print = elgg_add_action_tokens_to_url($url_ver_evaluacion);
        
         //Url que permite modificar la evaluacion
        // $url_evaluacion.='<a href="/elgg2/evaluadores/evaluar_investigacion/'.$entity->guid.'">Modificar</a>';
        $url_evaluacion="<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarModificarEvaluacion({$entity->guid})'>Modificar</a>";
        //url que aprueba la Investigacion Evaluada
        $url= elgg_get_site_url()."action/convocatorias/aprobar_financiacion?id_conv=".$guid_conv."&id_linea=".$guid_linea."&id_inv=".$entity->guid;
        $url1= elgg_add_action_tokens_to_url($url);

        if($evaluaciones[0]->puntaje_total<18){
          $url_aprobar="";
        }
        else{
          $url_aprobar="<a href='$url1'>Aprobar financiación</a>"; 
        }
        
        $tabla_preseleccionadas.="<tr>"
                . "<td>{$title_link}</td>"
                . "<td>{$evaluaciones[0]->concepto}&nbsp; <a href='".$url_print."'>Ver Concepto</a> &nbsp; {$url_evaluacion}</td>"
                . "<td>$url_aprobar</td>"
                . "</tr>";
    }
    $tabla_preseleccionadas.="</tbody></table>";
    echo "<br>".$tabla_preseleccionadas;
    
}
?>

<div id="myModal" class="reveal-modal pop-up-mas-ancha">
    <div class="close-reveal-modal"></div>
                <div class="form-asesor-evaluador" id="pop-up-form">
                    <div class='titulo-pop-up'>
                        <h2>Modificar Concepto de Evaluacion</h2>
                    </div>
                    <div class="content-pop-up" id='content-pop-up'>
                        
                    </div>
                </div>
</div>