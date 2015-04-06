<?php
elgg_load_js('confirmacion');
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_js("jquery-ui");
elgg_load_js("turn");
elgg_load_js("perfect");
$convocatorias_abiertas = $vars["convocatorias"];
$cuaderno = $vars['cuaderno'];
$guid = $vars['id_grupo'];
$bitacoras = $vars['bitacoras'];
$site_url = elgg_get_site_url();
$pregunta_seleccionada = elgg_get_pregunta_investigacion($cuaderno->guid);
$user = elgg_get_logged_in_user_guid();
$cuaderno_nota = elgg_get_cuaderno_nota($user, $cuaderno->guid);
$total_notas = elgg_get_total_notas($cuaderno_nota->guid, "cero");
$diario = elgg_get_diario_campo($cuaderno->guid);
$total_actividades = elgg_get_total_actividades($diario->guid, "cero", "Actividades/Sucesos");
$total_reflexion = elgg_get_total_actividades($diario->guid, "cero", "reflexion");
$total_aspectos = elgg_get_total_actividades($diario->guid, "cero", "aspectos");
$total_documentos = elgg_get_total_actividades($diario->guid, "cero", "documentos");
$total_anecdotas = elgg_get_total_actividades($diario->guid, "cero", "anecdotas");
$data_query = array("relationship" => "inscrita_a_convocatoria_especial",
    "relationship_guid" => $cuaderno->guid);
$inscrita = count(elgg_get_entities_from_relationship($data_query)) > 0;
elgg_load_js("ajax_comentarios");
$boton = '<a class="" href="#" id="agregar-nota" onclick=\' getAgregarNota("' . $cuaderno_nota->guid . '","cero")  \'>Agregar Nota</a>';
$boton_diario = '<a class="" href="#" id="agregar-nota-diario" onclick=\' getAgregarNotaDiario("' . $diario->guid . '","cero")  \'>Agregar Nota</a>';
echo "<div class='box contet-grupo-investigacion'><div class='padding20'>";
echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la iniciativa de investigación?</div>';
$listaBread = array(array('titulo' => 'Iniciativas de Investigación', 'url' => "{$site_url}grupo_investigacion/ver/{$guid}/cuadernos"),
    array('titulo' => $cuaderno->name, 'url' => "{$site_url}grupo_investigacion/ver/{$guid}/cuadernos/$cuaderno->guid")
);
$inv = elgg_get_site_url() . "action/investigacion/crear_investigacion?id_cuaderno=" . $cuaderno->guid . "&id_grupo=" . $guid . "&pregunta=" . $pregunta_seleccionada;
$investigacion = elgg_add_action_tokens_to_url($inv);

//url para eliminar el bookmark
$url = elgg_get_site_url() . "action/cuaderno_campo/eliminar?id_grupo=" . $guid . "&id=" . $cuaderno->guid;
$url_el = elgg_add_action_tokens_to_url($url);
$maestros = $cuaderno->getEntitiesFromRelationship('es_colaborador_de', true);
$estudiante = elgg_get_relationship_inversa($cuaderno, 'hace_parte_de');


if ($user == $cuaderno->owner_guid && sizeof($maestros) == 0 && sizeof($estudiante) == 0) {
    $img_eliminar = "<a data-tooltip='Eliminar Iniciativa' onclick=\"confirmar('{$url_el}')\"><div class='icon-eliminar-2'></div></a>";
}

$header.="<div style='margin-left:90%;'>{$img_eliminar}</div>";
$header.= "<h2 class='title-legend'> Iniciativa de investigación</h2>";
echo $header;
$header = "";
if ($user == $cuaderno->owner_guid || check_entity_relationship($user, 'hace_parte_de', $cuaderno->guid) || check_entity_relationship($user, 'es_colaborador_de', $cuaderno->guid)) {
    $diario = elgg_get_diario_campo($cuaderno->guid);
    $header.='<a href="#" onclick="verDiario(\'' . $guid . '\',\'' . $cuaderno->guid . '\' )" data-reveal-id="myModal-diario">Diario de Campo &nbsp; &nbsp; </a>';
}
if (elgg_get_cuaderno_nota($user, $cuaderno->guid) != null) {
    $usuario = elgg_get_logged_in_user_entity();
    if ($usuario->getSubtype() == "estudiante") {
        $header.='<a href="#" onclick="verCuaderno(\'' . $guid . '\',\'' . $cuaderno->guid . '\' )" data-reveal-id="myModal">Cuaderno de Notas</a>';
    } else {
        $header.='<a href="#" onclick="verCuaderno(\'' . $guid . '\',\'' . $cuaderno->guid . '\' )" data-reveal-id="myModal">Libreta de Acompañante</a>';
    }
}
$edicion = false;
if ($user == $cuaderno->owner_guid || elgg_is_rol_logged_user("SuperAdmin")) {
    $edicion = true;
}

echo '<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la Iniciativa de Investigación?</div>';
echo "<div class='titulo-iniciativa'><h3>{$cuaderno->name}</h3></div>";
echo $header;
foreach ($bitacoras as $bitacora) {
    echo elgg_view('bitacoras/item/default', array('bitacora' => $bitacora,
        'id_grupo' => $guid, 'edicion' => $edicion));
}
if (!$inscrita) {
    ?>
    <div class="botones" style="min-height: 50px;">
        <a class="link-button" href="#" data-reveal-id="inscribirAConvocatoria">Inscribir a convocatoria</a>
    </div>
    <div id="inscribirAConvocatoria" class="reveal-modal">
        <div class="close-reveal-modal cierre-eventos"></div>
        <div class="pop-up-calendar pop-up">
            <h2 class="title-legend">Inscribir Iniciativa a Convocatoria</h2>
            <?php
            if (sizeof($convocatorias_abiertas) > 0) {
                $data = array("convocatorias" => $convocatorias_abiertas,
                    "iniciativa" => $cuaderno->guid);
                echo elgg_view_form("bitacoras/convocatorias/inscribir", null, $data);
            } else {
                ?>
                <br/>
                <p>No existe ninguna convocatoria abierta en este momento</p>
                <br/>
            <?php } ?>
        </div>
    </div>
<?php
} else {
    echo "<br><br><p>Tu iniciativa ya esta inscrita a una convocatoria, pronto recibiras un email con el resultado de la evaluación.</p>";
}
?>




<style type="text/css">
    #magazine{
        width:1152px;
        height:752px;
    }

    #magazine-2, .book{
        width:1152px;
        height:752px;
        z-index: 9900;
    }

    #magazine .turn-page{
    }

    .row{
        display: inline-block;
        vertical-align: top;
    }
    .pestanas{
        margin-top: 10px;
        width: 50px;
        height: 700px;
        margin-left: -5px;
        z-index: 500;
    }
    .pestanas>ul>li{
        height: 100px;
        width: 100px;
        margin-left: -60px;
        padding-top: 10px;
        transform:rotate(90deg);
        -ms-transform:rotate(90deg); /* IE 9 */
        -webkit-transform:rotate(90deg); /* Opera, Chrome, and Safari */
        text-align: center;
        border-radius: 7px;
        font-weight: 700;
        color:white;
    }
    .pestanas>ul>li:hover{
        cursor: pointer;
        height: 120px!important;
        width: 120px!important;
    }
    .select{
        height: 120px!important;
        width: 120px!important;
        font-weight: 700!important;
    }
    .nota-cuaderno{
        font-family: "Sunsine";
        font-size: 32px;
        width: 80%;
        height: 80%;
        padding-top: 10%;
        padding-bottom: 10%;
        padding-left: 10%;
        padding-right: 10%;
        color:black;
    }

    .nota-diario>div{
        font-family: "Sunsine";
        font-size: 20px;
        display: inline-block;
        vertical-align: top;
        max-width: 350px;
        margin-left: 10px;
    }

    .nota-diario>div>a>img{
        width: 60px;
        border-radius: 5px;
        border-color: gray;
        border-width: 1px;
        border-style: solid;
        margin-left: 10px;
    }
    .nota-diario{
        font-family: "Sunsine";
        font-size: 18px;
        width: 100%;
        height: 80%;
        padding-top: 10%;
        padding-bottom: 10%;
        color:black;
    }

    .element-1{
        background-color: rgb(255,110,110);

    }
    .element-2{
        background-color: rgb(247,200,45);

    }
    .element-3{
        background-color: rgb(12,204,191);

    }
    .element-4{
        background-color: rgb(177,63,114);
    }
    .element-5{
        background-color: rgb(168,207,69);
    }

    .element-6{
        background-color:  rgb(145,216,247);
        margin-top: 20px;
    }



    .nota-cuaderno>b{
        font-family: "Sunsine";
        font-size: 32px;
        color:black;
    }

    div#notas-ajax::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    div#notas-ajax::-webkit-scrollbar
    {
        width: 7px;
        background-color: #F5F5F5;
    }

    div#notas-ajax::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #A6A6A6;
    }
    .titulo-cuaderno{
        width: 60%;
        margin-left: 25%;
        margin-right: 15%;
        margin-top: 300px;
        text-align: center;
        font-size: 40px;
        color:white;
        font-weight: 700;
    }
    .add-nota{
        display: none;
    }
</style>


<div id="myModal" class="reveal-modal" style="width:1262px; height:752px; margin-left:-580px">
    <div class="close-reveal-modal cambio-2"></div>
    <div class="cuaderno" id="ver-cuaderno">
        <div id="magazine" class="book row" >
            <div class=" hard cover" ></div>
            <div class="hard cuaderno-izquierdo"></div>
        </div>
        <div class="pestanas row" id="pestana-cuaderno">
            <ul>
                <li class="element-1"><?php echo $boton; ?></li>
            </ul>
        </div>
        <div class="add-nota" id="add-nota">

        </div>
        <ul class="botones">
            <li class="preview" data-tooltip="Pagina Anterior" onClick="botonAnterior()"></li>
            <li class="next" data-tooltip="Siguiente Pagina" onClick="botonSiguiente()"></li>
        </ul>
    </div>
</div>

<div id="myModal-diario" class="reveal-modal" style="width:1262px; height:752px; margin-left:-580px">
    <div class="close-reveal-modal cambio-2"></div>
    <div class="cuaderno" id="ver-cuaderno">
        <div id="magazine-2" class="row book">
            <div class=" hard cover" ><div class="titulo-cuaderno">Actividades y Sucesos</div></div>
            <div class="hard cuaderno-izquierdo"></div>
        </div>
        <div id="reflexiones" class="row book">
            <div class=" hard cover" ><div class="titulo-cuaderno">Reflexiones e Ideas</div></div>
            <div class="hard cuaderno-izquierdo"></div>
        </div>
        <div id="aspectos" class="row book" >
            <div class=" hard cover" ><div class="titulo-cuaderno">Aspectos Subjetivos</div></div>
            <div class="hard cuaderno-izquierdo"></div>
        </div>
        <div id="documentos" class="row book">
            <div class=" hard cover" ><div class="titulo-cuaderno">Documentos Leidos</div></div>
            <div class="hard cuaderno-izquierdo"></div>
        </div>
        <div id="anecdotas" class="row book">
            <div class=" hard cover" ><div class="titulo-cuaderno">Anécdotas</div></div>
            <div class="hard cuaderno-izquierdo"></div>
        </div>
        <div class="pestanas row" id="pestana-diario">
            <ul>
                <li id="actividades-li" class="element-1 select">Actividades y Sucesos</li>
                <li id="reflexiones-li" class="element-2">Reflexiones e Ideas</li>
                <li id="aspectos-li" class="element-3">Aspectos Sujetivos</li>
                <li id="documentos-li" class="element-4">Documentos Leidos</li>
                <li id="anecdotas-li" class="element-5">Anecdotas y Otros</li>
                <li class="element-6"><?php echo $boton_diario; ?></li>
            </ul>
        </div>
        <div class="add-nota" id="add-nota-diario">

        </div>
    </div>
    <ul class="botones">
        <li class="preview" data-tooltip="Pagina Anterior" onClick="botonAnterior()"></li>
        <li class="next" data-tooltip="Siguiente Pagina" onClick="botonSiguiente()"></li>
    </ul>
</div>

<script>
    var grupo;
    var cuaderno;
    var diario = <?php echo $diario->guid; ?>;
    var i = 0;
    var total =<?php echo $total_notas; ?>;
    var totalActividades =<?php echo $total_actividades; ?>;
    var totalReflexion =<?php echo $total_reflexion; ?>;
    var totalAspectos =<?php echo $total_aspectos; ?>;
    var totalDocumentos =<?php echo $total_documentos; ?>;
    var totalAnecdotas =<?php echo $total_anecdotas; ?>;
    var esCuaderno = false;
    var esDiario = false;
    var tipo;
    $(document).ready(function () {
        i = 0;
        ocultarTodos();
        $("#magazine-2").show();
        $("#actividades-li").addClass('select');
        $("#actividades-li").live('click', function () {
            ocultarTodos();
            $("#actividades-li").addClass('select');
            $("#magazine-2").show();
            tipo = 0;
        });
        $("#reflexiones-li").live('click', function () {
            ocultarTodos();
            $(this).addClass('select');
            $("#reflexiones").show();
            tipo = 1;
        });
        $("#aspectos-li").live('click', function () {
            ocultarTodos();
            $(this).addClass('select');
            $("#aspectos").show();
            tipo = 2;
        });
        $("#documentos-li").live('click', function () {
            ocultarTodos();
            $(this).addClass('select');
            $("#documentos").show();
            tipo = 3;
        });
        $("#anecdotas-li").live('click', function () {
            ocultarTodos();
            $(this).addClass('select');
            $("#anecdotas").show();
            tipo = 4;
        });

        $("#agregar-nota").click(function () {
            $("#magazine").hide();
            $("#pestana-cuaderno").hide();
            $("#add-nota").show();
            $(".botones").hide();
        });

        $("#agregar-nota-diario").click(function () {
            $("#magazine-2").hide();
            $("#reflexiones").hide();
            $("#aspectos").hide();
            $("#documentos").hide();
            $("#anecdotas").hide();
            $("#pestana-diario").hide();
            $("#add-nota-diario").show();
            $(".botones").hide();
        });
    });
    $(window).ready(function () {
        $('#magazine-2').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            autoCenter: true,
            when: {
                turned: function (e, page) {
                    /*console.log('Current view: ', $(this).turn('view'));*/
                }
            }
        });
        $('#magazine').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            autoCenter: true,
            when: {
                turned: function (e, page) {
                    /*console.log('Current view: ', $(this).turn('view'));*/
                }
            }
        });
        $('#reflexiones').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            autoCenter: true,
            when: {
                turned: function (e, page) {
                    /*console.log('Current view: ', $(this).turn('view'));*/
                }
            }
        });
        $('#aspectos').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            autoCenter: true,
            when: {
                turned: function (e, page) {
                    /*console.log('Current view: ', $(this).turn('view'));*/
                }
            }
        });
        $('#documentos').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            autoCenter: true,
            when: {
                turned: function (e, page) {
                    /*console.log('Current view: ', $(this).turn('view'));*/
                }
            }
        });
        $('#anecdotas').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            autoCenter: true,
            when: {
                turned: function (e, page) {
                    /*console.log('Current view: ', $(this).turn('view'));*/
                }
            }
        });
    });

    $(window).bind('keydown', function (e) {
        if (e.keyCode == 37 && esDiario) {
            switch (tipo) {
                case 0:
                    $("#magazine-2").turn('previous');
                    break;
                case 1:
                    $("#reflexiones").turn('previous');
                    break;
                case 2:
                    $("#aspectos").turn('previous');
                    break;
                case 3:
                    $("#documentos").turn('previous');
                    break;
                case 4:
                    $("#anecdotas").turn('previous');
                    break;
            }
        }
        else if (e.keyCode == 39 && esDiario) {
            switch (tipo) {
                case 0:
                    cargarSiguienteActividad();
                    break;
                case 1:
                    cargarSiguienteReflexion();
                    break;
                case 2:
                    cargarSiguienteAspecto();
                    break;
                case 3:
                    cargarSiguienteDocumento();
                    break;
                case 4:
                    cargarSiguienteAnecdota();
                    break;
            }
        }
    });

    $(window).bind('keydown', function (e) {
        if (e.keyCode == 37 && esCuaderno) {
            $('#magazine').turn('previous');
        }
        else if (e.keyCode == 39 && esCuaderno) {
            var pagina = $("#magazine").turn("pages");
            if (pagina - 2 < total) {
                elgg.get('ajax/view/cuaderno_nota/ver_cuaderno', {
                    timeout: 30000,
                    data: {
                        grupo: grupo,
                        cuaderno: cuaderno,
                        etapa: "cero",
                        offset: pagina - 2
                    },
                    success: function (result, success, xhr) {
                        var clase = "cuaderno-izquierdo";
                        if (pagina % 2 == 0) {
                            clase = "cuaderno-derecho";
                        }
                        var element = "<div class='" + clase + "'>" + result + "</div>";
                        $("#magazine").turn("addPage", element, pagina + 1);

                    },
                });
            }
            pagina = $("#magazine").turn("pages");
            if (pagina - 2 < total) {
                elgg.get('ajax/view/cuaderno_nota/ver_cuaderno', {
                    timeout: 30000,
                    data: {
                        grupo: grupo,
                        cuaderno: cuaderno,
                        etapa: "cero",
                        offset: pagina - 2,
                    },
                    success: function (result, success, xhr) {
                        var clase = "cuaderno-izquierdo";
                        if (pagina % 2 == 0) {
                            clase = "cuaderno-derecho";
                        }
                        var element = "<div class='" + clase + "'>" + result + "</div>";
                        $("#magazine").turn("addPage", element, pagina + 1);
                    },
                });
            } else if (pagina - 3 < total) {
                var clase = "cuaderno-izquierdo";
                if (pagina % 2 == 0) {
                    clase = "cuaderno-derecho";
                    var element = "<div class='" + clase + "'></div>";
                    $("#magazine").turn("addPage", element, pagina + 1);
                }
            }
            $('#magazine').turn('next');
        }
    });


    function verCuaderno(grup, cuadern) {
        grupo = grup;
        cuaderno = cuadern;
        esCuaderno = true;
        esDiario = false;
    }


    function verDiario(grup, cuadern) {
        grupo = grup;
        cuaderno = cuadern;
        esCuaderno = false;
        esDiario = true;
        tipo = 0;
        $("#magazine-2").show();
        $("#reflexiones").hide();
        $("#aspectos").hide();
        $("#documentos").hide();
        $("#anecdotas").hide();
        $("#pestana-diario").show();
        $("#add-nota-diario").hide();
    }

    function ocultarTodos() {
        $("#reflexiones").hide();
        $("#documentos").hide();
        $("#aspectos").hide();
        $("#magazine-2").hide();
        $("#anecdotas").hide();
        $(".select").removeClass("select");
    }

    function cargarSiguienteActividad() {
        var pagina = $("#magazine-2").turn("pages");
        if (pagina - 2 < totalActividades) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "Actividades/Sucesos"

                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#magazine-2").turn("addPage", element, pagina + 1);

                },
            });
        }
        pagina = $("#magazine-2").turn("pages");
        if (pagina - 2 < totalActividades) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "Actividades/Sucesos"
                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#magazine-2").turn("addPage", element, pagina + 1);
                },
            });
        } else if (pagina - 3 < totalActividades) {
            var clase = "cuaderno-izquierdo";
            if (pagina % 2 == 0) {
                clase = "cuaderno-derecho";
                var element = "<div class='" + clase + "'></div>";
                $("#magazine-2").turn("addPage", element, pagina + 1);
            } else {

            }
            ;

        }
        $('#magazine-2').turn('next');
    }

    function cargarSiguienteReflexion() {
        var pagina = $("#reflexiones").turn("pages");
        if (pagina - 2 < totalReflexion) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "reflexion"

                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#reflexiones").turn("addPage", element, pagina + 1);

                },
            });
        }
        pagina = $("#reflexiones").turn("pages");
        if (pagina - 2 < totalReflexion) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "reflexion"
                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#reflexiones").turn("addPage", element, pagina + 1);
                },
            });
        } else if (pagina - 3 < totalReflexion) {
            var clase = "cuaderno-izquierdo";
            if (pagina % 2 == 0) {
                clase = "cuaderno-derecho";
                var element = "<div class='" + clase + "'></div>";
                $("#reflexiones").turn("addPage", element, pagina + 1);
            } else {
            }

        }
        $('#reflexiones').turn('next');
    }

    function cargarSiguienteAspecto() {
        var pagina = $("#aspectos").turn("pages");
        if (pagina - 2 < totalAspectos) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "reflexion"

                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#aspectos").turn("addPage", element, pagina + 1);

                },
            });
        }
        pagina = $("#aspectos").turn("pages");
        if (pagina - 2 < totalAspectos) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "aspectos"
                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#aspectos").turn("addPage", element, pagina + 1);
                },
            });
        } else if (pagina - 3 < totalAspectos) {
            var clase = "cuaderno-izquierdo";
            if (pagina % 2 == 0) {
                clase = "cuaderno-derecho";
                var element = "<div class='" + clase + "'></div>";
                $("#aspectos").turn("addPage", element, pagina + 1);
            } else {

            }
        }
        $('#aspectos').turn('next');
    }


    function cargarSiguienteDocumento() {
        var pagina = $("#documentos").turn("pages");
        if (pagina - 2 < totalDocumentos) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "documentos"

                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#documentos").turn("addPage", element, pagina + 1);

                },
            });
        }
        pagina = $("#documentos").turn("pages");
        if (pagina - 2 < totalDocumentos) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "documentos"
                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#documentos").turn("addPage", element, pagina + 1);
                },
            });
        } else if (pagina - 3 < totalDocumentos) {
            var clase = "cuaderno-izquierdo";
            if (pagina % 2 == 0) {
                clase = "cuaderno-derecho";
                var element = "<div class='" + clase + "'></div>";
                $("#documentos").turn("addPage", element, pagina + 1);
            } else {

            }
        }
        $('#documentos').turn('next');
    }


    function cargarSiguienteAnecdota() {
        var pagina = $("#anecdotas").turn("pages");
        if (pagina - 2 < totalAnecdotas) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "anecdotas"

                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#anecdotas").turn("addPage", element, pagina + 1);

                },
            });
        }
        pagina = $("#anecdotas").turn("pages");
        if (pagina - 2 < totalAnecdotas) {
            elgg.get('ajax/view/diario_campo/ver_diario', {
                timeout: 30000,
                data: {
                    grupo: grupo,
                    diario: diario,
                    etapa: "cero",
                    offset: pagina - 2,
                    tipo: "anecdotas"
                },
                success: function (result, success, xhr) {
                    var clase = "cuaderno-izquierdo";
                    if (pagina % 2 == 0) {
                        clase = "cuaderno-derecho";
                    }
                    var element = "<div class='" + clase + "'>" + result + "</div>";
                    $("#anecdotas").turn("addPage", element, pagina + 1);
                },
            });
        } else if (pagina - 3 < totalAnecdotas) {
            var clase = "cuaderno-izquierdo";
            if (pagina % 2 == 0) {
                clase = "cuaderno-derecho";
                var element = "<div class='" + clase + "'></div>";
                $("#anecdotas").turn("addPage", element, pagina + 1);
            } else {
            }

        }
        $('#anecdotas').turn('next');
    }

    function getAgregarNota(guid, etapa) {
        var diario = guid;
        var etapa = etapa;
        elgg.get('ajax/view/nota/agregar_nota', {
            timeout: 30000,
            data: {
                diario: diario,
                etapa: etapa,
            },
            success: function (result, success, xhr) {
                $('#add-nota').html(result);
            },
        });
    }

    function getAgregarNotaDiario(guid, etapa) {
        var diario = guid;
        var etapa = etapa;
        elgg.get('ajax/view/nota/agregar_nota_tipo', {
            timeout: 30000,
            data: {
                diario: diario,
                etapa: etapa,
            },
            success: function (result, success, xhr) {
                $('#add-nota-diario').html(result);
            },
        });
    }

    function botonAnterior() {
        if (esDiario) {
            switch (tipo) {
                case 0:
                    $("#magazine-2").turn('previous');
                    break;
                case 1:
                    $("#reflexiones").turn('previous');
                    break;
                case 2:
                    $("#aspectos").turn('previous');
                    break;
                case 3:
                    $("#documentos").turn('previous');
                    break;
                case 4:
                    $("#anecdotas").turn('previous');
                    break;
            }
        } else {
            $("#magazine").turn('previous');
        }
    }
    function botonSiguiente() {
        if (esDiario) {
            switch (tipo) {
                case 0:
                    cargarSiguienteActividad();
                    break;
                case 1:
                    cargarSiguienteReflexion();
                    break;
                case 2:
                    cargarSiguienteAspecto();
                    break;
                case 3:
                    cargarSiguienteDocumento();
                    break;
                case 4:
                    cargarSiguienteAnecdota();
                    break;
            }
        } else {

            var pagina = $("#magazine").turn("pages");
            if (pagina - 2 < total) {
                elgg.get('ajax/view/cuaderno_nota/ver_cuaderno', {
                    timeout: 30000,
                    data: {
                        grupo: grupo,
                        cuaderno: cuaderno,
                        etapa: "cero",
                        offset: pagina - 2
                    },
                    success: function (result, success, xhr) {
                        var clase = "cuaderno-izquierdo";
                        if (pagina % 2 == 0) {
                            clase = "cuaderno-derecho";
                        }
                        var element = "<div class='" + clase + "'>" + result + "</div>";
                        $("#magazine").turn("addPage", element, pagina + 1);

                    },
                });
            }
            pagina = $("#magazine").turn("pages");
            if (pagina - 2 < total) {
                elgg.get('ajax/view/cuaderno_nota/ver_cuaderno', {
                    timeout: 30000,
                    data: {
                        grupo: grupo,
                        cuaderno: cuaderno,
                        etapa: "cero",
                        offset: pagina - 2,
                    },
                    success: function (result, success, xhr) {
                        var clase = "cuaderno-izquierdo";
                        if (pagina % 2 == 0) {
                            clase = "cuaderno-derecho";
                        }
                        var element = "<div class='" + clase + "'>" + result + "</div>";
                        $("#magazine").turn("addPage", element, pagina + 1);
                    },
                });
            } else if (pagina - 3 < total) {
                var clase = "cuaderno-izquierdo";
                if (pagina % 2 == 0) {
                    clase = "cuaderno-derecho";
                    var element = "<div class='" + clase + "'></div>";
                    $("#magazine").turn("addPage", element, pagina + 1);
                }
            }
            $('#magazine').turn('next');
        }
    }

</script>