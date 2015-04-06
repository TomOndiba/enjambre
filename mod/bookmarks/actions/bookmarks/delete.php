<?php
/**
 * Delete a bookmark
 *
 * @package Bookmarks
 */

$guid = get_input('guid');
$bookmark = get_entity($guid);

if (elgg_instanceof($bookmark, 'object', 'bookmarks') && $bookmark->canEdit()) {
	$container = $bookmark->getContainerEntity();
	if ($bookmark->delete()) {
		system_message(elgg_echo("bookmarks:delete:success"));
                
                if(elgg_instanceof($container, 'group', 'red_tematica')){
                    forward("redes_tematicas/marcadores/$container->guid"); 
                }
                else  if(elgg_instanceof($container, 'group', 'grupo_investigacion')){
                    forward("grupo_investigacion/marcadores/$container->guid"); 
                }
                else  if(elgg_instanceof($container, 'group', 'institucion')){
                    forward("instituciones/marcadores/$container->guid"); 
                }
                else  if(elgg_instanceof($container, 'group', 'grupo_investigacion')){
                    forward("feria/marcadores/$container->guid"); 
                }
                else{
                      if(elgg_instanceof($container, 'group')) {
                            forward("bookmarks/group/$container->guid/all");
                    } else {
                            forward("bookmarks/owner/$container->username");
                    }
                }
	}
}

register_error(elgg_echo("bookmarks:delete:failed"));
forward(REFERER);
