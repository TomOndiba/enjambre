<?php
$input = elgg_view('input/text', array('id' => 'input-usuario', 'autocomplete' => "off"));
$asunto = elgg_view('input/text', array('name' => 'asunto', 'autocomplete' => "off", 'placeholder'=>'Asunto del mensaje'));
$button = elgg_view('input/submit', array('value' => elgg_echo('Enviar')));
$usuario = elgg_get_logged_in_user_entity();
$amigos = $usuario->getFriends("",0,0);
$cantidad = sizeof($amigos);
?>
<div>

    <div class='mensaje-para'>
        <div><span>Para: </span></div><div id="usuario-agregados"></div><?php echo $input; ?>
    </div>
    <div class="inputs-hidden"></div>
    <div id="output-usuarios">

    </div>
    <div class="asunto-mensaje">
        <span>Asunto:</span>
        <?php echo $asunto; ?>
    </div>
    <div class="contenido-mensaje">
        <span>Mensaje: </span>
        <textarea name='mensaje' placeholder="Escriba aqui su mensaje"></textarea>
    </div>
 

    <?php echo $button; ?>
</div>

<script>
    var agregados = new Array();
    var amigos = new Array(<?php echo $cantidad; ?>);
    var guids = new Array(<?php echo $cantidad; ?>);
    var imagenes = new Array(<?php echo $cantidad; ?>);
<?php
for ($i = 0; $i < $cantidad; $i++) {
    ?>
        amigos[<?php echo $i; ?>] = "<?php echo $amigos[$i]->name . " " . $amigos[$i]->apellidos; ?>";
        guids[<?php echo $i; ?>] = "<?php echo $amigos[$i]->guid; ?>";
        imagenes[<?php echo $i; ?>] = "<?php echo $amigos[$i]->getIconURL(); ?>";
    <?php
}
?>
    $(document).keyup(function(event) {
        if (event.which == 27)
        {
            $("#output-usuarios").hide();
        }
    });

    $(document).ready(function() {
        $("#input-usuario").focus();
        $("#input-usuario").live('keyup', function() {
            var nombre = $("#input-usuario").val();
            var pos = obtenerAmigosPorNombre(nombre);
            var cadena = llenarDivUsuarios(pos);
            var elemento = document.getElementById('input-usuario');
            var pos = getAbsoluteElementPosition(elemento);
            cambiarPosicion(pos);
            $("#output-usuarios").html(cadena);
            $("#output-usuarios").show();
            if (event.which == 27)
            {
                $("#output-usuarios").hide();
            }
        });

        $(".item-usuario-lista").live('click', function() {
            var posicion = $(this).attr('id');
            agregados.push(posicion);
            var usuario = cargarUsuario(posicion);
            var ocultos = crearInputHidden(posicion);
            $(".inputs-hidden").append(ocultos);
            $("#usuario-agregados").append(usuario);
            $("#output-usuarios").html("");
            $("#input-usuario").val("");
            $("#input-usuario").focus();
            $("#output-usuarios").hide();
        });
    });

    function cambiarPosicion(pos) {
        var top=pos.top+35;
        $("#output-usuarios").css({
            "top": top+"px",
            "left": pos.left+"px"
        });
    }

    function obtenerAmigosPorNombre(nombre) {
        var posiciones = [];
        for (var i = 0; i < amigos.length; i++) {
            var amigo = amigos[i].toUpperCase();
            if (amigo.indexOf(nombre.toUpperCase()) != -1) {
                posiciones.push(i);
            }
        }
        return posiciones;
    }

    function llenarDivUsuarios(posiciones) {
        var cadena = "<ul class='lista-usuarios-a-enviar'>";
        for (var i = 0; i < posiciones.length; i++) {
            if (!estaAgregado(posiciones[i])) {
                cadena += "<li class='item-usuario-lista' id='" + posiciones[i] + "'><div><img src='" + imagenes[posiciones[i]] + "' /></div><div class='nombre-usuario-mensajes'>" + amigos[posiciones[i]] + "</div></li>";
            }
        }
        cadena += "</ul>";
        return cadena;
    }

    function cargarUsuario(pos) {
        var resultado = "<span class='user-mensaje'>" + amigos[pos] + "</span>";
        return resultado;
    }

    function estaAgregado(posicion) {
        for (var i = 0; i < agregados.length; i++) {
            if (agregados[i] == posicion) {
                return true;
            }
        }
        return false;
    }

    function crearInputHidden(pos) {
        var resultado = "<input type='hidden' value='" + guids[pos] + "' name='usuarios[]'/>";
        return resultado;
    }

    function getAbsoluteElementPosition(element) {
        if (typeof element == "string")
            element = document.getElementById(element)

        if (!element)
            return {top: 0, left: 0};

        var y = 0;
        var x = 0;
        while (element.offsetParent) {
            x += element.offsetLeft;
            y += element.offsetTop;
            element = element.offsetParent;
        }
        return {top: y, left: x};
    }
</script>