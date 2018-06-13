function login(form)
{
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:form,
        success: function(response) {
            console.log(response);
            $("#error").html(response);
            var resposta = $.parseJSON(response);
            
            if(resposta.status){
                window.location.href = "home.php";
            }else {
                console.log(resposta.message);
            }
        }
    })
}

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




$(document).ready(function(){

    $("#formLogin").submit(function(e){
        e.preventDefault();
        var arrEnviar = $(this).serializeArray();
        arrEnviar.push({"name":"cmd","value":"login"});
        login(arrEnviar);
    });

    $("#logout").click(function(){
        logout();
    });

    $("#painel").click(function(){
        window.location.href = "home.php";
    });

    $("#exampleInputPassword1").keyup(function (e) {
        e.preventDefault();
        $("#btn_entrar").click();
    });

});