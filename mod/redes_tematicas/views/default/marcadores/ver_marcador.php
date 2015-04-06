<?php
elgg_load_js('confirmacion');
elgg_load_js("ajax_comentarios");
elgg_load_js('miniaturas');
elgg_load_js("reveal2");
elgg_load_css('reveal');
$bookmark = $vars['entity'];

$owner = $bookmark->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$container = $bookmark->getContainerEntity();


$link='<a target="_blank" href="'.$bookmark->address.'">'.$bookmark->address.' </a>';
$description = elgg_view('output/longtext', array('value' => $bookmark->description, 'class' => 'pbl'));

$owner_link = elgg_view('output/url', array(
    'href' => "bookmarks/owner/$owner->username",
    'text' => $owner->name,
    'is_trusted' => true,
        ));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($bookmark->time_created);

//url para eliminar el bookmark
$url = elgg_get_site_url() . "action/bookmarks/delete?guid=" . $bookmark->guid;
$url_el = elgg_add_action_tokens_to_url($url);

$user = elgg_get_logged_in_user_guid();

//url para  editar el bookmark 
 $container = get_entity($bookmark->container_guid);
 $url_editar='<a href="#" data-tooltip="Editar Marcador" data-reveal-id="myModalMarcador" onclick=\'editarMarcador(' . $bookmark->container_guid . ','.$bookmark->guid.')  \'><div class="icon-editar-2"></div></a>';
        
if ($user == $owner->guid) {
    $img_eliminar = "<a data-tooltip='Eliminar Marcador' onclick=\"confirmar('{$url_el}')\"><div class='icon-eliminar-2'></div></a>";
} else {
    $img_eliminar = "";
    $url_editar="";
}

$likes = elgg_view('like/like_entity', array('guid' => $bookmark->guid));
$bookmark_icon = elgg_view_icon('push-pin-alt');

echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Marcador?</div>';
echo "<div class='file'><div class='img-file' style='margin-left:20px;'><div class='descripcion-archivo'><a target='_blank' href='{$bookmark->address}'><img src='http://api.webthumbnail.org?width=200&height=150&screen=1024&url={$bookmark->address}'/></a></div></div>"
 . "<div class='info-file' style='margin-left:20px;' ><span class='name-file'>$link</span><br>"
 . "<div class='descripcion-archivo'>$author_text<br>"
 . "$date<br><br></div>"
 . "<span style='color:black;'>$description</span>"
 . "</div>"
 . "<div class='iconos-file'>{$url_editar} {$img_eliminar}</div>"
 . "<div class='file-likes'>$likes</div>"
 . "</div>";

echo elgg_view('comentarios/comentarios', array('guid' => $bookmark->guid));


?>

<div id="myModalMarcador" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-marcador pop-up">
    </div>
</div>
<script>
    function editarMarcador(grupo, marcador){
        elgg.get('ajax/view/marcadores/add_marcador', {
            timeout: 30000,
            data: {
                owner:grupo,
                guid_marcador:marcador,
                
            },
            success: function(result, success, xhr) {
                $('.pop-up-marcador').html(result);
            },
        });
    }
</script>
