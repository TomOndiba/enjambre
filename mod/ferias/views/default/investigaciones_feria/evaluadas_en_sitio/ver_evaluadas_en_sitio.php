<?php
elgg_load_js('sumar_4.2');
elgg_load_js('sumar_evalinfcuad');
elgg_load_js('sumar_4.1');
elgg_load_js('sumar_3_INN');
elgg_load_js('sumar_3_INV');
elgg_load_js('sumar2.1');

$ajax = get_input("ajax");
$relacion = get_input('relacion');
$guid_feria = get_input('feria');
$feria = new ElggFeria($guid_feria);

if (!$ajax) {
    $relacion_input = elgg_view('input/hidden', array('id' => 'relacion', 'value' => $relacion));

    echo  "$titulo <br />"
    . $feria_input . $relacion_input . "<div id='investigaciones'>";
    echo elgg_get_investigaciones_feria(15, 0, $guid_feria, $relacion);
    echo "</div>";
} else {
    $investigaciones = elgg_get_investigaciones_feria(15,$offset, $guid_feria, $relacion);
    echo $investigaciones;
}