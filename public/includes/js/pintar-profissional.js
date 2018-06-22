//TODO renomear as zonas do corpo

//Custom hot to cold temperature color gradient
//http://web-tech.ga-usa.com/2012/05/creating-a-custom-hot-to-cold-temperature-color-gradient-for-use-with-rrdtool/index.html

var zona, cor, valor, numZonas, zonaCorArray;
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
    "#0032ff",
    "#0500ff"
].reverse();

$(document).ready(function () {
    reset();

    highlightSettings();

    createSlider();
    createGradient();
    highlight();

    imageMapResize();

    buscarDadosArray();
    
});


function createGradient() {
    var gradient = "linear-gradient(to right";
    for (var i=0; i<corArray.length ; i++) gradient += ", " + corArray[i];
    gradient += ")";
    $(".ui-slider").css("background", gradient);
}

function createSlider () {
    $("#slider").slider({
        min : 0,
        max : 10,
        width : 500,
        slide: function( event, ui ) {
            for (var i=0; i<corArray.length ; i++) {
                if (ui.value == i) {
                    cor = corArray[i].slice(1);
                    valor = ui.value;
                    highlightSettings();
                }
            }
        }
    }).each(function (){
            // Add labels to slider whose values are specified by min, max and whose step is set to 1
            // Get the options for this slider
            var opt = $(this).data().uiSlider.options;
            // Get the number of possible values
            var vals = opt.max - opt.min;
            // Space out values
            for (var i = 0; i <= vals; i++) {
                var el = $('<label>'+ i +'</label>').css('left',(i/vals*100)+'%');
                $( "#slider" ).append(el);
            }
        });
}

function highlightSettings() {
    $('.map').maphilight({
        fillColor: cor,
        strokeColor: cor,
        strokeWidth: 1,
        fillOpacity: 0.8
    });
}

function highlight() {
    $("area").click(function(e) {

        //Keep color in zone
        e.preventDefault();
    });
}

function preencheCorpo(arrPreencher){
    $.each(arrPreencher, function(index, value){
        console.log(value);
        let zonaAtual = value.zona;
        let corAtual = value.cor;
        let corPor = corArray[corAtual].slice(1);
        console.log(zonaAtual + " - " + corPor);

        console.log($("area[alt='"+zonaAtual+"']").attr("title")); 
        $("area[alt='"+zonaAtual+"']").data("maphilight", {"stroke":false, "fillColor": corPor, "fillOpacity":1,"alwaysOn":true}).trigger('alwaysOn.maphilight');
        //$("area[alt='"+zonaAtual+"']").mouseover();
        
    });
}

function buscarDadosArray(){

    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data:{
            "cmd":"getEpisodioDor",
            "utente":id_utente_ver,
            "epDorID":epDorID,
        },
        success: function (response) { 
            console.log(response);
            var resposta = $.parseJSON(response);
            preencheCorpo(resposta); 
        },
        async: false
    });
    
}

function reset() {
    //Valores default
    zonaCorArray = [];
    numZonas = 0;
    valor = 0;
    cor = corArray[0].slice(1);
    $("#slider").slider({
      value: valor
    });

    $('area').each(function()  {
        $(this).data('maphilight', {})
    });

    highlightSettings();
}