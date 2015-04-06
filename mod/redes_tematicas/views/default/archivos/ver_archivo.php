<?php

/*
  Vista de Un archivo
 */
elgg_load_js('confirmacion');
elgg_load_js("ajax_comentarios");
//elgg_load_js("reveal2");
//elgg_load_css('reveal');


$file = $vars['file'];

$owner = $file->getOwnerEntity();

$container = $file->getContainerEntity();
$descripcion = elgg_get_excerpt($file->description);

$owner_link = elgg_view('output/url', array(
    'href' => "file/owner/$owner->username",
    'text' => $owner->name,
    'is_trusted' => true,
        ));
$author_text = elgg_echo('byline', array($owner_link));

//obtiene el icono del archivo
$file_icon = elgg_view_entity_icon($file, 'small');

$date = elgg_view_friendly_time($file->time_created);

//comentarios
$comments_count = $file->countComments();

//Url para descargar el archivo
$url = elgg_get_site_url() . "file/download/$file->guid";
$img_descargar = "<a href='{$url}' download><div class='icon-descargar-2' data-tooltip='Descargar Archivo' ></div></a>";

$likes = elgg_view('like/like_entity', array('guid' => $file->guid));

//url para eliminar el archivo
$url = elgg_get_site_url() . "action/file/delete?guid=" . $file->guid;
$url_el = elgg_add_action_tokens_to_url($url);

$user= elgg_get_logged_in_user_guid();

//Url para editar
//$url_editar='<a href="#" data-reveal-id="myModalArchivo" onclick=\'editarArchivo(' . $container->guid . ','.$file->guid.')  \'>Editar</a>';


if($user==$owner->guid){
$img_eliminar = "<a data-tooltip='Eliminar Archivo' onclick=\"confirmar('{$url_el}')\"><div class='icon-eliminar-2'></div></a>";
}
else{
$img_eliminar="";

}



echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Archivo?</div>';
echo "<div class='file'>"
 . "<div class='img-file'>" . $file_icon . "</div>"
 . "<div class='info-file'><span class='name-file'>$file->title</span><br>"
 . "<span class='subtitulo-file'>Publicado $author_text <br>"
 . "$date</span>"
 . "</div>"
 . "<div class='iconos-file'>{$img_descargar}{$img_eliminar}</div>"
 . "<div class='descripcion-file'>$descripcion</div>"
 . "<div class='file-likes'>$likes </div>"
 . "</div>";

echo elgg_view('comentarios/comentarios', array('guid' => $file->guid));

?>

