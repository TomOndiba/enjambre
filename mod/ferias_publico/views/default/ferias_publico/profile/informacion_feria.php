<?php
//echo elgg_view("ferias_publico/profile/prueba", array());


$guid = $vars['guid'];
$feria = get_entity($guid);
$patrocinadores = elgg_get_patrocinador_de_feria($guid);
$lista_patrocinadores = "<ul>";
foreach ($patrocinadores as $patrocinador) {
    $site_url = elgg_get_site_url();
    $url = $site_url . "photos/thumbnail/{$patrocinador->logo}/small/";
}
$lista_patrocinadores.="</ul>";
?>

<div class="contenedor-informacion-feria">
    <div class="contenido-informacion-feria">
        <div class="item-informacion-feria" id="informacion-basica">
            <div class="cuadro-1" id="info-1">
                <label>Descripcion: </label>
                <p><?php echo $feria->descripcion; ?></p>
                <br><label>Objetivos: </label>
                <p><?php echo $feria->objetivos; ?></p>
                <br><label>Tipo de Feria </label>
                <p><?php echo $feria->tipo_feria; ?></p>
            </div>
            <div class="cuadro-2" id="info-2">
                <label>Fecha de Inicio de la Feria: </label>
                <p><?php echo $feria->fecha_inicio_feria; ?></p>
                <br><label>Fecha de Fin de la Feria: </label>
                <p><?php echo $feria->fecha_fin_feria; ?></p>
            </div>
            <div class="cuadro-3" id="info-3">
                <label>Departamento: </label>
                <p><?php echo $feria->departamento; ?></p>
                <br><label>Municipio: </label>
                <p><?php echo $feria->municipio; ?></p>
                <br><label>Correos Contacto: </label>
                <p><?php echo $feria->correos_contacto; ?></p>
            </div>
        </div>
        <div class="item-informacion-feria" id="informacion-premios">
            <div class="cuadro-2" id="info-4">
                <label>Fecha de Inicio de Inscripciones: </label>
                <p><?php echo $feria->fecha_inicio_inscripciones; ?></p>
                <br><label>Fecha Fin de Inscripciones: </label>
                <p><?php echo $feria->fecha_fin_inscripciones; ?></p>
                <br><label>Valor de Inscripción: </label>
                <p><?php echo $feria->valor_inscripcion; ?></p>
                <br><label>Máximo de Inscritos: </label>
                <p><?php echo $feria->max_inscritos; ?></p>
            
            </div>
        
            <div class="cuadro-3" id="info-6">
                <label>Fecha de Montaje de Puestos: </label>
                <p><?php echo $feria->fecha_montaje_puestos; ?></p>
                <br><label>Hora Montaje de Puestos: </label>
                <p><?php echo $feria->hora_montaje_puestos; ?></p>
                <br><label>Fecha Desmontaje de Puestos: </label>
                <p><?php echo $feria->fecha_desmontaje_puestos; ?></p>
                <br><label>Hora Desmontaje de Puestos: </label>
                <p><?php echo $feria->hora_desmontaje_puestos; ?></p>
            </div>
            <div class="cuadro-1" id="info-5">
                <label>Fecha de Montaje de Puestos: </label>
                <p><?php echo $feria->fecha_montaje_puestos; ?></p>
                <label>Hora Montaje de Puestos: </label>
                <p><?php echo $feria->hora_montaje_puestos; ?></p>
                <label>Fecha Desmontaje de Puestos: </label>
                <p><?php echo $feria->fecha_desmontaje_puestos; ?></p>
                <label>Hora Desmontaje de Puestos: </label>
                <p><?php echo $feria->hora_desmontaje_puestos; ?></p>
            </div>

        </div>
        <div class="item-informacion-feria" id="informacion-final">
            <div class="cuadro-1" id="info-7">
                <label>Formas de Participación: </label>
                <p><?php echo $feria->formas_participacion; ?></p>
                <br><label>Premios-Distinciones: </label>
                <p><?php echo $feria->premios_distinciones; ?></p>
                <br><label>Requisitos para Participar: </label>
                <p><?php echo $feria->requisitos_participacion; ?></p>
            </div>
            <div class="cuadro-2" id="info-8">
                <label>Actividades: </label>
                <p><?php echo $feria->actividades; ?></p>
                <br><label>Público Invitado: </label>
                <p><?php echo $feria->publico_invitado; ?></p>
            </div>
            <div class='cuadro-3' id='patrocinadores'>
                <ul class="lista-patrocinadores">
                   
                    <?php
                    foreach ($patrocinadores as $patrocinador) {
                        $site_url = elgg_get_site_url();
                        $url = $site_url . "photos/thumbnail/{$patrocinador->logo}/large/";
                        ?>
                        <li>
                            <div>
                                <img src='<?php echo $url ?>'><a href=""></a>
                            </div>
                            <div>
                                <h4><?php echo $patrocinador->nombre ?></h4>
                            </div>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
        <div id="divDerecha"></div>
        
    </div>
</div>
<ul class="menu-informacion-feria">
    <li id="item-1"><div>Informacion Basica</div></li>
    <li id="item-2"><div>Inscripciones</div></li>
    <li id="item-3"><div>Mas Información</div></li>
</ul>
    
            
<script>
    $(document).ready(function() {
        $("#item-1").live("click", function() {
            $(".contenido-informacion-feria").animate({left: "0px", position: "relative"}, "slow");
            $(this).animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
            $("#item-2").animate({backgroundColor: 'rgb(204,110,97)'}, "slow");
            $("#item-3").animate({backgroundColor: 'rgb(204,110,97)'}, "slow");
        });
        $("#item-2").live("click", function() {
            $(".contenido-informacion-feria").animate({left: "-750px", position: "relative"}, "slow");
            $(this).animate({backgroundColor: 'rgb(191,52,68)'}, "slow");
            $("#item-1").animate({backgroundColor: 'rgb(204,110,97)'}, "slow");
            $("#item-3").animate({backgroundColor: 'rgb(204,110,97)'}, "slow");
        });
        $("#item-3").live("click", function() {
            $(".contenido-informacion-feria").animate({left: "-1520px", position: "relative"}, "slow");
            $(this).animate({backgroundColor: 'rgb(168,207,69)'}, "slow");
            $("#item-2").animate({backgroundColor: 'rgb(204,110,97)'}, "slow");
            $("#item-1").animate({backgroundColor: 'rgb(204,110,97)'}, "slow");
        });
        $("#item-1").animate({backgroundColor: 'rgb(255,204,41)'}, "slow");
        $('#divDerecha').click(function() {
                    $('#patrocinadores ul').append($('#patrocinadores ul li:first')).fadeIn('slow');

            });
        setInterval("$('#divDerecha').click()", 2000);
    });
</script>