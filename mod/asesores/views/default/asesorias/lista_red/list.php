<table class="tabla-coordinador">
    <tr>
        <th>Fecha</th>
        <th>Hora de Inicio</th>
        <th>Hora de fin</th>
        <th>Asesorias</th>
        <th>Asesor</th>
    </tr>
    <?php
    $entities = $vars['entities'];
    foreach ($entities as $entity) {
        $opciones = "No disponible";
        $asesor = get_entity($entity->container_guid);
        $name_asesor = $asesor->name . " " . $asesor->apellidos;
        if ($entity->container_guid == elgg_get_logged_in_user_guid()) {

            $url_asesorias = elgg_get_site_url() . "asesores/cronograma/$entity->guid";
            $opciones = "<a href='{$url_asesorias}'>Ver asesorias</a>";
        }
        $tr = "<tr><td>{$entity->fecha}</td><td>{$entity->hora_inicio}:00</td><td>{$entity->hora_fin}:00</td>"
                . "<td>{$opciones}</td><td>{$name_asesor}</td></tr>";
        echo $tr;
    }
    ?>
</table>

