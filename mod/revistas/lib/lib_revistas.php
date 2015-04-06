<?php

function elgg_get_list_revistas($limit, $offset) {
    $query = array('type' => 'object', 'subtype' => 'revista');
    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'revistas/lista/list');
    $content = elgg_list_paginable_entities($options);
    echo $content;
}

