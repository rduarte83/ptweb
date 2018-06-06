function getUsers(){
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:{
            "cmd":"getUsers"
        },
        success:function(response){
            var resposta = $.parseJSON(response);
            var items = [];
            $.each(resposta, function (key, val) {
                if (data[key].role == "3") {
                    $("#list_pacientes").append(
                        '<li class="list-group-item"><span class="badge badge-primary" style="margin-right: 8px; padding: 10px; vertical-align: middle;">' +
                        data[key].id + '</span>' + data[key].nome +
                        '</li>');
                } else if (data[key].role == "2") {
                    $("#list_func").append(
                        '<li class="list-group-item"><span class="badge badge-primary" style="border-right: 1px dashed #333; margin-right: 8px;">' +
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
            success: function (data) {
                alert(data); // show response from the php script.
                console.log("sucess");
                console.log(data);
            },
            error: function(response){
                console.log("error " + response.getAllResponseHeaders);
            }
        });
}

$(document).ready(function () {

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