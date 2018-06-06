/* ADMIN */


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
});

