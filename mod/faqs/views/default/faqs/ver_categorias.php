<?php
/**
 * Vista que muestra las categorias existentes de FAQ's
 * @author DIEGOX_CORTEX
 */
$categorias = getCategoriesFaqs();

if (sizeof(getCategoriesFaqs()) > 0) {
    ?>
    <?php
    $body = "<ul class='lista-categorias'>";
    foreach ($categorias as $cat) {
        $body .= "<li><a id='categoria' name='$cat'>{$cat}</a></li>";
    }
    $body .= "</ul>";
} else {
    $body = "No hay categorias registradas.";
}
?>
<style>
    ul.lista-categorias{
        width: 100%;
    }

    ul.lista-categorias>li{
        width: 94%;
        padding-left: 3%;
        padding-right: 3%;
        padding-top: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #d3d6db;
    }
    ul.lista-categorias-2{
        width: 100%;
    }

    ul.lista-categorias-2>li{
        width: 94%;
        padding-left: 3%;
        padding-right: 3%;
        padding-top: 30px;
        padding-bottom: 30px;
        border-bottom: 1px solid #d3d6db;
    }
    ul.lista-categorias>li:hover{
        background-color:  #f6f7f8;;
        font-weight: 700;
    }

    ul.lista-categorias-2>li>label{
        font-weight: 700;
        font-size: 16px;
        line-height: 24px;
    }
    .contenido-investigacion{
        color:black;
    }
    .titulo-faq{
        padding-top: 30px;
        margin-left: 30px;
        margin-bottom: 30px;
    }
</style>
<div class='contenido-investigacion'  style="height: auto; background-color: white;">
    <div class="titulo-faq">
        <h2 class='title-legend'>Preguntas Frecuentes</h2>
    </div>
    <div class="row" style="width: 35%">
        <div class='item-info'>
            <div class='titulo-info'>Categorias</div>
            <?php echo $body; ?>
        </div>
    </div>


    <div id='preguntas' class="row" style="width: 60%">


    </div>

</div>   


<script type="text/javascript">
    $(document).ready(function() {
        $("#categoria").live('click', function() {
            var categoria = $(this).attr('name');
            $('#preguntas').html('<div class="elgg-ajax-loader" style="height:100px;"></div>');
            elgg.get('ajax/view/faqs/ver_preguntas', {
                timeout: 30000,
                data: {
                    categoria: categoria,
                    pageowner: elgg.get_page_owner_guid()
                },
                success: function(result, success, xhr) {
                    $('#preguntas').html(result);
                },
            });
        });
    });
</script> 
