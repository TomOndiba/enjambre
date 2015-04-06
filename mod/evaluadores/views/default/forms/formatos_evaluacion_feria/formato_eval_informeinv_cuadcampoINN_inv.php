<?php

/** 
 * Form donde se llenan los datos necesarios de la evaluación del cuaderno o diario de
 * campo componente investigacion, categoria investigacion
 * 
 * @author CORTEX_DIEGOX
 */


elgg_load_js('sumar_4.2');

//Recepción de datos
$guid_feria = $vars['guid_feria'];
$guid_inv = $vars['guid_inv'];
$guid_evaluador = $vars['guid_eval'];
$dpto = $vars['dpto'];
$nombre_grupo = $vars['nombre_grupo'];
$inv_name = $vars['inv_name'];
$colaborador = $vars['colaborador'];
$name_eval = $vars['name_eval'];
$profesion_eval = $vars['profesion_eval'];
$colegio_eval = $vars['colegio_eval'];
$categoria_inv = $vars['categoria_inv'];
$linea_tematica = $vars['linea_tematica'];
$lineas_pre = $vars['lineas_pre'];
$lines_open = $vars['lines_open'];


//EVALUACION HECHA
$evaluacion = $vars['eval_hecha'];
$guid_evaluacion_hecho = $evaluacion['guid_evaluacion_hecho'];
    //COHERENCIA
$puntaje_trabajo_colaborativo = $evaluacion['puntaje_trabajo_colaborativo'];
$puntaje_claridad_pregunta = $evaluacion['puntaje_claridad_pregunta'];
$subtotal_coherencia = $evaluacion['subtotal_coherencia'];
    //RUTA_INDAGACION
$puntaje_diseño_metodologico = $evaluacion['puntaje_diseño_metodologico'];
$puntaje_conceptos_investigacion = $evaluacion['puntaje_conceptos_investigacion'];
$puntaje_resultados_claros = $evaluacion['puntaje_resultados_claros'];
$subtotal_ruta = $evaluacion['subtotal_ruta'];
    //FUENTES
$puntaje_forma_adecuada = $evaluacion['puntaje_forma_adecuada'];
$subtotal_fuentes = $evaluacion['subtotal_fuentes'];
    //ANEXOS
$puntaje_total = $evaluacion['puntaje_total'];
$observaciones = $evaluacion['observaciones'];
$url_print = $evaluacion['url_print'];
$lineaPRECAR = $vars['lineaPRECAR'];

$imprimir = '';
if(!empty($url_print)){
    $imprimir = "<a href='$url_print' >Imprimir</a>";
}



//Junto los datos para las lineas tematicas dependiendo si hay una existente o no
$lineas_de_investigación = '';

if (empty($lineaPRECAR)) {
    $lineas_de_investigación = '';
        if (!empty($linea_tematica)){
            $lineas_de_investigación = "<input type=text name='linea_tematica' value='$linea_tematica' readonly><br>";
    }else{
        $lineas_de_investigación .= "<h5>Lineas Preestructuradas<hr></h5>";
        $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_pre', 'onclick = borra()','align' => 'horizontal', 'options' => $vars['lineas_pre']));
        $lineas_de_investigación .= "<br>";
        $lineas_de_investigación .= "<h5>Lineas Abiertas<hr></h5>";
        $lineas_de_investigación .= elgg_view('input/radio', array('name' => 'lineas_open', 'align' => 'horizontal', 'options' => $vars['lines_open']));
        $lineas_de_investigación .= "<br>";
    }
} else {
    $lineas_de_investigación = "<input type=text name='linea_tematicaPRE' value='$lineaPRECAR' readonly><br>";
}

//Labels y titulos del body del formulario
$titulo_general = elgg_echo('evaluador:formtaos:evaluar:informecuad:titulo_general');
$lbl_inf_in = elgg_echo('evaluador:formtaos:evaluar:informe:infinv');

$lbl_dpto = elgg_echo('evaluador:formtaos:evaluar:informe:dpto');
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
$lbl_coherencia = elgg_echo('evaluador:formtaos:evaluar:informecuad:lbl_coherencia');
$lbl_puntaje_trabajo_colaborativo = elgg_echo('evaluador:formtaos:evaluar:informecuad:puntaje_trabajo_colaborativo');
$lbl_puntaje_claridad_pregunta = elgg_echo('evaluador:formtaos:evaluar:informecuad:puntaje_claridad_pregunta');
//RUTA_INDAGACION
$lbl_ruta_indagacion = elgg_echo('evaluador:formtaos:evaluar:informecuad:ruta_indagacion');
$lbl_puntaje_diseño_metodologico = elgg_echo('evaluador:formtaos:evaluar:informecuad:puntaje_diseño_metodologico');
$lbl_puntaje_conceptos_investigacion = elgg_echo('evaluador:formtaos:evaluar:informecuad:puntaje_conceptos_investigacion');
$lbl_puntaje_resultados_claros = elgg_echo('evaluador:formtaos:evaluar:informecuad:puntaje_resultados_claros');
//FUENTES
$lbl_fuentes = elgg_echo('evaluador:formtaos:evaluar:informecuad:lbl_fuentes');
$lbl_puntaje_forma_adecuada = elgg_echo('evaluador:formtaos:evaluar:informecuad:puntaje_forma_adecuada');
//ANEXOS
$lbl_puntaje_total = elgg_echo('evaluador:formtaos:evaluar:informecuad:lbl_puntaje_total');
$lbl_obs = elgg_echo('evaluador:formtaos:evaluar:informecuad:obs');

$button = elgg_view('input/submit', array( 'value' => elgg_echo('Guardar')));

$body =   "<input type='hidden' name='guid_invest' value='$guid_inv'>"
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
            //COHERENCIA   
            . "<tr>"
                . "<td rowspan=3>$lbl_coherencia</td>"
                . "<td COLSPAN=5>$lbl_puntaje_trabajo_colaborativo</td>"
                . "<td><input type='number' name='puntaje_trabajo_colaborativo' id='puntaje_trabajo_colaborativoINNinv' value='$puntaje_trabajo_colaborativo' required></td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=5>$lbl_puntaje_claridad_pregunta</td>"
                . "<td><input type='number' name='puntaje_claridad_pregunta' id='puntaje_claridad_preguntaINNinv' value='$puntaje_claridad_pregunta' required></td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=5><center><h4>$lbl_subtotal</h4></center></td>"
                . "<td><input type='number' name='subtotal_coherencia' id='subtotal_coherenciaINNinv' value='$subtotal_coherencia' readonly></td>"
            . "</tr>"
            //RUTA_INDAGACION
            . "<tr>"
                . "<td rowspan=4>$lbl_ruta_indagacion</td>"
                . "<td COLSPAN=5>$lbl_puntaje_diseño_metodologico</td>"
                . "<td><input type='number' name='puntaje_diseño_metodologico'  id='puntaje_diseño_metodologicoINNinv' value='$puntaje_diseño_metodologico' required></td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=5>$lbl_puntaje_conceptos_investigacion</td>"
                . "<td><input type='number' name='puntaje_conceptos_investigacion'  id='puntaje_conceptos_investigacionINNinv' value='$puntaje_conceptos_investigacion' required></td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=5>$lbl_puntaje_resultados_claros</td>"
                . "<td><input type='number' name='puntaje_resultados_claros' id='puntaje_resultados_clarosINNinv' value='$puntaje_resultados_claros' required></td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=5><center><h4>$lbl_subtotal</h4></center></td>"
                . "<td><input type='number' name='subtotal_ruta'  id='subtotal_rutaINNinv' value='$subtotal_ruta' readonly></td>"
            . "</tr>"
            //FUENTES
            . "<tr>"
                . "<td rowspan=2>$lbl_fuentes</td>"
                . "<td COLSPAN=5>$lbl_puntaje_forma_adecuada</td>"
                . "<td><input type='number' name='puntaje_forma_adecuada' id='puntaje_forma_adecuadaINNinv' value='$puntaje_forma_adecuada' required></td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=5><center><h4>$lbl_subtotal</h4></center></td>"
                . "<td><input type='number' name='subtotal_fuentes' id='subtotal_fuentesINNinv' value='$subtotal_fuentes' readonly></td>"
            . "</tr>"
            //ANEXOS
            . "<tr>"
                . "<td COLSPAN=6><center><h4>$lbl_puntaje_total</h4></center></td>"
                . "<td><input type='number' name='puntaje_total' id='puntaje_totalINNinv' value='$puntaje_total' readonly></td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=7>$lbl_obs</td>"
            . "</tr>"
            . "<tr>"
                . "<td COLSPAN=7><textarea name='observaciones'>$observaciones</textarea></td>"
            . "</tr>"
        . "</table>"
        . "<br>"
        . "<center>$button</center>";

echo $body;

