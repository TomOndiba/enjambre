<?php
/**
 * Vista que permite ver las lineas temáticas registradas en el sistemas
 * @author DIEGOX_CORTEX
 */
elgg_load_js('acciones_linea');
elgg_load_js('pagination/linea');
elgg_load_js('reveal2');
$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;
$url = elgg_get_site_url() . "linea/crear";
$url2 = elgg_get_site_url() . "linea/listar_deshabilitadas";
$content = "";
$lista = "";
if (!$ajax) {
    echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea deshabilitar la linea temática?</div>';
    ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Lineas Temáticas</h2>
        </div>

        <?php
        echo "<div class='contenedor-button'>"
        . "<a href='$url' class=\"link-button\">Crear nueva</a> ";
        $header.="</div>";
        echo $header;
        echo "<div id='paginable' class='lista-coordinacion'>";
        echo elgg_get_list_lineas($limit, 0);
        echo "</div>";
        echo $lista;
        ?>
        <div id="myModal" class="reveal-modal" style="top:90px">
            <div class="close-reveal-modal"></div>
            <div class="form-asesor-evaluador" id="pop-up-form">
                <div class='titulo-pop-up' style="font-size: 20px; text-align: center">
                    Asignar Asesor
                </div>
                <div class="content-pop-up" id='content-pop-up' style="padding-top: 10px;">
                    
                </div>
            </div>
        </div>
        <script>
        function asesorRed(red){
            elgg.get('ajax/view/linea_tematica/cambiar_asesor', {
            timeout: 30000,
            data: {
                red: red
            },
            success: function (result, success, xhr) {
                $('#content-pop-up').html(result);
            },
        });
        }
        </script>
    </div>
    <?php
} else {
    $lista = elgg_get_list_lineas($limit, $offset);
    echo $lista;
}
?>