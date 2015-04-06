<?php
$investigacion = $vars['iniciativa'];
$grupo = elgg_get_entities_from_relationship(array(
            'relationship_guid' => $investigacion->guid,
            'relationship' => 'tiene_cuaderno_campo',
            'inverse_relationship' => true
        ))[0];
$url = elgg_get_site_url() . "grupo_investigacion/ver_cuaderno/{$grupo->guid}/{$investigacion->guid}";
$action_aceptar = elgg_get_site_url() . "action/iniciativa/aceptar_iniciativa"
        . "?guid={$investigacion->guid}&convocatoria={$vars['convocatoria']}&grupo={$grupo->guid}";
$action_aceptar = elgg_add_action_tokens_to_url($action_aceptar);
$action_rechazar = elgg_get_site_url() . "action/iniciativa/rechazar_iniciativa?guid={$investigacion->guid}&convocatoria={$vars['convocatoria']}";
$action_rechazar = elgg_add_action_tokens_to_url($action_rechazar);
?>

<tr>
    <td><a href="<?php echo $url ?>"><?php echo $investigacion->name ?></a></td>
    <td style="text-align: center;">
        <a href="#">Información</a>&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $action_aceptar?>">Aceptar</a>&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $action_rechazar?>">Rechazar</a>
    </td>
</tr>