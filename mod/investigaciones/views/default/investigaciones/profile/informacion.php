<?php
$guid = get_input('guid_inv');

$investigacion = new ElggInvestigacion($guid);

$grupo = elgg_get_relationship_inversa($investigacion, "tiene_la_investigacion");
$institucion = elgg_get_relationship($grupo[0], "pertenece_a");
$integrantes = elgg_listar_integrantes_cuaderno($investigacion->guid, "true");

$tabla1.="<ul class='list-user-investigacion'>";


foreach ($integrantes as $user) {



    $tabla1.="<li>";
    $tabla1.="<a href='$url_re.'profile/{$user['username']}'><img src='{$user['icono']}'/></a>";
    $tabla1.="<div>"
            . "<a href='{$url_re}profile/{$user['username']}'><b>{$user['nombre']} {$user['apellidos']}</b></a><br>"
            . "</div>";
    $tabla1.= "</li>";
}

$tabla1.="</ul>";



$maestros = elgg_listar_maestros_cuaderno($investigacion->guid, "true");
$tabla2.="<ul class='list-user-investigacion'>";


foreach ($maestros as $user) {


    $curso = $user['curso'];
    $sexo = $user['sexo'];
    $email = $user['email'];
    $tabla2.="<li>";
    $tabla2.="<a href='$url_re.'profile/{$user['username']}'><img src='{$user['icono']}'/></a>";
    $tabla2.="<div>"
            . "<a href='{$url_re}profile/{$user['username']}'><span><b>{$user['nombre']} {$user['apellidos']}</b></span></a><br>"
            . "</div>";
    $tabla2.= "</li>";
}

$tabla2.="</ul>";


if (sizeof($integrantes) == 0) {
    $tabla1 = "<br>No Hay Estudiantes registrados en la Investigación";
}

if (sizeof($maestros) == 0) {
    $tabla2 = "<br>No Hay  Maestros registrados en la Investigación";
}
$time=new DateTime('now');
$time->setTimestamp($investigacion->time_created);
?>

<div class="informacion-investigacion">
    <div class='titulo-investigacion'>
        Información de la Investigación
    </div>
    <div class='contenido-investigacion'>
        <div class='pestañas-info-investigacion'>
            <div class="separator info-selected" onClick="mostrarDatosBasicos(this)">
                <h2>Datos Básicos</h2>
            </div>
            <div  onClick="mostrarIntegrantesInfo(this)">
                <h2>Integrantes</h2>
            </div>
        </div>
        <div id="datos-basicos">
            <div class="row" style="width: 47%">
                <div class='item-info'>
                    <div class='titulo-info'>Información</div>
                    <div> <label>Pregunta de Investigación:</label><p> <?php echo $investigacion->name; ?></p></div>
                    <div> <label>Fecha de Creación:</label><p><?php echo $time->format( 'd-m-Y' ) ; ?></p></div>
                </div>
            </div>
            <div class="row" style="width: 47%">
                <div class='item-info'>
                    <div class='titulo-info'>Grupo de Investigación</div>
                    <div class='info-grupo-info'><div class="row"><a href="<?php echo elgg_get_site_url() . "grupo_investigacion/ver/{$grupo[0]->guid}"; ?>"><img src='<?php echo $grupo[0]->getIconUrl(); ?>'/></a></div><div class="row" style="width: 55%;margin-left: 20px"><label><a href="<?php echo elgg_get_site_url() . "grupo_investigacion/ver/{$grupo[0]->guid}"; ?>"><?php echo $grupo[0]->name; ?></a></label></div></div>
                </div>
                <div class='item-info'>
                    <div class='titulo-info'>Institución</div>
                    <div class='info-grupo-info'><div class="row"><a href="<?php echo elgg_get_site_url() . "instituciones/ver/{$institucion[0]->guid}"; ?>"><img src='<?php echo $institucion[0]->getIconUrl(); ?>'/></a></div><div class="row" style="width: 55%;margin-left: 20px"><label><a href="<?php echo elgg_get_site_url() . "instituciones/ver/{$institucion[0]->guid}"; ?>"><?php echo $institucion[0]->name; ?></a></label></div></div>

                </div>
            </div>
        </div>
        <div id="integrantes-info-grupo">
            <div class="row" style="width: 47%;">
                <div class='item-info'>
                    <div class='titulo-info'>Estudiantes</div>
                   <?php echo $tabla1 ?>
                </div>
            </div>
             <div class="row" style="width: 47%;">
                <div class='item-info'>
                    <div class='titulo-info'>Maestros</div>
                   <?php echo $tabla2 ?>
                </div>
            </div>
        </div>


    </div>
</div>