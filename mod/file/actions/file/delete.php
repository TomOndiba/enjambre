<?php

/**
 * Elgg file delete
 * 
 * @package ElggFile
 */
$guid = (int) get_input('guid');
$container_guid = elgg_get_logged_in_user_guid();
$usuario = get_entity($container_guid);

$file = new FilePluginFile($guid);
if (!$file->guid) {
    register_error(elgg_echo("file:deletefailed"));
    forward('file/all');
}

if (!$file->canEdit()) {
    register_error(elgg_echo("file:deletefailed"));
    forward($file->getURL());
}

$container = $file->getContainerEntity();

if ($file->guid == $usuario->hoja_vida) {
    $options = array(
        'guid' => $usuario->guid,
        'metadata_name' => 'hoja_vida',
        'limit' => false
    );
    $g = elgg_delete_metadata($options);
}

if (!$file->delete()) {
    register_error(elgg_echo("file:deletefailed"));
} else {

    system_message(elgg_echo("file:deleted"));


    $options2 = array(
        'guid' => $file->container_guid,
        'metadata_name' => 'hoja_de_vida',
        'limit' => false
    );

    $del = elgg_delete_metadata($options2);
}


if($container->getSubtype()=="red_tematica")
{
    forward("/redes_tematicas/archivos/{$container->guid}");
}
  else if($container->getSubtype()=="grupo_investigacion"){
        forward("/grupo_investigacion/archivos/{$container->guid}");  
     }  
     else if($container->getSubtype()=="feria"){
        forward("/ferias_publico/archivos/{$container->guid}");  
     } 
     else if($container->getSubtype()=="institucion"){
        forward("/instituciones/archivos/{$container->guid}");  
     }  
     else{
        if (elgg_instanceof($container, 'group')) {
            forward("file/group/$container->guid/all");
        } else {
            forward("file/owner/$container->username");
        }
     }