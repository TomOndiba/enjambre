<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <script type="text/javascript" charset="utf-8">
        if (window.top == window) {
            // you're not in a frame so you reload the site
            window.setTimeout('location.reload()', 20000); //reloads after 10 seconds
        } else {
            //you're inside a frame, so you stop reloading
        }
    </script>
</head>

<body>

    <div class="inicio-webinar" id="main">

        <?php
        elgg_load_library('elgg:webinar');

        $guid = $vars['guid'];
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
            }else if($webinar->estado=='finalizada'){
                $holdMessage = '<div id="status">
				<p>Su asesoría ya ha finalizado.</p><br>
                                </div>';
            }


            // The meeting is not running yet so hold your horses:
            if ($status == 'false') {
                echo $holdMessage;
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
                    forward($result);
                }
            }
        }
        // Instatiate the BBB class:
//    $bbb = new BigBlueButton();
//
//    $itsAllGood = true;
//    try {
//        $result = $bbb->isMeetingRunningWithXmlResponseArray($guid);
//    } catch (Exception $e) {
//        echo 'Caught exception: ', $e->getMessage(), "\n";
//        $itsAllGood = false;
//    }
//
//    if ($itsAllGood == true) {
//
//        $bbb = new BigBlueButton();
//
//        $joinParams = array(
//            'meetingId' => $webinar->getGUID(), // REQUIRED - We have to know which meeting to join.
//            'username' => 'Test Attendee', // REQUIRED - The user display name that will show in the BBB meeting.
//            'password' => 'ap', // REQUIRED - Must match either attendee or moderator pass for meeting.
//            'createTime' => '', // OPTIONAL - string
//            'userId' => '', // OPTIONAL - string
//            'webVoiceConf' => ''   // OPTIONAL - string
//        );
//
//        // Get the URL to join meeting:
//        $url_join = $bbb->getJoinMeetingURL($joinParams);
//
////        $url = elgg_get_site_url() . "action/webinar/join?webinar_guid=$guid";
////
////        $url_join = elgg_add_action_tokens_to_url($url);
//        echo "<p> Para entrar a la Sala haga clic sobre el botón</p>";
//        echo "<div class='boton-entrar-webinar'><a href='$url_join'> Entrar </a></div>";
//    } else {
//        echo "Debe esperar a que se dé inicio a la asesoría";
//    }
        ?>
    </div>
</body>