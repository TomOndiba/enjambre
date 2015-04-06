<?php
/**
 * Formulario que permite gestionar la bitacora 5
 * @author DIEGOX_CORTEX
 */
$id_inv = $vars['id_inv'];
$id_grupo = $vars['id_group'];
$id_bit = $vars['bit'];
$owner_inv = $vars['owner_inv'];
$user = elgg_get_logged_in_user_guid();

$inst_name = $vars['nombre_institucion'];
$inst_munic = $vars['municipio'];

$grupo_name = $vars['nombre_grupo'];
$linea_inv = $vars['linea_inv'];

$info_trayectos = $vars['info_trayectos'];

$info_totales = $vars['info_totales'];


?>

<div class="form-nuevo-album">
    <h2 class="title-legend"><center>BITÁCORA No5. PRESUPUESTO Y SEGUIMIENTO A LA EJECUCIÓN</center></h2>  
    <br>
    <input type="hidden" name="id_bit" value="<?php echo $id_bit ?>">
    <table class="tabla-integrantes">
        <tr>
            <th>Nombre de la Institución Educativa</th>
            <td><?php echo $inst_name ?></td>
        </tr> 
        <tr>
            <th>Municipio</th>
            <td><?php echo $inst_munic ?></td>
        </tr> 
        <tr>
            <th>Nombre del Grupo de Investigación</th>
            <td><?php echo $grupo_name ?></td>
        </tr> 
        <tr>
            <th>Línea de Investigación</th>
            <td><?php echo $linea_inv ?></td>
        </tr> 
    </table>
    <br><br>
    <div id="crear-tray-bit5">

    </div>

    <div id="tabla-item-bit5">

        <?php echo $info_trayectos ?>
        
    </div>


    <?php
    if ($user == $owner_inv) {
        ?>

        <!--<input type="submit" name="Aceptar" value="Guardar" class="elgg-button button-publicar">-->
    <?php } ?>
</div>

<div id="form-crear-rubro-bit51">

</div>

<script>
</script>