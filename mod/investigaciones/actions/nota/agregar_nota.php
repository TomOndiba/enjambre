<?php

$guid_diario=  get_input('guid');
$contenido=get_input('nota');
$tipo=get_input('tipo');
$etapa=  get_input('etapa');


$nota= new ElggNota();
$nota->description=$contenido;
$nota->container_guid=  elgg_get_logged_in_user_guid();
$nota->owner_guid=$guid_diario;
$nota->etapa=$etapa;
$nota->tipo=$tipo;
$guid=$nota->save();


if($guid){
    system_messages(elgg_echo('nota:save:ok'), 'success');
}

else{
    system_messages(elgg_echo('nota:save:error'), 'error');
}

forward(REFERER);

