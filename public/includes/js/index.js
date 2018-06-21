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
                alerta(resposta.message, true);
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

function alerta(mensagem, error=false){
    if(!error){
        $("#sucessoMensagem").html(mensagem);
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    }else{
        $("#errorMensagem").html(mensagem);
        $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#danger-alert").slideUp(500);
        });
    }
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
    
});