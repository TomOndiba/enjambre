<?php
$red = $vars['red'];

$admin = elgg_get_relationship_inversa($red, "administrador_red");

?>



<div class='box contet-grupo-investigacion infor-grupo'>
    <h2 class='title-legend'>Información</h2>
    <div class="descripcion-grupo-investigacion">
        <label> Descripción de la Red:</label><br><br>
        <p><?php echo $red->description; ?></p><br><br>
    </div>

    <div class="descripcion-grupo-investigacion">
        <label> Administrador de la Red:</label><br><br>
        <div class='info-grupo-info'><div class="row"><a href="<?php echo elgg_get_site_url() . "profile/{$admin[0]->username}"; ?>">
                    <img src='<?php echo $admin[0]->getIconUrl(); ?>'/></a></div>
            <div class="row" style="width: 55%;margin-left: 20px"><label><a href="<?php echo elgg_get_site_url() . "profile/{$admin[0]->username}"; ?>">
<?php echo $admin[0]->name . " " . $admin[0]->apellidos; ?></a></label></div></div>
    </div>
</div>


