<?php

elgg_load_library('elgg:webinar');
$guid = get_input('guid');
$webinar = new ElggWebinar($guid);
$user = elgg_get_logged_in_user_entity();

// Instatiate the BBB class:
$bbb = new BigBlueButton();

/* ___________ JOIN MEETING w/ OPTIONS ______ */
/* Determine the meeting to join via meetingId and join it.
 */

$joinParams = array(
    'meetingId' => $guid, // REQUIRED - We have to know which meeting to join.
    'username' => $user->username . " (Asesor)", // REQUIRED - The user display name that will show in the BBB meeting.
    'password' => 'mp', // REQUIRED - Must match either attendee or moderator pass for meeting.
    'createTime' => '', // OPTIONAL - string
    'userId' => '', // OPTIONAL - string
    'webVoiceConf' => ''    // OPTIONAL - string
);

// Get the URL to join meeting:
$urlMettingModeratorRecord = $bbb->getJoinMeetingURL($joinParams);

$itsAllGood = true;
try {
    $result = $bbb->isMeetingRunningWithXmlResponseArray($guid);
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
    $itsAllGood = false;
}

if ($itsAllGood == true) {

    $status = $result['running'];
    if ($status == 'false') {
        if($webinar->estado=='creada'){
            echo "<div class='boton-video-conferencia join'><a href='$urlMettingModeratorRecord'> Iniciar </a></div>";
        }else if($webinar->estado=='finalizada'){
            echo "<br><center><b><p>Ya se ha finalizado la asesoría</p></b></center><br>";
        }
    } else {
        $webinar->estado = 'iniciada';
        $webinar->save();
        $url2 = elgg_get_site_url() . "action/webinar/stop?webinar_guid={$webinar->getGUID()}";
        $url_stop = elgg_add_action_tokens_to_url($url2);
        echo "<div class='boton-video-conferencia detener'><a href='$url_stop'>Finalizar</a></div>";
    }
//    $url = elgg_get_site_url() . "action/webinar/join?webinar_guid=$guid";
//    $url_join = elgg_add_action_tokens_to_url($url);
//}else if ($webinar->isUpcoming()) {
//    $url = elgg_get_site_url() . "action/webinar/start?webinar_guid={$webinar->getGUID()}";
//    $url_start = elgg_add_action_tokens_to_url($url);
//    echo "<a href='$url_start'> Comenzar </a>";
} 
//else {
//    $url = elgg_get_site_url() . "action/webinar/start2?webinar_guid={$webinar->getGUID()}";
//    $url_start = elgg_add_action_tokens_to_url($url);
//    echo "<div class='boton-video-conferencia join'><a href='$url_start'> Comenzar </a></div>";
//}