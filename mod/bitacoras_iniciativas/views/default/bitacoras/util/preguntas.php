<?php
$bitacora = $vars['bitacora'];
for($i=1; $i<6; $i++){
    $attr = "p".$i;
?>
<tr>
    <td colspan="1">
        <?php echo $i.".";?>
    </td>
    <td colspan="19">
        <input type="text" style="width: 99.4%; height: 100%" name="<?php echo $attr?>" onkeyup="cambiarItemEspejo(this);" data-id="<?php echo $i?>" value="<?php echo $bitacora->$attr?>">
    </td>
</tr>
<?php
}

