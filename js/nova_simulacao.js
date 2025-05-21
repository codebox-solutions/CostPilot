$(document).ready(function () {
    $(".acordiao_btn").click(function () {
        $(this).toggleClass("active");
        var conteudo = $(this).next().find(".conteudo");

        if (conteudo.css("display") === "block") {
            conteudo.slideUp();
            $(this).text('+ Opções Avançadas');
        } else {
            conteudo.slideDown();
            $(this).text('- Opções Avançadas');
        }
    });

    $("#juros_compostos").change(function () {
        if ($(this).is(":checked")) {
            $(".juros_campos").slideDown();
        } else {
            $(".juros_campos").slideUp();
        }
    });

    $("#fluxo_caixa").change(function () {
        if ($(this).is(":checked")) {
            $(".fluxo_campos").slideDown();
        } else {
            $(".fluxo_campos").slideUp();
        }
    });
});
