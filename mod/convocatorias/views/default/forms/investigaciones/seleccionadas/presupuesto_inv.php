<?php
elgg_load_js('suma');
elgg_load_js('presupuesto');
$guid_convocatoria = $vars['guid_convocatoria'];
$convocatoria = new ElggConvocatoria($guid_convocatoria);

$investigaciones = elgg_get_investigaciones_seleccionadas_linea_convocatoria($convocatoria);
$todos=  elgg_view('input/number', array('id'=>"valor_todos", 'min'=>'0'));

$table="<div align='center'>"
        . "<table class='' style='width:100%'><tr><th>Todas</th><th>$todos</th><th align='center'><a class='link-button' style='float:none !important' id='presupuesto_todos'>Aplicar</a></th></tr></table>"
        . "<br><br><table class='tabla-coordinador'>"
        . "<tr><th>Investigación</th><th>Presupuesto</th>"
        . "</tr>";
$suma_pre=0;
$ids="";
foreach($investigaciones as $inv){
    $number=  elgg_view('input/number', array('name'=>"presupuesto{$inv->guid}", 'value'=>"$inv->presupuesto", 
                        'class'=>"presupuesto", 'min'=>'0', 'id'=>"presupuesto{$inv->guid}"));
    $table.="<tr><td> $inv->name</td><td>$number</td></tr>";
    $ids.=$inv->guid."-";
    $suma_pre=((int)$inv->presupuesto)+$suma_pre;
}
$table.="</table></div>";
$valor_total=$convocatoria->presupuesto;
$total=  elgg_view('input/text', array('id'=>'total', 'value'=>"$valor_total", 'readonly'=>'true'));
$suma=  elgg_view('input/text', array('id'=>'suma', 'value'=>"$suma_pre", 'readonly'=>'true'));
$ids_input=  elgg_view('input/hidden', array('name'=>'ids', 'value'=>"$ids"));
$convocatoria_input=  elgg_view('input/hidden', array('name'=>'guid_convocatoria', 'value'=>"$guid_convocatoria"));
$rest=$valor_total-$suma_pre;
$restante=  elgg_view('input/text', array('id'=>'restante', 'value'=>"$rest", 'readonly'=>'true'));

$button = elgg_view('input/submit', array('id'=>'guardar', 'value' => elgg_echo('Guardar')));

echo <<<HTML
<div id='sumatoria' class='default'>
    <table width='100%' class='tabla-coordinador'><tr>
    <th>Presupuesto Convocatoria</th>
    <th>Presupuesto Asignado</th>
    <th>Presupuesto Disponible</th>
    <tr><td>{$total}</td><td>{$suma}</td><td>{$restante}</td></tr>
    </table>
    $ids_input  $convocatoria_input
</div>
<div style='display:none;' id="dialog-confirm" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea aplicar este presupuesto para todas las investigaciones?</p>
</div>
<br><br>
$table
<div id="dialog" title="Presupuesto">
  <p>
<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span></p>
</div>
<div class="elgg-foot" align="center">
$button
</div>
HTML;
?>
