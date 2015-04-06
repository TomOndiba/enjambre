<?php
$maestros = $vars['integrantes'];
foreach ($maestros as $maestro) {
    ?>
    <table class="tabla-bitacoras">
        <colgroup>
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
            <col width="5%"><col width="5%">
        </colgroup>
        <tr>
            <td colspan="10"><b> Nombre del maestro / Coinvestigador</b></td>
            <td colspan="2"><b> Edad</b></td>
            <td colspan="2"><b> Sexo</b></td>
            <td colspan="6"><b> Experiencia en el area de Conocimiento</b></td>
        </tr>
        <tr>
            <td colspan="10"><?php echo $maestro->name . " " . $maestro->apellidos ?></td>
            <td colspan="2"><?php echo elgg_get_edad_ByfechaNac($maestro->fecha_nacimiento) ?></td>
            <td colspan="2"> <?php echo $maestro->sexo ?></b></td>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="4"><b>Identificación</b></td>
            <td colspan="6"><?php echo $maestro->numero_documento ?></td>
            <td colspan="3"><b>Email</b></td>
            <td colspan="7"><?php echo $maestro->email ?></td>
        </tr>
        <tr>
            <td colspan="4"><b>Celular</b></td>
            <td colspan="6"><?php echo $maestro->telefono ?></td>
            <td colspan="4"><b>Telefono</b></td>
            <td colspan="6"><?php echo $maestro->telefono ?></td>
        </tr>
    </table>
    <?php
}