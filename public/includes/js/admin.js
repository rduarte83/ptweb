function carregaData(texto) {
    $.ajax({
        type: "POST",
        url: 'includes/php/funcsWeb.php',
        data: {
            "cmd": "getSingleUser",
            "key": texto
        },
        dataType: "json", // serializes the form's elements.
        success: function (data) {
            $("form input[name='nome']").val(data[0].nome);
            $("form input[name='morada']").val(data[0].morada);
            $("form input[name='nacionalidade']").val(data[0].nacionalidade);
            $("form input[name='nif']").val(data[0].nif);
            $("form input[name='cc']").val(data[0].cc);
            $("form select[name='genero']").val(data[0].genero);
            $("form input[name='data_nascimento']").val(data[0].data_nascimento);
            $("form input[name='contacto']").val(data[0].contacto);
            $("form input[name='email']").val(data[0].mail);
            $("form select[name='role']").val(data[0].role);
            $("form input[name='idKey']").val(texto);
        },
        error: function (response) {
            console.log("error " + response.getAllResponseHeaders);
        }
    });
}

function getUsers(){
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getUsers"
        },
        success:function(response){
            console.log(response);
            var resposta = $.parseJSON(response);
            var items = [];
            $.each(resposta, function (key, val) {
                if (resposta[key].role == "3") {
                    $("#list_pacientes").append(
                        '<li class="list-group-item"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' +
                        resposta[key].id + '</span>' + resposta[key].nome +
                        '</li>');
                } else if (resposta[key].role == "2") {
                    $("#list_func").append(
                        '<li class="list-group-item"><span class="badge badge-primary" style="border-right: 1px dashed #333; margin-right: 8px;">' +
                        resposta[key].id + '</span>' + resposta[key].nome +
                        '</li>');
                } else if (data[key].role == "1") {
                    $("#list_admin").append(
                        '<li id="list_' + data[key].id +
                        '" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#addUserModal"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' +
                        data[key].id + '</span>' + data[key].nome +
                        '</li>');
                }
            });
        }
    });
}

function insertUser(dados)
{
        $.ajax({
            type: "POST",
            url: 'includes/php/funcsWeb.php',
            data: dados, // serializes the form's elements.
            success: function (data) { // show response from the php script.
                console.log(data);
                $("#error").html(data);
            },
            error: function(response){
                console.log("error->" + response.getAllResponseHeaders);
            }
        });
}

$(document).ready(function () {

    getUsers();

    $("#add_user").click(function(){
        $("form").removeClass("edit")
        $("#addUserModal").show();
    });

    $("#edit_user").click(function(){
        $("form").addClass("edit");
        $("#addUserModal").show();
    });

    $(document).on("click", ".list-group-item", function () {
        carregaData($(this).find("span").text());
    });

    $("#addUserForm").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        
        if(!$("form").hasClass("edit")){
            arrDados.push({"name":"cmd","value":"insertUser"});
            insertUser(arrDados);
        }else{
            arrDados.push({"name":"cmd","value":"updateUser"});
            updateUser(arrDados);
        }
            
    });
});