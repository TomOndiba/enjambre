<?php

/** Vista que permite mostrar todas las investigaciones de una feria dada que fueron asignadas al evaluador
 *  para realizar su evaluación inicial */
$entities = $vars['entities'];
$tipo = $vars['participa'];//municipal, departamental
$guid_feria = $vars['guid_entity'];


$user = elgg_get_logged_in_user_entity();
$url_site = elgg_get_site_url();
$tabla_inv = "<table class='tabla-coordinador' cellspacing='3'><thead><tr><th>Investigacion</th><th>Opciones</th></tr></thead><tbody>";

if (!$entities) {
    echo "<b>No tiene asignadas Investigaciones</b>";
} else {

    foreach ($entities as $entity) {
        
            $url = "investigaciones/ver/{$entity->guid}/evaluador_feria/$user->guid/$guid_feria";
            $params = array(
                'text' => elgg_view('output/longtext', array('value' => $entity->name)),
                'href' => $url,
                'is_trusted' => true,
            );
            $title_link = elgg_view('output/url', $params);

            $categoria = $entity->categoria_inv;

            if ($categoria == "Innovación") {
                //formato 4.1
                $evaluaciones = elgg_get_relationship($entity, "evaluada_4_en_" . $guid_feria . "_con");
                if (sizeof($evaluaciones) != 0) {//AQUIIIIIII
                    $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN_inv({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
                    //$lista = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_diariocampoINN_inv/" . $guid_feria . "/" . $entity->guid . '/' . $evaluaciones[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
                } else {
                    $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN_inv({$guid_feria}, {$entity->guid})'>Valorar Informe y Diario de Campo - Componente Investigación</a>";
                    //$lista = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_diariocampoINN_inv/" . $guid_feria . "/" . $entity->guid . "'>Valorar Informe y Diario de Campo - Componente Investigación</a>";
                }
                //formato 5
                $evaluaciones1 = elgg_get_relationship($entity, "evaluada_5_en_" . $guid_feria . "_con");
                if (sizeof($evaluaciones1) != 0) {
                    $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN({$guid_feria}, {$entity->guid}, {$evaluaciones1[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Innovación</a>";
                    //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_diariocampoINN/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones1[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Innovación</a>";
                } else {
                    $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN({$guid_feria}, {$entity->guid})'>Valorar Informe y Diario de Campo - Componente Innovación</a>";
                    //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_diariocampoINN/" . $guid_feria . "/" . $entity->guid . "'>Valorar Informe y Diario de Campo - Componente Innovación</a>";
                }
                //formato 2.1
                $evaluaciones2 = elgg_get_relationship($entity, "evaluada_2.1_en_" . $guid_feria . "_con");
                if (sizeof($evaluaciones2) != 0) {
                    $lista2 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid}, {$evaluaciones2[0]->guid})'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
                    //$lista2 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones2[0]->guid . "'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
                } else { 
                    $lista2 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid})'>Valorar Ponencia Escrita del Maestro</a>";
                    //$lista2 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "'>Valorar Ponencia Escrita del Maestro</a>";
                }
                
                $tabla_inv.="<tr>"
                        . "<td rowspan='3'>{$title_link}</td>"
                        . "<td>$lista</td></tr>"
                        . "<tr><td>$lista1</td></tr>"
                        . "<tr><td>$lista2</td></tr>";
            } else if ($categoria == "Investigación") {
                //formato 4.2
                $evaluaciones = elgg_get_relationship($entity, "evaluada_4_en_" . $guid_feria . "_con");
                if (sizeof($evaluaciones) != 0) {
                    $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_cuadcampoINN_inv({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
                    //$lista = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_cuadcampoINN_inv/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
                } else {
                    $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_cuadcampoINN_inv({$guid_feria}, {$entity->guid})'>Valorar Informe y Diario de Campo - Componente Investigación</a>";
                    //$lista = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_cuadcampoINN_inv/" . $guid_feria . "/" . $entity->guid . "'>Valorar Informe y Diario de Campo - Componente Investigación</a>";
                }

                //formato 2.1
                $evaluaciones1 = elgg_get_relationship($entity, "evaluada_2.1_en_" . $guid_feria . "_con");
                if (sizeof($evaluaciones1) != 0) {
                    $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid}, {$evaluaciones1[0]->guid})'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
                    //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones1[0]->guid . "'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
                } else {
                    $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid})'>Valorar Ponencia Escrita del Maestro</a>";
                    //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "'>Valorar Ponencia Escrita del Maestro</a>";
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
      
    function evaluar_maestro_escrito(guid_feria, guid_inv, guid_eval) {
        var feria = guid_feria;
        var inves = guid_inv;
        var eval = guid_eval;
        elgg.get('ajax/view/formatos_evaluacion_feria/formato_valoracion_maestro_escrito', {
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
    
    function evaluar_informeinv_diariocampoINN_inv(guid_feria, guid_inv, guid_eval) {
        var feria = guid_feria;
        var inves = guid_inv;
        var eval = guid_eval;
        elgg.get('ajax/view/formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN_inv', {
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
    
    function evaluar_informeinv_diariocampoINN(guid_feria, guid_inv, guid_eval) {
        var feria = guid_feria;
        var inves = guid_inv;
        var eval = guid_eval;
        elgg.get('ajax/view/formatos_evaluacion_feria/formato_eval_informeinv_diariocampoINN', {
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
  
    
    function evaluar_informeinv_cuadcampoINN_inv(guid_feria, guid_inv, guid_eval) {
        var feria = guid_feria;
        var inves = guid_inv;
        var eval = guid_eval;
        elgg.get('ajax/view/formatos_evaluacion_feria/formato_eval_informeinv_cuadcampoINN_inv', {
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


