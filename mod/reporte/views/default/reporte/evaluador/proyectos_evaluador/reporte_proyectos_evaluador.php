<?php
/**
 * Vista que muestra el reporte de los proyectos asiganodos a un evaluador
 *
 */
$evaluador = get_input('evaluador');
$as = get_entity($evaluador);

$datos = elgg_get_estadisticas_proyectos_evaluador($evaluador);
$estudiantes = $datos['lista'];

$lista = $datos['lista'];
$contenido_lista = "";
$filtros = array('grupo' => array(), 'institucion' => array());

//Listo las investigaciones asignadas
foreach ($lista as $item) {
    if (!in_array($item['grupo'], $filtros['grupo'])) {
        $filtros['grupo'][] = $item['grupo'];
    }
    if (!in_array($item['colegio'], $filtros['institucion'])) {
        $filtros['institucion'][] = $item['colegio'];
    }


    $contenido_lista.="<tr>"
            . "<td>{$item['nombre']}</td>"
//            . "<td>{$item['linea']}</td>"
//            . "<td>{$item['categoria']}</td>"                
            . "<td>{$item['grupo']}</td>"
            . "<td>{$item['colegio']}</td>"
            . "<td>{$item['municipio']}</td>"
            . "</tr>";
}

$select_g = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['grupo'] as $t) {
    if ($t != "") {
        $select_g.="<option value='$t' >$t</option>";
    }
}
$select_g.="</select>";
$select_i = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['institucion'] as $t) {
    if ($t != "") {
        $select_i.="<option value='$t' >$t</option>";
    }
}
$select_i.="</select>";

$evaluad = "<center><h2><span>Evaluador:</span></h2>"
        . "<div><div class='info-evaluador-form'>"
        . "<a><img src='{$as->getIconURL()}' width='35' /></a><div class='row' style='margin-left:10px;font-weight:700;'><span>{$as->name} {$as->apellidos}</span></div>"
        . "</div></div></center><br><br>";

echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
            <!--            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>-->
            <li class="selected" onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Investigaciones</a></li>
        </ul>
        <div class="tabs-asesores">
            <div>
<?php echo $evaluad; ?>
            </div>
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
                        <label>Grupo</label>
<?php echo $select_g ?>
                    </div>
                    <div class="row">
                        <label>Institución</label>
<?php echo $select_i ?>
                    </div>
                </div>
                <div id="imprimir">
                    <br>
                    <h2 class="titulo-reportes">Investigaciones Asignadas a <?php echo $as->name . " " . $as->apellidos ?></h2>
                    <form action="http://<?php echo elgg_get_url_server() ?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-proyectos-eval')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-proyectos-eval" class="responstable">
                        <thead><tr><th>Nombre</th><th>Grupo</th><th>Institución</th><th>Municipio</th></tr></thead>
                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
//            var loadInstituciones = false;
//            var loadGrupos = false;
//            function verEstaditicas(element) {
//                deseleccionarTodos();
//                $(element).addClass('selected');
//                $("#listados").hide();
//                $("#estaditicas").show();
//            }

            function verListado(element) {
                deseleccionarTodos();
                $(element).addClass('selected');
                $("#listados").show();
                $("#estaditicas").hide();
            }



            function deseleccionarTodos() {
                $(".tabs-coordinacion li").each(function() {
                    $(this).removeClass("selected");
                });
            }

            function consultarTabla() {
                $("#tabla-proyectos-eval_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-proyectos-eval_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-proyectos-eval').dataTable({
                    "bPaginate": false
                });
//                $("#listados").hide();
            });
        </script>
    </div>    
<?php ?>