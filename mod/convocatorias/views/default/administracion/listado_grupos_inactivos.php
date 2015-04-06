



<?php
/**
 * Vista ajax que permite realizar la paginación del listado de los Grupos inactivas
 */
elgg_load_js('grupos-inactivos');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;


if (!$ajax) {
    ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Administración</h2>
        </div>
        <div class="menu-coordinacion">
    <?php echo elgg_view("convocatorias/menu_admin", array()); ?>
        </div>

        <div class="contenido-coordinacion">

            <div class="titulo-coordinacion">
                <h2>Grupos Inactivos</h2>
            </div>

    <?php
    echo "<div id='paginable' class='lista-coordinacion'>";
    echo elgg_get_list_grupos_inactivos($limit, 0, "grupo_investigacion");
    echo "</div>";
    ?>

            <?php
        } else {
            echo elgg_get_list_grupos_inactivos($limit, $offset, "grupo_investigacion");
        }
        ?>

    </div>