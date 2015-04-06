<?php
$json = get_input("guids");
$id= get_input("id");
$array_guids = json_decode($json, true);
$retorno = "";
foreach ($array_guids as $entity) {
    $user = get_entity($entity['guid']);
    $icon = $user->getIconURL();
    $owner_link = "<a class='name' href=\"{$user->getURL()}\">$user->name $user->apellidos</a>";
    $retorno.="<div class='item-usuario-like'><div class='row'><img src='{$icon}' /></div><div class='row'>$owner_link</div></div>";
}
echo "<div class='titulo-item-usuario-like'>Personas a las que les gusta esto</div><div class='contenido-likes like-$id'>" . $retorno . "</div>";
?>
<script>
        var element = $('.like-<?php echo $id?>');
        var totalUsers = <?php echo count($array_guids); ?>;
        if (totalUsers <= 6) {
            element.css('overflow-y', 'hidden');
        }else{
            element.css('overflow-y', 'auto');
        }
</script>