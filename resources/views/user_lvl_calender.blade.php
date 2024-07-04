<!DOCTYPE html>
<html>

<head>
    <title>FullCalendar Integration in Laravel 8</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="{{ asset('css/userlevelcalstyle.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    
</head>

<body>

    <div class="container">
        <br />
        <h1 class="text-center text-primary">Vivekanand Education Society’s Institute of Technology Event Calendar</h1>
        <br />

        <div id="calendar"></div>

    </div>

    <script>
        $(document).ready(function () {
            // Initial state of the filter
            let filterPriority = false;

            // Define a function to fetch events, possibly filtering by priority
            function fetchEvents(start, end, timezone, callback) {
                console.log("Fetching events with filterPriority:", filterPriority);
                $.ajax({
                    url: '/filter_events',
                    method: 'GET',
                    data: {
                        filterPriority: filterPriority ? 1 : undefined
                    },
                    success: function (events) {
                        console.log("Events fetched successfully:", events);
                        callback(events); // Make sure this callback correctly updates the events in FullCalendar
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching events:", status, error);
                        console.error("XHR response:", xhr.responseText);
                    }
                });
            }

            $('#calendar').fullCalendar({
                customButtons: {
                    priorityFilter: {
                        text: 'Priority',
                        click: function () {
                            filterPriority = !filterPriority; // Toggle the filter state
                            console.log("Priority filter toggled:", filterPriority);
                            $('#calendar').fullCalendar('refetchEvents'); // Refetch events with the new filter
                            // Toggle the active class on the button
                            $('.fc-priorityFilter-button').toggleClass('fc-priorityFilter-button-active');
                        }
                    }
                },
                header: {
                    left: 'prev,next today priorityFilter', // Add the priorityFilter button to the header
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: fetchEvents,
                defaultView: 'agendaWeek', // Set default view to agendaWeek
                editable: false,
                selectable: false,
                selectHelper: true,
                eventLimit: true, // Enable event limit
                eventLimitClick: 'popover', // Use popover to show all events
                eventRender: function (event, element, view) {
                    if (view.type === 'agendaWeek' || view.type === 'agendaDay') {
                        element.addClass('vertical-event'); // Add custom class for styling
                    }
                },
                dayClick: function (date, jsEvent, view) {
                    // Handle day click if needed
                },
                eventAfterAllRender: function (view) {
                    // This callback runs after all events have been rendered.
                    // You can implement custom logic here if needed to handle more than 3 events.
                },
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        // Implement event creation logic here
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                dayRender: function (date, cell) {
                    if (date.format() === moment().format('YYYY-MM-DD')) {
                        cell.addClass('today-highlight');
                    }
                }
            });

            // Use event delegation for dynamically added elements
            $(document).on('click', '.plus-icon', function () {
                var dateStr = $(this).data('date');
                alert('Show all events for ' + dateStr);
                // Implement the logic to show all events for the clicked day
            });

        });
        $(document).ready(function () {
            $('.fc-priorityFilter-button').change(function () {
                if ($(this).prop('checked')) {
                    // Handle the toggle turned on
                    console.log('Toggle is on');
                } else {
                    // Handle the toggle turned off
                    console.log('Toggle is off');
                }
            });
        });
    </script>


</body>

</html>
