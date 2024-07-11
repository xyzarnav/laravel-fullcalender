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


</head>

<body>
    <div id="pointingDialog" class="pointing-dialog">
        <div class="pointing-dialog-content" id="dialogContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>

    <div class="container calendar-container">
        <br />
        <h1 class="text-center text-primary">Vivekanand Education Society’s Institute of Technology Event Calendar</h1>
        <br />
        <div id="calendar"></div>
        <div id="tableViewContainer" class="table-view-container" style="display: none;">
            <button id="backButton" class="btn btn-primary mb-3">Back to Month View</button>
            <table id="tableView" class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows will be populated dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script>
        $(document).ready(function () {
            let filterPriority = false;
            let currentView = 'calendar'; // Variable to track current view ('calendar' or 'tableView')

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
                                event.end = moment(event.end).endOf('day').format('YYYY-MM-DD HH:mm');
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

            function generateTableView(events) {
                let tableBodyHtml = '';

                events.forEach(function (event) {
                    tableBodyHtml += '<tr>';
                    tableBodyHtml += `<td>${moment(event.start).format('YYYY-MM-DD')}</td>`;
                    tableBodyHtml += `<td>${event.title}</td>`;
                    tableBodyHtml += `<td>${event.event_start_time}</td>`;
                    tableBodyHtml += `<td>${event.event_end_time}</td>`;
                    tableBodyHtml += '</tr>';
                });

                $('#tableView tbody').html(tableBodyHtml); // Populate table body
            }

            $('#calendar').fullCalendar({
                buttonText: {
                    today: 'Today',
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
                    },
                    grid_view: {
                        text: 'Week',
                        click: function () {
                            changeView('basicWeek');
                        }
                    },
                    table_view: {
                        text: 'Table View',
                        click: function () {
                            changeView('tableView');
                        }
                    },
                },
                header: {
                    left: 'prev,next today priorityFilter',
                    center: 'title',
                    right: 'month,grid_view,table_view'
                },
                events: fetchEvents,
                defaultView: 'month', // Default view set to month
                editable: false,
                selectable: false,
                selectHelper: true,
                eventLimit: 3,
                eventLimitClick: 'popover',
                eventRender: function (event, element, view) {
                    var eventColor = event.event_color_coding || '#83d44c';
                    element.css({
                        'background-color': eventColor,
                        'border-color': eventColor
                    });
                    element.data('id', event.id);
                    element.data('event_start_time', event.event_start_time);
                    element.data('event_end_time', event.event_end_time);
                    element.data('title', event.title);
                    element.data('start', event.start.format('YYYY-MM-DD '));
                    element.data('end', event.end ? event.end.format('YYYY-MM-DD ') : '');
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

            function changeView(viewName) {
                if (viewName === 'tableView') {
                    $('#calendar').hide(); // Hide the calendar view
                    $('#tableViewContainer').show(); // Show the table view container

                    // Fetch events for the current month
                    var startDate = moment().startOf('month').format('YYYY-MM-DD');
                    var endDate = moment().endOf('month').format('YYYY-MM-DD');

                    $.ajax({
                        url: '/filter_events',
                        method: 'GET',
                        data: {
                            startDate: startDate,
                            endDate: endDate
                        },
                        success: function (events) {
                            console.log("Events fetched successfully:", events);
                            generateTableView(events);
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching events:", status, error);
                            console.error("XHR response:", xhr.responseText);
                        }
                    });

                    currentView = 'tableView'; // Update current view
                } else {
                    $('#tableViewContainer').hide(); // Hide the table view container
                    $('#calendar').show(); // Show the calendar view

                    $('#calendar').fullCalendar('changeView', viewName); // Change to the selected view
                    currentView = 'calendar'; // Update current view
                }
            }

            // Hover functionality for event details
            $(document).on('mouseenter', '#calendar .fc-content', function () {
                var $this = $(this);
                var hoverTimeout;

                hoverTimeout = setTimeout(function () {
                    var $dialog = $('#pointingDialog');
                    var $content = $('#dialogContent');
                    var eventId = $this.closest('.fc-event').data('id');
                    var eventTitle = $this.closest('.fc-event').data('title');
                    var eventStart = $this.closest('.fc-event').data('start');
                    var eventEnd = $this.closest('.fc-event').data('end');
                    var eventstarttime = $this.closest('.fc-event').data('event_start_time');
                    var eventendtime = $this.closest('.fc-event').data('event_end_time');


    $content.html(`
    <div class="container-fluid p-0" style="background-color: #f8fa00; position: relative;">
        <div class="close-icon" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
            <i class="bi bi-calendar3" style="font-size: 24px; color: #6c7ddd;"></i>
        </div>
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

// Add click event handler for the close icon
$content.on('click', '.close-icon', function() {
    $content.empty(); // This will remove the content from the container
});$content.html(`
    <div class="container-fluid p-0" style="background-color: #f8f9fa; position: relative;">
        <div class="close-icon" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
            <i class="bi bi-x-circle" style="font-size: 24px; color: #6c757d;"></i> <!-- Corrected color value -->
        </div>
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

// Add click event handler for the close icon
$content.on('click', '.close-icon', function() {
    $content.empty(); // This will remove the content from the container
});

                    var offset = $this.offset();
                    $dialog.css({
                        top: offset.top - $dialog.outerHeight() - 10,
                        left: offset.left + $this.outerWidth() / 2 - $dialog.outerWidth() / 2,
                        display: 'block',
                        opacity: 1,
                        transform: 'translateY(0)'
                    });

                    $dialog.stop(true, true).fadeIn(300);
                }, 10); // Delay showing the dialog by 400 milliseconds
            });

            $(document).on('mouseleave', '.fc-content', function () {
    // Set a timeout when the mouse leaves the content area
    hoverTimeout = setTimeout(function () {
        // Check if the mouse is not over the dialog
        if (!isMouseInContentOrDialog) {
            $('#pointingDialog').stop(true, true).fadeOut(100); // Fade out the dialog
        }
    }, 100); // Set the timeout to 100 milliseconds
});

$('#pointingDialog').on('mouseenter', function () {
    clearTimeout(hoverTimeout); // Clear the timeout if the mouse enters the dialog
    isMouseInContentOrDialog = true; // Set the flag to true when mouse is over the dialog
});

$('#pointingDialog').on('mouseleave', function () {
    isMouseInContentOrDialog = false; // Reset the flag when mouse leaves the dialog
    // Set a timeout to fade out the dialog after leaving
    setTimeout(function () {
        if (!isMouseInContentOrDialog) { // If the mouse is not over the dialog after 100ms
            $('#pointingDialog').stop(true, true).fadeOut(100); // Fade out the dialog
        }
    }, 100);
});

$('#backButton').on('click', function () {
    changeView('month'); // Switch back to calendar view
    $('.fc-month-button').addClass('fc-state-active'); // Activate the "Month" button
});

        });

    </script>
</body>

</html>
