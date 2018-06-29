var menu, user=0, userTo=0;
var tableTreino;
var previousMain = [];
var level = 0;

function goBack(){
    level--;
    if(level == 0)
        location.reload();

    
    $("#receive").html(previousMain[level]);
    tableTreino.destroy();

    tableTreino = $("#tabela-treinos").DataTable();
}

function addToMain(conteudo){

    previousMain[level] = $("#receive").html();
    level++;
    $("#receive").html("");
    $("#receive").html('    <div class="row-fluid">\n' +
        '        <button type="button" class="btn btn-info" id="btn-back" onclick="goBack();">Back</button>\n<br><br>' +
        '    </div>' + conteudo);
}

function changePage(pagina){
    $.ajax({
        url:pagina,
        type:"POST",
        success:function(resposta){
            addToMain(resposta);  
        },
        async:false
    });
}

function verTreino(pagina, id){
    $.ajax({
        url:pagina,
        type:"POST",
        data:{
            "idTreino":id,
        },
        success:function(resposta){
            addToMain(resposta);  
        },
        async:false
    });
}

function loadChat(){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"getMessages",
            "id_to":$("#id_to").val(),
        },
        success:function(resposta){
            var trabalhar = $.parseJSON(resposta);
            var chatFinal ="";

            trabalhar.forEach(function(elem){
                if ( elem.origem == user  ){
                    chatFinal += "<li class='direita'>"+elem.conteudo+"</li><span class='clearfix'></span>";
                }else if( elem.origem == userTo ){
                    console.log(userTo)
                    chatFinal += "<li class='esquerda'>"+elem.conteudo+"</li>";
                }
                
            })
            $(".chat").html(chatFinal);
        },
        async:false
    });
}

function getMyUser(){
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"getMyUser",
        },
        success:function(resposta){
            console.log("AQUI->"+resposta);
            user=resposta;
            userTo=$("#id_to").val();
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
        },
        async:false
    });
}
/*
previousMain[level] = $("#receive").html();
level++;
addToMain(response);    
*/
$(document).ready(function(){
    getMyUser();
    
    menu = $("#receive").html();
    previousMain[0] = $("#receive").html();
    
    $("#backMenu").click(function(){
        $("#receive").html(menu);
        previousMain = [];
        level = 0;
        location.reload();
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
        changePage("modules/home/paciente/treinos.php");
    });

    $(document).on('click',"#consultas", function(){
        changePage("modules/home/paciente/consultas.php");
    });

    $(document).on('click',"#dadosPessoais", function(){
        changePage("modules/home/paciente/dadosPessoais.php");
        //$("#utenteInfo").modal('toggle');
    });

    $(document).on('click',"#treinos", function(){
        changePage("modules/home/paciente/tabelaTreinos.php");
        $("#tabela-treinos").DataTable();
    });
    

    $("#infoProfissional").click(function(){
        $("#containerMensagem").toggle();
    });
        

    $(document).on('click',"#submitFormCorpo", function(e){
        e.preventDefault();
        submitDor();
    });

     // Ver zona EP DOR
     $(document).on("click", "#tabela-treinos .btn-treino", function(){
        verTreino("modules/home/paciente/treinos.php",$(this).attr("id-treino"));
        //$("#tabela-treinos").DataTable();
    });

    
});
