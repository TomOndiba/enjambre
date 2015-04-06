<?php

$pass = get_input('pass');
$pam = new ElggPAM('user');
$credentials = array('username' => elgg_get_logged_in_user_entity()->username, 'password' => $pass);
$result = $pam->authenticate($credentials);
echo json_encode(array('val' => $result));
