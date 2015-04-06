$(document).ready(function() {
    // página cargada, inicializamos el calendario...
    $('#calendar').fullCalendar({
        height: 450,
        width: 20,
        events: [
            {
                title: 'event1',
                start: '2014-01-29'
            },
            {
                title: 'event2',
                start: '2010-01-05',
                end: '2010-01-07'
            },
            {
                title: 'event3',
                start: '2010-01-09 12:30:00',
                allDay: false // will make the time show
            }
        ]
    })
});







