<?php
elgg_load_js("jquery-ui");
elgg_load_js("turn");
echo elgg_view('vistas/js');
$investigacion = get_input('investigacion');
$etapa = get_input('etapa');
$pregunta_seleccionada = elgg_get_pregunta_investigacion($investigacion);
$user = elgg_get_logged_in_user_guid();
$diario = elgg_get_diario_campo($investigacion);
error_log("guid:diario".$diario->guid);
$total_actividades = elgg_get_total_actividades($diario->guid, $etapa, "Actividades/Sucesos");
error_log("actividades".$total_actividades);
$total_reflexion = elgg_get_total_actividades($diario->guid, $etapa, "reflexion");
error_log("reflexiones".$total_reflexion);
$total_aspectos = elgg_get_total_actividades($diario->guid, $etapa, "aspectos");
$total_documentos = elgg_get_total_actividades($diario->guid, $etapa, "documentos");
$total_anecdotas = elgg_get_total_actividades($diario->guid, $etapa, "anecdotas");
$boton_diario = '<a class="" href="#" id="agregar-nota-diario" onclick=\' getAgregarNotaDiario("' . $diario->guid . '","' . $etapa . '")  \'>Agregar Nota</a>';
?>
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


<script>
    var grupo;
    var cuaderno;
    var diario = <?php echo $diario->guid; ?>;
    var i = 0;
    var totalActividades =<?php echo $total_actividades; ?>;
    var totalReflexion =<?php echo $total_reflexion; ?>;
    var totalAspectos =<?php echo $total_aspectos; ?>;
    var totalDocumentos =<?php echo $total_documentos; ?>;
    var totalAnecdotas =<?php echo $total_anecdotas; ?>;
    var etapa = "<?php echo $etapa ?>";
    var esCuaderno = false;
    var esDiario = false;
    var tipo;
    $(document).ready(function() {
        i = 0;
        ocultarTodos();
        $("#magazine-2").show();
        $("#actividades-li").addClass('select');
        $("#actividades-li").live('click', function() {
            ocultarTodos();
            $("#actividades-li").addClass('select');
            $("#magazine-2").show();
            tipo = 0;
        });
        $("#reflexiones-li").live('click', function() {
            ocultarTodos();
            $(this).addClass('select');
            $("#reflexiones").show();
            tipo = 1;
        });
        $("#aspectos-li").live('click', function() {
            ocultarTodos();
            $(this).addClass('select');
            $("#aspectos").show();
            tipo = 2;
        });
        $("#documentos-li").live('click', function() {
            ocultarTodos();
            $(this).addClass('select');
            $("#documentos").show();
            tipo = 3;
        });
        $("#anecdotas-li").live('click', function() {
            ocultarTodos();
            $(this).addClass('select');
            $("#anecdotas").show();
            tipo = 4;
        });

        $("#agregar-nota-diario").click(function() {
            $("#magazine-2").hide();
            $("#reflexiones").hide();
            $("#aspectos").hide();
            $("#documentos").hide();
            $("#anecdotas").hide();
            $("#pestana-diario").hide();
            $("#add-nota-diario").show();
            $(".botones").hide();
        });
        verDiario(0, diario);
    });
    $(window).ready(function() {
        $('#magazine-2').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            autoCenter: true,
            when: {
                turned: function(e, page) {
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
                turned: function(e, page) {
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
                turned: function(e, page) {
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
                turned: function(e, page) {
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
                turned: function(e, page) {
                    /*console.log('Current view: ', $(this).turn('view'));*/
                }
            }
        });
    });

    $(window).bind('keydown', function(e) {
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
        }
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "Actividades/Sucesos"

                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "Actividades/Sucesos"
                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "reflexion"

                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "reflexion"
                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "reflexion"

                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "aspectos"
                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "documentos"

                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "documentos"
                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "anecdotas"

                },
                success: function(result, success, xhr) {
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
                    etapa: etapa,
                    offset: pagina - 2,
                    tipo: "anecdotas"
                },
                success: function(result, success, xhr) {
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
            success: function(result, success, xhr) {
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
            success: function(result, success, xhr) {
                $('#add-nota-diario').html(result);
            },
        });
    }

</script>
