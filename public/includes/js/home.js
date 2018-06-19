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

$(document).ready(function()
{
    $("#openDropDownUtentes").click(function(){
        $("div[class='dropdown-container Utentes']").slideToggle( "fast" );
    });

    $("#openDropDownArtigos").click(function(){
        $("div[class='dropdown-container Artigos']").slideToggle( "fast" );
    });

    $("#openDropDownVideos").click(function(){
        $("div[class='dropdown-container Videos']").slideToggle( "fast" );
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
});

