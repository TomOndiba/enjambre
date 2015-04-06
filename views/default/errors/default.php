<?php
/**
 * General error
 */

$message = elgg_echo('error:default');

echo "<h2>$message</h2>";
header( 'Location: http://www.enjambre.co/' ) ;
