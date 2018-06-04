function login(form)
{
    $.ajax({
        type:"POST",
        url:"includes/php/funcsWeb.php",
        data:form,
        success: function(response) {
            location.reload();
            console.log(response);
        }
    })
}


$(document).ready(function(){
    var scrollDown = false;
    var lastScrollTop = 10;
    $(window).scroll(function(event){
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            // downscroll code
            if(!scrollDown){
                $(".topText").animate({"margin-top": "-200px"},510);
                $("#navTop").animate({"margin-top": "0px"},500);
                $("#logoDor").show();
                scrollDown = true;
            }
                
        } else {
            
            // upscroll code
            if( st <= 1){
                $(".topText").animate({"margin-top": "0px"},500);
                $("#navTop").animate({"margin-top": "300px"},550);
                $("#logoDor").hide();
                scrollDown = false;
            }           
        }
        lastScrollTop = st;
    });

    $("#formLogin").submit(function(e){
        e.preventDefault();
        login($(this).serializeArray());
    });

});