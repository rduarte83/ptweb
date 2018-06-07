/* Como adicionar um evento:
    var event = {id:1 , title: 'Evento NOVO', start: '2018-06-30', end:'2018-06-31' };
    $('#calendar').fullCalendar( 'renderEvent', event, true);*/

var calendar
$(document).ready(function() {
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
        events: [
            {
                title: 'Event',
                start: '2018-06-01',
            },
            {
                title: 'Long Event',
                start: '2018-06-18',
                end: '2018-06-28'
            },
            {
                id: 1,
                title: 'Repeating Event',
                start: '2018-06-04'
            },
            {
                id: 1,
                title: 'Repeating Event',
                start: '2018-06-11'
            },
            {
                title: 'Event 1',
                start: '2018-06-08',
            },
            {
                title: 'Event 2',
                start: '2018-06-08'
            },
            {
                title: 'Event 3',
                start: '2018-06-08'
            },
            {
                title: 'Event 4',
                start: '2018-06-08'
            },
            {
                title: 'Event 5',
                start: '2018-06-08'
            },
        ]
    });
});

