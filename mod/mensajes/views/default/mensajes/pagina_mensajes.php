<?php
$guid= elgg_get_logged_in_user_entity()->guid;
$pagina=  get_input('pagina');
$offset= $pagina *3;
$mensajes = elgg_get_entities_from_metadata(array(
    'type' => 'object',
    'subtype' => 'messages',
    'metadata_name_value_pair' => array(
        array('name' => 'toId', 'value' => $guid),
        array('name' => 'hiddenTo', 'value' =>'0'),
    ),
    'limit' => 10,
    'offset' => $offset
        ));
 echo elgg_view_form('mensajes/lista',null, array('mensajes'=>$mensajes));