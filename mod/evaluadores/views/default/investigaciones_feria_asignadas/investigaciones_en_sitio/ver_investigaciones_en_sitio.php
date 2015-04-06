<?php

$offset = get_input('offset');
$ajax = get_input('ajax');
$relation = get_input('relation');//mun, dptal
$participa = get_input('participa');//municipal, departamental
$relacion = get_input('relacion');//investigaciones_inicial, investigaciones_en_sitio
$guid_feria = get_input('guid_feria');
$guid_evaluador = get_input('evaluador');

$limit = 2;

$relacion_input=elgg_view('input/hidden', array('id'=>'relacion_vista', 'name'=>'relacion_vista','value'=>$relacion));
echo $relacion_input;



if (!$ajax) {
    echo "<div class='box contet-grupo-investigacion'><div class='padding20'>";
    echo "<div id='paginable' class='elgg-image-block clearfix'><br><br>";
    echo elgg_get_investigaciones_asignadas_usuario($guid_evaluador, 
                                                    "es_evaluador_en_sitio_".$relation."_de", 
                                                    'investigaciones_feria_asignadas/investigaciones_en_sitio/lista_investigaciones_en_sitio', 
                                                    $participa, $guid_feria);
    echo "</div></div></div>";
} else {
    echo elgg_get_investigaciones_asignadas_usuario($guid_evaluador, 
                                                    "es_evaluador_en_sitio_".$relation."_de", 
                                                    'investigaciones_feria_asignadas/investigaciones_en_sitio/lista_investigaciones_en_sitio', 
                                                    $participa, $guid_feria);
}
