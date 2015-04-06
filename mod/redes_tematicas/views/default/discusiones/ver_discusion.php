<?php
$topic = elgg_extract('entity', $vars, FALSE);
elgg_load_js('confirmacion');
elgg_load_js('foro');
elgg_load_js("ajax_comentarios");
elgg_load_js("reveal2");
elgg_load_css('reveal');


$user_logued = elgg_get_logged_in_user_entity();
$grupo = $vars['grupo'];

if (!$topic) {
    return true;
}

$poster = $topic->getOwnerEntity();
$group = $topic->getContainerEntity();
$excerpt = elgg_get_excerpt($topic->description);

$poster_icon = elgg_view_entity_icon($poster, 'tiny');

$poster_link = elgg_view('output/url', array(
    'href' => $poster->getURL(),
    'text' => $poster->name,
    'is_trusted' => true,
        ));

$poster_text = elgg_echo('groups:started', array($poster->name));
$date = elgg_view_friendly_time($topic->time_created);

$replies_link = '';
$reply_text = '';


$params = array(
    'annotation_name' => 'group_topic_post',
    'guid' => $topic->getGUID(),
);
$contenido = "<ul style='margin-top:20px;'>";
$site_url = elgg_get_site_url();
$respuestas = elgg_get_annotations($params);

foreach ($respuestas as $respuesta) {
    $user_respuesra = $respuesta->owner_guid;
    $user = get_entity($user_respuesra);
    $usuario = "<a href='{$site_url}profile/{$user->username}'><img style='width:40px;' src='{$user->getIconURL()}' /></a>";

    //Creando la url de eliminar
    $url_anot = elgg_get_site_url() . "action/discussion/reply/delete?annotation_id=$respuesta->id";
    $url_elim_anot = elgg_add_action_tokens_to_url($url_anot);



    $link_responder = "<ul class='elgg-menu elgg-menu-annotation elgg-menu-hz float-alt elgg-menu-annotation-default'>";

    if (check_entity_relationship($user_logued->guid, "administrador", $group->guid)) {
        $link_responder.='<li class="elgg-menu-item-edit" style="float:right"><a data-tooltip="Eliminar Comentario" href="' . $url_elim_anot . '"> <div class="icon-eliminar-3"></div></a></li>';
    }

    $link_responder.="<li class='elgg-menu-item-edit' style='float:right'><a data-tooltip='Comentar Respuesta' style='vertical-align:bottom;margin-right:10px;' onClick='pintarFormRespuesta($respuesta->id, this)' rel='toogle'> <div class='row icon-responder'></div></a></li></ul>";



    $query = array(
        'annotation_name' => 'respuesta_foro',
        'reverse_order_by' => true,
        'limit' => 0,
        'wheres' => " n_table.entity_guid=$respuesta->id "
    );
    $options = array('query' => $query, 'view' => 'discusiones/ver_comentarios');
    $date_r = elgg_view_friendly_time($respuesta->time_created);
    // Obtiene las respuestas- comentarios
    $output = elgg_get_comments_post($options);
    $view = elgg_get_site_url() . "ajax/view/info/user?guid={$user->guid}";
    $contenido.="<li style='width:98%; margin-left:1%;margin-right:1%;border-bottom-style: solid;border-bottom-width: 1px;border-bottom-color: #e5e5e5; margin-bottom:10px; '>"
            . "<div style='width:100%;'><div style='display:inline-block; margin-right:10px'>{$usuario}</div>"
            . "<div class=row><a class='informacion-user' tooltip-view='{$view}' href='{$site_url}profile/{$user->username}'>{$user->name} {$user->apellidos}</a><br><span style='color:black'>$date_r</span></div>"
            . "<div style='margin-top:5px; margin-left:10px;'><span style='color:black'>{$respuesta->value}</span></div></div>"
            . "<div style='display:inline-block; vertical-align:top; width:96%; background-color: #F2F2F2;padding-left:2%' > <div id='respuesta-pregunta-nuevo-{$respuesta->id}'>
         $output
        </div>
        <div id='respuesta-pregunta-{$respuesta->id}'>
        </div>   $link_responder</div>"
            . "</li>";
}
$contenido.="</ul>";
$likes = elgg_view('like/like_entity', array('guid' => $topic->guid));

$params = $params + $vars;
//$list_body = elgg_view('object/elements/summary', $params);
//$final = "<div class='contenedor-$list_body = elgg_view('object/elements/summary', $params);lista-foros'>";
//$final.="<div></div>";
$view = elgg_get_site_url() . "ajax/view/info/user?guid={$poster->guid}";
$body = "<div class='row'><a href='{$site_url}profile/{$poster->username}'><img src='{$poster->getIconURL()}' /></a></div>";
$body.="<div class='row'><a class='informacion-user' tooltip-view='{$view}' href='{$site_url}profile/{$poster->username}'>$poster->name $poster->apellidos</a><br>$date</div>";
$body.="<div><span style='margin-right:10px;'>" . $topic->title . "</span><br>" . elgg_view('output/longtext', array(
            'value' => $topic->description,
            'style' => 'margin-right:10px;',
        )) . "</div>";
$body.="";

//Creando la url de eliminar
$url2 = elgg_get_site_url() . "action/discussion/delete?guid=$topic->guid";
$url_el = elgg_add_action_tokens_to_url($url2);
$img_eliminar = "<a data-tooltip='Eliminar Foro' onclick=\"confirmar('{$url_el}')\"><div class='icon-eliminar-2'></div></a>";


//Creando url que dirige a editar
$url_editar = '<a href="#" data-tooltip="Editar Foro" data-reveal-id="myModalDiscusion" onclick=\'editarDiscusion(' . $group->guid . ',' . $topic->guid . ')  \'><div class="icon-editar-2"></div></a>';

//Si el usuario logueado no es el Owner de la discusion, no se muestran los link de Editar y eliminar        
if ($user_logued->guid != $poster->guid) {
    $img_eliminar = "";
    $url_editar = "";
}







echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Foro?</div>';
?>
<div class="contenedor-lista-foros">
    <div class="lista-foros" style="padding-top: 7px">
        <div class="titulo-foro" style="display: inline-block; width:70%;">
            <?php
            echo $body;
            ?>

        </div>

        <?php
        echo "<div class='iconos-file' style='display:inline-block; margin-top: 20px;'>{$url_editar} {$img_eliminar}</div>";
        echo "<div style='padding:10px;'>$likes</div>";
        echo $contenido;



        echo "<label class='lbl-responder'>Responde esta pregunta</label>";

        echo elgg_view_form('discusiones/responder', null, array('guid' => $topic->guid, 'id' => $grupo));
        ?>

    </div>


</div>

<div id="myModalDiscusion" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-discusion pop-up">
    </div>
</div>

<script>
    function editarDiscusion(grupo, discusion) {
        elgg.get('ajax/view/discusiones/editar_discusion', {
            timeout: 30000,
            data: {
                id: grupo,
                guid_dis: discusion,
            },
            success: function (result, success, xhr) {
                $('.pop-up-discusion').html(result);
            },
        });
    }
</script>
