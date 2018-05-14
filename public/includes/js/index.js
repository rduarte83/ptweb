$(document).ready(function(){
    var scrollDown = false;
    var lastScrollTop = 0;
    $(window).scroll(function(event){
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            // downscroll code
            if(!scrollDown){
                $(".topText").animate({"margin-top": "-100px"},510);
                $("#navTop").animate({"margin-top": "0px"},500);
                scrollDown = true;
            }
                
        } else {
            
            // upscroll code
            if( st <= 1){
                $(".topText").animate({"margin-top": "0px"},500);
                $("#navTop").animate({"margin-top": "100px"},550);
                scrollDown = false;
                
            }
            
           
        }
        lastScrollTop = st;
    });

});