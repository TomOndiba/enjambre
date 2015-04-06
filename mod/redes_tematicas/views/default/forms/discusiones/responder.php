<textarea name='group_topic_post' style="width: 90%; margin-left: 25px; height: 100px;" placeholder="Escibre aqui tu respuesta" ></textarea>
<?php
$guid_foro = elgg_view('input/hidden', array('name' => 'entity_guid', 'value' => $vars['guid']));
$id = elgg_view('input/hidden', array('name' => 'id', 'value' => $vars['id']));
echo $respuesta_input;
echo $guid_foro;
echo $id;
echo elgg_view('input/submit', array('value' => 'Responder', 'style' => 'margin-right:25px;'));
