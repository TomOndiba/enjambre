<?php
/** Vista que permite mostrar todas las investigaciones de convocatoria que fueron asignadas al evaluador */
elgg_load_js('reveal2');
elgg_load_js('validarCampos');
elgg_load_js('sumar');
elgg_load_css('reveal');

$entities = $vars['entities'];

$guid_conv = $vars['guid_entity'];
$user = elgg_get_logged_in_user_entity();

$lista = "<ul class='lista-investigaciones-asesor'>";

//$entities = elgg_investigaciones_convocatoria($entities1, $guid_conv);

if (!$entities) {
    echo "<b>No tiene asignadas Investigaciones</b>";
} else {

    foreach ($entities as $entity) {

        //$conv_ins = elgg_get_relationship($entity, "participa_en_convocatoria");

     
        $url = "investigaciones/ver/{$entity->guid}/evaluador_convocatoria/$user->guid/{$guid_conv}";
        $params = array(
            'text' => elgg_view('output/longtext', array('value' => $entity->name)),
            'href' => $url,
            'is_trusted' => true,
        );
        $title_link = elgg_view('output/url', $params);

        // Busca la relacion del grupo con la investigacion  para enviar datos al formulario de registro y actualización
        $grupo = elgg_get_relationship_inversa($entity, "tiene_la_investigacion");

        if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $entity->guid)) {
            // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
        }

        // Busca si existe la relación entre la investigación y la evaluacion para obtener el id de la evaluación.
     
        $evaluaciones = elgg_get_relationship($entity, "tiene_la_evaluacion");

        if (sizeof($evaluaciones) != 0) {
            //Url que permite modificar la evaluacion
            // $url_evaluacion.='<a href="/elgg2/evaluadores/evaluar_investigacion/'.$entity->guid.'">Modificar</a>';
            $url_evaluacion = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarModificarEvaluacion({$entity->guid})'>Modificar Concepto</a>";
            $puntaje="{$evaluaciones[0]->puntaje_total}";
        } else {
            //Url que permite modificar la evaluacion
            // $url_evaluacion.='<a href="/elgg2/evaluadores/evaluar_investigacion/'.$entity->guid.'">Modificar</a>';
            $url_evaluacion = "<a id='modificar-evaluacion' data-reveal-id='myModal' onclick='cargarModificarEvaluacion({$entity->guid})'>Evaluar Bitácora</a>";
            $puntaje="";
        }

    

        $url = elgg_get_site_url();
        $lista.="<li>"
                . "<div class='titulo-investigacion'>{$title_link}</div>"
                . "<div class='info-investigacion-item'>"
                . "<div class='row'>Grupo de Investigación: <a href='{$url}grupo_investigacion/ver/{$grupo[0]->guid}'>{$grupo[0]->name}</a><br>"
                . "Institución: <a href='{$url}instituciones/ver/{$institucion[0]->guid}'>{$institucion[0]->name}</a><br>"
                . "Puntaje: $puntaje</div>"
                . "<div class='row' style='float:right;'>$url_evaluacion</div>"
                . "</div>"
                . "</li>";
    }
    $lista.="</ul>";
    echo $lista;
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

<script>
    function cargarModificarEvaluacion(guid) {
        var investigacion = guid;
        elgg.get('ajax/view/investigaciones/preseleccionadas/modificar_evaluacion', {
            timeout: 30000,
            data: {
                ajax: 1,
                investigacion: investigacion,
                pageowner: elgg.get_page_owner_guid()
            },
            success: function(result, success, xhr) {
                $('#content-pop-up').html(result);
                sumar();
            },
        });
    }
</script>