<?php
/**
 * Vista que muestra el resultado del reporte del listado de usuarios que pertenecen a la red temática
 * @author DIEGOX_CORTEX
 */

$guid_red = get_input('red');

$red=  get_entity($guid_red);
$d = elgg_get_usuarios_red($guid_red);
$datos = $d['lista'];
$filtros = array('tipo' => array(), 'sexo' => array());

foreach ($datos as $item) {
    if (!in_array($item['tipo'], $filtros['tipo'])) {
        $filtros['tipo'][] = $item['tipo'];
        error_log("FILTRO EN POS TIPO -> ".$item['tipo']);
    }
    if (!in_array($item['sexo'], $filtros['sexo'])) {
        $filtros['sexo'][] = $item['sexo'];
        error_log("SEXO EN POS SEXO -> ".$item['sexo']);
    }

    $contenido_lista.="<tr>"
            . "<td>{$item['name']}</td>"
            . "<td>{$item['email']}</td>"
            . "<td>{$item['sexo']}</td>"
            . "<td>{$item['tipo']}</td>"
            . "<td>{$item['grupos']}</td>"
            . "</tr>";
}


$select_t = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['tipo'] as $t) {
    if ($t != ""){
        $select_t.="<option value='$t' >$t</option>";
    }
}
$select_t.="</select>";

$select_g = '<select onchange="consultarTabla()" class="select-filtro" title-contenido=""><option></option>';
foreach ($filtros['sexo'] as $t) {
    if ($t != ""){
        $select_g.="<option value='$t' >$t</option>";
    }
}
$select_g.="</select>";


echo elgg_view_form("reportes/form_impresion");
?>
<div>
    <div>
        <ul class="tabs-coordinacion">
<!--            <li class="selected" onclick="verEstaditicas(this)"><a href="#" class="tab-asesores" name="asignados" rel="nofollow">Estadisticas</a></li>-->
            <li onclick="verListado(this)" ><a href="#" class="tab-asesores" name="no-asignados" title="" rel="nofollow">Usuarios</a></li>
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
                        <?php echo $select_t ?>
                        
                        <label>Género</label>
                        <?php echo $select_g ?>
                    </div>
                </div>
                    
                    <br>
                    <div id="imprimir">
                    <h2 class="titulo-reportes">Usuarios dentro de la Red: <?php echo $red->name ?></h2>
                    <br>
                    <form action="http://<?php echo elgg_get_url_server()?>/reporte/imprimir_excel.php" method="post" target="_blank" id="FormularioExportacion">
                        <a onclick="imprimirExcel('tabla-ferias-grupo')">Exportar a Excel</a>
                        <input type="hidden" id="contenido_excel" name="contenido" />
                    </form>
                    <table id="tabla-ferias-grupo" class="responstable">
                        <thead><tr><th>Nombre</th><th>Email</th><th>Género</th><th>Tipo de Usuario</th><th>Grupos</th></tr></thead>
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