<?php

/**
 * Formulario que administra la informacion de un rubro de la bitacora 5.1
 * @author DIEGOX_CORTEX
 */

$bitacora = $vars['bit'];
$datos = explode(',', $bitacora);

if(!empty($datos['3'])){
    $rubro = new Elgg_Rubro($datos['3']);
}

?>

<div class="form-nuevo-album">
    
        <h2 class="title-legend">Nuevo Rubro</h2>
        

        <input hidden="" name="bit" value="<?php echo $datos['0']?>">       
        <input hidden="" name="inv" value="<?php echo $datos['1']?>">   
         <input hidden="" name="grupo" value="<?php echo $datos['2']?>">
        <input hidden="" name="rub" value="<?php echo $datos['3']?>">   
        
        <div>
            <label>Rubro:</label> <input type="text"  name="nombre" required="true" value="<?php echo $rubro->nombre; ?>">
        </div>
        <div>
            <label>Descripción del gasto:</label> <input type="text"  name="descripcion_gasto" required="true" value="<?php echo $rubro->descripcion_gasto; ?>">
        </div>
        <div>
            <label>Valor Unitario:</label> <input type="number" id="valor_unitario" name="valor_unit" required="true" value="<?php echo $rubro->valor_unit; ?>" min="0" > 
        </div>
        <div>
            <label>Valor total del rubro:</label> <input type="number"  id="total_rubro" name="valor_tot_rub" required="true" value="<?php echo $rubro->valor_tot_rub; ?>" min="0" >
        </div>
        <div>
            <label>valor_total:</label> <input type="number"  name="valor_total" required="true" value="<?php echo $rubro->valor_total; ?>" min="0">
        </div>
        
        
        <input type="submit" name="crear_R" value="Crear Rubro">
    
</div>