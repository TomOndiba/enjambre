<?php
elgg_load_js('acciones');

$grupos=$vars['grupos'];
$contenido="" ;

foreach($grupos as $grupo){
    
    $contenido.="<tr><td>".$grupo['nombre']."</td>"
            . "<td><a onclick='editar(\"".$grupo['id']."\")'>Editar</a></td> "
            . '<td><a onclick="confirmar(\''.$grupo['href'].'\')">Eliminar</a></td>'
            . "<td><center><div class=\"elgg-avatar elgg-avatar-tiny\"><a onclick='verSolicitudes(\"".$grupo['id']."\")' class>"
            ."<img src=\"http://localhost/elgg/_graphics/spacer.gif\" alt=\"\" title=\"\" class= \"\" style=\"background: url(http://localhost/elgg/_graphics/icons/user/defaulttiny.gif) no-repeat;\">"
            . "</a></div></center></td></tr>";
}




if(sizeof($grupos)==0)
    $contenido="</br><td><h3> No hay Grupos de Investigación Registrados  <h3></td>";

echo <<<HTML
<div style="display:none;" id="dialog-confirm" title="Confirmación"> Está seguro de eliminar el Grupo de Investigación?</div>
<div> <h2>Listado de Grupos de Investigación<hr> </h2><br </div>

<table class='elgg-table' align='center' width='100%'>
<tr>
<th><center> NOMBRE</center>  </th>   <th colspan="2" > <center> ACCIONES </center></th><th><center>SOLICITUDES </center></th>
<tr>
$contenido
</table>
 <br> <hr> <br>
 <a href="registrar" class="elgg-button elgg-button-submit">Registrar Grupo</a> 
        
HTML;
