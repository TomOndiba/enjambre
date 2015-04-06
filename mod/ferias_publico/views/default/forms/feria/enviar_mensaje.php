<?php

$guid=$vars['guid'];

echo "<label> Asunto </label>";
echo elgg_view('input/text', array('name' => 'asunto', 'required'=>'true'));
echo "<label> Nuevo Mensaje </label>";
echo elgg_view('input/longtext', array('name' => 'mensaje', 'required'=>'true'));
echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
echo elgg_view('input/submit', array('value' => elgg_echo('Enviar')));
