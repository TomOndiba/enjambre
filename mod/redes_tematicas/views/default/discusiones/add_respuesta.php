<?php
$comment = get_input('comentario');
$annotation= get_input("annotation");
$owner= elgg_get_annotation_from_id($annotation);
$poster= elgg_get_logged_in_user_entity();

$result=$owner->annotate('respuesta_foro', $comment, ACCESS_PUBLIC, $poster->guid);
    if ($result) {
        $query = array(
            'annotation_name' => 'respuesta_foro',
            'reverse_order_by' => true,
            'limit' => 1,
            'wheres' => " n_table.entity_guid=$owner->id "
        );
        $options = array('query' => $query, 'view' => 'messageboard/comment/ver_comentarios');
        echo $output = elgg_get_comments_post($options);
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

