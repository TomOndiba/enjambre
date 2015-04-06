<?php

$instrucciones=  elgg_echo('instruccion:roles:asignarusuario');
$nombre_input = elgg_view('input/text', array(
    'id'=>'buscar',
    'placeholder'=>'Nombres y/o Apellidos del usuario',
    'required'=>'true',
        ));

echo <<<HTML
<br><div>$instructions</div>
<div>
    <label>Documento</label><br />$nombre_input
</div>
    <br>    
<div id="destino">   
</div>      
HTML;
