<?php


$lista = $vars['lista'];
$conv_id = $vars['id_conv'];
$conv=  get_entity($conv_id);
$sitio=  elgg_get_site_url();
?>
<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Convocatoria: <?php echo $conv->name;?></h2>
    </div>
    <div class="menu-coordinacion">
        <?php echo elgg_view("convocatorias/menu", array('guid'=>$conv_id));?>
    </div>
    <div class="contenido-coordinacion">
        <h2>
            Listado de Visitas:
        </h2>

<?php
$txt.="<ul class=''>";
if(!empty($lista)){
foreach ($lista as $v) {
    $txt.="<li id='elgg-object-observaciones-" . $v['id'] . "' class=''>" .
    "<div class='elgg-image-block clearfix item-lista-visitas'>"
        ."<div class='elgg-body'>";
            $txt.="<div class=' elgg-image'><img src='{$v['institucion-icon']}'/></div>";
            $txt.="<div class='elgg-body' ><h3><a href='{$v['institucionURL']}'>" . $v['institucion'] . "</a></h3>";
                $txt.="<div class='elgg-subtext'>";
                $txt.="".$v['municipio'].",".$v['departamento'];
                $txt.="</div></div>";
                
                $txt.="<div class='elgg-subtext'>";
                $txt.="<div class='contenedor-button'><a class='mostrar right link-button' id='mostrar_".$v['id']."' onclick='ver_detalles(".$v['id'].")'>Ver Información</a>";
                $txt.="<a class='ocultar right link-button' id='ocultar_".$v['id']."' onclick='ocultar_detalles(".$v['id'].")'>Ocultar</a></div>";
                $txt.="</div>";
                $txt.="<div class='detalles-visitas' id='observaciones_".$v['id']."'>";
                
                $txt.='<table class="vertical-table">';
                $txt.='<tr>';
                $txt.="<td><h4>Fecha de la visista</h4></td><td>".$v['fecha_visita']."</td>";
                $txt.="<td ><h4>Tipo de visita: </h4></td><td>".$v['tipo_comunicacion']."</td>";
                $txt.='</tr>';
                $txt.='<tr>';
                $txt.="<td ><h4>Asunto: </h4></td><td >".$v['asunto']."</td>";
                $txt.='</tr>';
                $txt.='<tr>';
                $txt.='<td colspan="4"><h4>Observaciones:</h4> '.$v['observaciones'].'</td>';
                $txt.='</tr>';
                $txt.='</table>';
                $txt.="<a class='link-button' href='{$sitio}visitas/editar/{$conv_id}/{$v['id']}'>Editar</a>";
                $delete = "{$sitio}action/visitas/delete_conv?id_conv={$conv_id}&id_v={$v['id']}";
                $url_delete = elgg_add_action_tokens_to_url($delete);
                $txt.="<a class='link-button' href='{$url_delete}'>Eliminar</a>";
                
                $txt.="</div>";
        $txt.="</div>"
    ."</div>";
}
$txt.="</ul>";
}else{
    $txt = "No hay Visitas Registradas.";
}
echo $txt;

