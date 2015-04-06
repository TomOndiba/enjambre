<?php

/** Vista que permite mostrar todas las investigaciones que fueron asignadas al evaluador */
elgg_load_js('confirmacion');
elgg_load_js('validate');

$entities = $vars['entities'];


if (!$entities) {
    echo "<div class='mensaje-vacio'><h2>No tiene Marcadores</h2></div>";
} else {
    $lista="<ul class='lista-archivos'>";
    foreach ($entities as $bookmark) {

        $owner = $bookmark->getOwnerEntity();
        $owner_icon = elgg_view_entity_icon($owner, 'tiny');
        $container = $bookmark->getContainerEntity();

        //url para eliminar el bookmark
        $url = elgg_get_site_url() . "action/bookmarks/delete?guid=" . $bookmark->guid;
        $url_el = elgg_add_action_tokens_to_url($url);
        $url_eliminar = '<a onclick="confirmar(\'' . $url_el . '\')">Eliminar</a>';

        //url para ver el bookmark 
        $container = get_entity($bookmark->container_guid);
        if ($container->getSubtype() == "grupo_investigacion") {
            $url_file = elgg_get_site_url() . "grupo_investigacion/marcadores/{$bookmark->container_guid}/view/{$bookmark->guid}";
        } else if ($container->getSubtype() == "institucion") {
            $url_file = elgg_get_site_url() . "instituciones/marcadores/{$bookmark->container_guid}/view/{$bookmark->guid}";
        } else if ($container->getSubtype() == "feria") {
            $url_file = elgg_get_site_url() . "feria/marcadores/{$bookmark->container_guid}/view/{$bookmark->guid}";
        } else {
            $url_file = elgg_get_site_url() . "redes_tematicas/marcadores/{$bookmark->container_guid}/view/{$bookmark->guid}";
             }

        $user = elgg_get_logged_in_user_entity();
        //Si el usuario logueado no es el Owner del marcador, no se muestran los link de Editar y eliminar 
        if ($user->guid != $owner->guid) {
            $url_editar = "";
            $url_eliminar = "";
        }

        $link = elgg_view('output/url', array('href' => $bookmark->address));
        $description = elgg_view('output/longtext', array('value' => $bookmark->description, 'class' => 'pbl'));


        $author_text = elgg_echo('byline', array($owner->name));

        $date = elgg_view_friendly_time($bookmark->time_created);

        $comments_count = $bookmark->countComments();
//only display if there are commments
        if ($comments_count != 0) {
            $text = elgg_echo("comments") . " ($comments_count)";
            $comments_link = elgg_view('output/url', array(
                'href' => $bookmark->getURL() . '#comments',
                'text' => $text,
                'is_trusted' => true,
            ));
        } else {
            $comments_link = '';
        }

        $titulo=  mb_substr($bookmark->title,0,80,'UTF-8');
        $link2=  mb_substr($bookmark->address,0, 45,'UTF-8');
        $subtitle = "$author_text $date $comments_link ";
        $lista.="<li class='element-verde' style='height:80px;'><div style='height:80px;'>";
        $lista.= "<div class='descripcion-archivo-2' style='margin-left:20px;'><a  data-tooltip='{$bookmark->title}' style='font-weight:700;' href='{$url_file}'>{$titulo}</a> <br>"
                . "<span>$subtitle<br>"
                . "<a target='_blank' href='{$bookmark->address}'>$link2 </a><br>"
                ."</span> </div>";
        $lista.="</div></li>";
                
      
    }
    $lista.="</ul>";

    
    echo $lista;
}
?>



