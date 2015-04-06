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
$user = $vars['user'];


if ($user->getSubtype() == "estudiante") {

    $institucion = elgg_get_relationship($user, "estudia_en");
    $info_int = "<div><label>Curso:</label><p> {$user->curso}</p></div>"
    . "<div><label>Qué hace en el tiempo libre?:</label><p> {$user->tiempo_libre}</p></div>";
                 
            
} else {
    $institucion = elgg_get_relationship($user, "trabaja_en");
    $info_int ="<div><label>Título:</label><p> {$user->titulo}</p></div>"
            . "<div><label>Especialidad:</label><p>{$user->especialidad}</p></div>"
            . "<div><label>Área en el que se desempeña:</label><p>{$user->area_conocimiento}</p></div>";
}


if($user->guid !=33){
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
                    <div class='titulo-info'>Información Básica</div>
                    <?php echo $informacion;?>
                </div>
                <?php if(sizeof($institucion)){ ?>
                <div class='item-info'>
                    <div class='titulo-info'>Institución</div>
                    <div class='info-grupo-info'><div class="row"><a href="<?php echo elgg_get_site_url() . "instituciones/ver/{$institucion[0]->guid}"; ?>"><img src='<?php echo $institucion[0]->getIconUrl(); ?>'/></a></div><div class="row" style="width: 55%;margin-left: 20px"><label><a href="<?php echo elgg_get_site_url() . "instituciones/ver/{$institucion[0]->guid}"; ?>"><?php echo $institucion[0]->name; ?></a></label></div></div>

                </div>
                <?php }?>
            </div>
            <div class="row" style="width: 47%">
                <div class='item-info'>
                    <div class='titulo-info'>Otros</div>
                    <?php echo $info_int;?>
                </div>
            </div>
        </div>
    </div>
<?php
}

else{
    
?>    
  <div class='contenido-investigacion'>
        <div class='pestañas-info-investigacion'>
            <div class="separator info-selected">
                <h2>Información</h2>
            </div>
        </div>
        <div id="datos-basicos">
            <div class="row" style="width: 47%">
                <div class='item-info'>
                    <div class='titulo-info'>Información Básica</div>
                    <div> <label> Nombre:</label> <p><?php echo $user->name." ".$user->apellidos;?></p></div>
                    <div> <label> Teléfono:</label> <p><?php echo $user->celular;?></p></div>
                    <div> <label> Email:</label> <p><?php echo $user->email;?></p></div>
                </div>
               
            </div>
           
        </div>
    </div>  
    
<?php
    


}