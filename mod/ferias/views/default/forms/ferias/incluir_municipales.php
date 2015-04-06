<?php

/*
 * Vista donde se permite incluir ferias municipales en una feria departamental
 */

$ferias_municipales = $vars['ferias_municipales'];
$guid_feria = $vars['id_feria'];


$ferias_input=elgg_view('input/checkboxes', array('name'=>'ferias_municipales', 'align'=>'Vertical', 
                        'options'=>$ferias_municipales));

$feria_dptal = elgg_view('input/hidden', array('name' => 'id_feria', 'value' => $guid_feria));


$button = elgg_view('input/submit', array('id'=>'incluir', 'value' => elgg_echo('Incluir')));

echo <<<HTML
<div class='box contet-grupo-investigacion'><div class='padding20'>
<div> <label>Ferias municipales disponibles<hr></label></div>        
       $ferias_input
       <br>
       $feria_dptal
</div>
<div id='href' align='center'>
    $button
    <br><br>
</div>
</div>

HTML;
?>