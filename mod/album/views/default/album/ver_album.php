<?php
$album = $vars['album'];
$limit = 16;

$user = elgg_get_logged_in_user_entity();


if (!$album) {
    $album = get_input('album');
}
$alb = get_entity($album);
$es_miembro = elgg_is_miembro_admin($alb->owner_guid, $user->guid);
$entity = get_entity($album);
$offset = get_input("offset");
if (!get_input("ajax")) {
    elgg_load_js('confirmacion');
    elgg_load_js("ajax_comentarios");
    elgg_load_js("ajax_album");
    elgg_load_js("visor_js");
    elgg_load_css("visor_css");
    elgg_load_js('reveal2');
    elgg_load_css("reveal");
    
    
    //url para eliminar el bookmark
$url = elgg_get_site_url() . "action/album/delete_album?album=" . $album;
$url_el = elgg_add_action_tokens_to_url($url);

if ($user == $cuaderno->owner_guid && sizeof($maestros)==0 && sizeof($estudiante)==0) {
    $img_eliminar = "<a data-tooltip='Eliminar Iniciativa' onclick=\"confirmar('{$url_el}')\"><div class='icon-eliminar-2'></div></a>";
}

$header.="<div style='margin-left:90%;'>{$img_eliminar}</div>";
    ?>

    <div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
        <h2 class="title-legend">Álbum: <?php echo $entity->title; ?></h2>
    <?php if ($es_miembro) { ?>
            <div  class="contenedor-button" data-reveal-id="myModal-addfotos" >
                <a class="link-button">Agregar Fotos</a>
            </div>
    <?php } ?>
        <div id="myModal-addfotos" class="reveal-modal">
            <div class="close-reveal-modal" ></div>
            <div class="pop-up">
    <?php
    $form_params = array('enctype' => 'multipart/form-data');
    $vars = array('guid' => $album);
    echo elgg_view_form('album/add_fotos_album', $form_params, $vars);
    ?>
            </div>
        </div>

        <div id="myModal-fotos" class="reveal-modal" style="width: 850px; margin-left: -600px; top:20px">
            <div class="close-reveal-modal" style="right: -160px;margin-top: -5px;"></div>
            <div class="pop-up-foto">
            </div>
        </div>
        <ul style="margin-left: 0">
    <?php
}
$content = "<div class='visor-fotos'></div><div id='fotos-ajax'>";
$prox_offset = $offset + $limit;
if ($prox_offset < elgg_get_total_fotos_album($album)) {
    $ver_mas = "<a title='{$prox_offset}' name='{$album}' id='ver-mas-fotos'>Ver mas</a>";
}

$fotos = elgg_get_fotos_album($album, $offset, $limit);

foreach ($fotos as $foto) {
    echo "<li><div class='imagen-grupo'>";
    $site_url = elgg_get_site_url();
    $url = $site_url . "photos/thumbnail/{$foto->guid}/small/";
    echo "<a><img src='{$url}' title='{$foto->guid}' class='foto' data-reveal-id='myModal-fotos'></img></a>";
    echo "</div></li>";
}
$content.="</div>" . $ver_mas;

echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Si elimina el Album, se eliminarán todas las fotos.Está seguro que desea eliminarlo?</div>';

echo $content;
?>
    </ul
</div>