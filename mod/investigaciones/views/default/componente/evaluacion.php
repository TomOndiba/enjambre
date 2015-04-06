<?php
$categoria = get_input('categoria');
$etapa = get_input('etapa');
$guid_inv = get_input('investigacion');

$asesorias = elgg_get_asesorias_realizadas($guid_inv);
?>

<div class="titulo-componente bg-color-5">
    <div class="gancho" style="float:left;margin-left: 20%;">

    </div>
    <div class="gancho" style=" float:right;margin-right: 20%;">

    </div>
    <h2>Evaluación</h2>
</div>
<div class="overflow-2">
    <br><br>
    <h2 class='title-legend'>Asesorias Realizadas</h2>
    <ul class="lista-asesorias-evaluacion">
        <?php
        $site_url = elgg_get_site_url();
        foreach ($asesorias as $asesoria) {
            $editable = "calificable";
            $annotations = $asesoria->getAnnotations('calificacion');
            $notaFinal = 0;
            foreach ($annotations as $nota) {
                $notaFinal+=(int) $nota->value;
                if ($nota->owner_guid == elgg_get_logged_in_user_guid()) {
                    $editable = "no-editable";
                }
            }
            $note = ($notaFinal / sizeof($annotations));
            if (sizeof($annotations) == 0) {
                $note = "0";
            }
            $asesor_guid = $asesoria->owner_guid;
            $asesor = get_entity($asesor_guid);
            $sala = elgg_get_relationship($asesoria, "tiene_sala");
            $guid_webinar = $sala[0]->guid;
            $bbb = new BigBlueButton();
            $recordingParams = array(
                'meetingId' => $guid_webinar,
            );
            $url_grab=$bbb->getGrabacion($recordingParams);
            $info.= "<li><div class='titulo-asesoria'>" . $asesoria->title . "</div>"
                    . "<div class='info-asesor row'><label>Asesor:  </label><a href='{$site_url}profile/{$asesor->username}'>$asesor->name $asesor->apellidos</a><br>"
                    . "<label>Fecha de Asesoria:  </label>{$asesoria->fecha}";
                    if($url_grab){
                    $info.= "<br><a  href='{$url_grab}'>Ver Asesoria</a>";
                    
                    }
                    
                    $info.="</div>";
            $info.="<div class='$editable row' style='float:right;' data-average='$note' title='{$asesoria->guid}' name=''></div></li>";
        }
        echo $info;
        ?>
    </ul>
</div>

