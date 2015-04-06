<?php

$guid_convocatoria=  get_input('guid_convocatoria');
$ids= get_input('ids');


$id=  explode("-", $ids);
$sw=true;
foreach($id as $inv){
    if(!empty($inv)){
       
        $investigacion= new ElggInvestigacion($inv);
        $investigacion->presupuesto= get_input("presupuesto$inv");
        $user = elgg_get_logged_in_user_entity();
        if(!create_metadata($inv, 'presupuesto', $investigacion->presupuesto, 'text', $user->guid, ACCESS_PUBLIC)){
            $sw=$sw&false;
        }
    }
}

if($sw){
    system_message(elgg_echo("presupuesto:ok:asignacion"));
    forward("convocatorias/investigaciones/$guid_convocatoria#seleccionadas");
}else{
    register_error(elgg_echo("presupuesto:error:asignacion"));
    //forward(REFERER);
}

