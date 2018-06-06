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
                console.log("sucess");
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
        $("#addUserModal").show();
    });

    $("#addUserForm").on("submit", function (e) {
        e.preventDefault();
        console.log("submit in js!");
        var arrDados = $(this).serializeArray();
        arrDados.push({"name":"cmd","value":"insertUser"});
        insertUser(arrDados);

        
    });
});