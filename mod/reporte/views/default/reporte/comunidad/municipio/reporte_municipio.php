<?php
$municipio = mb_strtoupper(get_input("munic"), 'UTF-8');
$datos = elgg_get_estaditicas_municipio($municipio);
$usuarios = $datos['usuario'];
$tablas = $datos['tablas'];
$tipo_usuario = $tablas['Tipo de Usuario'];
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
$filtros = array('sexo' => array(), 'curso' => array(), 'tipo_institucion' => array(), 'etnia' => array(), 'tipo_user' => array());
foreach ($lista as $item) {
    if (!in_array($item['genero'], $filtros['sexo'])) {
        $filtros['sexo'][] = $item['genero'];
    }
    if (!in_array($item['etnia'], $filtros['etnia'])) {
        $filtros['etnia'][] = $item['etnia'];
    }
    if (!in_array($item['tipo_institucion'], $filtros['tipo_institucion'])) {
        $filtros['tipo_institucion'][] = $item['tipo_institucion'];
    }
    if (!in_array($item['tipo'], $filtros['tipo_user'])) {
        $filtros['tipo_user'][] = $item['tipo'];
    }
    if (!in_array($item['curso'], $filtros['curso'])) {
        $filtros['curso'][] = $item['curso'];
    }
    if ($item['tipo'] == "Maestro") {
        $total_m++;
    } elseif ($item['tipo'] == "Estudiante") {
        $total_e++;
    }
    $contenido_lista.="<tr>"
            . "<td>{$item['nombre']}</td>"
            . "<td>{$item['email']}</td>"
            . "<td>{$item['fecha_nacimiento']}</td>"
            . "<td>{$item['tipo']}</td>"
            . "<td>{$item['curso']}</td>"
            . "<td>{$item['etnia']}</td>"
            . "<td>{$item['genero']}</td>"
            . "<td>{$item['institucion']}</td>"
            . "<td>{$item['tipo_institucion']}</td>"
            . "</tr>";
}
$select_tipoUser = '<select onchange="mostrarEdades(this);consultarTabla(); " class="select-filtro" title-contenido=""><option></option>';
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
$select_tipo_institucion = '<select onchange="consultarTabla()" class="select-filtro"><option></option>';
foreach ($filtros['tipo_institucion'] as $ti) {
    if ($ti != "")
        $select_tipo_institucion.="<option value='$ti'>$ti</option>";
}
$select_tipo_institucion.="</select>";
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
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Usuarios</a></li>
            <li onclick="verInstituciones(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Instituciones</a></li>
            <li onclick="verGrupos(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Grupos</a></li>
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
                        <label>Tipo de Institución:</label>
                        <?php echo $select_tipo_institucion ?>
                    </div>
                    <div class="row">
                        <label>Grado:</label>
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



                <div id="imprimir">
                    <br>
                    <h2 class="titulo-reportes">Usuarios del Municipio <?php echo $municipio ?></h2>

                    <br><br>     <div><label>Total de Maestros: </label><strong><?php echo $total_m ?></strong></div>
                    <div><label>Total de Estudiantes: </label><strong><?php echo $total_e ?></strong></div>
                    <div><label>Total de Usuarios: </label><strong><?php echo sizeof($lista) ?></strong></div><br><br>
                    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-datos-municipio')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-datos-municipio" class="responstable">
                        <thead><tr><th>Nombre</th><th>Email</th><th>Edad</th><th>Tipo de Usuario</th><th>Grado</th><th>Etnia</th><th>Genero</th><th>Institución</th><th>Tipo de Institucion</th></tr></thead>

                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>
            <div id="listado-instituciones"></div>
            <div id="listado-grupos"></div>
        </div>

        <script>
            var loadInstituciones = false;
            var loadGrupos = false;
            
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
                $("#listado-grupos").hide();
                $("#listado-instituciones").hide();
                $("#estaditicas").show();
            }

            function verListado(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").show();
                $("#listado-instituciones").hide();
                $("#estaditicas").hide();
            }

            function verInstituciones(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").hide();
                $("#estaditicas").hide();
                $("#listado-grupos").hide();
                $("#listado-instituciones").show();
                if (loadInstituciones) {
                    return false;
                }
                $("#listado-instituciones").html(imprimirLoader());
                elgg.get('ajax/view/reporte/comunidad/municipio/instituciones_municipio/instituciones_municipio', {
                    timeout: 30000,
                    data: {
                        munic: "<?php echo $municipio ?>",
                    },
                    success: function(result, success, xhr) {
                        loadInstituciones = true;
                        $("#listado-instituciones").html(result);
                    },
                });
            }

            function verGrupos(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").hide();
                $("#estaditicas").hide();
                $("#listado-instituciones").hide();
                $("#listado-grupos").show();
                if (loadGrupos) {
                    return false;
                }
                $("#listado-grupos").html(imprimirLoader());
                elgg.get('ajax/view/reporte/comunidad/municipio/grupos_municipio/grupos_municipio', {
                    timeout: 30000,
                    data: {
                        munic: "<?php echo $municipio ?>",
                    },
                    success: function(result, success, xhr) {
                        loadGrupos = true;
                        $("#listado-grupos").html(result);
                    },
                });
            }

            function deseleccionarTodos() {
                $(".tabs-coordinacion li").each(function() {
                    $(this).removeClass("selected");
                });
            }

            function consultarTabla() {
                $("#tabla-datos-municipio_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-datos-municipio_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-datos-municipio').dataTable({
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
<?php ?>