<?php
elgg_load_js('sumar_4.2');
elgg_load_js('sumar_evalinfcuad');
elgg_load_js('sumar_4.1');
elgg_load_js('sumar_3_INN');
elgg_load_js('sumar_3_INV');
elgg_load_js('sumar2.1');

$entities = $vars['entities'];
$guid_feria = $vars['guid'];
$feria = new ElggFeria($guid_feria);
$url_site = elgg_get_site_url();
$tabla_evaluadas = "<table class='tabla-coordinador'><thead>"
        . "<tr><th>Investigacion</th>"
        . "<th>Categoría</th>"
        . "<th>Puntaje Total</th>"
        . "<th colspan='2'>Opciones</th></tr></thead><tbody>";
if (!$entities) {
    echo "<b>No existen investigaciones</b>";
} else {
    $investigaciones = array();
    //investigacion, categoria, evaluacion4, evaluacion5, evaluacion2.1, evaluacion3, evaluacion2.2, puntaje total
    foreach ($entities as $entity) {

        $url = "investigaciones/ver/{$entity->guid}/feria/$guid_feria";
        $params = array(
            'text' => elgg_view('output/longtext', array('value' => $entity->name)),
            'href' => $url,
            'is_trusted' => true,
        );
        $title_link = elgg_view('output/url', $params);
        $inv = array();
        $inv['investigacion'] = $title_link;
        $categoria = $entity->categoria_inv;
        $inv['categoria'] = $categoria;
        $puntaje_total = 0;
        if ($categoria == "Innovación") {
            //formato 4.1
            $evaluaciones = elgg_get_relationship($entity, "evaluada_4_en_" . $guid_feria . "_con");
            $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN_inv({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
            //$lista = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_diariocampoINN_inv/" . $guid_feria . "/" . $entity->guid . '/' . $evaluaciones[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
            $inv['evaluacion4'] = $lista;
            $puntaje_total = $puntaje_total + $evaluaciones[0]->puntaje_total;
            //formato 5
            $evaluaciones1 = elgg_get_relationship($entity, "evaluada_5_en_" . $guid_feria . "_con");
            $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN({$guid_feria}, {$entity->guid}, {$evaluaciones1[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Innovación</a>";
            //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_diariocampoINN/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones1[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Innovación</a>";
            $inv['evaluacion5'] = $lista1;
            $puntaje_total = $puntaje_total + $evaluaciones1[0]->puntaje_total;
            //formato 2.1
            $evaluaciones2 = elgg_get_relationship($entity, "evaluada_2.1_en_" . $guid_feria . "_con");
            $lista2 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid}, {$evaluaciones2[0]->guid})'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            //$lista2 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones2[0]->guid . "'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            $inv['evaluacion2.1'] = $lista2;
            $puntaje_total = $puntaje_total + $evaluaciones2[0]->puntaje_total;
            //formato 3.1
            $evaluaciones3 = elgg_get_relationship($entity, "evaluada_3_en_" . $guid_feria . "_con");
            $lista3 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarSustentacionOralINN({$guid_feria}, {$entity->guid}, {$evaluaciones3[0]->guid})'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
            //$lista3 = "<a href='" . $url_site . "evaluadores/evaluar_sustentacion_oral_INN/" . $guid_feria . "/" . $entity->guid . '/' . $evaluaciones3[0]->guid . "'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
            $inv['evaluacion3'] = $lista3;
            $puntaje_total = $puntaje_total + $evaluaciones3[0]->puntaje_total;
            //formato 2.2
            $evaluaciones4 = elgg_get_relationship($entity, "evaluada_2.2_en_" . $guid_feria . "_con");
            $lista4 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarConceptoValoraciónPonenciaOral({$guid_feria}, {$entity->guid}, {$evaluaciones4[0]->guid})'>Modificar Concepto Valoración Ponencia Oral del Maestro</a>";
            //$lista4 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_oral/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones4[0]->guid . "'>Modificar Concepto Valoración Ponencia Oral del Maestro</a>";
            $inv['evaluacion2.2'] = $lista4;
            $puntaje_total = $puntaje_total + $evaluaciones4[0]->puntaje_total;
        } else if ($categoria == "Investigación") {
            //formato 4.2
            $evaluaciones = elgg_get_relationship($entity, "evaluada_4_en_" . $guid_feria . "_con");
            $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_cuadcampoINN_inv({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
            //$lista = $lista = "<a href='" . $url_site . "evaluadores/evaluar_informeinv_cuadcampoINN_inv/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
            $inv['evaluacion4'] = $lista;
            $puntaje_total = $puntaje_total + $evaluaciones[0]->puntaje_total;
            //formato 2.1
            $evaluaciones1 = elgg_get_relationship($entity, "evaluada_2.1_en_" . $guid_feria . "_con");
            $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid}, {$evaluaciones1[0]->guid})'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            //$lista1 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones1[0]->guid . "'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            $inv['evaluacion2.1'] = $lista1;
            $puntaje_total = $puntaje_total + $evaluaciones1[0]->puntaje_total;
            //formato 3.2
            $evaluaciones3 = elgg_get_relationship($entity, "evaluada_3_en_" . $guid_feria . "_con");
            $lista3 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarSustentacionOralINV({$guid_feria}, {$entity->guid}, {$evaluaciones3[0]->guid})'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
            //$lista3 = "<a href='" . $url_site . "evaluadores/evaluar_sustentacion_oral_INV/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones3[0]->guid . "'>Modificar Concepto Valoración Sustentación Oral de Investigación</a>";
            $inv['evaluacion3'] = $lista3;
            $puntaje_total = $puntaje_total + $evaluaciones3[0]->puntaje_total;
            //formato 2.2
            $evaluaciones4 = elgg_get_relationship($entity, "evaluada_2.2_en_" . $guid_feria . "_con");
            $lista4 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarConceptoValoraciónPonenciaOral({$guid_feria}, {$entity->guid}, {$evaluaciones4[0]->guid})'>Modificar Concepto Valoración Ponencia Oral del Maestro</a>";
            //$lista4 = "<a href='" . $url_site . "evaluadores/evaluar_maestro_oral/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones4[0]->guid . "'>Modificar Concepto Valoración Ponencia Oral del Maestro</a>";
            $inv['evaluacion2.2'] = $lista4;
            $puntaje_total = $puntaje_total + $evaluaciones4[0]->puntaje_total;
        }

        $user = elgg_get_logged_in_user_entity();
        $inv['guid'] = $entity->guid;
        $inv['puntaje_total'] = $puntaje_total;

        if ($feria->tipo_feria == 'Municipal') {
            create_metadata($entity->guid, 'puntaje_feria_municipal', $puntaje_total, 'text', $user->guid, ACCESS_PUBLIC);
        }else if ($feria->tipo_feria == 'Departamental') {
            create_metadata($entity->guid, 'puntaje_feria_departamental', $puntaje_total, 'text', $user->guid, ACCESS_PUBLIC);
        }
        array_push($investigaciones, $inv);
    }

    //ordenar las investigaciones de acuerdo a su puntaje en forma descendente
    usort($investigaciones, "cmpPuntajesDesc");

    foreach ($investigaciones as $invest) {
        $title_link = $invest['investigacion'];
        $categoria = $invest['categoria'];
        $evaluacion4 = $invest['evaluacion4'];
        $evaluacion5 = $invest['evaluacion5'];
        $evaluacion21 = $invest['evaluacion2.1'];
        $evaluacion3 = $invest['evaluacion3'];
        $evaluacion22 = $invest['evaluacion2.2'];
        $puntaje_total = $invest['puntaje_total'];

        $url = elgg_get_site_url() . "action/ferias/seleccionar_finalista?id_inv=" . $invest['guid'] . "&id_feria=" . $guid_feria;
        $finalista = elgg_add_action_tokens_to_url($url);

        if ($categoria == 'Innovación') {
            $tabla_evaluadas.="<tr>"
                    . "<td rowspan='5'>{$title_link}</td>"
                    . "<td rowspan='5'>$categoria</td>"
                    . "<td rowspan='5'>$puntaje_total</td>"
                    . "<td>$evaluacion4</td>"
                    . "<td rowspan='5'><a href='$finalista'>Seleccionar como finalista</a></td></tr>"
                    . "<tr><td>$evaluacion5</td></tr>"
                    . "<tr><td>$evaluacion21</td></tr>"
                    . "<tr><td>$evaluacion3</td></tr>"
                    . "<tr><td>$evaluacion22</td></tr>";
        } else if ($categoria == 'Investigación') {
            $tabla_evaluadas.="<tr>"
                    . "<td rowspan='4'>{$title_link}</td>"
                    . "<td rowspan='4'>$categoria</td>"
                    . "<td rowspan='4'>$puntaje_total</td>"
                    . "<td>$evaluacion4</td>"
                    . "<td rowspan='4'><a href='$finalista'>Seleccionar como finalista</a></td></tr>"
                    . "<tr><td>$evaluacion21</td></tr>"
                    . "<tr><td>$evaluacion3</td></tr>"
                    . "<tr><td>$evaluacion22</td></tr>";
        }
    }

    $url1 = elgg_get_site_url() . "action/bitacoras/print?bit=100&guid_feria=$guid_feria";
    $url_print = elgg_add_action_tokens_to_url($url1);

    $tabla_evaluadas.="</tbody></table>";
    echo "<div class='contenedor-button'><a class='link-button' href='$url_print'>Imprimir Listado</a></div>";
    echo $tabla_evaluadas;
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
