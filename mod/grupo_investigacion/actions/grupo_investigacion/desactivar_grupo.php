<?php

$entity = get_entity(get_input("guid"));


if($entity->disable()){
    system_messages(elgg_echo('Se ha desactivado'), 'success');
}else{
    register_error(elgg_echo('No se ha completado la accion'));
}

$site=  elgg_get_site_url();
if($entity->getSubtype()=="grupo_investigacion"){
forward("/grupo_investigacion/listar/");
}
else if($entity->getSubtype()=="institucion"){
forward("/instituciones/");
}
else{
    forward("/redes_tematicas/listar/");
}