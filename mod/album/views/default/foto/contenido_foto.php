<?php

$foto = $vars['foto'];
$site_url = elgg_get_site_url();
$url = $site_url . "photos/thumbnail/{$foto}/large/";
?>
<img src='<?php echo $url;?>'/>