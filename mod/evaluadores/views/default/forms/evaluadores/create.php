<?php

$button = elgg_view('input/submit', array(
    'value' => elgg_echo('create'),
        ));

echo <<<HTML
<div class="elgg-foot">
$button
</div>
HTML;
?>

