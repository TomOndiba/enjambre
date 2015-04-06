<?php
elgg_load_css('logged');
$id_bitacora = get_input('id_bitacora');
$tipo = get_input('tipo');
$grupo = new ElggGrupoInvestigacion(get_input('id_grupo'));
$params = array("id_bitacora" => $id_bitacora );
$content = elgg_view('bitacoras/show/bitacora_'.$tipo, $params);
$body = array('izquierda'=>elgg_view('grupo_investigacion/profile/menu', array('grupo'=>$grupo)), 'derecha'=>$content);
echo elgg_view_page($title, $body, "profile", array('grupo'=>$grupo));
