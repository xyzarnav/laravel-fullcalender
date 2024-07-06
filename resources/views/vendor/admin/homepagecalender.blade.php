<!-- resources/views/calendar.blade.php -->
@extends('vendor.admin.full-calender')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 offset-md-1 center-parent-calendar">
            <br />
            <br />
            <div id="calendar" class="center-calendar"></div>
        </div>
    </div>
    <div id="pointingDialog" class="pointing-dialog">
        <div class="pointing-dialog-content" id="dialogContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            $(function () {
                // This will initialize all toggles once the DOM is fully loaded
                $('input[type="checkbox"][data-toggle="toggle"]').bootstrapToggle();
            });

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                 buttonText: {
                    today: 'Today', // Capitalize "Today"
                    month: 'Month'
                },
                header: {
                    left: 'prev,next today priorityFilter',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                customButtons: {
                    priorityFilter: {
                        text: 'Priority',

                        click: function () {
                            filterPriority = !filterPriority; // Toggle the filter state
                            console.log("Priority filter toggled:", filterPriority);
                            $('#calendar').fullCalendar('refetchEvents'); // Refetch events with the new filter
                        }
                    }
                },
                events: fetchEvents,
                selectable: true,
                selectHelper: true,
                eventLimit: true, // Enable event limit
                eventLimitClick: 'popover', // Use popover to show all events
                eventRender: function (event, element, view) {
                    // Apply custom styles based on event color coding
                    var eventColor = event.event_color_coding || '#83d44c'; // Default color if none specified
                    element.css({
                        'background-color': eventColor,
                        'border-color': eventColor
                    });

                    if (view.type === 'agendaWeek' || view.type === 'agendaDay') {
                        element.addClass('vertical-event');
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
                }
            });

            // Use event delegation for dynamically added elements
            $(document).on('click', '.plus-icon', function () {
                var dateStr = $(this).data('date');
                alert('Show all events for ' + dateStr);
                // Implement the logic to show all events for the clicked day
            });
        });
        // $(document).ready(function () {
        //         // Use event delegation for dynamically generated .fc-content elements
        //         $('#calendar').on('click', '.fc-content', function (e) {
        //             var $dialog = $('#pointingDialog');
        //             var $content = $('#dialogContent');

        //             // Example content - replace with dynamic content if needed
        //             $content.html('<p>Event details here</p>');

        //             // Position the dialog above the fc-content element
        //             var offset = $(this).offset();
        //             $dialog.css({
        //                 top: offset.top - $dialog.outerHeight() - 10, // Adjust as needed
        //                 left: offset.left + $(this).outerWidth() / 2 - $dialog.outerWidth() / 2,
        //                 display: 'block'
        //             });

        //             e.stopPropagation(); // Prevent event from bubbling up
        //         });

        //         // Hide the dialog when clicking anywhere else on the page
        //         $(document).on('click', function () {
        //             $('#pointingDialog').hide();
        //         });

        //         // Prevent the dialog from closing when clicking inside it
        //         $('#pointingDialog').on('click', function (e) {
        //             e.stopPropagation();
        //         });
        //     });
    </script>
</div>
@endsection
