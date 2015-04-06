<?php
/**
 * Vista que busca listar las evidencias de una asesoria
 */
//elgg_load_js("ajax_album");
//elgg_load_js("visor_js");
//elgg_load_css("visor_css");
elgg_load_js('reveal2');
elgg_load_css("reveal");

$id_inv = $vars['id_inv'];
$guid_conv = $vars['id_conv'];
$id_asesoria = $vars['id_asesoria'];

$asesoria = get_entity($id_asesoria);

$archivos = elgg_get_archivos_asesora($id_asesoria);
?>
<div class="form-nuevo-album"> 
    <br>
    <a href='<?php echo elgg_get_site_url() . "asesores/asesorias/cronograma/{$id_inv}/{$guid_conv}" ?>'>Volver al Cronograma</a>

    <h2 class="title-legend">
        <center>Evidencias De Asesoria <?php echo $asesoria->title ?></center>

    </h2>
    <table class='tabla-coordinador'>
        <tr>
            <th>Nombre</th>
            <th>Opciones</th>
        </tr>
        <?php
        foreach ($archivos as $f) {
            $url_descarga = "<a href='" . elgg_get_site_url() . "file/download/{$f->guid}'>Descargar</a>";
            ?>
            <tr>
                <td><?php echo $f->originalfilename; ?></td>
                <td><?php echo $url_descarga; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <div  class="contenedor-button" data-reveal-id="myModal">
        <a class="link-button">Agregar Archivos</a>
    </div>
    <div id="myModal" class="reveal-modal pop-up-evidencia">
        <div class="close-reveal-modal"></div>
        <div class="form-asesor-evaluador" id="pop-up-form">
            <div class="pop-up">
                <div class='titulo-pop-up'>
                    <h2>SUBIR EVIDENCIAS</h2>
                </div>
                <div class="content-pop-up" id='content-pop-up'>
                    <?php
                    $form_params = array('enctype' => 'multipart/form-data');
                    $vars = array('inv' => $id_inv, 'ases' => $id_asesoria);
                    echo elgg_view_form('asesorias/evidencias', $form_params, $vars);
                    ?>
                </div>

            </div>
        </div>
    </div>

</div>