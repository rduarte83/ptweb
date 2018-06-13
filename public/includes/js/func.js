
function getUsersPacientes(){
    
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getUsers"
        },
        success:function(response){
            console.log(response);
            var resposta = $.parseJSON(response);
            console.log(resposta);
            var listPaciente = '<li class="list-group-item"> ID | Nome</li>';
            $.each(resposta, function (key, val) {
                if (resposta[key].role === 4) {
                    listPaciente+='<li id="list_' + resposta[key].id +'" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#addUserModal"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' + resposta[key].id + '</span>' + resposta[key].nome +'</li>';
                }
            });
            
            $("div #list_pacientes").html(listPaciente);
        }
    });
}




$(document).ready(function () {

    $("#show_list_pac").on("click", function (){
        $("#main_div").html('<div id="lista_pacientes" class="col-md"> <h1>Pacientes</h1> <div id="list_pacientes"' +
            ' class="lista"> <li class="list-group-item"> ID | Nome</li> </div> </div>');
        getUsersPacientes();
    });

    $("#add_pac").on("click", function (){
        alert("lol");
    });
    $("#add_article").on("click", function (){
        alert("lol");
    });
    $("#edit_article").on("click", function (){
        alert("lol");
    });
    $("#add_video").on("click", function (){
        alert("lol");
    });
    $("#edit_video").on("click", function (){
        alert("lol");
    });


});

