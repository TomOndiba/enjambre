<br>
<label>Fecha:</label><input class="datepicker" type="date" name="fecha"/>
<label>Hora de Inicio:</label><select name="hora_inicio">
    <option value="6">6 am</option>
    <option value="7">7 am</option>
    <option value="8">8 am</option>
    <option value="9">9 am</option>
    <option value="10">10 am</option>
    <option value="11">11 am</option>
    <option value="12">12 am</option>
    <option value="13">1 pm</option>
    <option value="14">2 pm</option>
    <option value="15">3 pm</option>
    <option value="16">4 pm</option>
    <option value="17">5 pm</option>
    <option value="18">6 pm</option>
    <option value="19">7 pm</option>
    <option value="20">8 pm</option>
</select>
<label>Hora Fin:</label><select name="hora_fin">
    <option value="6">6 am</option>
    <option value="7">7 am</option>
    <option value="8">8 am</option>
    <option value="9">9 am</option>
    <option value="10">10 am</option>
    <option value="11">11 am</option>
    <option value="12">12 am</option>
    <option value="13">1 pm</option>
    <option value="14">2 pm</option>
    <option value="15">3 pm</option>
    <option value="16">4 pm</option>
    <option value="17">5 pm</option>
    <option value="18">6 pm</option>
    <option value="19">7 pm</option>
    <option value="20">8 pm</option>
</select>
<label>Duración:</label><select name="duracion">
    <option value="15">15 minutos</option>
</select>
<input type="hidden" name="red" value="<?php echo $vars['red']?>"/>
<input type="submit" value="Registrar"/>
