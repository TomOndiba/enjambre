

<?php
elgg_load_js('pagination/marcadores');
elgg_load_js("reveal2");
elgg_load_css('reveal');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 5;



if (!$ajax) {


    echo '<div class="list-grupos" style="margin-left: 20px; margin-top: 25px">
    <h2 class="title-legend">Marcadores </h2>';
    $guid = $vars['guid'];

    $site_url = elgg_get_site_url();
    $entity = get_entity($guid);


    // Se crea un cuadro de búsqueda para filtrar los archivos por nombre
    $busqueda = elgg_view('input/text', array('name' => 'busqueda',
        'id' => 'busqueda',
        'class' => 'text-busqueda',
        'value' => "",
        'title' => $guid,
    ));


    $header.="<div id='contenedor-busqueda'>"
            . " $busqueda </div>";

    $user = elgg_get_logged_in_user_guid();
    if ((elgg_is_miembro_admin($guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $guid)) || $entity->getSubtype() == "feria") {
        $header.="<div class='botones-titulo'><div class='contenedor-button'>"
                . '<a class="link-button" href="#" data-reveal-id="myModal" onclick=\'getAgregarMarcadores("' . $guid . '")  \'>Añadir Marcador</a> '
                . "</div></div>";
    }
//<a class="link-button" href="#" data-reveal-id="myModal" onclick=\' getCargarArchivos("' . $guid . '","'.$autoformacion.'")  \'>Subir Archivo</a></div>';
    echo $header;
    echo "<div id='paginable' class='elgg-image-block clearfix'><br><br>";
    echo elgg_get_marcadores($limit, 0, $guid);
    echo "</div>";
} else {
    $guid = get_input('guid');
    $query = get_input('busqueda');

    if ($query) {
        echo elgg_get_marcadores_nombre($limit, $offset, $query, $guid);
    } else {
        echo elgg_get_marcadores($limit, $offset, $guid);
    }
}
?>

<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-archivos pop-up">
    </div>
</div>
<script>
    function getAgregarMarcadores(guid) {
        var owner = guid;
        elgg.get('ajax/view/marcadores/add_marcador', {
            timeout: 30000,
            data: {
                owner: owner,
            },
            success: function(result, success, xhr) {
                $('.pop-up-archivos').html(result);
            },
        });
    }
</script>
</div>