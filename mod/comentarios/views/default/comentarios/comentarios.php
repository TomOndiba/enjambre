<?php
$guid = $vars['guid'];
$query = array(
    'annotation_name' => 'comentario',
    'guid' => $guid,
    'wheres' => " n_table.entity_guid=$guid",
    'reverse_order_by' => true,
);
$comentarios = elgg_get_annotations($query);
$input_comentario = elgg_view('input/text', array('value' => "", "placeholder" => 'Escribe aqui tu comentario', 
    'name' => 'comentario', "id"=>"input-comentario", 'title'=>$guid));
$lista_comentarios="";
$site_url= elgg_get_site_url();
foreach ($comentarios as $comentario){
    $like= elgg_view('like/like_annotation', array('guid'=>$comentario->id));
    $opciones="";
    $owner_guid= $comentario->owner_guid;
    $owner= get_entity($owner_guid);
    $owner_name= $owner->name." ".$owner->apellidos;
    $friendlytime = elgg_view_friendly_time($comentario->time_created);
    $lista_comentarios.="<li><div>";
    $view= elgg_get_site_url()."ajax/view/info/user?guid={$owner->guid}";
    $lista_comentarios.="<a href='{$site_url}profile/{$owner->username}'><img src='{$owner->getIconURL()}'/></a>"
            . "<div class='info-comment'><a class='informacion-user' tooltip-view='{$view}' href='{$site_url}profile/{$owner->username}'><span>{$owner_name}</span></a><br><span>{$friendlytime}</span></div>"
            . "<div class='contenido-comentario'><span>$comentario->value</span></div>"
            . ""
            . "</div><div class='me-gusta-comentarios'>{$like}</div>";
    $lista_comentarios.="</li>";
}
?>
<div class='comentarios-entity'>
    <ul class='lista-comentarios-entities'>
        <?php echo $lista_comentarios;?>
    </ul>
    <div class='input-comentario-entity'>
        <?php echo $input_comentario;?>
    </div>
</div>