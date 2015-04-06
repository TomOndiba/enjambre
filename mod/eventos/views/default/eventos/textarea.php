<?php

$name=$vars['name'];
$required=$vars['required'];
$value=$vars['value'];

if ($required == 'true') {
    $textarea = "<textarea rows='10' cols='50' name='$name' class='elgg-input-longtext' required>$value</textarea>";
}else if($required == 'false'){
    $textarea="<textarea rows='10' cols='50' name='$name' class='elgg-input-longtext'>$value</textarea>";
}

echo $textarea;
