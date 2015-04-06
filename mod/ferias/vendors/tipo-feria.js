$(document).ready(function() {
    $("#tipo").change(function()  {
        var tipo = $('input:radio[name=tipo]:checked').val();
        if(tipo==='Municipal'){
            elgg.get('ajax/view/ferias/municipios', {
                timeout: 30000,
                data: {
                    ajax: 0,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#ajax-tipo-feria').html(result);
                    cargarMunicipios(getMunicipios("Amazonas"));
                }
            });
        }else if(tipo==='Departamental'){
            elgg.get('ajax/view/ferias/departamentos', {
                timeout: 30000,
                data: {
                    ajax: 0,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#ajax-tipo-feria').html(result);
                }
            });
        }else if(tipo==='Institucional'){
            elgg.get('ajax/view/ferias/tipo_institucional', {
                timeout: 30000,
                data: {
                    ajax: 0,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#ajax-tipo-feria').html(result);
                }
            });
        }
        
    });

});