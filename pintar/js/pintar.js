//TODO renomear as zonas do corpo
//TODO reduzir o numero de zonas???
//TODO suportar varias zonas??? (criar array)
//TODO resize https://github.com/davidjbradshaw/image-map-resizer

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

$(document).ready(function () {
    //Valores default
    valor = 1;
    cor = corArray[0].slice(1);
    $("#pickedColor").css("background-color", corArray[0]);
    $("#valor").val(valor);

    highlightSettings()

    createSlider();
    createGradient();
    highlight();

    $('map').imageMapResize();
});

function createGradient() {
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
                    cor = rgbToHex(cor).slice(1);
                    valor = $("#valor").val();
                    highlightSettings();
                }
            }
        }
    });
}

function rgbToHex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function highlightSettings() {
    $('.map').maphilight({
        fillColor: cor,
        strokeColor: cor,
        strokeWidth: 1,
        fillOpacity: 0.8
    })
}

function highlight() {
    $('.corpo').click(function(e) {
        zona = this.alt;
        console.log("cor:",cor,"zona:", zona, "valor:", valor);
        highlightSettings();
        e.preventDefault();
        var data = $(this).mouseout().data('maphilight') || {};
        data.alwaysOn = !data.alwaysOn;
        $(this).data('maphilight', data).trigger('alwaysOn.maphilight');
    })
}