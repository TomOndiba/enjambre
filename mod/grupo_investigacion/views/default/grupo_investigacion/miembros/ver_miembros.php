<?php
$guid = $vars['grupo']['guid'];
$lista_miembros = elgg_get_lista_miembros($guid);
$titulo = elgg_echo("miembros:grupo_investigacion");
$header = "<div class='header-list-group'>";
$header.="<div class='titulo-list-group'>{$titulo}</div>";
$header.="</div>";
?>

<div class='box contet-grupo-investigacion'>
    <div class='padding20'>
        <?php echo $breadcrumbs . $header ?>
    </div>
</div>

<div class='box contet-grupo-investigacion'>
    <div class='padding20'>
        <?php echo $breadcrumbs . $header ?>
    </div>
</div>
