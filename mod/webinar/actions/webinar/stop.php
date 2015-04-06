<?php

$webinar_guid = get_input('webinar_guid');
$webinar = new ElggWebinar($webinar_guid);

// Instatiate the BBB class:
$bbb = new BigBlueButton();

/* ___________ END A MEETING ______ */
/* Determine the meeting to end via meetingId and end it.
 */

$endParams = array(
    'meetingId' => $webinar_guid, // REQUIRED - We have to know which meeting to end.
    'password' => 'mp', // REQUIRED - Must match moderator pass for meeting.
);

// Get the URL to end a meeting:
$itsAllGood = true;
try {
    $result = $bbb->endMeetingWithXmlResponseArray($endParams);
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
    $itsAllGood = false;
}

if ($itsAllGood == true) {
    // If it's all good, then we've interfaced with our BBB php api OK:
    if ($result == null) {
        // If we get a null response, then we're not getting any XML back from BBB.
      
        echo "Ha ocurrido un error";
    } else {
        // We got an XML response, so let's see what it says:
        print_r($result);
        if ($result['returncode'] == 'SUCCESS') {
            // Then do stuff ...
          
            $webinar->estado = 'finalizada';
            $webinar->save();
            forward(REFERER);
        } else {
           
            echo "<p>Falló la finalización de la asesoría.</p>";
        }
    }
}
?>
