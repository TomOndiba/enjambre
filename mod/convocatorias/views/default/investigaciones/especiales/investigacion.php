<?php
$investigacion = $vars['investigacion'];
$grupo = elgg_get_entities_from_relationship(array(
            'relationship_guid' => $investigacion->guid,
            'relationship' => 'tiene_la_investigacion',
            'inverse_relationship' => true
        ))[0];
$url = elgg_get_site_url() . "grupo_investigacion/ver_cuaderno/{$grupo->guid}/{$investigacion->guid}";
$asesor = elgg_get_entities_from_relationship(array(
    'relationship'=>'es_asesor_de',
    'relationship_guid'=> $investigacion->guid,
    'inverse_relationship'=> true
))[0];
$msj_asesor= "No se ha asignado asesor";
$guid = 0;
if($asesor->guid >0){
    $msj_asesor = $asesor->name." ".$asesor->apellidos;
    $guid = $asesor->guid;
}
?>

<tr>
    <td><a href="<?php echo $url ?>"><?php echo $investigacion->name ?></a></td>
    <td style="text-align: center;">
        <?php echo $msj_asesor?>
    </td>
    <td style="text-align: center;">
        <a href="#" onclick="seleccionarAsesor(<?php echo $guid?>, <?php echo $investigacion->guid?>);"data-reveal-id='myModal'>Cambiar Asesor</a>
    </td>
</tr>