
<?php

elgg_load_js('pagination/discusiones');
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js('validate');

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 5;


if (!$ajax) {

    $guid = $vars['guid'];

    $titulo = elgg_view_title("Foros");

    $site_url = elgg_get_site_url();

    $entity = get_entity($guid);

   echo ' <div class="list-grupos" style="margin-left: 20px; margin-top: 25px"><h2 class="title-legend">Foros</h2>';
    
    // Se crea un cuadro de búsqueda para filtrar los archivos por nombre
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda',
        'class' => 'text-busqueda',
        'value' => "",
        'title' => $guid,
        'placeholder'=>"Escribe aqui tu busqueda"
    ));

    echo '<div id="contenedor-busqueda">' . $busqueda . ' </div>';
    
    $user=  elgg_get_logged_in_user_guid();
    echo'<div class="botones-titulo"><div class="contenedor-button"> <a class="link-button" href="#" data-reveal-id="myModald" onclick=\' getCargarDiscusiones("' . $guid . '")\'>Crear Foro</a></div></div>';
    
    
    echo "<div class='contenedor-lista-foros'><div id='paginable' class='lista-foros'><br><br>";
    echo elgg_get_discusiones($limit, 0, $guid);
    echo "</div></div>";
} else {
    
    $guid = get_input('guid');
    $query = get_input('busqueda');
    
    if ($query) {
        echo elgg_get_discusiones_nombre($limit, $offset, $query, $guid);
    } else {
        echo elgg_get_discusiones($limit, $offset, $guid);
    }
}

?>
</div>
<div id="myModald" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-discusiones pop-up">
    </div>
</div>
<script>
    function getCargarDiscusiones(guid){
        var guid=guid;
        elgg.get('ajax/view/discusiones/agregar_discusion', {
            timeout: 30000,
            data: {
                guid:guid,
            },
            success: function(result, success, xhr) {
                $('.pop-up-discusiones').html(result);
            },
        });
    }
</script>