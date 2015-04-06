<?php
$foto = $vars['foto'];
$input_comentario = elgg_view("input/text", array('id' => "input-comentario-foto", "title" => $foto, 'placeholder' => 'Escribe tu comentarioss'));
$titulo = elgg_echo("titulo:comentarios:fotos");
$f = get_entity($foto);
$query = array(
    'annotation_name' => 'comentario_foto',
    'guid' => $foto,
    'wheres' => " n_table.entity_guid=$foto",
    'reverse_order_by' => true,
);
$comentarios = elgg_get_comentarios_foto($query, false);
$likes = elgg_view('like/like_entity', array('guid' => $foto));
$url = elgg_get_site_url() . "action/album/delete_foto?foto={$foto}";
$eliminar = elgg_add_action_tokens_to_url($url);
//$lista ='<li><a onclick="confirmar(\''.$eliminar.'\')">Eliminar</a></li>';
?>
<div id="comentarios-visor-fotos">
    <?php echo $likes ?>
    <div> <?php echo $input_comentario ?> </div>   
    <!--<div><?php echo $lista ?></div>-->
    <div><?php echo $comentarios ?> </div>
</div>
