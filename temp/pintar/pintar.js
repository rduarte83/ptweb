var cor="";
var zona="";

//$(".items").unbind("click");

$(document).ready(function () {
    $(".cores").click(function () {
        escolheCor($(this));
    })

    $(".grid-item").click(function () {
        zonaCorpo($(this));
        getUrl($(this));
    })

});

function zonaCorpo(e) {
    zona = e.css("background-Image");
    if (zona == "none" || zona == "") {
        e.css({
            "background-color": cor
        });
    }
}

function escolheCor(e) {
    //limpar a selecção anterior
    $(".cores").css({
        "border": "3px solid transparent"
    });
    cor = e.css("background-color");
    e.css({
        "border": "3px solid black"
    });
}

function getUrl (e) {
    //cleanup do url p obter apenas o nome do ficheiro
    var url = e.css("background-Image");
    var cleanup = /\"|\'|\)/g;
    zona = url.split('/').pop().replace(cleanup, '');
    alert(zona);
}
