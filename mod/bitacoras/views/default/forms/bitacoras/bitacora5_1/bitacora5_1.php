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
?>

<div class="form-nuevo-album">
    <div id="bitacora51">
        <div style='display:none;' id="dialog-confirm-act" title="Confirmación">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar el Rubro?</p>
        </div>

        <h2 class="title-legend">
            <center>BITÁCORA No. 5.1: PRESUPUESTO DETALLADO</center>

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
        <h3 style="color: #000000; font-size: 14pt; alignment-adjust: central">Relación de gastos a realizar con los recursos del grupo de investigación</h3> 
        <br> <br><br>

        <div id="crear-rubro-bit51">
        </div>
        <!--<a onclick="actualizarContBit51(<?php echo $id_inv?>, <?php echo $id_group?>)">Actualizar</a> -->
        <div id="tabla-rubro-bit51">
            <?php echo $info_rubros ?>
        </div>
        <div>
            <br><br>

            <div id="myModalBit5_1" class="reveal-modal">
                <div class="pop-up-bit5_1 pop-up">
                </div>
            </div>
            <script>
                function getCrearRubro(bitacora, investigacion, grupo, rubro) {
                    var bit = bitacora;
                    var inv = investigacion;
                    var grupo = grupo;
                    var rub = rubro;

                    elgg.get('ajax/view/bitacoras/bitacora5_1/rubro_bit5_1', {
                        timeout: 30000,
                        data: {
                            bit: bit,
                            inv: inv,
                            grupo: grupo,
                            rub: rub,
                        },
                        success: function(result, success, xhr) {
                            $('.pop-up-bit5_1').html(result);
                        },
                    });
                }

            </script>
        </div>
    </div>
</div>
