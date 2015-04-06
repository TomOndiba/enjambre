<?php

function elgg_get_albunes_owner($guid) {
    $options = array("type" => 'object',
        'subtype' => 'album',
        'owner_guid' => $guid,
        'limit'=>0);
    return elgg_get_entities($options);
}

function elgg_get_foto_portada($guid) {
    $options = array("type" => 'object',
        'subtype' => 'image',
        'container_guid' => $guid);
    return elgg_get_entities($options)[0];
}

function elgg_get_fotos_album($guid, $offset, $limit) {
    $options = array("type" => 'object',
        'subtype' => 'image',
        'container_guid' => $guid,
        'limit' => $limit,
        'offset' => $offset
    );
    return elgg_get_entities($options);
}

function elgg_get_total_fotos_album($guid) {
    $options = array("type" => 'object',
        'subtype' => 'image',
        'container_guid' => $guid,
        'count' => true);
    return elgg_get_entities($options);
}

function elgg_get_comentarios_foto($query, $comment) {
    $options = array('query' => $query,
        'view' => 'foto/comentarios/ver',
        'coment'=>$comment
    );
    return elgg_get_view_comentarios_foto($options);
}

function elgg_get_view_comentarios_foto($options) {
    $consulta = $options['query'];
    $entities = elgg_get_annotations($consulta);
    $options['entities'] = $entities;
    $consulta['count'] = true;
    $count = elgg_get_annotations($consulta);
    if(sizeof($entities)==0){
        $retorno= "<div id='nuevos-comentarios'>No existen comentarios en la foto</div>";
    }else{
     $retorno = elgg_view($options['view'], $options);   
    }
    return $retorno;
}

function comentario_foto_add($poster, $owner, $message, $access_id = ACCESS_PUBLIC) {
	$result = $owner->annotate('comentario_foto', $message, $access_id, $poster->guid);
	return $result;
}
