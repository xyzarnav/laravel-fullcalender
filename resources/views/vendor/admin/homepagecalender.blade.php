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
                    // Custom event rendering can be done here
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
            });

            // Use event delegation for dynamically added elements
            $(document).on('click', '.plus-icon', function () {
                var dateStr = $(this).data('date');
                alert('Show all events for ' + dateStr);
                // Implement the logic to show all events for the clicked day
            });
        });
    </script>
</div>
@endsection
