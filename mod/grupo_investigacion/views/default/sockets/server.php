<?php

$mc = new Memcached();
$mc->addServer(elgg_get_url_server(), 11211);
$total = ($mc->getAllKeys());
$count = 0;
foreach ($total as $key) {
    $obj = $mc->get($key);
    echo $key;
    $count++;
    echo "<br>";
}


