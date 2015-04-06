<?php

$guid_evento = get_input('guid_evento');
$evento = get_entity($guid_evento);

if ($evento->getSubtype() == "evento") {

    $fecha_actual = new DateTime("now");
    $fecha_asesoria = new DateTime($evento->fecha_inicio);
    $horas = explode(":", $evento->hora);
    $fecha_asesoria->setTime($horas[0], $horas[1]);
    if ($fecha_asesoria > $fecha_actual) {
        $fecha_div = '<div id="DateCountdown" data-date="' . $fecha_asesoria->format("Y-m-d H:i") . '" style="width: 100%;"></div>';
    }



    echo <<<HTML
    <div class="evento-asesor">
    <h2 class="title-legend">{$evento->nombre_evento}</h2>
    <label>Lugar:</label><br>{$evento->lugar}<br><br>
    <label>Fecha:</label><br>{$evento->fecha_inicio}<br><br>
    <label>Hora:</label><br>{$evento->hora}<br><br>
    <label>Tiempo Restante:</label><br>
     $fecha_div
     </div> 
    
HTML;
} else {
    $investigacion = $evento->container_guid;
    $asesor = elgg_get_relationship_inversa(get_entity($investigacion), 'es_asesor_de')[0];
    elgg_load_library('elgg:webinar');
    $sala = elgg_get_relationship($evento, "tiene_sala")[0];
    if ($sala->guid) {
        $guid = $sala->guid;
        $webinar = new ElggWebinar($guid);
        $user = elgg_get_logged_in_user_entity();

        $bbb = new BigBlueButton();
        $itsAllGood = true;
        try {
            $result = $bbb->isMeetingRunningWithXmlResponseArray($guid);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            $itsAllGood = false;
        }
        if ($itsAllGood == true) {
//Output results to see what we're getting:
//print_r($result);		
            $status = $result['running'];
//echo "<p style='color:red;'>".$status."</p>";

            if ($webinar->estado == 'creada') {
                $holdMessage = '<div id="status">
    <p>Su asesoría no ha comenzado.</p><br>
    <p>Usted será redireccionado automáticamente a la sala de asesoría cuando su asesor de inicio a la misma.</p>
</div>';
            } else if ($webinar->estado == 'finalizada') {
                $holdMessage = '<div id="status">
    <p>Su asesoría ya ha finalizado.</p><br>
</div>';
            }


// The meeting is not running yet so hold your horses:
            if ($status == 'false') {
                $holdMessage;
            } else {
//Here we redirect the user to the joinUrl.
// For now we output this:

                $joinParams = array(
                    'meetingId' => $guid, // REQUIRED - We have to know which meeting to join.
                    'username' => $user->username, // REQUIRED - The user display name that will show in the BBB meeting.
                    'password' => 'ap', // REQUIRED - Must match either attendee or moderator pass for meeting.
                    'createTime' => '', // OPTIONAL - string
                    'userId' => '', // OPTIONAL - string
                    'webVoiceConf' => ''   // OPTIONAL - string
                );

// Get the URL to join meeting:
                $allGood = true;
                try {
                    $result = $bbb->getJoinMeetingURL($joinParams);
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                    $allGood = false;
                }

                if ($allGood == true) {
//Output resulting URL. Send user there...
                    $resultado = $result;
                }
            }
        }
    }
    if (!$resultado) {
        if (!$holdMessage) {
            $holdMessage = '<div id="status">
    <p>Su asesoría no esta disponible en este momento.</p><br>
</div>';
        }
        $resultado = "<div class='msj-no-asesoria'>" . $holdMessage . "</div>";
    } else {
        $resultado = "<a href='$resultado' id='click_entrar'>Entrar</a>";
    }
    $url_asesor = elgg_get_site_url() . "profile/{$asesor->username}";
    echo <<<HTML

    <h2 class="title-legend">Asesoria: {$evento->title}</h2>
    <div class="evento-asesor">
        <div class='row info-evento-asesoria'>
            <label>Tipo:</label><br>{$evento->tipo}<br><br>
            <label>Modalidad:</label><br>{$evento->modo}<br><br>
            <label>Fecha:</label><br>{$evento->fecha}<br><br>
            <label>Hora:</label><br>{$evento->hora}<br><br>
        </div>
        <div class='row info-asesor-evento-asesoria'>
            <a href='{$url_asesor}'><img src='{$asesor->getIconUrl()}' /></a>
            <a href='{$url_asesor}'><h4>$asesor->name $asesor->apellidos</h4></a>
            <span>Asesor</span>
        </div>
    </div>
    $resultado           
HTML;
}
?>
<script>
$(document).ready(function(){
    $("#click_entrar").click();
})</script>

