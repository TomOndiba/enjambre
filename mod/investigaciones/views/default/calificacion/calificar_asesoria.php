<?php
$asesoria_guid= get_input("asesoria");
$rate= get_input("rate");

$asesoria= new ElggAsesoria($asesoria_guid);
$asesoria->annotate('calificacion', $rate, ACCESS_PUBLIC, elgg_get_logged_in_user_entity()->guid);
$annotations= $asesoria->getAnnotations('calificacion');
$notaFinal=0;
foreach($annotations as $nota){
    $notaFinal+=(int) $nota->value;
}

echo ($notaFinal/ sizeof($annotations));
