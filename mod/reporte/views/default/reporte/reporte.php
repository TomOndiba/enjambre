<?php
elgg_load_js("data_table");
elgg_load_js("mun-dep-reportes");
?>
<style>
    .dataTables_wrapper{
        overflow-x: auto !important;
    }
</style>
<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Reportes</h2>
    </div>
    <div class="menu-coordinacion">
        <nav>
            <ul>
                <li>
                    <div><a>Comunidad</a></div>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/comunidad/departamento/init')">Departamento</a>
                        </li>
                    </ul>

                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/comunidad/municipio/init_municipio')">Municipio</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/comunidad/institucion/init_institucion')">Institución</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/comunidad/grupo/init_grupo')">Grupos</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/comunidad/investigaciones/init_investigaciones')">Investigaciones</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li>
                    <div><a>Convocatoria</a></div>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/listado_convocatorias/init_listado')">Listado de Convocatorias</a>
                        </li>
                    </ul>

                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/departamento/init_departamento')">Convocatorias Por Departamento</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/participacion_grupos/init_grupos_conv')">Grupos en Convocatorias</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/participacion_investigaciones/init_investigaciones_conv')">Investigaciones en Convocatorias</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/participacion_estudiantes/init_estudiantes_conv')">Estudiantes</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/participacion_maestros/init_maestros_conv')">Maestros</a>
                        </li>
                    </ul>

                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/evaluadores_conv/init_evaluadores_conv')">Evaluadores</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/asesores_conv/init_asesores_conv')">Asesores</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/convocatoria/ferias_en_convocatorias/init_ferias_in_conv')">Ferias en Convocatoria</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li>
                    <div><a>Feria</a></div>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/feria/departamento/init_departamento')">Ferias por Departamento</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/feria/municipio/init_municipio')">Ferias por Municipio</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/feria/estudiantes/init_tipo_feria')">Estudiantes</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/feria/maestros/init_tipo_feria')">Maestros</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/feria/grupos/init_grupos_feria')">Grupos</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/feria/investigaciones/init_investigaciones_feria')">Investigaciones</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/feria/evaluadores/init_evaluadores_feria')">Evaluadores</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <nav>
            <ul>
                <li>
                    <div><a>Grupos</a></div>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/grupo/convocatoria/init_convocatoria_grupo')">Convocatorias</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/grupo/feria/init_feria_grupo')">Ferias</a>
                        </li>
                    </ul>

                </li>
            </ul>
        </nav>


        <nav>
            <ul>
                <li>
                    <div><a>Evaluadores</a></div>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/evaluador/proyectos_evaluador/busqueda_evaluador')">Proyectos de un Evaluador</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/evaluador/proyectos_evaluados_convocatoria/init_proyectos_evaluados_conv')">Proyectos evaluados en Convocatoria</a>
                        </li>
                    </ul>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/evaluador/proyectos_evaluados_feria/init_proyectos_evaluados_feria')">Proyectos evaluados en Feria</a>
                        </li>
                    </ul>

                </li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li>
                    <div><a>Asesores</a></div>
                    <ul class="nav-interno">
                        <li>
                            <a id='busqueda-asesor' onclick="cargarvista('ajax/view/reporte/asesor/proyectos_asesor/busqueda_asesor')">Proyectos por Asesor</a>
                        </li>
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/asesor/proyectos_asesor_conv/init_proyectos_asesor_conv')">Proyectos por Asesor en Convocatoria</a>
                        </li>
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/asesor/calificacion_asesor_conv/init_calificaion_asesor_conv')">Calificacion de Asesor en Convocatoria</a>
                        </li>
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/asesor/asesorias_by_asesor/busqueda_asesorias_asesor')">Asesorias Realizadas</a>
                        </li>
                    </ul>


                </li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li>
                    <div><a>Redes</a></div>
                    <ul class="nav-interno">
                        <li>
                            <a onclick="cargarvista('ajax/view/reporte/redes_tematicas/init')">Redes</a>
                        </li>
                    </ul>


                </li>
            </ul>
        </nav>

    </div>

    <div class="contenido-coordinacion" id="container-resultado">

    </div>
</div>
<script  type = "text/javascript"  src = "https://www.google.com/jsapi" >
</script> 
<script>
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart(data, titulo, numero) {
        var data = new google.visualization.DataTable(data);
        var opciones = {
            title: titulo,
        };

        var chart = new google.visualization.PieChart(document.getElementById('grafica-' + numero));
        chart.draw(data, opciones);
    }
    function cargarvista(url) {
        elgg.get(url, {
            timeout: 30000,
            success: function(result, success, xhr) {
                $("#container-resultado").html(result);
            },
        });
    }


    function imprimirExcel(id) {
        $("#contenido_excel").val($("<div>").append($("#" + id).eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    }
</script>