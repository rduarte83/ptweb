/* Como adicionar um evento:
    var event = {id:1 , title: 'Evento NOVO', start: '2018-06-30', end:'2018-06-31' };
    $('#calendar').fullCalendar( 'renderEvent', event, true);*/

var eventosCalendario;
function buildCalendar(){
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listWeek'
        },
        locale: 'pt',
        themeSystem: 'bootstrap4',
        bootstrapFontAwesome: {
            prev: 'fa-arrow-left',
            next: 'fa-arrow-right'
        },
        handleWindowResize: true,
        weekNumbers: true,
        navLinks: false,
        editable: false,
        eventLimit: true,
        events: []
    });
}


function getDataUser()
{
    console.log(user);
    $.ajax({
        url:"includes/php/funcsWeb.php",
        type:"POST",
        data:{
            "cmd":"getEventsCalendar",
            "utente":user,
        },
        dataType:"JSON",
        success:function(resposta){
            console.log(resposta);
            $.each(resposta[0], function(index, value){
                var event = {id: resposta[0][index].id , title: resposta[0][index].titulo, start: resposta[0][index].inicio, end: resposta[0][index].fim };
                $('#calendar').fullCalendar( 'renderEvent', event, true);
            })

            $.each(resposta[1], function(index, value){
                var event = {id: resposta[1][index].id , title: resposta[1][index].titulo, start: resposta[1][index].inicio };
                $('#calendar').fullCalendar( 'renderEvent', event, true);
            })
            
        }

    });
}

var calendar;
$(document).ready(function() {
    buildCalendar();
    getDataUser();
});

