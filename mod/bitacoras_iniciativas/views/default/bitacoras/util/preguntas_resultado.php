<?php
$bitacora = $vars['bitacora'];
$cols = "<tr class='hidden-after-load'>";
for ($pos = 0; $pos < 20; $pos++) {
    $cols.="<td width='5%' style='font-size: 1px; line-height: 0;'></td>";
}
$cols . "</tr>";
for ($i = 1; $i < 6; $i++) {
    $attr = "p{$i}";
    $jquery = "pregunta-{$i}";
    $sintesis= "p{$i}s";
    $fuente= "p{$i}f";
    ?>
    <table class="tabla-bitacoras">
        <?php echo $cols ?>
        <tr>
            <td colspan="1"><?php echo $i ?></td>
            <td colspan="19"> 
                <p class="<?php echo $jquery?>"><?php echo $bitacora->$attr ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="10"><b>Síntesis de las respuestas que se encontraron</b></td>
            <td colspan="10"><b>Fuente</b></td>
        </tr>
        <tr>
            <td colspan="10"><textarea class="format-text-simple" name="<?php echo $sintesis?>"><?php echo $bitacora->$sintesis?></textarea></td>
                <td colspan="10"><textarea class="format-text-simple" name="<?php echo $fuente?>"><?php echo $bitacora->$fuente?></textarea></td>
            </tr>
        </table>
    <?php
}

