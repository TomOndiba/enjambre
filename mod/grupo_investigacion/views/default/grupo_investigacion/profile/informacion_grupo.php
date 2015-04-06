<script>
    $(document).ready(function() {
    });

    function getMostrarAdministracion() {
        $(".contenedor-admin").show();
    }
    function mostrarDatosBasicos(element) {
        $("#datos-basicos").show();
        $("#integrantes-info-grupo").hide();
        $(".info-selected").removeClass("info-selected");
        $(element).addClass("info-selected")
    }

    function mostrarIntegrantesInfo(element) {
        $("#datos-basicos").hide();
        $("#integrantes-info-grupo").show();
        $(".info-selected").removeClass("info-selected");
        $(element).addClass("info-selected");
    }

</script>
<?php
$grupo = $vars['grupo'];
$admin = elgg_get_relationship_inversa($grupo, "administrador");
$institucion = elgg_get_relationship($grupo, 'pertenece_a');
$insti = get_entity($institucion[0]->guid);
$informacion = "<div><label>Nombre: </label> <p>{$user->name} </p></div>"
        . "<div><label>Apellidos: </label>  <p>{$user->apellidos} </p></div>"
        . "<div><label>Sexo: </label>  <p>{$user->sexo}</p></div>"
        . "<div><label>Fecha de Nacimiento:  </label><p> {$user->fecha_nacimiento}</p></div>"
        . "<div><label>Lugar de Nacimiento:  </label><p> {$user->municipio_nacimiento}, {$user->departamento_nacimiento}</p></div><br>"
?>

<div class='contenido-investigacion'>
    <div class='pestañas-info-investigacion'>
        <div class="separator info-selected" onClick="mostrarDatosBasicos(this)">
            <h2>Información</h2>
        </div>
    </div>
    <div id="datos-basicos">
        <div class="row" style="width: 47%">
            <div class='item-info'>
                <div class='titulo-info'>Institución</div>
                <div class='info-grupo-info'><div class="row"><a href="<?php echo elgg_get_site_url() . "instituciones/ver/{$institucion[0]->guid}"; ?>"><img src='<?php echo $institucion[0]->getIconUrl(); ?>'/></a></div><div class="row" style="width: 55%;margin-left: 20px"><label><a href="<?php echo elgg_get_site_url() . "instituciones/ver/{$institucion[0]->guid}"; ?>"><?php echo $institucion[0]->name; ?></a></label></div></div>

            </div>
            <div class='item-info'>
                <div class='titulo-info'>Líder del Grupo</div>
                <div class='info-grupo-info'><div class="row"><a href="<?php echo elgg_get_site_url() . "profile/{$admin[0]->username}"; ?>"><img src='<?php echo $admin[0]->getIconUrl(); ?>'/></a></div><div class="row" style="width: 55%;margin-left: 20px"><label><a href="<?php echo elgg_get_site_url() . "profile/{$admin[0]->username}"; ?>"><?php echo $admin[0]->name." ".$admin[0]->apellidos; ?></a></label></div></div>
            </div>
        </div>
        <div class="row" style="width: 47%">
            <div class='item-info'>
                <div class='titulo-info'>Descripcion del Grupo</div>
                <p style="padding: 20px; color:black;"><?php echo $grupo->description; ?></p>
            </div>
        </div>
    </div>
</div>
<?php
?>