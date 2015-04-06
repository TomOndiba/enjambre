<?php

$guid_grupo=  get_input('id_grupo');
$guid_inv=  get_input('id_inv');
$tipo= get_input('tipo');

$integrantes=  elgg_listar_integrantes_cuaderno($guid_inv, $tipo);

$params = array ('id_grupo'=>$guid_grupo,'id_cuad'=>$guid_inv, 'integrantes'=>$integrantes);

$content=elgg_view('cuaderno_campo/cuadro_busqueda', $params); 

echo $content;