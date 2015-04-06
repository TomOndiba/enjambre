<?php
$bitacora = $vars['bitacora'];
$grupo = $vars['id_grupo'];
$edicion = $vars['edicion'];
$subtype = $bitacora->getSubtype();
$tipo = '';
if ($subtype == 'bitacora1') {
    $tipo = 'uno';
} elseif ($subtype == 'bitacora2') {
    $tipo = 'dos';
} elseif ($subtype == 'bitacora3') {
    $tipo = 'tres';
}
$url_edit = elgg_get_site_url() . "grupo_investigacion/ver/{$grupo}/bitacoras/editar/{$tipo}/{$bitacora->guid}/";
$url_show = elgg_get_site_url() . "grupo_investigacion/ver/{$grupo}/bitacoras/ver/{$tipo}/{$bitacora->guid}/";
?>
<div class="item-bitacora-iniciativa">
    <h4>
        <?php echo $bitacora->title; ?>
    </h4>
    <a href="<?php echo $url_show ?>" data-tooltip='Ver bitácora'><div class="view-bitacora"></div></a>
    <?php if ($edicion) { ?>
        <a href="<?php echo $url_edit; ?>" data-tooltip='Editar bitácora'><div class="editar-bitacora"></div></a>
            <?php } ?>
</div>
