<?php

/**
 * Action que almacena la informacion editada en el formulario para un rubro de la
 * bitcora 5.1
 * @author DIEGOX_CORTEX
 */

$bit = get_input('bit');
$rub = get_input('rub');



if(empty($rub)){
    $rubro = new Elgg_Rubro();
}else{
    $rubro = new Elgg_Rubro($rub);
}

$rubro->nombre = get_input('nombre');
$rubro->descripcion_gasto = get_input('descripcion_gasto');
$rubro->valor_unit = get_input('valor_unit');
$rubro->valor_tot_rub = get_input('valor_tot_rub');
$rubro->valor_total = get_input('valor_total');
$rubro->owner_guid = $bit;

$guid = $rubro->save();

if($guid){
    if(empty($rub)){
        system_message("Se ha registrado un nuevo Rubro.", 'success');
    }
    
}else{
    register_error("No se pudo realizar la accion, verifique de nuevo.");
}

$rubros = elgg_get_rubros_bitacora51($guid_bit);
$info_rubros = array();
foreach ($rubros as $rubro) {
    $rub_x = array('guid' => $rubro->guid,'nombre' => $rubro->nombre, 'descripcion_gasto' => $rubro->descripcion_gasto, 'valor_unit' => $rubro->valor_unit,
        'valor_tot_rub' => $rubro->valor_tot_rub, 'valor_total' => $rubro->valor_total);
    array_push($info_rubros, $rub_x);
}
if (sizeof($info_rubros) > 0) {
    foreach ($info_rubros as $rubro){
        $url_editar = '<a  href="#" data-reveal-id="myModalBit5_1" onclick=\' getCrearRubro("' . $bit . ',' . $id_inv . ',' . $id_group . ',' . $rubro['guid'] . '")  \'>Editar</a>';
        $href = elgg_get_site_url()."action/bitacoras/bitacora5_1/delete_rubro?rub=".$rubro['guid'];
        $href_eliminar = elgg_add_action_tokens_to_url($href);        
        $url_eliminar = "<a onclick=elgg_confirmar_elim_ACT('" . $href_eliminar . "');   title='Eliminar'> Eliminar </a>";
        $tabla_actividades .= "<table class='tabla-integrantes' id=''>"
            . "<tr>"
            . "<th>Nombre</th>"
            . "<th>Descripcion</th>"
            . "<th>Valor unitario</th>"
            . "<th>Valor Total Rubro</th>"    
            . "<th>Valor Total</th>"
            . "<th>Opciones</th>"
            . "</tr>";
        $tabla_rubros .= "<tr>"
                            . "<td>{$rubro['nombre']}</td>"
                            . "<td>{$rubro['descripcion_gasto']}</td>"
                            . "<td>{$rubro['valor_unit']}</td>"
                            . "<td>{$rubro['valor_tot_rub']}</td>"
                            . "<td>{$rubro['valor_total']}</td>"
                            . "<td>{$url_eliminar}</td>"
                       . "</tr>";
    }
}else{
    $tabla_rubros = "No hay Rubros Registrados en la bitácora.";
}

echo $tabla_rubros;

