<?php

/**
 * 
 */

$guid_grupo=  get_input('id_grupo');
$guid_cuaderno=get_input('id_cuaderno');
$pregunta=  get_input('pregunta');

$grupo=new ElggGrupoInvestigacion($guid_grupo);
$cuaderno= new ElggCuadernoCampo($guid_cuaderno);
$name_anterior=$cuaderno->name;
$dbprefix = elgg_get_config('dbprefix');
$subtype_id = add_subtype('group', 'investigacion');
$guid=update_data("UPDATE {$dbprefix}entities set subtype='$subtype_id' WHERE guid=$cuaderno->guid");

if($guid){
    if($grupo->removeRelationship($guid_cuaderno, 'tiene_cuaderno_campo')){
        if($grupo->addRelationship($guid_cuaderno, 'tiene_la_investigacion')){
            $cuaderno->name=$pregunta;
            $cuaderno->elegible='false';
            $save=$cuaderno->save();
            if($guid==$save){
                system_message(elgg_echo("investigacion:ok:create"));
                forward('investigaciones/ver/'.$guid_cuaderno."/grupo/".$guid_grupo);
            }
        }else{
            $subtype_id = add_subtype('group', 'cuaderno_campo');
            $guid=update_data("UPDATE {$dbprefix}entities set subtype='$subtype_id' WHERE guid=$cuaderno->guid");
            $grupo->addRelationship($guid_cuaderno, 'tiene_cuaderno_campo');
            register_error(elgg_echo("evento:error:create"));
            forward(REFERER);
        }
    }else{
        $subtype_id = add_subtype('group', 'cuaderno_campo');
        $guid=update_data("UPDATE {$dbprefix}entities set subtype='$subtype_id' WHERE guid=$cuaderno->guid");
        register_error(elgg_echo("evento:error:create"));
        forward(REFERER);
    }
}else{
    register_error(elgg_echo("evento:error:create"));
    forward(REFERER);
}
