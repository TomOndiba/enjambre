<?php

/**
 * Form donde se llenan los datos necesarios de la evaluación del maestro escrito
 * 
 * @author CORTEX_DIEGOX
 */
elgg_load_js('sumar2.1');

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
$categoria = $vars['categoria'];


//EVALUACION HECHA
$evaluacion = $vars['eval_hecha'];
$guid_evaluacion_hecho = $evaluacion['guid_evaluacion_hecho'];
$visible_reflexiones = $evaluacion['visible_reflexiones'];
$puntaje_visible_reflexiones = $evaluacion['puntaje_visible_reflexiones'];
$practica_pedagogica = $evaluacion['practica_pedagogica'];
$puntaje_practica_pedagogica = $evaluacion['puntaje_practica_pedagogica'];
$aprendizajes_propios = $evaluacion['aprendizajes_propios'];
$puntaje_aprendizajes_propios = $evaluacion['puntaje_aprendizajes_propios'];
$reflexion_presentada = $evaluacion['reflexion_presentada'];
$puntaje_reflexion_presentada = $evaluacion['puntaje_reflexion_presentada'];
$puntaje_total = $evaluacion['puntaje_total'];
$obs = $evaluacion['obs'];
$url_print = $evaluacion['url_print'];

$imprimir = '';
if (!empty($url_print)) {
    $imprimir = "<a href='$url_print' >Imprimir</a>";
}



//Labels y titulos del body del formulario
$titulo_general = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:title:escrito');

$lbl_dpto = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:dpto');
$lbl_nombre_grupo = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:nombregrupo');
$lbl_colegio = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:colegio');
$lbl_name_Inv = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:nombreinv');
$lbl_colaborador = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:colaborador');
$lbl_nombre_eval = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:nombreeval');
$lbl_eval_colegio = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:evalcolegio');
$lbl_profesion = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:profesion');
$lbl_criterios = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:criterios');
$lbl_comentarios = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:comentarios');
$lbl_puntaje = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:puntaje');

//
$lbl_visible_reflexiones = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:visible_reflexiones');
$lbl_practica_pedagogica = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:practica_pedagogica');
$lbl_aprendizajes_propios = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:aprendizajes_propios');
$lbl_reflexion_presentada = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:reflexion_presentada');
$lbl_puntaje_total = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:puntaje_total');
$lbl_obs = elgg_echo('evaluador:formtaos:evaluar:maestro:escrito:obs');

$button = elgg_view('input/submit', array('value' => elgg_echo('Guardar')));

$body = "<input type='hidden' name='guid_invest' value='$guid_inv'>"
        . "<input type='hidden' name='guid_eval' value='$guid_evaluador'>"
        . "<input type='hidden' name='guid_colegio' value='$guid_colegio'>"
        . "<input type='hidden' name='guid_feria' value='$guid_feria'>"
        . "<input type='hidden' name='guid_evaluacion_hecho' value='$guid_evaluacion_hecho'>"
        . "<input type='hidden' name='categoria' value='$categoria'>"
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
        . "<td>$lbl_colaborador</td> <td COLSPAN=5><input type='text' name='colaborador' value='$colaborador' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_nombre_grupo</td> <td COLSPAN=5><input type='text' name='name_grupo' value='$nombre_grupo' size='180' readonly></td>"
        . "</tr>"
        . "<tr>"
        . "<td>$lbl_name_Inv</td> <td COLSPAN=5><input type='text' name='name_inv' value='$inv_name' size='180' readonly></td>"
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
        . "<td COLSPAN=5><center>$lbl_criterios</center></td>"
        . "<td><center>$lbl_puntaje</center></td>"
        //. "<td><center>$lbl_comentarios</td>"                
        . "</tr>"
        . "<tr><td COLSPAN=6></td></tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_visible_reflexiones</td>"
        . "<td><center><input type='number' name='puntaje_visible_reflexiones'  id='puntaje_visible_reflexiones' value='$puntaje_visible_reflexiones' required></center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center><textarea name = 'visible_reflexiones' required>$visible_reflexiones</textarea></center></td>"
        . "</tr>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_practica_pedagogica</td>"
        . "<td><center><input type='number' name='puntaje_practica_pedagogica'  id='puntaje_practica_pedagogica' value='$puntaje_practica_pedagogica' required></center></td>"
        . "<tr>"
        . "<td COLSPAN=6>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center><textarea name = 'practica_pedagogica' required>$practica_pedagogica</textarea></center></td>"
        . "</tr>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_aprendizajes_propios</td>"
        . "<td><center><input type='number' name='puntaje_aprendizajes_propios'  id='puntaje_aprendizajes_propios' value='$puntaje_aprendizajes_propios' required></center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center><textarea name = 'aprendizajes_propios' required>$aprendizajes_propios</textarea></center></td>"
        . "</tr>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_reflexion_presentada</td>"
        . "<td><center><input type='number' name='puntaje_reflexion_presentada'  id='puntaje_reflexion_presentada' value='$puntaje_reflexion_presentada' required></center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6>Comentarios:</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=6><center><textarea name = 'reflexion_presentada' required>$reflexion_presentada</textarea></center></td>"
        . "</tr>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=5>$lbl_puntaje_total</td>"
        . "<td><center><input type='number' name='puntaje_total'  id='puntaje_totalMO' value='$puntaje_total' readonly></center></td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=7>$lbl_obs</td>"
        . "</tr>"
        . "<tr>"
        . "<td COLSPAN=7><center><textarea name='obs' required>$obs</textarea></center></td>"
        . "</tr>"
        . "</table>"
        . "<br>"
        . "<center>$button</center>";

echo $body;

