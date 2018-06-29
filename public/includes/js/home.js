function logout()
{
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"logout"
        },
        success: function(response) {
            console.log(response);
            $("#error").html(response);
            location.reload();
        }
    })
}

function alerta(mensagem, error=false, tempo = 2000){
    if(!error){
        $("#sucessoMensagem").html(mensagem);
        $("#success-alert").fadeTo(tempo, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    }else{
        $("#errorMensagem").html(mensagem);
        $("#danger-alert").fadeTo(tempo, 500).slideUp(500, function(){
            $("#danger-alert").slideUp(500);
        });
    }
}

function notificacoes(id){
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getNotificacoes"
        },
        success: function(response) {
            console.log(response);
            $("#error").html(response);
            location.reload();
        }
    })
}

function numberNotificacoes(id){
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getNotificacoes"
        },
        success: function(response) {
            console.log(response);
            $("#error").html(response);
            location.reload();
        }
    })
}

$(document).ready(function()
{
    $("#openDropDownUtentes").click(function(){
        $("div[class='dropdown-container Utentes']").slideToggle( "fast" );
    });

    $("#openDropDownArtigos").click(function(){
        $("div[class='dropdown-container Artigos']").slideToggle( "fast" );
    });

    $("#openDropDownAdmin").click(function(){
        $("div[class='dropdown-container Admin']").slideToggle( "fast" );
    });


    $("#pinicial").click(function(){
        window.location.href = "index.php";
    });

    $("#logout").click(function(){
        logout();
    });
});

