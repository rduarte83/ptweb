var cor="";

//$(".items").unbind("click");

$(document).ready(function () {
    $(".grid-item").click(function () {
        parteCorpo($(this));
    })

    $(".cores").click(function () {
        escolheCor($(this));
    })
});

function parteCorpo(e) {
    var bg = e.css("background-Image");
    if (bg == "none" || bg == "") {
        e.css({
            "background-color": cor
        });
    }
}

function escolheCor(e) {
    //limpar as restantes seleccções
    $(".cores").css({
        "border": "3px solid transparent"
    });
    cor = e.css("background-color");
    e.css({
        "border": "3px solid black"
    });
}
