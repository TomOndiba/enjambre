<?php
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js('validate');
elgg_load_js('pag_revistas');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 3;
$url = elgg_get_site_url() . "grupo_investigacion/registrar";
if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> Está seguro de eliminar el Grupo de Investigación?</div>';
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda',
        'class' => 'text-busqueda',
        'value' => "",
        'placeholder' => "Busca aquí tu grupo"
    ));
    if(elgg_get_logged_in_user_guid()==33){
    echo '<div class="botones-titulo" style="width:95% !important"><div class="contenedor-button"> <a data-reveal-id="myModalRevistas" onclick="getCrearRevista()" class="link-button" style="float:right">Crear Revista</a></div></div>';
	}
    echo "<div id='paginable' class='list-grupos'>";
    echo elgg_get_list_revistas($limit, 0);
    echo "</div>";
} else {
    echo elgg_get_list_revistas($limit, $offset);
}
?>
<div id="myModalRevistas" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-album pop-up">
    </div>
</div>
<script>
    function getCrearRevista() {

        elgg.get('ajax/view/revistas/create', {
            timeout: 30000,
            data: {
            },
            success: function(result, success, xhr) {
                $('.pop-up-album').html(result);
            },
        });
    }
</script>
