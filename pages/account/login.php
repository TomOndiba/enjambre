
<?php
/**
 * Assembles and outputs a login page.
 *
 * This page serves as a fallback for non-JS users who click on the login
 * drop down link.
 *
 * If the user is logged in, this page will forward to the front page.
 *
 * @package Elgg.Core
 * @subpackage Accounts
 */
header( 'Location: http://www.enjambre.co/enjambre/instituciones' ) ;

if (elgg_is_logged_in()) {


	forward('');
}

$title = elgg_echo('login');
$content = elgg_view('core/account/login_box');

if (elgg_get_config('walled_garden')) {
	elgg_load_css('elgg.walled_garden');
	$body = elgg_view_layout('walled_garden', array('content' => $content));
	echo elgg_view_page($title, $body, 'walled_garden');
} else {
	$body = elgg_view_layout('one_column', array('content' => $content));
	echo elgg_view_page($title, $body);
}


