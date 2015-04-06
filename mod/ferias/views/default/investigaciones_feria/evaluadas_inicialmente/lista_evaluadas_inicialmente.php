<?php
elgg_load_js('sumar_4.2');
elgg_load_js('sumar_evalinfcuad');
elgg_load_js('sumar_4.1');
elgg_load_js('sumar_3_INN');
elgg_load_js('sumar_3_INV');
elgg_load_js('sumar2.1');

$entities = $vars['entities'];
$guid_feria = $vars['guid'];
$url_site= elgg_get_site_url();
$tabla_evaluadas = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th colspan='2'>Opciones</th></tr></thead><tbody>";
echo "<div style='display:none;' id='dialog_eval' title='Asignar Evaluador en Sitio'><p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span></p></div>";
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
        
        $asignar_eval2 = "<br><div align='center'><a id='asignar' onclick=abrirform2({$entity->guid});>Asignar Evaluador en Sitio</a></div>";
        
        $categoria=$entity->categoria_inv;
        
        if($categoria=="Innovación"){
            //formato 4.1
            $evaluaciones = elgg_get_relationship($entity, "evaluada_4_en_".$guid_feria."_con");
            $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN_inv({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
            //$lista = "<a href='".$url_site."evaluadores/evaluar_informeinv_diariocampoINN_inv/" . $guid_feria . "/" . $entity->guid. '/' . $evaluaciones[0]->guid  . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
        
            //formato 5
            $evaluaciones1 = elgg_get_relationship($entity, "evaluada_5_en_".$guid_feria."_con");
            $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_diariocampoINN({$guid_feria}, {$entity->guid}, {$evaluaciones1[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Innovación</a>";
            //$lista1 = "<a href='".$url_site."evaluadores/evaluar_informeinv_diariocampoINN/" . $guid_feria. "/" . $entity->guid . "/" . $evaluaciones1[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Innovación</a>";
        
            //formato 2.1
            $evaluaciones2 = elgg_get_relationship($entity, "evaluada_2.1_en_".$guid_feria."_con");
            $lista2 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid}, {$evaluaciones2[0]->guid})'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            //$lista2 = "<a href='".$url_site."evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones2[0]->guid . "'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            
            $tabla_evaluadas.="<tr>"
                    . "<td rowspan='3'>{$title_link}</td>"
                    . "<td>$lista</td>"
                    . "<td rowspan='3'>$asignar_eval2</td></tr>"
                    . "<tr><td>$lista1</td></tr>"
                    . "<tr><td>$lista2</td></tr>";
        }else if($categoria=="Investigación"){
            //formato 4.2
            $evaluaciones = elgg_get_relationship($entity, "evaluada_4_en_".$guid_feria."_con");
            $lista = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_informeinv_cuadcampoINN_inv({$guid_feria}, {$entity->guid}, {$evaluaciones[0]->guid})'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
            //$lista = $lista = "<a href='".$url_site."evaluadores/evaluar_informeinv_cuadcampoINN_inv/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones[0]->guid . "'>Modificar Concepto Valoración Informe y Diario de Campo - Componente Investigación</a>";
        
            //formato 2.1
            $evaluaciones1 = elgg_get_relationship($entity, "evaluada_2.1_en_".$guid_feria."_con");
            $lista1 = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='evaluar_maestro_escrito({$guid_feria}, {$entity->guid}, {$evaluaciones1[0]->guid})'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            //$lista1 = "<a href='".$url_site."evaluadores/evaluar_maestro_escrito/" . $guid_feria . "/" . $entity->guid . "/" . $evaluaciones1[0]->guid . "'>Modificar Concepto Valoración Ponencia Escrita del Maestro</a>";
            
            $tabla_evaluadas.="<tr>"
                    . "<td rowspan='2'>{$title_link}</td>"
                    . "<td>$lista</td>"
                    . "<td rowspan='2'>$asignar_eval2</td></tr>"
                    . "<tr><td>$lista1</td></tr>";
        }
        
    }
    $tabla_evaluadas.="</tbody></table>";
    
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
</script>