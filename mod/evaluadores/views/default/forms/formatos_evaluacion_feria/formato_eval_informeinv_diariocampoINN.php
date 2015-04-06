<?php

/**
 * Form donde se llenan los datos necesarios de la evaluación del cuaderno o diario de
 * campo
 * 
 * @author CORTEX_DIEGOX
 */
elgg_load_js('sumar_evalinfcuad');

//Recepción de datos
$guid_feria = $vars['guid_feria'];
$guid_inv = $vars['guid_inv'];
$guid_evaluador = $vars['guid_eval'];
$guid_colegio = $vars['colegio_guid'];
$nombre_colegio = $vars['colegio_name'];
$dpto = $vars['dpto'];
$nombre_grupo = $vars['nombre_grupo'];
$inv_name = $vars['inv_name'];
$colaborador = $vars['colaborador'];
$name_eval = $vars['name_eval'];
$profesion_eval = $vars['profesion_eval'];
$colegio_eval = $vars['colegio_eval'];
$subcategorias = $vars['subcate'];
$linea_tematica = $vars['linea_tematica'];
$lineas_pre = $vars['lineas_pre'];
$lines_open = $vars['lines_open'];


//EVALUACION HECHA
$evaluacion = $vars['eval_hecha'];
$guid_evaluacion_hecho = $evaluacion['guid_evaluacion_hecho'];
//Findamentos
$fundamentos_conocimiento = $evaluacion['fundamentos_conocimiento'];
$puntaje_fundamentos_conocimiento = $evaluacion['puntaje_fundamentos_conocimiento'];
$propuesta_metodologica = $evaluacion['propuesta_metodologica'];
$puntaje_propuesta_metodologica = $evaluacion['puntaje_propuesta_metodologica'];
$existe_coherencia = $evaluacion['existe_coherencia'];
$puntaje_existe_coherencia = $evaluacion['puntaje_existe_coherencia'];
$subtotal_fundamentacion = $evaluacion['subtotal_fundamentacion'];
//Tipos y proceso de
$forma_original = $evaluacion['forma_original'];
$puntaje_forma_original = $evaluacion['puntaje_forma_original'];
$argumenta_transformacion = $evaluacion['argumenta_transformacion'];
$puntaje_argumenta_transformacion = $evaluacion['puntaje_argumenta_transformacion'];
$proceso_investigativo = $evaluacion['proceso_investigativo'];
$puntaje_proceso_investigativo = $evaluacion['puntaje_proceso_investigativo'];
$subtotal_tipos = $evaluacion['subtotal_tipos'];
//Pertinencia e impacto
$grado_elaboracion = $evaluacion['grado_elaboracion'];
$puntaje_grado_elaboracion = $evaluacion['puntaje_grado_elaboracion'];
$resultados_investigacion = $evaluacion['resultados_investigacion'];
$puntaje_resultados_investigacion = $evaluacion['puntaje_resultados_investigacion'];
$evolucion_desarrollo = $evaluacion['evolucion_desarrollo'];
$puntaje_evolucion_desarrollo = $evaluacion['puntaje_evolucion_desarrollo'];
$subtotal_impacto = $evaluacion['subtotal_impacto'];
//Apropiación
$dinamica_vivida = $evaluacion['dinamica_vivida'];
$puntaje_dinamica_vivida = $evaluacion['puntaje_dinamica_vivida'];
$social_logrado = $evaluacion['social_logrado'];
$puntaje_social_logrado = $evaluacion['puntaje_social_logrado'];
$importancia_social = $evaluacion['importancia_social'];
$puntaje_importancia_social = $evaluacion['puntaje_importancia_social'];
$subtotal_apropiacion = $evaluacion['subtotal_apropiacion'];
//Anexos
$puntaje_total = $evaluacion['puntaje_total'];
$observaciones = $evaluacion['observaciones'];
$url_print = $evaluacion['url_print'];
$subcatPRECAR = $vars['subcategoriaPRECAR'];
$lineaPRECAR = $vars['lineaPRECAR'];

$imprimir = '';
if (!empty($url_print)) {
    $imprimir = "<a href='$url_print' >Imprimir</a>";
}

//preparo las subcategroias
$sub = "";
if (empty($subcatPRECAR)) {
    $sub = elgg_view('input/checkboxes', array('name' => 'tipo_innovacion', 'align' => 'horizontal', 'options' => $subcategorias));
} else {
    $sub = "<input type=text name='tipo_innovacionPRE' value='$subcatPRECAR' readonly><br>";
}

//Junto los datos para las lineas tematicas dependiendo si hay una existente o no
$lineas_de_investigación = '';
if (empty($lineaPRECAR)) {
    if (!empty($linea_tematica)) {
        $lineas_de_investigación = "<input type=text name='linea_tematica' value='$linea_tematica' readonly><br>";
    } else {
        $lineas_de_investigación .= "<h5>Lineas Preestructuradas<hr></h5>";
        $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_pre', 'align' => 'horizontal', 'options' => $vars['lineas_pre']));
        $lineas_de_investigación .= "<br>";
        $lineas_de_investigación .= "<h5>Lineas Abiertas<hr></h5>";
        $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_open', 'align' => 'horizontal', 'options' => $vars['lines_open']));
        $lineas_de_investigación .= "<br>";
    }
} else {
    $lineas_de_investigación = "<input type=text name='linea_tematicaPRE' value='$lineaPRECAR' readonly><br>";
}

//Labels y titulos del body del formulario
$titulo_general = elgg_echo('evaluador:formtaos:evaluar:informe:title');
$lbl_inf_in = elgg_echo('evaluador:formtaos:evaluar:informe:infinv');

$lbl_dpto = elgg_echo('evaluador:formtaos:evaluar:informe:dpto');
$lbl_name_grupo = elgg_echo('evaluador:formtaos:evaluar:informe:nombregrupo');
$lbl_colegio = elgg_echo('evaluador:formtaos:evaluar:informe:colegio');
$lbl_nombre_inv = elgg_echo('evaluador:formtaos:evaluar:informe:nombreinv');
$lbl_colaborador = elgg_echo('evaluador:formtaos:evaluar:informe:colaborador');
$lbl_nombre_eval = elgg_echo('evaluador:formtaos:evaluar:informe:nombreeval');
$lbl_eval_colegio = elgg_echo('evaluador:formtaos:evaluar:informe:evalcolegio');
$lbl_profesion = elgg_echo('evaluador:formtaos:evaluar:informe:profesion');
$lbl_categroias_innova = elgg_echo('evaluador:formtaos:evaluar:informe:categoriainnova');
$lbl_line_inv = elgg_echo('evaluador:formtaos:evaluar:informe:lineinv');
$lbl_criterios = elgg_echo('evaluador:formtaos:evaluar:informe:criterios');
$lbl_comentarios = elgg_echo('evaluador:formtaos:evaluar:informe:comentarios');
$lbl_puntaje = elgg_echo('evaluador:formtaos:evaluar:informe:puntaje');
//Findamentos
$lbl_fundamentacion = elgg_echo('evaluador:formtaos:evaluar:informe:fundamentacion');
$lbl_fundamentos_conocimiento = elgg_echo('evaluador:formtaos:evaluar:informe:fundamentos_conocimiento');
$lbl_propuesta_metodologica = elgg_echo('evaluador:formtaos:evaluar:informe:propuesta_metodologica');
$lbl_existe_coherencia = elgg_echo('evaluador:formtaos:evaluar:informe:existe_coherencia');
$lbl_subtotal = elgg_echo('evaluador:formtaos:evaluar:informe:lbl_subtotal');
$lbl_puntaje_total = elgg_echo('evaluador:formtaos:evaluar:informe:puntaje_total');
$lbl_obs = elgg_echo('evaluador:formtaos:evaluar:informe:lbl_obs');
//Tipos 
$lbl_tipos = elgg_echo('evaluador:formtaos:evaluar:informe:tipos');
$lbl_forma_original = elgg_echo('evaluador:formtaos:evaluar:informe:forma_original');
$lbl_argumenta_transformacion = elgg_echo('evaluador:formtaos:evaluar:informe:argumenta_transformacion');
$lbl_proceso_investigativo = elgg_echo('evaluador:formtaos:evaluar:informe:proceso_investigativo');
//Pertinencia e impacto
$lbl_impacto = elgg_echo('evaluador:formtaos:evaluar:informe:lbl_impacto');
$lbl_grado_elaboracion = elgg_echo('evaluador:formtaos:evaluar:informe:grado_elaboracion');
$lbl_resultados_investigacion = elgg_echo('evaluador:formtaos:evaluar:informe:resultados_investigacion');
$lbl_evolucion_desarrollo = elgg_echo('evaluador:formtaos:evaluar:informe:evolucion_desarrollo');
//Apropiacion
$lbl_apropiacion = elgg_echo('evaluador:formtaos:evaluar:informe:lbl_apropiacion');
$lbl_dinamica_vivida = elgg_echo('evaluador:formtaos:evaluar:informe:dinamica_vivida');
$lbl_social_logrado = elgg_echo('evaluador:formtaos:evaluar:informe:social_logrado');
$lbl_importancia_social = elgg_echo('evaluador:formtaos:evaluar:informe:importancia_social');


$button = elgg_view('input/submit', array('value' => elgg_echo('Guardar')));

$body = "<input type='hidden' name='guid_invest' value='$guid_inv'>"
        . "<input type='hidden' name='guid_eval' value='$guid_evaluador'>"
        . "<input type='hidden' name='guid_colegio' value='$guid_colegio'>"
        . "<input type='hidden' name='guid_feria' value='$guid_feria'>"
        . "<input type='hidden' name='guid_evaluacion_hecho' value='$guid_evaluacion_hecho'>"
        . "<table class='tabla-coordinador'>"
        . "<tr>"
        . "<th COLSPAN=6><h2><center>$titulo_general  $imprimir<hr></center></h2></th>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_dpto</td> <td COLSPAN=5><input type='text' name='dpto' value='$dpto' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_colegio</td> <td COLSPAN=5><input type='text' name='colegio' value='$nombre_colegio' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_name_grupo</td> <td COLSPAN=5><input type='text' name='name_grupo' value='$nombre_grupo' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_nombre_inv</td> <td COLSPAN=5><input type='text' name='name_inv' value='$inv_name' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_colaborador</td> <td COLSPAN=5><input type='text' name='colaborador' value='$colaborador' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_nombre_eval</td> <td COLSPAN=5><input type='text' name='name_eval' value='$name_eval' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_eval_colegio</td> <td COLSPAN=5><input type='text' name='eval_colegio' value='$colegio_eval' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_profesion</td> <td COLSPAN=5><input type='text' name='profesion' value='$profesion_eval' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center>$lbl_categroias_innova</center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6>$sub</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center>$lbl_line_inv</center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lineas_de_investigación<td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=4><center>$lbl_criterios</center></td>"
        //. "<td COLSPAN=2><center>$lbl_comentarios</center></td>"
        . "<td><center>$lbl_puntaje</center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><h3><center>$lbl_inf_in</center></h3></td>"
        . "</tr>"
        //Fundamentacion    
        . "<tr>"
        . "<td rowspan=9>$lbl_fundamentacion</td>"
        . "<td COLSPAN=3>$lbl_fundamentos_conocimiento</td>"        
        . "<td><input type='number' name='puntaje_fundamentos_conocimiento' id='puntaje_fundamentos_conocimientoDCINN' value='$puntaje_fundamentos_conocimiento' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='fundamentos_conocimiento' required>$fundamentos_conocimiento</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_propuesta_metodologica</td>"        
        . "<td><input type='number' name='puntaje_propuesta_metodologica' id='puntaje_propuesta_metodologicaDCINN' value='$puntaje_propuesta_metodologica' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='propuesta_metodologica' required>$propuesta_metodologica</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_existe_coherencia</td>"        
        . "<td><input type='number' name='puntaje_existe_coherencia' id='puntaje_existe_coherenciaDCINN' value='$puntaje_existe_coherencia' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='existe_coherencia' required>$existe_coherencia</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=4><center><h4>$lbl_subtotal</h4></center></td>"
        . "<td><input type='number' name='subtotal_fundamentacion' id='subtotal_fundamentacionDCINN' value='$subtotal_fundamentacion' readonly></td>"
        . "</tr>"
        //Tipos y proceso de  
        . "<tr>"
        . "<td rowspan=9>$lbl_tipos</td>"
        . "<td COLSPAN=3>$lbl_forma_original</td>"        
        . "<td><input type='number' name='puntaje_forma_original' id='puntaje_forma_originalDCINN' value='$puntaje_forma_original' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='forma_original' required>$forma_original</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_argumenta_transformacion</td>"        
        . "<td><input type='number' name='puntaje_argumenta_transformacion' id='puntaje_argumenta_transformacionDCINN' value='$puntaje_argumenta_transformacion' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='argumenta_transformacion' required>$argumenta_transformacion</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_proceso_investigativo</td>"        
        . "<td><input type='number' name='puntaje_proceso_investigativo' id='puntaje_proceso_investigativoDCINN' value='$puntaje_proceso_investigativo' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='proceso_investigativo' required>$proceso_investigativo</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=4><center><h4>$lbl_subtotal</h4></center></td>"
        . "<td><input type='number' name='subtotal_tipos' id='subtotal_tiposDCINN' value='$subtotal_tipos' readonly></td>"
        . "</tr>"
        //Pertinencia e impacto
        . "<tr>"
        . "<td rowspan=9>$lbl_impacto</td>"
        . "<td COLSPAN=3>$lbl_grado_elaboracion</td>"        
        . "<td><input type='number' name='puntaje_grado_elaboracion' id='puntaje_grado_elaboracionDCINN' value='$puntaje_grado_elaboracion' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='grado_elaboracion' required>$grado_elaboracion</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_resultados_investigacion</td>"        
        . "<td><input type='number' name='puntaje_resultados_investigacion' id='puntaje_resultados_investigacionDCINN' value='$puntaje_resultados_investigacion' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='resultados_investigacion' required>$resultados_investigacion</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_evolucion_desarrollo</td>"        
        . "<td><input type='number' name='puntaje_evolucion_desarrollo' id='puntaje_evolucion_desarrolloDCINN' value='$puntaje_evolucion_desarrollo' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='evolucion_desarrollo' required>$evolucion_desarrollo</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=4><center><h4>$lbl_subtotal</h4></center></td>"
        . "<td><input type='number' name='subtotal_impacto' id='subtotal_impactoDCINN' value='$subtotal_impacto' readonly></td>"
        . "</tr>"
        //Apropiacion
        . "<tr>"
        . "<td rowspan=9>$lbl_apropiacion</td>"
        . "<td COLSPAN=3>$lbl_dinamica_vivida</td>"        
        . "<td><input type='number' name='puntaje_dinamica_vivida' id='puntaje_dinamica_vividaDCINN' value='$puntaje_dinamica_vivida' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='dinamica_vivida' required>$dinamica_vivida</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_social_logrado</td>"        
        . "<td><input type='number' name='puntaje_social_logrado' id='puntaje_social_logradoDCINN' value='$puntaje_social_logrado' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='social_logrado' required>$social_logrado</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>$lbl_importancia_social</td>"        
        . "<td><input type='number' name='puntaje_importancia_social' id='puntaje_importancia_socialDCINN' value='$puntaje_importancia_social' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=3><textarea name='importancia_social' required>$importancia_social</textarea></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=4><center><h4>$lbl_subtotal</h4></center></td>"
        . "<td><input type='number' name='subtotal_apropiacion' id='subtotal_apropiacionDCINN' value='$subtotal_apropiacion' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center><h3>$lbl_puntaje_total</h3></center></td>"
        . "<td><input type='number' name='puntaje_total' id='puntaje_totalDCINN' value='$puntaje_total' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6>$lbl_obs</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><textarea name='obs' >$observaciones</textarea></td>"
        . "</tr>"
        . "</table>"
        . "<br>"
        . "<center>$button</center>";

echo $body;
