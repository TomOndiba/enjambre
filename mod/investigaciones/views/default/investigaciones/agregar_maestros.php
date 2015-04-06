<?php

$guid_grupo=  get_input('id_grupo');
$guid_inv=  get_input('id_inv');
$tipo= get_input('tipo');
$maestros=  elgg_listar_maestros_cuaderno($guid_inv, $tipo);
$params = array ('id_grupo'=>$guid_grupo,'id_cuad'=>$guid_inv, 'maestros'=>$maestros);
$content=elgg_view('cuaderno_campo/cuadro_busqueda_maestro', $params);  
$content.= elgg_view_form('cuaderno_campo/lista_maestros', NULL, $params);

echo $content;