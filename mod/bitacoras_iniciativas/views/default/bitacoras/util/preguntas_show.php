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
       <?php echo $bitacora->$attr?>
    </td>
</tr>
<?php
}

