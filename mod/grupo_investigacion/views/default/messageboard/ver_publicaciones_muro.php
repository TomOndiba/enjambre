<?php
$offset= get_input('offset');
$guid_grupo= get_input('id_grupo');
$limit= get_input('limit');
$query = array(
    'annotation_name' => 'messageboard',
    'guid' => $guid_grupo,
    'limit' => 12,
    'offset'=>$offset,
    'wheres' => " n_table.entity_guid=$guid_grupo",
    'reverse_order_by' => true,
);
echo elgg_get_messageboard_grupo_investigacion($query, true);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

