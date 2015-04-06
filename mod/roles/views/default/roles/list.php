<?php

$roles = $vars['roles'];
elgg_load_js('roles/confirmacion');

echo <<<HTML
<div style="display:none;" id="dialog-confirm" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar el rol?</p>
</div>

   <br>
   <table class="elgg-table-alt">
    <thead>
        <tr>
            <th>Nombre</th><th>Descripcion</th><th>Opciones</th>
        </tr>
   </thead>
   <tbody>
HTML;

foreach($roles as $rol){
    
    echo '<tr>'
    . '<td>'.$rol['nombre'].'</td>'
    . '<td>'.$rol['descripcion'].'</td>'
    . '<td>'
    . ''
    . '<a onclick="confirmar(\''.$rol['href'].'\')" href="#">Eliminar</a></td>'
    . '</tr>';
}
echo <<<HTML
</tbody>
</table>
HTML;


