<?php
/**
 * Vista que muestra el resultado del reporte del listado de convocatorias a las que pertenece o ha pertenecido un grupo de investigación
 * @author Erika Parra*/

$guid_grupo = get_input('grupo');
$grupo=  get_entity($guid_grupo);
$datos = elgg_get_estadisticas_ferias_grupo($guid_grupo);
$convocatorias = $datos['lista'];
$filtros = array('tipo_feria' => array());

foreach ($datos as $item) {
    if (!in_array($item['tipo_feria'], $filtros['tipo_feria'])) {
        $filtros['tipo_feria'][] = $item['tipo_feria'];
    }

    $contenido_lista.="<tr>"
            . "<td>{$item['nombre_feria']}</td>"
            . "<td>{$item['tipo_feria']}</td>"
            . "<td>{$item['forma_partic']}</td>"
            . "<td>{$item['dpto']}</td>"
            . "</tr>";
}


$select_t = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo_feria'] as $t) {
    if ($t != ""){
        $select_t.="<option value='$t' >$t</option>";
    }
}
$select_t.="</select>";


echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
<!--            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>-->
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Ferias</a></li>
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
                        <label>Tipo de Feria</label>
                        <?php echo $select_t ?>
                    </div>
                </div>
                    
                    <br>
                    <div id="imprimir">
                    <h2 class="titulo-reportes">Ferias en las que ha participado el Grupo: <?php echo $grupo->name ?></h2>
                    <br>
                    <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-ferias-grupo')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-ferias-grupo" class="responstable">
                        <thead><tr><th>Nombre</th><th>Tipo de Feria</th><th>Formas de Participación</th><th>Departamento</th></tr></thead>
                        <tbody><?php echo $contenido_lista ?></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
          
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
                $("#tabla-ferias-grupo_filter label input").val("");
                var busqueda = "";
                $(".select-filtro").each(function() {
                    var text = $(this).val() + " ";
                    if (text != " ") {
                        busqueda += text;
                    }
                });
                $("#tabla-ferias-grupo_filter label input")
                        .val(busqueda)
                        .change();
            }
            ;

            $(document).ready(function() {
                var table = $('#tabla-ferias-grupo').dataTable({
                    "bPaginate": false
                });
//                $("#listados").hide();
            });
        </script>
    </div>    
    <?php
    ?>