<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('SWITCH_ENABLED','1');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */

if(!file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'engine'.DIRECTORY_SEPARATOR.'settings.php')) {
	echo "Please check if cometchat is installed in the correct directory.<br /> The 'cometchat' folder should be placed at <ELGG_HOME_DIRECTORY>/cometchat";
	exit;
}
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'engine'.DIRECTORY_SEPARATOR.'settings.php');

// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW

define('DB_SERVER',				$CONFIG->dbhost					);
define('DB_PORT',				"3306"							);
define('DB_USERNAME',				$CONFIG->dbuser					);
define('DB_PASSWORD',				$CONFIG->dbpass					);
define('DB_NAME',				$CONFIG->dbname					);
define('TABLE_PREFIX',				$CONFIG->dbprefix				);
define('DB_USERTABLE',				"users_entity"					);
define('DB_USERTABLE_USERID',                   "guid"							);
define('DB_USERTABLE_NAME',			"username"						);
define('DB_AVATARTABLE', "left join ".TABLE_PREFIX."entity_relationships on ".TABLE_PREFIX."entity_relationships.guid_one =".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID."" );
define('DB_AVATARFIELD', "(SELECT DISTINCT CONCAT( ".TABLE_PREFIX."entity_relationships.guid_one,  '^', ".TABLE_PREFIX."entity_relationships.time_created ) FROM ".TABLE_PREFIX."entity_relationships WHERE (".TABLE_PREFIX."entity_relationships.guid_one = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." or ".TABLE_PREFIX."entity_relationships.guid_two = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID.") and  ".TABLE_PREFIX."entity_relationships.relationship='member_of_site')");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

 function getUserID() {
	$userid = 0;
	if (!empty($_SESSION['basedata']) && $_SESSION['basedata'] != 'null') {
		$_REQUEST['basedata'] = $_SESSION['basedata'];
	}
	if (!empty($_REQUEST['basedata'])) {
		if (function_exists('mcrypt_encrypt')) {
			$key = KEY_A.KEY_B.KEY_C;
			$uid = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($_REQUEST['basedata']), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
			if (intval($uid) > 0) {
				$userid = $uid;
			}
		} else {
			$userid = $_REQUEST['basedata'];
		}
	}
	if (!empty($_COOKIE['Elgg'])) {
		$sql = ("SELECT `data` FROM `".TABLE_PREFIX."users_sessions` WHERE `session` = '".mysqli_real_escape_string($GLOBALS['dbh'],$_COOKIE['Elgg'])."'");
		$result = mysqli_query($GLOBALS['dbh'],$sql);
		if($row = mysqli_fetch_array($result)){
			$data = explode('attributes";',$row[0]);
			if(!empty($data[1])){
				$session = unserialize($data[1]);
				$userid = $session['guid'];
			}
		}
	}
	$userid = intval($userid);
	return $userid;
}

function chatLogin($userName,$userPass) {
	$userid = 0;
	if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
		$sql = ("SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE email ='".$userName."'"); 
	} else {
		$sql = ("SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE username ='".$userName."'"); 		
	}
	
	$result = mysqli_query($GLOBALS['dbh'],$sql);
	$row = mysqli_fetch_array($result);
	if($row['password'] == md5($userPass.$row['salt'])){
		$userid = $row['guid'];
                if (isset($_REQUEST['callbackfn']) && $_REQUEST['callbackfn'] == 'mobileapp') {
                    $sql = ("insert into cometchat_status (userid,isdevice) values ('".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."','1') on duplicate key update isdevice = '1'");
                    mysqli_query($GLOBALS['dbh'], $sql);
                }
	}		
	if($userid && function_exists('mcrypt_encrypt')){
		$key = KEY_A.KEY_B.KEY_C;
		$userid = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $userid, MCRYPT_MODE_CBC, md5(md5($key))));
	}

	return $userid;
}

function getFriendsList($userid,$time) {
	global $hideOffline;
	$offlinecondition = '';
	$sql = "select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice from (SELECT guid_one, guid_two  FROM ".TABLE_PREFIX."entity_relationships WHERE relationship = 'friend' UNION SELECT guid_two, guid_one FROM ".TABLE_PREFIX."entity_relationships WHERE relationship = 'friend') friends join ".TABLE_PREFIX.DB_USERTABLE." on  friends.guid_two = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where friends.guid_one = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."' order by username asc";
	
	if ((defined('MEMCACHE') && MEMCACHE <> 0) || DISPLAY_ALL_USERS == 1) {
		if ($hideOffline) {	
			$offlinecondition =  "where (('".mysqli_real_escape_string($GLOBALS['dbh'],$time)."'-  cometchat_status.lastactivity < '".((ONLINE_TIMEOUT)*2)."') OR cometchat_status.isdevice = 1) and (cometchat_status.status IS NULL OR cometchat_status.status <> 'invisible' OR cometchat_status.status <> 'offline')";
		}
		$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username,  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." ".$offlinecondition."  order by username asc");	
	}
	
	return $sql;
}

function getFriendsIds($userid) {
	$sql = ("select group_concat(friends.fid) myfrndids from (SELECT guid_one fid FROM ".TABLE_PREFIX."entity_relationships WHERE relationship = 'friend' and guid_two='".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."' UNION SELECT guid_two fid FROM ".TABLE_PREFIX."entity_relationships WHERE relationship = 'friend' and guid_one='".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."') friends");	 
	
	return $sql;
}

function getUserDetails($userid) {
	$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");

	return $sql;
}

function updateLastActivity($userid) {
	$sql = ("insert into cometchat_status (userid,lastactivity) values ('".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."','".getTimeStamp()."') on duplicate key update lastactivity = '".getTimeStamp()."'");

	return $sql;
}

function getUserStatus($userid) {
	 $sql = ("select cometchat_status.message, cometchat_status.status from cometchat_status where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");

	 return $sql;
}

function fetchLink($link) {
	$url = BASE_URL."../pg/profile/".$link;
    return $url;
}

function getAvatar($image) {
	if(!empty($image)){
		$arr=explode('^',$image);
		return BASE_URL.'../mod/profile/icondirect.php?joindate='.$arr[1].'&guid='.$arr[0];
	} else {
		return BASE_URL.'../_graphics/icons/user/defaultsmall.gif';
	}
}

function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

if (!function_exists('getLink')) {
  	function getLink($userid) { return fetchLink($userid); }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_updateLastActivity($userid) {

}

function hooks_statusupdate($userid,$statusmessage) {
	
}

function hooks_forcefriends() {
	
}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$to,$unsanitizedmessage) {
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'license.php');
$x="\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 