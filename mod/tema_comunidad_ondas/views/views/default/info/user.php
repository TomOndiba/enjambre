<?php
$guid = get_input("guid");
$user = get_entity($guid);
$icon = $user->getIconURL();
$owner_link = "<a class='name' href=\"{$user->getURL()}\">$user->name $user->apellidos</a>";
$edad = elgg_get_edad($user);
if ($user->getSubtype() == "estudiante") {
    $institucion = elgg_get_relationship($user, "estudia_en");
    $curso = '<label>Curso:</label> <span>' . $user->curso . '</span>';
} else {
    $institucion = elgg_get_relationship($user, "trabaja_en");
}
?>
<div class="row icono-info-user">
    <img src="<?php echo $icon ?>"/>
</div>
<div class="row informacion-info-user">
    <?php echo $owner_link ?><br><br>
    <label>Institución: </label><a href="<?php echo elgg_get_site_url() . "instituciones/ver/{$institucion[0]->guid}"; ?>"><?php echo $institucion[0]->name; ?></a><br>      
    <label>Ubicación: </label> <span><?php echo " ".$institucion[0]->municipio . ", " . $institucion[0]->departamento; ?></span><br>
    <label>Edad: </label> <span><?php echo " ".$edad; ?> años</span><br>
    <?php echo $curso ?>
</div>