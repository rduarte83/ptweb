var utilizadorNotificaceos=0;

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
            "cmd":"getNotification"
        },
        success: function(response) {
            console.log(response);
            $("#notificacoes").html(response);
            //location.reload();
        }
    })
}

function numberNotificacoes(id){
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getNotificationNumber"
        },
        success: function(response) {
            console.log(response);
            $("#numberNotificacoes").html(response);
        }
    })
}

function getAtualUser(){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"getMyUser",
        },
        success:function(resposta){
            console.log("AQUI->"+resposta);
            utilizadorNotificaceos=resposta;
        },
        async: false
    });
}

function notificacoesLidas(){
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"readNotification"
        },
        success: function(response) {
            console.log(response);
            $("#numberNotificacoes").html(response);
        }
    })
}

$(document).ready(function()
{

    getAtualUser();

    numberNotificacoes(utilizadorNotificaceos);
    notificacoes(utilizadorNotificaceos);


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


    $("#navbarDropdownAlertas").click(function(){
        notificacoesLidas();
    });
    
    
});

