
    <?php
    $site_url = elgg_get_site_url();
    $integrantes = $vars['integrantes'];
    foreach ($integrantes as $integrante) {
        ?>
    <tr>
        <td>
            <?php echo $integrante->name; ?>
        </td>
        <td>
            <?php echo elgg_get_edad_ByfechaNac($integrante->fecha_nacimiento); ?>
        </td>
        <td>
            <?php echo $integrante->curso ?>
        </td>
        <td>
            <?php echo $integrante->sexo ?>
        </td>
        <td>
            <?php echo $integrante->numero_documento ?>
        </td>
        <td>
            <?php echo $integrante->email ?>
        </td>
    </tr>
<?php }  

