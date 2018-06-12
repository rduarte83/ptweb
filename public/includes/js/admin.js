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
            $("#editUserForm input[name='nome']").val(data[0].nome);
            $("#editUserForm input[name='morada']").val(data[0].morada);
            $("#editUserForm input[name='nacionalidade']").val(data[0].nacionalidade);
            $("#editUserForm input[name='nif']").val(parseInt(data[0].nif));
            $("#editUserForm input[name='cc']").val(data[0].cc);
            $("#editUserForm select[name='genero']").val(data[0].genero);
            $("#editUserForm input[name='data_nascimento']").val(data[0].data_nascimento);
            $("#editUserForm input[name='contacto']").val(data[0].contacto);
            $("#editUserForm input[name='email']").val(data[0].mail);
            $("#editUserForm select[name='role']").val(data[0].role);
            $("#editUserForm input[name='idKey']").val(parseInt(texto));
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
            //console.log(response);
            var resposta = $.parseJSON(response);
            //console.log(resposta);
            var listPaciente = '<li class="list-group-item"> ID | Nome</li>';
            var listFunc = '<li class="list-group-item"> ID | Nome</li>';
            var listAdmin = '<li class="list-group-item"> ID | Nome</li>';
            $.each(resposta, function (key, val) {
                if (resposta[key].role == "2" || resposta[key].role == "3") {
                    listFunc += '<li id="list_' + resposta[key].id +'" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#editUserModal"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' +resposta[key].id + '</span>' + resposta[key].nome + '</li>';
                } else if (resposta[key].role == "4") {
                    listPaciente+='<li id="list_' + resposta[key].id +'" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#editUserModal"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' + resposta[key].id + '</span>' + resposta[key].nome +'</li>';
                } else if (resposta[key].role == "1") {
                    listAdmin+='<li id="list_' + resposta[key].id +'" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#editUserModal"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' +resposta[key].id + '</span>' + resposta[key].nome +'</li>';
                }
            });

            $("#list_pacientes").html(listPaciente);
            $("#list_func").html(listFunc);
            $("#list_admin").html(listAdmin);
            
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
                //console.log(data);
                $("#error").html(data);
                $('#addUserModal').modal('toggle');
                getUsers();
            },
            error: function(response){
                console.log("error->" + response.getAllResponseHeaders);
            }
        });
}

function updateUser(dados)
{
        $.ajax({
            type: "POST",
            url: 'includes/php/funcsWeb.php',
            data: dados, // serializes the form's elements.
            success: function (data) { // show response from the php script.
                console.log("Update->"+data);
                $("#error").html(data);
                $('#editUserModal').modal('toggle');
                getUsers();
            },
            error: function(response){
                console.log("error->" + response.getAllResponseHeaders);
            }
        });
}

$(document).ready(function () {

    getUsers();

    $("#add_user").click(function(){
        $("#addUserModal").show();
    });

    $("#edit_user").click(function(){
        $("#editUserModal").show();
    });

    $(document).on("click", ".list-group-item", function () {
        carregaData($(this).find("span").text());
    });

    $("#addUserForm").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"insertUser"});
        insertUser(arrDados);
    });
    $("#editUserForm").on("submit", function (e) {
        e.preventDefault();
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"updateUser"});
        updateUser(arrDados);
        
    });
});