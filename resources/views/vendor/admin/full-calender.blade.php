<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>This is testing for calendar event</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('css/admincalstyle.css') }}" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- FullCalendar CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> -->


    <!-- Custom JS -->
    <script src="{{ asset('js/calendar.js') }}"></script>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button" aria-label="Toggle Sidebar">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">caltest</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Addeventmodal">
                            <i class="lni lni-agenda"></i>
                            Add event
                        </button>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Task</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <!-- event modal start -->


        <!-- event modal end -->
        <!-- main  cal -->
        <div class="main p-3">
            <div class="container-fluid">
                <div class="row">

                    <!-- Main content -->
                    <div class="col-md-8 offset-md-2  center-parent-calendar">
                        <br />
                        <br />
                        <div id="calendar" class="center-calendar"></div>
                    </div>
                </div>
            </div>

            <div class="container">
                <script>

                    $(document).ready(function () {

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var calendar = $('#calendar').fullCalendar({
                            editable: true,
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            events: '/full-calender',
                            selectable: true,
                            selectHelper: true,
                            select: function (start, end, allDay) {
                                var title = prompt('Event Title:');


                                // if (title) {
                                //     var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                                //     var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                                //     // Assume event_color_coding and event_priority are obtained from the user input
                                //     var event_color_coding = $('#eventColorCoding').val(); // Example: Get value from an input field
                                //     var event_priority = $('#eventPriority').val(); // Example: Get value from another input field

                                //     $.ajax({
                                //         url: "/full-calender/action",
                                //         type: "POST",
                                //         data: {
                                //             title: title,
                                //             start: start,
                                //             end: end,
                                //             event_color_coding: event_color_coding, // Add this line
                                //             event_priority: event_priority, // And this line
                                //             type: 'add'
                                //         },
                                //         success: function (data) {
                                //             calendar.fullCalendar('refetchEvents');
                                //             alert("Event Created Successfully");
                                //         }
                                //     });
                                // }
                            },
                            // editable: true,
                            // eventResize: function (event, delta) {
                            //     var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                            //     var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                            //     var title = event.title;
                            //     var id = event.id;

                            //     $.ajax({
                            //         url: "/full-calender/action",
                            //         type: "POST",
                            //         data: {
                            //             title: title,
                            //             start: start,
                            //             end: end,
                            //             id: id,
                            //             type: 'update'
                            //         },
                            //         success: function (response) {
                            //             calendar.fullCalendar('refetchEvents');
                            //             alert("Event Updated Successfully");
                            //         }
                            //     })
                            // },
                            // eventDrop: function (event, delta) {
                            //     var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                            //     var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                            //     var title = event.title;
                            //     var id = event.id;
                            //     $.ajax({
                            //         url: "/full-calender/action",
                            //         type: "POST",
                            //         data: {
                            //             title: title,
                            //             start: start,
                            //             end: end,
                            //             id: id,
                            //             type: 'update'
                            //         },
                            //         success: function (response) {
                            //             calendar.fullCalendar('refetchEvents');
                            //             alert("Event Updated Successfully");
                            //         }
                            //     })
                            // },

                            // eventClick: function (event) {
                            //     if (confirm("Are you sure you want to remove it?")) {
                            //         var id = event.id;
                            //         $.ajax({
                            //             url: "/full-calender/action",
                            //             type: "POST",
                            //             data: {
                            //                 id: id,
                            //                 type: "delete"
                            //             },
                            //             success: function (response) {
                            //                 calendar.fullCalendar('refetchEvents');
                            //                 alert("Event Deleted Successfully");
                            //             }
                            //         })
                            //     }
                            // }
                        });

                    });

                </script>
            </div>

        </div>
    </div>
    <!-- event modal -->
    <div class="modal fade" id="Addeventmodal" tabindex="-1" role="dialog" aria-labelledby="AddeventmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddeventmodalLabel">ADD EVENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store_events') }}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputtitle1">title</label>
                            <input type="title" class="form-control" name="title"
                                aria-describedby="titleHelp" placeholder="Enter title"  required>
                            <!-- <small id="titleHelp" class="form-text text-muted">We'll never share your title with
                                anyone else.</small> -->
                        </div>
                        <div class="form-group">
                            <label for="startDate">Start date</label>
                            <input type="date" class="form-control" name="start" placeholder="Start Date"  required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End date</label>
                            <input type="date" class="form-control" name="end" placeholder="End Date"  required>
                        </div>
                        <div class="form-group">
                            <label for="startTime">Start time</label>
                            <input type="time" class="form-control" id="startTime" placeholder="Start Time">
                        </div>
                        <div class="form-group">
                            <label for="endTime">End time</label>
                            <input type="time" class="form-control" id="startTime" placeholder="Start Time">
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="colorSelector" class="mr-2">Color Selector</label>
                            <input type="color" class="form-control"  required name="event_color_coding" onchange="updateColorCode(this.value)"
                                style="width: 50px; padding:0px">
                            <div class="dropdown">
                                <div id="colors" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"
                                    style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #ced4da; margin-left: 10px; cursor: pointer;">
                                    <span id="color-text"></span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="colors">
                                    <a class="dropdown-item" href="#" onclick="changeColor('#FF0000', 'Red')">Red</a>
                                    <a class="dropdown-item" href="#" onclick="changeColor('#0000FF', 'Blue')">Blue</a>
                                    <a class="dropdown-item" href="#" onclick="changeColor('#008000', 'Green')">Green</a>
                                    <a class="dropdown-item" href="#" onclick="changeColor('#FFFF00', 'Yellow')">Yellow</a>
                                </div>
                            </div>
                            <script>
                                function changeColor(color, name) {
                                    // Update the color code span with the selected color name and hex code
                                    document.getElementById('colorCode').textContent = `${name} (${color})`;
                                }

                                function updateColorCode(color) {
                                    // Update the color code span with the selected color hex code only
                                    document.getElementById('colorCode').textContent = color;
                                }
                            </script>
                            <span id="colorCode" class="ml-2"></span>
                        </div>



                        <!-- Checkbox for event_priority -->
                        <div class="custom-control custom-switch mb-4">
                            <input type="checkbox" class="custom-control-input" name="event_priority" id="prioritySwitch" value="1">
                            <label class="custom-control-label" for="prioritySwitch" style="font-size: 1rem">Priority</label>
                        </div>

                        <script>
                            function updatePriority(element) {
                                var priority = element.checked ? 1 : 0;
                                console.log("Priority set to:", priority);
                                // You can also perform other actions based on the priority value here
                            }
                        </script>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- mevent modal -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <!-- Your custom scripts should come after all dependencies -->
    <script src="/js/admincalscript.js"></script>



</body>

</html>
