//Custom hot to cold temperature color gradient
//http://web-tech.ga-usa.com/2012/05/creating-a-custom-hot-to-cold-temperature-color-gradient-for-use-with-rrdtool/index.html

var zona, cor, valor;
var corArray = [
    "#FF0000",
    "#FF6e00",
    "#FFa000",
    "#FFd200",
    "#fdff00",
    "#3eff00",
    "#00ff83",
    "#00d4ff",
    "#0084ff",
    "#0032ff"
].reverse();

//$(".items").unbind("click");

$(document).ready(function () {
    //Valores default
    var defaultValor = 1;
    $("#pickedColor").css("background-color", corArray[0]);
    $("#valor").val(defaultValor);

    $(".grid-item").click(function () {
        pintarZonaCorpo($(this));
        cleanURL($(this));
    });
    createSlider();
    setCores();

    var seekbar = new Seekbar.Seekbar({
        renderTo: "#seekbar-container",
        valueListener: function (value) {
            this.setValue(Math.round(value));
        }
    });



});

function setCores() {
    var gradient = "linear-gradient(to right";
    for (var i=0; i<corArray.length ; i++) gradient += ", " + corArray[i];
    gradient += ")";
    $(".ui-slider").css("background", gradient);
}

function createSlider () {
    $("#slider").slider({
        min : 1,
        max : 10,
        width : 500,
        slide: function( event, ui ) {
            $("#valor").val(ui.value);
            for (var i=0; i<corArray.length ; i++) {
                if (ui.value == i+1) {
                    $("#pickedColor").css("backgroundColor",corArray[i]);
                    cor = $("#pickedColor").css("backgroundColor");
                    valor = $("#valor").val();
                }
            }
        }
    });
}


function pintarZonaCorpo(e) {
    zona = e.css("background-Image");
    if (zona == "none" || zona == "") {
        e.css({
            "background-color": $("#pickedColor").css("backgroundColor")
        });
    }
}

function cleanURL (e) {
    //cleanup do url p obter apenas o nome do ficheiro sem extensão
    var url = e.css("background-Image");
    var cleanup = /\"|\'|\)/g;
    var filename = url.split('/').pop().replace(cleanup, '');
    zona = filename.substring(0,filename.length-4);
}