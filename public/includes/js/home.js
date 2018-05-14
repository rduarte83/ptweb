/* ADMIN */


$(document).ready(function(){

    
    $("#openDropDownPacientes").click(function(){
        $("div[class='dropdown-container Pacientes']").slideToggle( "slow" );
    });

    $("#openDropDownNoticias").click(function(){
        $("div[class='dropdown-container Noticias']").slideToggle( "slow" );
    });
});