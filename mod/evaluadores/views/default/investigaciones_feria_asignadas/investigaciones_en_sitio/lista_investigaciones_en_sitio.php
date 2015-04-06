<?php



/** Vista que permite mostrar todas las investigaciones de una feria dada 
 * que fueron asignadas al evaluador para realizar su evaluación en sitio */
$entities = $vars['entities'];
$guid_feria = $vars['guid_entity'];
$tipo = $vars['participa']; //municipal, departamental

$user = elgg_get_logged_in_user_entity();
$url_site = elgg_get_site_url();

$tabla_inv = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th>Opciones</th></tr></thead><tbody>";

if (!$entities) {
    echo "<b>No tiene asignadas Investigaciones</b>";
} else {

    foreach ($entities as $entity) {

        if (check_entity_relationship($entity->guid, "participa_en_$tipo", $guid_feria)) {

            $url = "investigaciones/ver/{$entity->guid}/evaluador_feria/$user->guid/$guid_feria";
            $params = array(
                'text' => elgg_view('output/longtext', array('value' => $entity->name)),
                'href' => $url,
                'is_trusted' => true,
            );
            $title_link = elgg_view('output/url', $params);

            $categoria = $entity->categoria_inv;

            if ($categoria == "Innovación") {
                //formato 3.1
                $evaluaciones = elgg_get_relationship($entity, "evaluada_3_en_" . $guid_feria . "_con");
                if (sizeof($evaluaciones) != 0) {
                    $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarSustentacionOralINN({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
//                    $lista = "<a href='" . $url_site . "evaluadores/evaluar_sustentacion_oral_INN/" . $guid_feria . "/" . $entity->guid . '/' . $evaluaciones[0]->guid . "'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
                } else {
                    $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarSustentacionOralINN({$guid_feria}, {$entity->guid})'>Valorar Sustentación Oral de Investigación</a>";
//                    $lista = "<a href='" . $url_site . "evaluadores/evaluar_sustentacion_oral_INN/" . $guid_feria . "/" . $entity->guid . "'>Valorar Sustentación Oral de Investigación</a>";
                }
            } else if ($categoria == "Investigación") {
                //formato 3.2
                $evaluaciones = elgg_get_relationship($entity, "evaluada_3_en_" . $guid_feria . "_con");
                if (sizeof($evaluaciones) != 0) {
                    $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarSustentacionOralINV({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
                    //$lista = "<a href='" . $url_site . "evaluadores/evaluar_sustentacion_oral_INV/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones[0]->guid . "'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
                } else {$lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarSustentacionOralINV({$guid_feria}, {$entity->guid})'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
                    //$lista = "<a href='" . $url_site . "evaluadores/evaluar_sustentacion_oral_INV/" . $guid_feria . "/" . $entity->guid . "'>Valorar Sustentación Oral de Investigación</a>";
                }
            }

            //formato 2.2
            $evaluaciones1 = elgg_get_relationship($entity, "evaluada_2.2_en_" . $guid_feria . "_con");
           
            if (sizeof($evaluaciones1) != 0) {
                $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarConceptoValoraciónPonenciaOral({$guid_feria}, {$entity->guid}, {$evaluaciones1[0]->guid})'>Modificar Concepto Valoración Ponencia Oral del Maestro</a>";
                //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_oral/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones1[0]->guid . "'>Modificar Concepto Valoración Ponencia Oral del Maestro</a>";
            } else {
                $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarConceptoValoraciónPonenciaOral({$guid_feria}, {$entity->guid})'>Valorar Ponencia Oral del Maestro</a>";
                //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_oral/" . $guid_feria . "/" . $entity->guid . "'>Valorar Ponencia Oral del Maestro</a>";
            }

            $tabla_inv.="<tr>"
                    . "<td rowspan='2'>{$title_link}</td>"
                    . "<td>$lista</td></tr>"
                    . "<tr><td>$lista1</td></tr>";
        }
    }
    $tabla_inv.="</tbody></table>";

    echo $tabla_inv;
}
?>

<div id="myModal" class="reveal-modal pop-up-mas-ancha">
    <div class="close-reveal-modal"></div>
    <div class="form-asesor-evaluador" id="pop-up-form">
        <div class='titulo-pop-up'>
            <h2>FORMATOS EVALUACION DE FERIA</h2>
        </div>
        <div class="content-pop-up" id='content-pop-up'>

        </div>
    </div>
</div>

<script>
    function cargarSustentacionOralINN(guid_feria, guid_inv, guid_eval) {
        var feria = guid_feria;
        var inves = guid_inv;
        var eval = guid_eval;
        elgg.get('ajax/view/formatos_evaluacion_feria/formato_eval_sustentacion_oral_INN', {
            timeout: 30000,
            data: {
                ajax: 1,
                guid_inv: inves,
                guid_f: feria,
                guid_eval:eval,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#content-pop-up').html(result);
            },
        });
    }
    
    function cargarSustentacionOralINV(guid_feria, guid_inv, guid_eval) {
        var feria = guid_feria;
        var inves = guid_inv;
        var eval = guid_eval;
        elgg.get('ajax/view/formatos_evaluacion_feria/formato_eval_sustentacion_oral_INV', {
            timeout: 30000,
            data: {
                ajax: 1,
                guid_inv: inves,
                guid_f: feria,
                guid_eval:eval,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#content-pop-up').html(result);
            },
        });
    }
    
    function cargarConceptoValoraciónPonenciaOral(guid_feria, guid_inv, guid_eval) {
        var feria = guid_feria;
        var inves = guid_inv;
        var eval = guid_eval;
        elgg.get('ajax/view/formatos_evaluacion_feria/formato_valoracion_maestro_oral', {
            timeout: 30000,
            data: {
                ajax: 1,
                guid_inv: inves,
                guid_f: feria,
                guid_eval:eval,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#content-pop-up').html(result);
            },
        });
    }
</script>

