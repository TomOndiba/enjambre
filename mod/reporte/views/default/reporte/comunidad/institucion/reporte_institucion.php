<?php
$inst = get_input("institucion");
$institucion = get_entity($inst);
$datos = elgg_get_estaditicas_institucion($institucion);
$usuarios = $datos['usuario'];
$tablas = $datos['tablas'];
$etnias = $tablas['etnias'];
$generos = $tablas['genero'];
$tipo_user = $tablas['Tipo de Usuario'];
$tipo = 0;
$contenido = "<div>";
foreach ($tablas as $key => $value) {
    $contenido.="<div class='box-estadistica'><h2 class='titulo-reportes'>$key</h2>";
    $table = array();
    $tabla_resumen = "";
    $table['cols'] = array(
        array('label' => $key, 'type' => 'string'),
        array('label' => 'Total', 'type' => 'number')
    );

    $tabla_resumen = "<table class='responstable'>"
            . "<thead><tr><th>$key</th><th>Número de Usuarios</th></tr></thead>";
    $rows = array();
    $total = 0;
    foreach ($value as $element => $valor) {
        error_log("element:".$element);
        $temp = array();
        $temp[] = array('v' => $element);
        $temp[] = array('v' => $valor);
        $rows[] = array('c' => $temp);
        $tabla_resumen.="<tr><td><b>$element</b></td><td>$valor</td></tr>";
        $total+=$valor;
    }
    $tabla_resumen.="<tr><td><b>Total</b></td><td>$total</td></tr></table>";
    $table['rows'] = $rows;
    $json_data = json_encode($table);
    $contenido.="<div id='grafica-$tipo' class='grafica'></div>";
    $contenido.= elgg_view('reporte/comunidad/departamento/pintar_grafica', array('datos' => $json_data, 'tipo' => $key, 'numero' => $tipo));
    $contenido.=$tabla_resumen;
    $contenido.="</div>";
    $tipo++;
}
$contenido.="</div>";
$lista = $datos['lista'];
$contenido_lista = "";
$filtros = array('genero' => array(), 'grado' => array(), 'tipo_institucion' => array(), 'etnia' => array(), 'tipo_user' => array());
$print = array();

foreach ($lista as $item) {
    if (!in_array($item['genero'], $filtros['genero'])) {
        $filtros['genero'][] = $item['genero'];
    }
    if (!in_array($item['etnia'], $filtros['etnia'])) {
        $filtros['etnia'][] = $item['etnia'];
    }
    if (!in_array($item['curso'], $filtros['grado'])) {
        $filtros['grado'][] = $item['curso'];
    }
    if (!in_array($item['tipo'], $filtros['tipo_user'])) {
        $filtros['tipo_user'][] = $item['tipo'];
    }

    $contenido_lista.="<tr>"
            . "<td>{$item['nombre']}</td>"
            . "<td>{$item['email']}</td>"
            . "<td>{$item['tipo']}</td>"
            . "<td>{$item['etnia']}</td>"
            . "<td>{$item['genero']}</td>"
            . "<td>{$item['curso']}</td>"
//            . "<td>$institucion->municipio</td>"
            . "</tr>";

    //$datos = array($item->name . " \n " . $item->apellidos, $subtype, $item->grupo_etnico, $item->sexo, $item->curso);
    //array_push($print, $datos);
}
$select_tipoUser = '<select onchange="mostrarEdades(this);consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo_user'] as $tip_us) {
    if ($tip_us != "")
        $select_tipoUser.="<option value='$tip_us' >$tip_us</option>";
}
$select_tipoUser.="</select>";

$select_sexo = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['genero'] as $sexo) {
    if ($sexo != "")
        $select_sexo.="<option value='$sexo' >$sexo</option>";
}
$select_sexo.="</select>";
$select_etnia = '<select onchange="consultarTabla()" class="select-filtro"><option></option>';
foreach ($filtros['etnia'] as $etnia) {
    if ($etnia != "")
        $select_etnia.="<option value='$etnia'>$etnia</option>";
}
$select_etnia.="</select>";
$select_tipo_institucion = '<select onchange="consultarTabla()" class="select-filtro"><option></option>';
foreach ($filtros['tipo_institucion'] as $ti) {
    if ($ti != "")
        $select_tipo_institucion.="<option value='$ti'>$ti</option>";
}
$select_tipo_institucion.="</select>";
$select_grado = '<select onchange="consultarTabla()" class="select-filtro"><option></option>';
foreach ($filtros['grado'] as $grado) {
    if ($grado != "")
        $select_grado.="<option value='$grado'>$grado</option>";
}
$select_grado.="</select>";

$width = array(90, 30, 20, 20, 20);
$titulo = "Reporte de Usuarios de $institucion->name";
$header = array("Nombre", "Tipo de Usuario", "Etnia", "Genero", "Curso");
$params = array('titulo' => $titulo, 'header' => $header, 'data' => $print, 'ancho' => $width);
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Usuarios</a></li>
            <li onclick="verGrupos(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Grupos de Investigación</a></li>
            <li onclick="verInvestigaciones(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Investigaciones</a></li>
        </ul>
        <div class="tabs-asesores">
            <div id="estaditicas">
                <?php echo $contenido ?>
            </div>
            <div id="listados">
                <div class="filtros">
                    <br>
                    <h2 class="titulo-reportes">Filtros</h2>
                    <br>
                    <label></label>
                    <div class="row">
                        <label>Tipo de Usuario:</label>
                        <?php echo $select_tipoUser ?>
                    </div>
                    <div class="row">
                        <label>Genero:</label>
                        <?php echo $select_sexo ?>
                    </div>

                    <div class="row">
                        <label>Grupo Etnico:</label>
                        <?php echo $select_etnia ?>
                    </div>
                    <div class="row">
                        <label>Grado:</label>
                        <?php echo $select_grado ?>
                    </div>
                    <div class="row">
                        <label>Tipo de Institución:</label>
                        <?php echo $select_tipo_institucion ?>
                    </div>
                    <div class="row" id="edad">
                        <label>Edades:</label>
                        <select id="min">
                            <option value="">Selccione Edad Inicial</option>
                            <option value="5">5 años</option>
                            <option value="6">6 años</option>
                            <option value="7">7 años</option>
                            <option value="8">8 años</option>
                            <option value="9">9 años</option>
                            <option value="10">10 años</option>
                            <option value="11">11 años</option>
                            <option value="12">12 años</option>
                            <option value="13">13 años</option>
                            <option value="14">14 años</option>
                            <option value="15">15 años</option>
                            <option value="16">16 años</option>
                            <option value="17">17 años</option>
                            <option value="18">18 años</option>
                            <option value="19">19 años</option>
                            <option value="20">20 años</option>
                        </select> &nbsp;&nbsp; a &nbsp;&nbsp; 
                        <select id="max">
                            <option value="">Selccione Edad Final</option>
                            <option value="5">5 años</option>
                            <option value="6">6 años</option>
                            <option value="7">7 años</option>
                            <option value="8">8 años</option>
                            <option value="9">9 años</option>
                            <option value="10">10 años</option>
                            <option value="11">11 años</option>
                            <option value="12">12 años</option>
                            <option value="13">13 años</option>
                            <option value="14">14 años</option>
                            <option value="15">15 años</option>
                            <option value="16">16 años</option>
                            <option value="17">17 años</option>
                            <option value="18">18 años</option>
                            <option value="19">19 años</option>
                            <option value="20">20 años</option>
                        </select>
                    </div>
                </div>

                <div id="imprimir">
                    <br>
                    <h2 class="titulo-reportes">USUARIOS DE <?php echo $institucion->name ?></h2>
                    <?php echo elgg_view_form("reportes/form_impresion_pdf", NULL, $params); ?>

                    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-datos-institucion')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-datos-institucion" class="responstable">
                        <thead><tr><th>Nombre</th><th>Email</th><th>Tipo de Usuario</th><th>Etnia</th><th>Genero</th><th>Curso</th></tr></thead>
                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>
            <div id="listado-grupos-institucion">
            </div>
            <div id="listado-investigaciones-institucion">
            </div>
        </div>

        <script>
            var loadGrupos = false;
            var loadInvestigaciones = false;
            
            function mostrarEdades(element){
                var value= $(element).val();
                if(value=="Maestro"){
                    $("#edad").hide();
                    $('#min').val("");
                    $('#max').val("");
                }else{
                    $("#edad").show();
                }
            }
            
            function verEstaditicas(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").hide();
                $("#estaditicas").show();
                $("#listado-investigaciones-institucion").hide();
                $("#listado-grupos-institucion").hide();
            }

            function verListado(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").show();
                $("#estaditicas").hide();
                $("#listado-investigaciones-institucion").hide();
                $("#listado-grupos-institucion").hide();
            }

            function verGrupos(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").hide();
                $("#estaditicas").hide();
                $("#listado-investigaciones-institucion").hide();
                $("#listado-grupos-institucion").show();
                if (loadGrupos) {
                    return false;
                }
                $("#listado-grupos-institucion").html(imprimirLoader());
                elgg.get('ajax/view/reporte/comunidad/institucion/grupos/grupos_institucion', {
                    timeout: 30000,
                    data: {
                        institucion: "<?php echo $inst ?>",
                    },
                    success: function(result, success, xhr) {
                        loadGrupos = true;
                        $("#listado-grupos-institucion").html(result);
                    },
                });
            }

            function verInvestigaciones(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").hide();
                $("#estaditicas").hide();
                $("#listado-grupos-institucion").hide();
                $("#listado-investigaciones-institucion").show();
                if (loadInvestigaciones) {
                    return false;
                }
                $("#listado-investigaciones-institucion").html(imprimirLoader());
                elgg.get('ajax/view/reporte/comunidad/institucion/investigaciones/investigaciones_institucion', {
                    timeout: 30000,
                    data: {
                        institucion: "<?php echo $inst ?>",
                    },
                    success: function(result, success, xhr) {
                        loadInvestigaciones = true;
                        $("#listado-investigaciones-institucion").html(result);
                    },
                });
            }

            function deseleccionarTodos() {
                $(".tabs-coordinacion li").each(function() {
                    $(this).removeClass("selected");
                });
            }

            function consultarTabla() {
                $("#tabla-datos-institucion_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-datos-institucion_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-datos-institucion').dataTable({
                    "bPaginate": false
                });
                 $('#min').change(function() {
                    table.fnDraw();
                });
                $('#max').change(function() {
                    table.fnDraw();
                });
                $("#edad").hide();
                $("#listados").hide();
            });

            $.fn.dataTableExt.afnFiltering.push(
                    function(oSettings, aData, iDataIndex) {
                        var iMin = document.getElementById('min').value * 1;
                        var iMax = document.getElementById('max').value * 1;
                        var iVersion = aData[2] == "-" ? 0 : aData[2] * 1;
                        if (iMin == "" && iMax == "")
                        {
                            return true;
                        }
                        else if (iMin == "" && iVersion <= iMax)
                        {
                            return true;
                        }
                        else if (iMin <= iVersion && "" == iMax)
                        {
                            return true;
                        }
                        else if (iMin <= iVersion && iVersion <= iMax)
                        {
                            return true;
                        }
                        return false;
                    }
            );

        </script>
    </div>    
    <?php
    ?>