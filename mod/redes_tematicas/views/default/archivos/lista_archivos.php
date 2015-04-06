<?php

/** Vista que permite mostrar todas las investigaciones que fueron asignadas al evaluador */

$entities = $vars['entities'];
$tabla_inv = "<ul class='lista-archivos'>";
if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No tiene archivos</h2></div>";
} else {

    foreach ($entities as $entity) {
        
        $owner = elgg_get_usuario_byId($entity->owner_guid);
        $owner_link = "<a href='" . elgg_get_site_url() . "profile/" . $owner->username . "'>{$owner->username}</a>";


        //url para ver y editar el archivo
        $container = get_entity($entity->container_guid);
        $user = elgg_get_logged_in_user_entity();

        if ($container->getSubtype() == "grupo_investigacion") {
            $url_file = elgg_get_site_url() . "grupo_investigacion/archivos/{$container->guid}/view/{$entity->guid}";
        }
        else if($container->getSubtype() == "institucion") {
            $url_file = elgg_get_site_url() . "instituciones/archivos/{$container->guid}/view/{$entity->guid}";
        } 
        else if($container->getSubtype() == "red_tematica") {
            $url_file = elgg_get_site_url() . "redes_tematicas/archivos/{$container->guid}/view/{$entity->guid}";
        }
        else {
            $url_file = elgg_get_site_url() . "feria/archivos/{$container->guid}/view/{$entity->guid}";
        } 
        


        //url para eliminar el archivo
        $url = elgg_get_site_url() . "action/file/delete?guid=" . $entity->guid;
        $url_el = elgg_add_action_tokens_to_url($url);
        $url_eliminar = '<a onclick="confirmar(\'' . $url_el . '\')">Eliminar</a>';

        //Si el usuario logueado no es el Owner del archivo, no se muestran los link de Editar y eliminar        
        if ($user->guid != $owner->guid) {
            $url_editar = "";
            $url_eliminar = "";
        }


        //ver icono del archivo
        $file_icon = elgg_view_entity_icon($entity, 'small');
        //autor
        $author_text = elgg_echo('byline', array($owner_link));
        //fecha de publicacion
        $date = elgg_view_friendly_time($entity->time_created);
        $excerpt = elgg_get_excerpt($entity->description);

        //comentarios
        $comments_count = $entity->countComments();
        //only display if there are commments
        if ($comments_count != 0) {
            $text = elgg_echo("comments") . " ($comments_count)";
            $comments_link = elgg_view('output/url', array(
                'href' => $entity->getURL() . '#file-comments',
                'text' => $text,
                'is_trusted' => true,
            ));
        } else {
            $comments_link = '';
        }

        //url para eliminar el archivo
        $url = elgg_get_site_url() . "action/likes/add?guid=" . $entity->guid;
        $url_megusta = elgg_add_action_tokens_to_url($url);

        $titulo=  mb_substr($entity->title,0,60,'UTF-8');
        
                
        $tabla_inv.="<li><div data-tooltip='{$entity->title}'>"
                . "<div class='icono-archivo'>{$file_icon}</div>"
                . "<div class='descripcion-archivo'><a  href='{$url_file}'>{$titulo}</a> <br>"
                . "<span>$author_text<br>"
                . "$date</span> </div></div> </li>";
    }
    $tabla_inv.="<ul/>";

    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Archivo?</div>';
    echo $tabla_inv;
}
?>



