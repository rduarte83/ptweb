var menu;

function changePage(pagina){
    $.ajax({
        url:pagina,
        type:"GET",
        success:function(resposta){
            $("#receive").html(resposta);
        }
    });
}

function loadChat(){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"getMessages",
        },
        success:function(resposta){
            loadChat();
        }
    });
}

function sendMessage(mensagem,id_to){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"sendTo",
            "mensagem":mensagem,
            "id_to":id_to,
        },
        success:function(resposta){
            loadChat();
        }
    });
}



$(document).ready(function(){
    menu = $("#receive").html();
    
    $("#backMenu").click(function(){
        $("#receive").html(menu);
    });

    $("#navbarProfissional").click(function(){
        $("#containerMensagem").toggle();
    });

    $("#formChat").submit(function(e){
        e.preventDefault();
        var mensagem = $("#mensagem").val();
        var para = $("#id_to").val();
        $("#mensagem").val("");
        sendMessage(mensagem, para);
    });

    $(document).on('click', "#registarDor", function(){
        changePage("modules/pintar.html");
    });

    $(document).on('click', "#calendario", function(){
        changePage("modules/calendar.html");
    });

    $(document).on('click', "#treinos", function(){
        $("#containerMensagem").toggle();
    });

    $(document).on('click',"#consultas", function(){
        $("#containerMensagem").toggle();
    });

    $("#infoProfissional").click(function(){
        $("#containerMensagem").toggle();
    });
    

    $(document).on('click',"#submitFormCorpo", function(e){
        e.preventDefault();
        submitDor();
    });

    
});
