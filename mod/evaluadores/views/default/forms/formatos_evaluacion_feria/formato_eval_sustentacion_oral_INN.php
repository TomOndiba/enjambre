<?php

/**
 * Form donde se llenan los datos necesarios de la evaluación de la sustentacion oral
 * categria innovacion
 * 
 * @author CORTEX_DIEGOX
 */
elgg_load_js('sumar_3_INN');

//Recepción de datos
$guid_feria = $vars['guid_feria'];
$guid_inv = $vars['guid_inv'];
$guid_evaluador = $vars['guid_eval'];
$colegio = $vars['colegio_name'];
$dpto = $vars['dpto'];
$nombre_grupo = $vars['nombre_grupo'];
$inv_name = $vars['inv_name'];
$colaborador = $vars['colaborador'];
$name_eval = $vars['name_eval'];
$profesion_eval = $vars['profesion_eval'];
$colegio_eval = $vars['colegio_eval'];
$categoria_inv = $vars['categoria'];
$linea_tematica = $vars['linea_tematica'];
$lineas_pre = $vars['linea_pre'];
$lines_open = $vars['linea_open'];


//EVALUACION HECHA
$evaluacion = $vars['eval_hecha'];
$guid_evaluacion_hecho = $evaluacion['guid_evaluacion_hecho'];
//Apropiacion
$puntaje_presenta_claridad = $evaluacion['puntaje_presenta_claridad'];
$puntaje_explica_fundamentos = $evaluacion['puntaje_explica_fundamentos'];
$puntaje_proceso_metodologico = $evaluacion['puntaje_proceso_metodologico'];
$puntaje_innovacion_lograda = $evaluacion['puntaje_innovacion_lograda'];
$subtotal_apropiacion = $evaluacion['subtotal_apropiacion'];
//Capacidades
$puntaje_evidentes_capacidades = $evaluacion['puntaje_evidentes_capacidades'];
$subtotal_capacidades = $evaluacion['subtotal_capacidades'];
//Puesto
$puntaje_diseño_investigativo = $evaluacion['puntaje_diseño_investigativo'];
$subtotal_puesto = $evaluacion['subtotal_puesto'];
//Anexos
$puntaje_total = $evaluacion['puntaje_total'];
$obs = $evaluacion['obs'];
$url_print = $evaluacion['url_print'];
$lineaPRECAR = $vars['lineaPRECAR'];

$imprimir = '';
if (!empty($url_print)) {
    $imprimir = "<a href='$url_print' >Imprimir</a>";
}



//Junto los datos para las lineas tematicas dependiendo si hay una existente o no
$lineas_de_investigación = '';

if (empty($lineaPRECAR)) {
    $lineas_de_investigación = '';
    if (!empty($linea_tematica)) {
        $lineas_de_investigación = "<input type=text name='linea_tematica' value='$linea_tematica' readonly><br>";
    } else {
        $lineas_de_investigación .= "<h5>Lineas Preestructuradas<hr></h5>";
        $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_pre', 'align' => 'horizontal', 'options' => $vars['linea_pre']));
        $lineas_de_investigación .= "<br>";
        $lineas_de_investigación .= "<h5>Lineas Abiertas<hr></h5>";
        $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_open', 'align' => 'horizontal', 'options' => $vars['linea_open']));
        $lineas_de_investigación .= "<br>";
    }
} else {
    $lineas_de_investigación = "<input type=text name='linea_tematicaPRE' value='$lineaPRECAR' readonly><br>";
}

//Labels y titulos del body del formulario
$titulo_general = elgg_echo('evaluador:formtaos:evaluar:exposicion:');

$lbl_dpto = elgg_echo('evaluador:formtaos:evaluar:informe:dpto');
$lbl_colegio = elgg_echo('');
$lbl_name_grupo = elgg_echo('evaluador:formtaos:evaluar:informe:nombregrupo');
$lbl_nombre_inv = elgg_echo('evaluador:formtaos:evaluar:informe:nombreinv');
$lbl_colaborador = elgg_echo('evaluador:formtaos:evaluar:informe:colaborador');
$lbl_nombre_eval = elgg_echo('evaluador:formtaos:evaluar:informe:nombreeval');
$lbl_eval_colegio = elgg_echo('evaluador:formtaos:evaluar:informe:evalcolegio');
$lbl_profesion = elgg_echo('evaluador:formtaos:evaluar:informe:profesion');
$lbl_categria = elgg_echo('evaluador:formtaos:evaluar:informeInvInn:categoria');
$lbl_line_inv = elgg_echo('evaluador:formtaos:evaluar:informe:lineinv');
$lbl_criterios = elgg_echo('evaluador:formtaos:evaluar:informe:criterios');
$lbl_puntaje = elgg_echo('evaluador:formtaos:evaluar:informe:puntaje');
$lbl_subtotal = elgg_echo('evaluador:formtaos:evaluar:informe:lbl_subtotal');
//COHERENCIA
$lbl_apropiacion = elgg_echo('evaluador:formtaos:evaluar:exposicion:lbl_apropiacion');
$lbl_puntaje_presenta_claridad = elgg_echo('evaluador:formtaos:evaluar:exposicion:puntaje_presenta_claridad');
$lbl_puntaje_explica_fundamentos = elgg_echo('evaluador:formtaos:evaluar:exposicion:puntaje_explica_fundamentos');
$lbl_puntaje_proceso_metodologico = elgg_echo('evaluador:formtaos:evaluar:exposicion:puntaje_proceso_metodologico');
$lbl_puntaje_innovacion_lograda = elgg_echo('evaluador:formtaos:evaluar:exposicion:puntaje_innovacion_lograda');
//CAPACIDADES
$lbl_capacidades = elgg_echo('evaluador:formtaos:evaluar:exposicion:lbl_capacidades');
$lbl_puntaje_evidentes_capacidades = elgg_echo('evaluador:formtaos:evaluar:exposicion:puntaje_evidentes_capacidades');
$lbl_puesto = elgg_echo('evaluador:formtaos:evaluar:exposicion:lbl_puesto');
$lbl_puntaje_diseño_investigativo = elgg_echo('evaluador:formtaos:evaluar:exposicion:puntaje_diseño_investigativo');
//ANeXOs
$lbl_puntaje_total = elgg_echo('evaluador:formtaos:evaluar:exposicion:lbl_puntaje_total');
$lbl_obs = elgg_echo('evaluador:formtaos:evaluar:exposicion:obs');

$button = elgg_view('input/submit', array('value' => elgg_echo('Guardar')));

$body = "<input type='hidden' name='guid_invest' value='$guid_inv'>"
        . "<input type='hidden' name='guid_eval' value='$guid_evaluador'>"
        . "<input type='hidden' name='guid_feria' value='$guid_feria'>"
        . "<input type='hidden' name='guid_evaluacion_hecho' value='$guid_evaluacion_hecho'>"
        . "<table class='tabla-coordinador'>"
        . "<tr>"
        . "<th COLSPAN=7><h2><center>$titulo_general  $imprimir<hr></center></h2></th>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_dpto</td> <td COLSPAN=6><input type='text' name='dpto' value='$dpto' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_name_grupo</td> <td COLSPAN=6><input type='text' name='name_grupo' value='$nombre_grupo' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_nombre_inv</td> <td COLSPAN=6><input type='text' name='name_inv' value='$inv_name' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_colaborador</td> <td COLSPAN=6><input type='text' name='colaborador' value='$colaborador' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_nombre_eval</td> <td COLSPAN=6><input type='text' name='name_eval' value='$name_eval' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_eval_colegio</td> <td COLSPAN=6><input type='text' name='eval_colegio' value='$colegio_eval' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_profesion</td> <td COLSPAN=6><input type='text' name='profesion' value='$profesion_eval' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=7><center><h4>$lbl_categria</h4></center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=7><input type='text' name='categoria_inv' value='$categoria_inv' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=7><center><h4>$lbl_line_inv</h4></center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=7>$lineas_de_investigación<td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center>$lbl_criterios</center></td>"
        . "<td><center>$lbl_puntaje</center></td>"
        . "</tr>"
        //Apropiacion   
        . "<tr>"
        . "<td rowspan=5>$lbl_apropiacion</td>"
        . "<td COLSPAN=5>$lbl_puntaje_presenta_claridad</td>"
        . "<td><input type='number' name='puntaje_presenta_claridad' id='puntaje_presenta_claridad' value='$puntaje_presenta_claridad' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_puntaje_explica_fundamentos</td>"
        . "<td><input type='number' name='puntaje_explica_fundamentos' id='puntaje_explica_fundamentos' value='$puntaje_explica_fundamentos' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_puntaje_proceso_metodologico</td>"
        . "<td><input type='number' name='puntaje_proceso_metodologico' id='puntaje_proceso_metodologico' value='$puntaje_proceso_metodologico' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_puntaje_innovacion_lograda</td>"
        . "<td><input type='number' name='puntaje_innovacion_lograda' id='puntaje_innovacion_lograda' value='$puntaje_innovacion_lograda' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5><center><h4>$lbl_subtotal</h4></center></td>"
        . "<td><input type='number' name='subtotal_apropiacion' id='subtotal_apropiacion' value='$subtotal_apropiacion' readonly></td>"
        . "</tr>"
        //Capacidades
        . "<tr>"
        . "<td rowspan=2>$lbl_capacidades</td>"
        . "<td COLSPAN=5>$lbl_puntaje_evidentes_capacidades</td>"
        . "<td><input type='number' name='puntaje_evidentes_capacidades' id='puntaje_evidentes_capacidades' value='$puntaje_evidentes_capacidades' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5><center><h4>$lbl_subtotal</h4></center></td>"
        . "<td><input type='number' name='subtotal_capacidades' id='subtotal_capacidades' value='$subtotal_capacidades' readonly></td>"
        . "</tr>"
        //PUESTO
        . "<tr>"
        . "<td rowspan=2>$lbl_puesto</td>"
        . "<td COLSPAN=5>$lbl_puntaje_diseño_investigativo</td>"
        . "<td><input type='number' name='puntaje_diseño_investigativo' id='puntaje_diseño_investigativo' value='$puntaje_diseño_investigativo' required></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5><center><h4>$lbl_subtotal</h4></center></td>"
        . "<td><input type='number' name='subtotal_puesto' id='subtotal_puesto' value='$subtotal_puesto' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center><h4>$lbl_puntaje_total</h4></center></td>"
        . "<td><input type='number' name='puntaje_total' id='puntaje_total' value='$puntaje_total' readonly>"
        . "</td>"
        . "<tr>"
        . "<td COLSPAN=7>$lbl_obs</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=7><textarea name='obs'>$obs</textarea>"
        . "</td>"
        . "</table>"
        . "<br>"
        . "<center>$button</center>";

echo $body;


