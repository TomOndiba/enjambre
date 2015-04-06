<?php
echo elgg_view_form('bitacoras/edit/bitacora_tres', null, $vars);
?>

<script>
    $(document).ready(function () {
        $("textarea").html().replace(/&lt;/g, '<')
                .replace(/&gt;/g, '>');
    })
</script>
