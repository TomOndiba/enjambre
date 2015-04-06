<?php
/**
 * Vista de el widget de encuestas para el grupo de investigacion
 * 
 * Lista las encuestas activas en el grupo
 */
$grupo = $vars['grupo'];


//$link = "<a href=\"{$grupo->getURL()}\"><b>{$grupo->name}</b></a>";
$link = "<a href=\"algo\"><b>{Encuestirijillas}</b></a>";
$encuestas = elgg_view('groups/grouppolls',array('entity' => $grupo));

echo <<<HTML
<div class='grupo-investigacion-miembros box'>
        <div class='tittle-box'>Encuesta</div>
            {$encuestas}
</div>            
HTML;
        