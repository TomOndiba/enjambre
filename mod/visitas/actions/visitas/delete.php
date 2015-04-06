<?php

$id_visita=get_input('id_v');

$visita = new ElggVisita($id_visita);

$r = $visita->delete();

if($r){
    system_message('operacion realizada');
}else{
    register_error('no se puedo realizar la operacion');
}
forward("visitas/");

