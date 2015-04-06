

<?php

elgg_load_js('pag_investigaciones');

$guid = $vars['grupo']['guid'];

$grupo = new ElggGrupoInvestigacion($guid);

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 8;



if (!$ajax) {
    echo '<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Investigaciones</h2>';
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la investigación?</div>';
//    echo "<div class='box'>";
//    $titulo = "Investigaciones";
//    $header.="<h2 class='title-legend'>$titulo</h2>";  
//    echo $header."</div>";
    echo "<div id='paginable' class='elgg-image-block clearfix'>";
    echo elgg_get_list_investigaciones_grupo($limit, 0, $guid);
    echo "</div>";
} else {
    $guid = get_input('guid');
    echo elgg_get_list_investigaciones_grupo($limit, $offset, $guid);
}
?>
</div>