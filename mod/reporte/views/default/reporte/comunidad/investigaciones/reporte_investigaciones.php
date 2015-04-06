<?php
$guid = get_input("inv");
//error_log('LLEGA -> '.$guid);
//$investigacion = get_entity($guid);
$datos = elgg_get_estadisticas_investigacione_grupoEM($guid);
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
$filtros = array('sexo' => array(), 'curso' => array(), 'etnia' => array(), 'tipo_user' => array());

foreach ($lista as $item) {
    if (!in_array($item['sexo'], $filtros['sexo'])) {
        $filtros['sexo'][] = $item['sexo'];
    }
    if (!in_array($item['etnia'], $filtros['etnia'])) {
        $filtros['etnia'][] = $item['etnia'];
    }
    if (!in_array($item['curso'], $filtros['curso'])) {
        $filtros['curso'][] = $item['curso'];
    }
    //$subtype = $item->getSubtype();
    if (!in_array($item['tipo_user'], $filtros['tipo_user'])) {
        $filtros['tipo_user'][] = $item['tipo_user'];
    }

    //$institucion = elgg_get_institucion_de_usuario($item);
    $contenido_lista.="<tr>"
            . "<td>{$item['nombre']}</td>"
            . "<td>{$item['email']}</td>"
            . "<td>{$item['edad']}</td>"
            . "<td>{$item['tipo_user']}</td>"            
            . "<td>{$item['curso']}</td>"
            . "<td>{$item['etnia']}</td>"
            . "<td>{$item['sexo']}</td>"            
            . "</tr>";
}
$select_tipoUser = '<select onchange="mostrarEdades();consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo_user'] as $tip_us) {
    if ($tip_us != "")
        $select_tipoUser.="<option value='$tip_us' >$tip_us</option>";
}
$select_tipoUser.="</select>";

$select_sexo = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['sexo'] as $sexo) {
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

$select_grado = '<select onchange="consultarTabla()" class="select-filtro"><option></option>';
foreach ($filtros['curso'] as $grado) {
    if ($grado != "")
        $select_grado.="<option value='$grado'>$grado</option>";
}
$select_grado.="</select>";
echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Integrantes</a></li>
            
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
                        <label>Tipo de Usuario</label>
                        <?php echo $select_tipoUser ?>
                    </div>
                    <div class="row">
                        <label>Genero</label>
                        <?php echo $select_sexo ?>
                    </div>

                    <div class="row">
                        <label>Grupo Etnico</label>
                        <?php echo $select_etnia ?>
                    </div>
                    <div class="row">
                        <label>Grado</label>
                        <?php echo $select_grado ?>
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
                <br>
                <div id="imprimir">
                    <h2 class="titulo-reportes">Miembros de <?php echo $grupo->name ?></h2>
                    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-datos-grupo')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-datos-grupo" class="responstable">
                        <thead><tr><th>Nombre</th><th>Email</th><th>Edad</th><th>Tipo de Usuario</th><th>Curso</th><th>Etnia</th><th>Genero</th></tr></thead>
                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>


            <div id="listado-investigaciones-grupo">
            </div>
        </div>

        <script>
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
                $("#listado-investigaciones-grupo").hide();
                $("#estaditicas").show();
            }

            function verListado(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").show();
                $("#estaditicas").hide();
                $("#listado-investigaciones-grupo").hide();

            }



            function verInvestigaciones(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").hide();
                $("#estaditicas").hide();
                $("#listado-investigaciones-grupo").show();
                if (loadInvestigaciones) {
                    return false;
                }
                $("#listado-investigaciones-grupo").html(imprimirLoader());
                elgg.get('ajax/view/reporte/comunidad/investigaciones/reporte_maestros_investigacion', {
                    timeout: 30000,
                    data: {
                        grupo: "<?php echo $guid ?>",
                    },
                    success: function(result, success, xhr) {
                        loadInvestigaciones = true;
                        $("#listado-investigaciones-grupo").html(result);
                    },
                });
            }

            function deseleccionarTodos() {
                $(".tabs-coordinacion li").each(function() {
                    $(this).removeClass("selected");
                });
            }

            function consultarTabla() {
                $("#tabla-datos-grupo_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-datos-grupo_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-datos-grupo').dataTable({
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