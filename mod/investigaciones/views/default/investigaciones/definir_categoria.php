<?php

$idGrupo = get_input('id_grupo');
$guid_investigacion=get_input('id_inv');
$value=get_input('value');
$params=array('grupo'=>$idGrupo, 'investigacion'=>$guid_investigacion, 'value'=>$value);

$content.= elgg_view_form('investigacion/definir_categoria', null, $params);
echo $content;

