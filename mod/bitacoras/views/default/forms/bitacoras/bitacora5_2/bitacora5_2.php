<?php
/**
 * Formulario que administra la informacion de la bitacora 5.1
 * @author DIEGOX_CORTEX 
 */
elgg_load_js('imprimir');
elgg_load_js("vista_modal");
elgg_load_js("reveal2");
elgg_load_css('reveal');

$id_inv = $vars['id_inv'];
$id_group = $vars['id_group'];
$bit = $vars['bit'];
$nombre_institucion = $vars['nombre_institucion'];
$municipio = $vars['municipio'];
$nombre_grupo = $vars['nombre_grupo'];
$linea_inv = $vars['linea_inv'];
$info_rubros = $vars['info_rubros'];
$owner_inv = $vars['owner_inv'];
$user = elgg_get_logged_in_user_guid();

$tabla_rubros = "";
if (sizeof($info_rubros) > 0) {

    $tabla_rubros.= "<table class='tabla-integrantes' id=''>"
            . "<tr>"
            . "<th>Nombre</th>"
            . "<th>Fecha de Gasto</th>"
            . "<th>Proveedor</th>"
            . "<th>Valor Unitario</th>"
            . "<th>Valor Total</th>"
            . "<th>Opciones</th>"
            . "</tr>";
    foreach ($info_rubros as $rubro) {
        $url_editar = '';
        $url_eliminar = '';
        if ($user == $owner_inv) {
            $url_editar = '<a  href="#" data-reveal-id="myModalBit5_2" onclick=\' getCrearRubro52("' . $bit . ',' . $id_inv . ',' . $id_group . ',' . $rubro['guid'] . '")  \'>Editar</a>';
            $href = elgg_get_site_url() . "action/bitacoras/bitacora5_2/delete_rubro52?rub=" . $rubro['guid'];
            $href_eliminar = elgg_add_action_tokens_to_url($href);
            $url_eliminar = "<a onclick='eliminarRubro2({$rubro['guid']},$bit);'   title='Eliminar'> Eliminar </a>";
        }
//        $tabla_rubros .= "<tr>"
//                . "<td>{$rubro['nombre']}</td>"
//                . "<td>{$rubro['fecha_gasto']}</td>"
//                . "<td>{$rubro['proveedor']}</td>"
//                . "<td>{$rubro['valor_unitario']}</td>"
//                . "<td>{$rubro['valor_total']}</td>"
//                . "<td>{$url_eliminar}</td>"
//                . "</tr>";
    }
    $tabla_rubros.="</table>";
} else {
    $tabla_rubros = "No hay Rubros Registrados en la bitácora.";
}
?>

<div class="form-nuevo-album">

    <div style='display:none;' id="dialog-confirm-act" title="Confirmación">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar el Rubro?</p>
    </div>

    <h2 class="title-legend">
        BITÁCORA No. 5.2: INFORME FINANCIERO DE EJECUCIÓN
    </h2> 
    <br>

    <table class="tabla-integrantes">
        <tr>
            <th>Nombre de la Institución Educativa</th>
            <td><?php echo $nombre_institucion ?></td>
        </tr>
        <tr>
            <th>Municipio</th>
            <td><?php echo $municipio ?></td>
        </tr>
        <tr>
            <th>Nombre del Grupo de Investigación</th>
            <td><?php echo $nombre_grupo ?></td>
        </tr>
        <tr>
            <th>Línea de Investigación</th>
            <td><?php echo $linea_inv ?></td>
        </tr>
    </table>

    <br><br>
    <h3 style="color: #000000; font-size: 14pt; alignment-adjust: central"><center>Relación de gastos a realizar con los recursos del grupo de investigación</center></h3>
    <?php
    if ($user == $owner_inv) {
        echo " <br><a onclick='cargarCrearRubro2($bit)' id='boton-agregar-rubro-bit52' class='elgg-button button-publicar'>Agregar Rubro</a>";
    }
    ?>
    <div id="form-crear-rubro-bit52">

    </div>
    <div id="tabla-rubro-bit52"><br><?php echo $tabla_rubros ?></div>

    <div>

        <br><br>

        <div id="myModalBit5_2" class="reveal-modal">
            <div class="pop-up-bit5_2 pop-up">
            </div>
        </div>
        <script>
            function getCrearRubro52(bitacora, investigacion, grupo, rubro) {
                var bit = bitacora;
                var inv = investigacion;
                var grupo = grupo;
                var rub = rubro;

                elgg.get('ajax/view/bitacoras/bitacora5_2/rubro_bit5_2', {
                    timeout: 30000,
                    data: {
                        bit: bit,
                        inv: inv,
                        grupo: grupo,
                        rub: rub,
                    },
                    success: function(result, success, xhr) {
                        $('.pop-up-bit5_2').html(result);
                    },
                });
            }

        </script>
    </div>
