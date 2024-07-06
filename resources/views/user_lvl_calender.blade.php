<!DOCTYPE html>
<html>

<head>
    <title>FullCalendar Integration in Laravel 8</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="{{ asset('css/userlevelcalstyle.css') }}" />
    <script src="{{ asset('js/userlvlcalscrit.js') }}"></script>
</head>

<body>
    <div id="pointingDialog" class="pointing-dialog">
        <div class="pointing-dialog-content" id="dialogContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>

    <div class="container">
        <br />
        <h1 class="text-center text-primary">Vivekanand Education Society’s Institute of Technology Event Calendar</h1>
        <br />
        <div id="calendar"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script>
        $(document).ready(function () {
            let filterPriority = false;

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
                        events.forEach(function (event) {
                            if (event.end) {
                                event.end = moment(event.end).add(1, 'days').format('YYYY-MM-DD');
                            }
                        });
                        callback(events);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching events:", status, error);
                        console.error("XHR response:", xhr.responseText);
                    }
                });
            }

            $('#calendar').fullCalendar({
                buttonText: {
                    today: 'Today', // Capitalize "Today"
                    month: 'Month'
                },
                customButtons: {
                    priorityFilter: {
                        text: ' ',
                        click: function () {
                            filterPriority = !filterPriority;
                            console.log("Priority filter toggled:", filterPriority);
                            $('#calendar').fullCalendar('refetchEvents');
                            $('.fc-priorityFilter-button').toggleClass('fc-priorityFilter-button-active');
                        }
                    }
                },
                header: {
                    left: 'prev,next today priorityFilter',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: fetchEvents,
                defaultView: 'agendaWeek',
                editable: false,
                selectable: false,
                selectHelper: true,
                eventLimit: true,
                eventLimitClick: 'popover',
                eventRender: function (event, element, view) {
                    // Apply custom styles based on event color coding
                    var eventColor = event.event_color_coding || '#83d44c'; // Default color if none specified
                    element.css({
                        'background-color': eventColor,
                        'border-color': eventColor
                    });

                    // Set data attributes
                    element.data('id', event.id);
                    element.data('event_start_time', event.event_start_time);
                    element.data('event_end_time', event.event_end_time);

                    element.data('title', event.title);
                    element.data('start', event.start.format('YYYY-MM-DD '));
                    element.data('end', event.end ? event.end.format('YYYY-MM-DD ') : '');

                    if (view.type === 'agendaWeek' || view.type === 'agendaDay') {
                        element.addClass('vertical-event');
                    }
                },
                dayClick: function (date, jsEvent, view) {
                    // Custom day click handler if needed
                },
                eventAfterAllRender: function (view) {
                    // Custom rendering logic if needed
                },
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        // Handle event creation if needed
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                dayRender: function (date, cell) {
                    if (date.format() === moment().format('YYYY-MM-DD')) {
                        cell.addClass('today-highlight');
                    }
                }
            });

            // Click handler for .fc-content within #calendar
            var isDialogClicked = false; // Initialize a flag to track the click state

           $(document).ready(function () {
                // Your existing code...

                $(document).on('mouseenter', '#calendar .fc-content', function () {
                    var $dialog = $('#pointingDialog');
                    var $content = $('#dialogContent');
                    var eventId = $(this).closest('.fc-event').data('id');
                    var eventTitle = $(this).closest('.fc-event').data('title');
                    var eventStart = $(this).closest('.fc-event').data('start');
                    var eventEnd = $(this).closest('.fc-event').data('end');
                    var eventstarttime = $(this).closest('.fc-event').data('event_start_time');
                    var eventendtime = $(this).closest('.fc-event').data('event_end_time');

                    // Example content - replace with dynamic content if needed
                    $content.html(`
            <div class="container-fluid p-0" style="background-color: #f8f9fa;">
                <div class="card border-0">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">
                        <div class="text-center">
                            <i class="bi bi-calendar3 text-primary" style="font-size: 44px;"></i>
                            <hr class="my-1">
                            <h5 id="eventTitle" class="card-title mt-2 text-dark text-center w-100" style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 16px; word-wrap: break-word;">${eventTitle}</h5>
                        </div>
                        <div class="event-details text-center">
                            <p class="card-text mb-1 text-muted" style="font-family: 'Arial', sans-serif;">
                                <i class="bi bi-calendar3"></i> ${eventStart}
                            </p>
                            <p class="card-text mb-0 text-muted" style="font-family: 'Arial', sans-serif;">
                                <i class="bi bi-calendar-x"></i> ${eventEnd}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-left d-flex align-items-center" style="font-family: 'Arial', sans-serif; background-color: #f8f9fa;">
                        <i class="bi bi-clock text-primary" style="margin-right: 10px;"></i>
                        <p class="card-text mb-2 text-dark" style="margin: 5px;">
                            ${eventstarttime} - ${eventendtime}
                        </p>
                    </div>
                </div>
            </div>
        `);

                    // Position the dialog above the fc-content element
                    var offset = $(this).offset();
                    $dialog.css({
                        top: offset.top - $dialog.outerHeight() - 10, // Adjust as needed
                        left: offset.left + $(this).outerWidth() / 2 - $dialog.outerWidth() / 2,
                        display: 'block',
                        opacity: 1, // Ensure opacity is set to 1 on hover
                        transform: 'translateY(0)' // Ensure dialog is fully visible on hover
                    });

                    // Use jQuery fadeIn for animation
                    $dialog.stop(true, true).fadeIn(300); // Adjust duration as needed

                    // Mouseleave handler for .fc-content
                    var isMouseInContentOrDialog = false;

                    $('.fc-content').on('mouseenter', function () {
                        isMouseInContentOrDialog = true;
                        $('#pointingDialog').stop(true, true).fadeIn(300); // Ensure dialog remains visible on content hover
                    });

                    $('.fc-content, #pointingDialog').on('mouseleave', function () {
                        isMouseInContentOrDialog = false;

                        setTimeout(function () {
                            if (!isMouseInContentOrDialog) { // Only hide if mouse is not in content or dialog
                                $dialog.stop(true, true).fadeOut(300); // Adjust duration as needed
                            }
                        }, 4000); // Adjust the timeout as needed
                    });

                    $('#pointingDialog').on('mouseenter', function () {
                        isMouseInContentOrDialog = true;
                    });
                });

                // Your existing click and other event handlers...

            });



            // Click handler for .plus-icon
            $(document).on('click', '.plus-icon', function () {
                var dateStr = $(this).data('date');
                alert('Show all events for ' + dateStr);
            });

            // Event listener for .fc-priorityFilter-button
            document.querySelector('.fc-priorityFilter-button').addEventListener('click', function () {
                this.classList.toggle('fc-priorityFilter-button-clicked');
            });

        });
    </script>

</body>

</html>
