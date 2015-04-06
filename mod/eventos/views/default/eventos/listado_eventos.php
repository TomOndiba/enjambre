<?php
$lista_eventos = $vars['lista_eventos'];
$id_conv = $vars['id_conv'];
$tipo_entity = $vars['tipo_entity'];
$nombre_convocatoria=$vars['nombre_convocatoria'];
$url_re = elgg_get_site_url();
$url_register = $url_re."eventos/registro_evento/$id_conv";

$tabla = "<table class='tabla-coordinador' width='100%'>
        <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Fecha de inicio</th>
            <th>Fecha de terminación</th>
            <th>Fecha límite de confirmación</th>
            <th>Lugar</th>
            <th>Opciones</th></tr>";


foreach ($lista_eventos as $evento){

$guid = $evento['id'];
$nombre = $evento['nombre'];
$tipo_evento = $evento['tipo_evento'];
$fecha_limite_confirm = $evento['fecha_limite_confirm'];
$fecha_inicio = $evento['fecha_inicio'];
$fecha_terminacion = $evento['fecha_terminacion'];
$lugar = $evento['lugar'];
$href_detalles = $evento['href_detalles'];
$href_eliminar = $evento['href_eliminar'];
$href_editar = $evento['href_editar'];

$tabla.="<tr>
                    
                    <td>$nombre</td>
                    <td>$tipo_evento</td>
                    <td>$fecha_inicio</td>
                    <td>$fecha_terminacion</td>
                    <td>$fecha_limite_confirm</td>
                    <td>$lugar</td>
                    <td><a href='$href_detalles'>Detalles</>
                    <a onclick=confirmar('".$href_eliminar."'); href='#'>Eliminar</a>
                    <a href='$href_editar'>Editar</></td>
                 </tr>";
}

$tabla.="</table><br>";

elgg_load_js('confirmacion');

if($tipo_entity=="convocatoria"){
$instructions = elgg_echo('evento:listado')."<br><br>";
if(empty($lista_eventos)){
$instructions = elgg_echo('evento:listado:vacio');
$tabla = "";
}
}else if($tipo_entity=="feria"){
$instructions = elgg_echo('evento:listado:feria')."<br><br>";
if(empty($lista_eventos)){
$instructions = elgg_echo('evento:listado:vacio:feria');
$tabla = "";
}
}

//Verificar que subtype es
$entity= get_entity($id_conv);

?>
<div class = "content-coordinacion">
<div class = "titulo-coordinacion">
 <?php 
 if($entity->getSubtype()=="convocatoria"){
     echo "<h2>Convocatoria: $entity->name</h2>";
 }
 else if($entity->getSubtype()=="feria"){
     echo "<h2>Feria: $entity->name</h2>";
 }
 else{}
?>
</div>
<div class="menu-coordinacion">
<?php 
if($entity->getSubtype()=="convocatoria"){
echo elgg_view("convocatorias/menu", array('guid' => $id_conv)); 
}
 else if($entity->getSubtype()=="feria"){
echo elgg_view("ferias/menu", array('guid' => $id_conv)); 
}
else{}
?>
</div>
<div class="contenido-coordinacion">
    <h2>
        Eventos:
    </h2>
    <?php echo <<<HTML
      
<div style='display:none;' id="dialog-confirm" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar el evento?</p>
</div>
       
<div>$instructions<br></div>
<div>
    $tabla
</div>
HTML;
    ?>