
<br>
<p>Seleccione la convocatoria a la quiere inscribir la iniciativa:</p><br>
<select name="convocatoria" style="width: 100%; height: 30px;">
    <?php
    $convocatorias = $vars['convocatorias'];
    foreach ($convocatorias as $convocatoria) {
        ?>
        <option value="<?php echo $convocatoria->guid ?>"><?php echo $convocatoria->name ?></option>
        <?php
    }
    ?>
</select>
<input type="hidden" name="iniciativa" value="<?php echo $vars['iniciativa']?>"/>
<input type="submit" value="Inscribir">