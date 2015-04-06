<?php

$id= get_input("id");
$query = array(
    'annotation_name' => 'comment_messageboard',
    'reverse_order_by' => false,
    'limit' => 100,
    'wheres' => " n_table.entity_guid=$id "
);
$entities = elgg_get_annotations_to_annotations($query);
 elgg_delete_annotation_by_id($id);
foreach($entities as $entity){
    elgg_delete_annotation_by_id($entity->id);
}