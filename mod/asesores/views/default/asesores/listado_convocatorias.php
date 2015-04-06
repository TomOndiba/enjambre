
<?php
$entities = $vars['entities'];
$user = elgg_get_logged_in_user_entity();
$lista="";
foreach ($entities as $entity) {
    //obtiene todas las investigaciones asignadas al evaluador
    $investigaciones = elgg_get_relationship($user, "es_asesor_de");
    //obtiene las investigaciones asignadas que pertenecen  a una convocatoria especifica
    $investigaciones_conv = elgg_investigaciones_entity2($investigaciones, $entity->guid);
    $url = elgg_get_site_url() . "asesores/asesorias/asignadas/" . $entity->guid;
    $lista.="<li><div class='titulo-convocatoria-lista'>{$entity->nombre}</div>"
            ."<div class='contenido-convocatoria-lista'> Tiene " . sizeof($investigaciones_conv) . " investigacion(es) Asignadas<div>"
            . "<div style='width:100%;text-align:right; height: 30px;'><a href='{$url}'><div class='icon-ver-investigaciones'></div></a></div></li>";
}

if (sizeof($entities) != 0) {
    ?>
    <ul class="lista-convocatorias-evaluador">
        <?php
        echo $lista;
        ?>
    </ul>
    <?php
} else {
    echo "No es Asesor de ninguna convocatoria";
}
