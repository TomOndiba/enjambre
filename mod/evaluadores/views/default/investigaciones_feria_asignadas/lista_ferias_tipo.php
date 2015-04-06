<?php
$entities = $vars['entities'];
$user = elgg_get_logged_in_user_entity();
$lista="";
foreach ($entities as $entity) {
    $url = elgg_get_site_url() . "evaluadores/listar_investigaciones_feria/" . $entity->guid;
    $cantidad = elgg_get_investigaciones_feria_evaluador($entity,$user->guid);
    $lista.="<li><div class='titulo-convocatoria-lista'>{$entity->name}</div>"
            ."<div class='contenido-convocatoria-lista'> <br>Tiene " . $cantidad['inicial'] . " investigacion(es) asignadas para evaluación inicial"
            . "<br><br> Tiene " . $cantidad['sitio'] . " investigacion(es) asignadas para evaluación en sitio<div>"
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
    echo "No es Evaluador de ninguna feria";
}


