var cor="";
var zona="";

//$(".items").unbind("click");

$(document).ready(function () {
    $(".cores").click(function () {
        escolherCor($(this));
    })

    $(".grid-item").click(function () {
        pintarZonaCorpo($(this));
        limparUrl($(this));
    })

});

function pintarZonaCorpo(e) {
    zona = e.css("background-Image");
    if (zona == "none" || zona == "") {
        e.css({
            "background-color": cor
        });
    }
}

function escolherCor(e) {
    //limpar a selecção anterior
    $(".cores").css({
        "border": "3px solid transparent"
    });
    cor = e.css("background-color");
    e.css({
        "border": "3px solid black"
    });
}

function limparUrl (e) {
    //cleanup do url p obter apenas o nome do ficheiro sem extensão
    var url = e.css("background-Image");
    var cleanup = /\"|\'|\)/g;
    var filename = url.split('/').pop().replace(cleanup, '');
    zona = filename.substring(0,filename.length-4);
}