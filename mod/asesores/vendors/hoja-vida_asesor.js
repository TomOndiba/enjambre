$(document).ready(function() {
    $(".item-hoja").live('click', function(evento) {
        var item = $(this).attr('name');
        cargarItem(item);
    });
    $("#agregar-estudios").live('click', function(evento) {
        var ultimo = $("#ultimo").val();
        agregarEstudio(ultimo);
    });

    $("#agregar-cursos").live('click', function(evento) {
        var ultimo = $("#ultimo").val();
        agregarCurso(ultimo);
    });

    $("#agregar-experiencia").live('click', function(evento) {
        var ultimo = $("#ultimo-experiencia").val();
        agregarExperiencia(ultimo);
    });

    $("#agregar-investigacion").live('click', function(evento) {
        var ultimo = $("#ultimo-investigacion").val();
        agregarInvestigacion(ultimo);
    });

    $("#agregar-pertenencia").live('click', function(evento) {
        var ultimo = $("#ultimo-pertenencia").val();
        agregarPertenencia(ultimo);
    });

    $("#agregar-ponencia").live('click', function(evento) {
        var ultimo = $("#ultimo-ponencia").val();
        agregarPonencia(ultimo);
    });

    $("#agregar-exp-docente").live('click', function(evento) {
        var ultimo = $("#ultimo-exp-docente").val();
        agregarExperienciaDocente(ultimo);
    });

    $("#agregar-publicacion").live('click', function(evento) {
        var ultimo = $("#ultimo-publicacion").val();
        agregarPublicacion(ultimo);
    });

    $("#guardar").live('click', function(evento) {
        var ultimo = $("#ultimo").val();
        var content = generarJson(ultimo);
        guardarEstudios(content);
    });

    $("#guardar-cursos").live('click', function(evento) {
        var ultimo = $("#ultimo").val();
        var content = generarJsonCursos(ultimo);
        guardarCursos(content);
    });

    $("#guardar-ponencias").live('click', function(evento) {
        var ultimo = $("#ultimo-ponencia").val();
        var content = generarJsonPonencias(ultimo);
        ultimo = $("#ultimo-publicacion").val();
        var publicacion= generarJsonPublicaciones(ultimo);
        guardarPonencias(content,publicacion);
    });

    $("#guardar-experiencia").live('click', function(evento) {
        var ultimo = $("#ultimo-experiencia").val();
        var experiencia = generarJsonExperiencia(ultimo);
        ultimo = $("#ultimo-exp-docente").val();
        var experienciaDocente = generarJsonExperienciaDocente(ultimo);
        guardarExperiencia(experiencia, experienciaDocente);
    });


    $("#guardar-investigacion").live('click', function(evento) {
        var ultimo = $("#ultimo-investigacion").val();
        var investigacion = generarJsonInvestigacion(ultimo);
        ultimo = $("#ultimo-pertenencia").val();
        var pertenencia = generarJsonPertenencia(ultimo);
        guardarInvestigacion(investigacion, pertenencia);
    });


    $(".borrar").live('click', function(evento) {
        var id = $(this).attr("id");
        $("#row" + id).remove();
    });

    $(".borrar-experiencia").live('click', function(evento) {
        var id = $(this).attr("id");
        $("#row-experiencia" + id).remove();
    });

    $(".borrar-investigacion").live('click', function(evento) {
        var id = $(this).attr("id");
        $("#row-investigacion" + id).remove();
    });

    $(".borrar-pertenencia").live('click', function(evento) {
        var id = $(this).attr("id");
        $("#row-pertenencia" + id).remove();
    });

    $(".borrar-publicacion").live('click', function(evento) {
        var id = $(this).attr("id");
        $("#row-publicacion" + id).remove();
    });

    $(".borrar-exp-docente").live('click', function(evento) {
        var id = $(this).attr("id");
        $("#row-exp-docente" + id).remove();
    });


    $(".borrar-ponencia").live('click', function(evento) {
        var id = $(this).attr("id");
        $("#row-ponencia" + id).remove();
    });

    $(".editar").live('click', function(evento) {
        var id = $(this).attr("id");
        permitirEdicion(id);
    });

    $(".editar-cursos").live('click', function(evento) {
        var id = $(this).attr("id");
        permitirEdicionCursos(id);
    });

    $(".editar-experiencia").live('click', function(evento) {
        var id = $(this).attr("id");
        permitirEdicionExperiencia(id);
    });


    $(".editar-experiencia-docente").live('click', function(evento) {
        var id = $(this).attr("id");
        permitirEdicionExperienciaDocente(id);
    });


    $(".editar-investigacion").live('click', function(evento) {
        var id = $(this).attr("id");
        permitirEdicionInvestigacion(id);
    });

    $(".editar-pertenencia").live('click', function(evento) {
        var id = $(this).attr("id");
        permitirEdicionPertenencia(id);
    });
    
    
    $(".editar-publicacion").live('click', function(evento) {
        var id = $(this).attr("id");
        permitirEdicionPublicacion(id);
    });

});


$(document).ready(function() {
    var src = String(window.location.href);
    var dir = src.split("#")[1];
    if (typeof dir === "undefined" || dir == "") {
        cargarItem('estudiosterminados');
    }
    else {
        cargarItem(dir);
    }
});

function permitirEdicion(id) {
    $('#clase' + id).removeAttr("readonly");
    $('#institucion' + id).removeAttr("readonly");
    $('#ciudad' + id).removeAttr("readonly");
    $('#fecha' + id).removeAttr("readonly");
    $('#resolucion' + id).removeAttr("readonly");
}

function permitirEdicionPublicacion(id) {
    $('#titulo' + id).removeAttr("readonly");
    $('#categoria' + id).removeAttr("readonly");
    $('#ciudad' + id).removeAttr("readonly");
    $('#fecha' + id).removeAttr("readonly");
    $('#isbn' + id).removeAttr("readonly");
    $('#issn' + id).removeAttr("readonly");
    $('#indexada' + id).removeAttr("readonly");
}

function permitirEdicionExperiencia(id) {
    $('#universidad' + id).removeAttr("readonly");
    $('#actividad' + id).removeAttr("readonly");
    $('#mt' + id).removeAttr("readonly");
    $('#tc' + id).removeAttr("readonly");
    $('#cat' + id).removeAttr("readonly");
    $('#desde-exp' + id).removeAttr("readonly");
    $('#hasta-exp' + id).removeAttr("readonly");
}


function permitirEdicionExperienciaDocente(id) {
    $('#entidad' + id).removeAttr("readonly");
    $('#cargo' + id).removeAttr("readonly");
    $('#desde' + id).removeAttr("readonly");
    $('#hasta' + id).removeAttr("readonly");
}

function permitirEdicionCursos(id) {
    $('#nombre' + id).removeAttr("readonly");
    $('#institucion' + id).removeAttr("readonly");
    $('#ciudad' + id).removeAttr("readonly");
    $('#fecha' + id).removeAttr("readonly");
    $('#intensidad' + id).removeAttr("readonly");
}

function permitirEdicionInvestigacion(id) {
    $('#titulo' + id).removeAttr("readonly");
    $('#entidad_patrocinadora' + id).removeAttr("readonly");
    $('#fecha_fin' + id).removeAttr("readonly");
}

function permitirEdicionPertenencia(id) {
    $('#nombre' + id).removeAttr("readonly");
    $('#categoria' + id).removeAttr("readonly");
    $('#fecha_fin_pertenencia' + id).removeAttr("readonly");
}

function agregarEstudio(pos) {
    var contenido = "<tr id='row" + pos + "'><td><input type='text' value='' name='clase' id='clase" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='institucion' id='institucion" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='ciudad' id='ciudad" + pos + "'  class='elgg-input-text'></td>\n\
        <td><input type='date' value='' name='fecha' id='fecha" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><input type='text' value='' name='resolucion' id='resolucion" + pos + "' class='elgg-input-text'></td>\n\
        <td><ul class='opciones-tabla'><li><a class='borrar' id='" + pos + "'>Borrar</a></li><li><a class='editar' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-estudios").append(contenido);
    $("#ultimo").val(eval(pos) + 1);
}

function agregarPublicacion(pos) {
    var contenido = "<tr id='row-publicacion" + pos + "'><td><input type='text' value='' name='titulo' id='titulo" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='editorial' id='editorial" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='ciudad' id='ciudad" + pos + "'  class='elgg-input-text'></td>\n\
        <td><input type='date' value='' name='fecha' id='fecha" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><input type='text' value='' name='isbn' id='isbn" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='issn' id='issn" + pos + "' class='elgg-input-text'></td>\n\\n\
    <td><input type='text' value='' name='indexada' id='indexada" + pos + "' class='elgg-input-text'></td>\n\
        <td><ul class='opciones-tabla'><li><a class='borrar-publicacion' id='" + pos + "'>Borrar</a></li><li><a class='editar-publicacion' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-publicaciones").append(contenido);
    $("#ultimo-publicacion").val(eval(pos) + 1);
}
function agregarCurso(pos) {
    var contenido = "<tr id='row" + pos + "'><td><input type='text' value='' name='nombre' id='nombre" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='institucion' id='institucion" + pos + "' class='elgg-input-text'></td>\n\\n\
        <td><input type='date' value='' name='fecha' id='fecha" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><input type='text' value='' name='ciudad' id='ciudad" + pos + "'  class='elgg-input-text'></td>\n\
        <td><input type = 'text' value = '' name = 'intensidad' id = 'intensidad" + pos + "' class = 'elgg-input-text'></td>\n\
        <td><ul class='opciones-tabla'><li><a class = 'borrar' id = '" + pos + "' > Borrar </a></li><li><a class='editar-cursos' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-estudios").append(contenido);
    $("#ultimo").val(eval(pos) + 1);
}


function agregarInvestigacion(pos) {
    var contenido = "<tr id='row-investigacion" + pos + "'><td><input type='text' value='' name='titulo' id='titulo" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='entidad_patrocinadora' id='entidad_patrocinadora" + pos + "' class='elgg-input-text'></td>\n\\n\
        <td><input type='date' value='' name='fecha' id='fecha_fin" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><ul class='opciones-tabla'><li><a class = 'borrar-investigacion' id = '" + pos + "' > Borrar </a></li><li><a class='editar-investigacion' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-investigaciones").append(contenido);
    $("#ultimo-investigacion").val(eval(pos) + 1);
}

function agregarPertenencia(pos) {
    var contenido = "<tr id='row-pertenencia" + pos + "'><td><input type='text' value='' name='nombre' id='nombre" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='categoria' id='categoria" + pos + "' class='elgg-input-text'></td>\n\\n\
        <td><input type='date' value='' name='fecha' id='fecha_fin_pertenencia" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><ul class='opciones-tabla'><li> <a class = 'borrar-investigacion' id = '" + pos + "' > Borrar </a></li><li><a class='editar-investigacion' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-pertenencia").append(contenido);
    $("#ultimo-pertenencia").val(eval(pos) + 1);
}

function agregarPonencia(pos) {
    var contenido = "<tr id='row-ponencia" + pos + "'><td><input type='text' value='' name='nombre' id='nombre" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='evento' id='evento" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='ciudad' id='ciudad" + pos + "' class='elgg-input-text'></td>\n\
        <td><select id='tipo" + pos + "'><option value='Nacional'>Nacional</option>\n\
        <option value='Internacional'>Internacional</option>\n\
        <option value='Colectiva'>Colectiva</option></select>\n\
        <td><input type='date' value='' name='fecha' id='fecha" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><ul class='opciones-tabla'><li><a class = 'borrar-ponencia' id = '" + pos + "' > Borrar </a></li><li><a class='editar-ponencia' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-ponencias").append(contenido);
    $("#ultimo-ponencia").val(eval(pos) + 1);
}
function agregarExperiencia(pos) {
    var contenido = "<tr id='row-experiencia" + pos + "'><td><input type='text' value='' name='universidad' id='universidad" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='actividad' id='actividad" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='radio' name='radio-tipo" + pos + "' value='tc'><br></td>\n\
        <td><input type='radio' name='radio-tipo" + pos + "' value='mt'><br></td>\n\
        <td><input type='radio' name='radio-tipo" + pos + "' value='cat'><br></td>\n\
        <td><input type='radio' name='radio-tipo" + pos + "' value='otro'><br></td>\n\
        <td><input type='date' value='' name='desde' id='desde-exp" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><input type='date' value='' name='hasta' id='hasta-exp" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><ul class='opciones-tabla'><li><a class = 'borrar-experiencia' id = '" + pos + "' > Borrar </a></li><li><a class='editar-experiencia' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-estudios").append(contenido);
    $("#ultimo-experiencia").val(eval(pos) + 1);
}

function agregarExperienciaDocente(pos) {
    var contenido = "<tr id='row-exp-docente" + pos + "'><td><input type='text' value='' name='entidad' id='entidad" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='text' value='' name='cargo' id='cargo" + pos + "' class='elgg-input-text'></td>\n\
        <td><input type='date' value='' name='desde' id='desde" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><input type='date' value='' name='hasta' id='hasta" + pos + "'  class='elgg-input-date popup_calendar'></td>\n\
        <td><ul class='opciones-tabla'><li><a class = 'borrar-exp-docente' id = '" + pos + "' > Borrar </a></li><li><a class='editar-experiencia-docente' id='" + pos + "'>Editar</a></li></ul></td></tr>";
    $("#tabla-exp-docente").append(contenido);
    $("#ultimo-exp-docente").val(eval(pos) + 1);
}
function cargarItem(item) {
    $('#ajax-hoja-vida').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
    elgg.get('ajax/view/asesores/hoja_de_vida/' + item, {
        timeout: 30000,
        data: {
            ajax: 0,
            item: item
        },
        success: function(result, success, xhr) {
            $('#ajax-hoja-vida').html(result);
            $(".selected").removeClass('selected');
            $("#" + item).addClass("selected");
        },
    });
}

function generarJson(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["clase"] = $('#clase' + i).val();
        aux["institucion"] = $('#institucion' + i).val();
        aux["ciudad"] = $('#ciudad' + i).val();
        aux["fecha"] = $('#fecha' + i).val();
        aux["resolucion"] = $('#resolucion' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}

function generarJsonPublicaciones(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["titulo"] = $('#titulo' + i).val();
        aux["editorial"] = $('#editorial' + i).val();
        aux["categoria"] = $('#categoria' + i).val();
        aux["ciudad"] = $('#ciudad' + i).val();
        aux["fecha"] = $('#fecha' + i).val();
        aux["isbn"] = $('#isbn' + i).val();
        aux["issn"] = $('#issn' + i).val();
        aux["indexada"] = $('#indexada' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}

function generarJsonPonencias(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["nombre"] = $('#nombre' + i).val();
        aux["tipo"] = $('#tipo' + i).val();
        aux["ciudad"] = $('#ciudad' + i).val();
        aux["fecha"] = $('#fecha' + i).val();
        aux["evento"] = $('#evento' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}

function generarJsonCursos(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["nombre"] = $('#nombre' + i).val();
        aux["institucion"] = $('#institucion' + i).val();
        aux["ciudad"] = $('#ciudad' + i).val();
        aux["fecha"] = $('#fecha' + i).val();
        aux["intensidad"] = $('#intensidad' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}

function generarJsonInvestigacion(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["titulo"] = $('#titulo' + i).val();
        aux["entidad_patrocinadora"] = $('#entidad_patrocinadora' + i).val();
        aux["fecha_fin"] = $('#fecha_fin' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}

function generarJsonPertenencia(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["nombre"] = $('#nombre' + i).val();
        aux["categoria"] = $('#categoria' + i).val();
        aux["fecha_fin_pertenencia"] = $('#fecha_fin_pertenencia' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}
function generarJsonExperiencia(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["universidad"] = $('#universidad' + i).val();
        aux["actividad"] = $('#actividad' + i).val();
        aux["tipo"] = $("input[name='radio-tipo" + i + "']:checked").val();
        aux["desde"] = $('#desde-exp' + i).val();
        aux["hasta"] = $('#hasta-exp' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}

function generarJsonExperienciaDocente(ultimo) {
    var myArray = new Object();
    for (var i = 0; i < eval(ultimo); i++) {
        var aux = new Object();
        aux["entidad"] = $('#entidad' + i).val();
        aux["cargo"] = $('#cargo' + i).val();
        aux["desde"] = $('#desde' + i).val();
        aux["hasta"] = $('#hasta' + i).val();
        myArray[i] = aux;
    }
    var otroArray = jQuery.makeArray(myArray);
    return JSON.stringify(otroArray);
}



function guardarEstudios(content) {
    elgg.get('ajax/view/asesores/hoja_de_vida/guardar_estudios', {
        timeout: 30000,
        data: {
            datos: content
        },
        success: function(result, success, xhr) {
            location.reload(true);
        },
    });
}

function guardarCursos(content) {
    elgg.get('ajax/view/asesores/hoja_de_vida/guardar_cursos', {
        timeout: 30000,
        data: {
            datos: content
        },
        success: function(result, success, xhr) {
            location.reload(true);
        },
    });
}

function guardarPonencias(content, publicaciones) {
    elgg.get('ajax/view/asesores/hoja_de_vida/guardar_ponencias', {
        timeout: 30000,
        data: {
            datos: content,
            publicaciones:publicaciones,
        },
        success: function(result, success, xhr) {
            location.reload(true);
        },
    });
}

function guardarExperiencia(experiencia, experienciaDocente) {
    elgg.get('ajax/view/asesores/hoja_de_vida/guardar_experiencia', {
        timeout: 30000,
        data: {
            experiencia: experiencia,
            experiencia_docente: experienciaDocente,
        },
        success: function(result, success, xhr) {
            location.reload(true);
        },
    });
}


function guardarInvestigacion(investigacion, pertenencia) {
    elgg.get('ajax/view/asesores/hoja_de_vida/guardar_investigacion', {
        timeout: 30000,
        data: {
            investigacion: investigacion,
            pertenencia: pertenencia,
        },
        success: function(result, success, xhr) {
            location.reload(true);
        },
    });
}
