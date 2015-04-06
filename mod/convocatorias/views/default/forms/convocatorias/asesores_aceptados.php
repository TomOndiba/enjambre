<?php
$convocatoria = $vars['guid_conv'];
$investigacion = $vars['investigacion'];
$value = '';
$asesores = elgg_get_asesores_asignados_convocatoria($convocatoria);
$asesor_investigacion = elgg_get_relationship_inversa(get_entity($investigacion), 'es_asesor_de')[0];
$ases = get_entity($asesor_investigacion->guid);
$site_url = elgg_get_site_url();
$info = "";
if ($ases) {
    $info = "<a href='{$site_url}profile/{$ases->username}'><img src='{$ases->getIconURL()}' width='32'></img><span>{$asesor_investigacion->name} {$asesor_investigacion->apellidos}</span></a>";
} else {
    $info = "No tiene asesor Asignado";
}
$select_lineas = "<select onchange='actualizarAsesores(this)'>"
        . "<option value='Todos' selected>Todas las Lineas</option>";
$lineas_total = elgg_get_lineas_tematicas();
foreach ($lineas_total as $linea_u) {
    $select_lineas.="<option value='$linea_u->name'>$linea_u->name</option>";
}
$select_lineas.="</select>";
$info_evaluador = "<div><div class='subtitulo-form'>Asesor Asignado</div><div class='info-evaluador-form'>$info</div></div>";
$contenido = $info_evaluador;
$contenido.="<br><div class='subtitulo-form'>Cambiar de Asesor</div><br>"
        . "<span>Seleccione la línea temática y a continuación el asesor que va a asignar a esta investigación.</span>";
$contenido.="$select_lineas<div class='lista-evaluadores-inscritos'><div id='msj-vacio' style='width=100%;text-align:center; padding-top:10px;font-weight:700'>No esisten asesores asociados a esta línea temática.</div>"
        . ""
        . "";
foreach ($asesores as $asesor) {
    if ($asesor->guid != $ases->guid) {
        $as = get_entity($asesor->guid);
        $lineas = elgg_get_lineas_asesor($asesor->guid);
        $lin = "";
        $lin2="";
        foreach ($lineas as $linea) {
            $lin.="$linea->name//";
            $lin2.= $linea->name.",";
        }
        $contenido.="<div class='item-evaluacion' lineas-value='$lin'><input type='radio' name='asesor' value='{$asesor->guid}' /><a href='{$site_url}profile/{$as->username}'><div class='row'><img src='{$as->getIconURL()}' width='50' /></div><div class='row' style='margin-left:10px;font-weight:700;'><span>{$asesor->name} {$asesor->apellidos}</span><br><span style='color:black;font-weight:400;'>$lin2</span></div></a></div>";
    }
}
$contenido.="</div>";
$convocatoria_input = elgg_view('input/hidden', array('name' => 'guid_conv', 'value' => $convocatoria));
$investigacion_input = elgg_view('input/hidden', array('name' => 'investigacion', "id" => 'investigacion', 'value' => $investigacion));
$button = elgg_view('input/submit', array('id' => 'aceptar', 'value' => elgg_echo('Aceptar')));

echo <<<HTML
<div>
$convocatoria_input  $investigacion_input
</div>
<div>
$contenido
   </div>        
<div class="elgg-foot" align="center">
    $button
</div>
HTML;
?>
<script>
    $(document).ready(function(){
       $("#msj-vacio").hide(); 
    });
    function actualizarAsesores(element) {
        var value = $(element).val();
        var contador=0;
        if (value == "Todos") {
            $(".item-evaluacion").each(function(index, item) {
                $(item).show();
                contador++;
            });
        } else {
            $(".item-evaluacion").each(function(index, item) {
                var visible=false;
                var lineas = $(item).attr('lineas-value');
                var arreglo = lineas.split("//")
                $.each(arreglo, function(index, valor) {
                   if(value==valor){
                      $(item).show();
                      visible=true;
                      contador++;
                   }
                });
                if(!visible){
                   $(item).hide(); 
                }
            });
        }
        if(contador==0){
            $("#msj-vacio").show();
        }else{
            $("#msj-vacio").hide();
        }
    }
</script>

