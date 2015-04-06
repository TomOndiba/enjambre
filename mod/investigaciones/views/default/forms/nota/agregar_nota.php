<?php

$guid_diario=$vars['guid'];

$diario_input=  elgg_view('input/hidden', array('name'=>'guid', 'value'=>$guid_diario));
$etapa_input=elgg_view('input/hidden', array('name'=>'etapa', 'value'=>$vars['etapa']));
$tipo_input = elgg_view('input/hidden', array('name' => 'tipo', 'value'=>''));
$button = elgg_view('input/submit', array('value' => elgg_echo('Agregar')));
?>

<div class="box">
    <h2 class="title-legend">Agregar Nota</h2>

    
    <div class="contenido-mensaje">
       
        <textarea name='nota' placeholder="Escriba aqui su Nota" required></textarea>
    </div>
 
    <div>
        <?php echo $diario_input.$tipo_input.$etapa_input; ?>
    </div>
    <div class="contenedor-button">
        <?php echo $button ?>
    </div>
</div>