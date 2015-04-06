<?php

/**
 * Action que almacena la informacion editada en el formulario para un rubro de la
 * bitcora 5.2
 * @author DIEGOX_CORTEX
 */
$bit = get_input('bitacora');



if(!empty(get_input('nombre')) && !empty(get_input('fechagasto')) && !empty(get_input('proveedor')) && !empty(get_input('valorunitario')) && !empty(get_input('valortotal'))){
$rubro = new Elgg_Rubro_5_2();


$rubro->nombre = get_input('nombre');
$rubro->fecha_gasto = get_input('fechagasto');
$rubro->proveedor = get_input('proveedor');
$rubro->valor_unitario = get_input('valorunitario');
$rubro->valor_total = get_input('valortotal');
$rubro->owner_guid = $bit;

$guid = $rubro->save();
$rubros = elgg_get_rubros_bitacora52($bit);
$info_rubros = array();
foreach ($rubros as $rubro) {
    $rub_x = array('guid' => $rubro->guid, 'nombre' => $rubro->nombre, 'fecha_gasto' => $rubro->fecha_gasto, 'proveedor' => $rubro->proveedor,
        'valor_unitario' => $rubro->valor_unitario, 'valor_total' => $rubro->valor_total);
    array_push($info_rubros, $rub_x);
}
$tabla_rubros = "";
if (sizeof($info_rubros) > 0) {
    $tabla_rubros.= "<table class='tabla-integrantes' id=''>"
            . "<tr>"
            . "<th>Nombre</th>"
            . "<th>Fecha de Gasto</th>"
            . "<th>Proveedor</th>"
            . "<th>Valor Unitario</th>"
            . "<th>Valor Total</th>"
            . "<th>Opciones</th>"
            . "</tr>";
    foreach ($info_rubros as $rubro) {
        $url_editar = '<a  href="#" data-reveal-id="myModalBit5_2" onclick=\' getCrearRubro52("' . $bit . ',' . $id_inv . ',' . $id_group . ',' . $rubro['guid'] . '")  \'>Editar</a>';
        $href = elgg_get_site_url() . "action/bitacoras/bitacora5_2/delete_rubro52?rub=" . $rubro['guid'];
        $href_eliminar = elgg_add_action_tokens_to_url($href);
        $url_eliminar = "<a onclick='eliminarRubro2({$rubro['guid']}, $bit)';   title='Eliminar'> Eliminar </a>";
        $tabla_rubros .= "<tr>"
                . "<td>{$rubro['nombre']}</td>"
                . "<td>{$rubro['fecha_gasto']}</td>"
                . "<td>{$rubro['proveedor']}</td>"
                . "<td>{$rubro['valor_unitario']}</td>"
                . "<td>{$rubro['valor_total']}</td>"
                . "<td>{$url_eliminar}</td>"
                . "</tr>";
    }
    $tabla_rubros.="</table>";
} else {
    $tabla_rubros = "No hay Rubros Registrados en la bitácora.";
}
}
echo $tabla_rubros;
