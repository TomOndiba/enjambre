<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Álbumes</h2>
    <?php
    elgg_load_js("reveal2");
    elgg_load_css('reveal');
    elgg_load_js('validate');
    $page_link = $vars['page'];
    $guid = $vars['guid'];
    $entity=  get_entity($guid);

    $albunes = elgg_get_albunes_owner($guid);
    $content = "";
    $site_url = elgg_get_site_url();
    $user=  elgg_get_logged_in_user_entity();
    $es_miembro=  elgg_is_miembro_admin($guid, $user->guid);
    
    if(($es_miembro && !check_entity_relationship($user->guid, "usuario_desactivado_de", $guid))||$entity->getSubtype()=="feria"){
    $button_crear = '<div class="contenedor-button"><a class="link-button" href="#" data-reveal-id="myModalAlbum" onclick=\' getCrearAlbum("' . $guid . '")  \'>Crear Álbum</a></div>';
    }
    else{
    $button_crear="";
    }
    ?>
    <?php echo $button_crear; ?>
    <ul style="margin-left: 0">
        <?php
        if(sizeof($albunes)==0){
         echo "<div class='mensaje-vacio'><h2>No Hay Albumes</h2></div>";
        }
        else{
        foreach ($albunes as $album) {
            $portada = elgg_get_foto_portada($album->guid);
            $url = $site_url . "photos/thumbnail/{$portada->guid}/small/";
            $url_ver_album = "{$page_link}/fotos/{$album->guid}";
            $titulo = mb_substr($album->title,0,60,'UTF-8');
            ?>
            <li>
                <div class="imagen-grupo">
                    <a href="<?php echo  $url_ver_album ; ?>"> <img src="<?php echo  $url; ?>"/></a>
                </div>
                <div class="nombre-grupo">
                   <h4><?php //echo $titulo; ?></h4>
                    <a data-tooltip="<?php echo $album->title?>" href="<?php echo  $url_ver_album ; ?>"> <h4><?php echo $titulo; ?></h4> </a>
                </div>
            </li>
           

            <?php
        }
        }
        ?>
    </ul>

</div>

<div id="myModalAlbum" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-album pop-up">
    </div>
</div>
<script>
    function getCrearAlbum(guid){
       
        elgg.get('ajax/view/album/crear_album', {
            timeout: 30000,
            data: {
                id:guid,
            },
            success: function(result, success, xhr) {
                $('.pop-up-album').html(result);
            },
        });
    }
</script>
