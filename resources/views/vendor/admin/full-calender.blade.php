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
                            <a href="#">CodzSword</a>
                        </div>
                    </div>
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="lni lni-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="lni lni-agenda"></i>
                                <span>Task</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth"
                                aria-expanded="false" aria-controls="auth">
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
                                    <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two"
                                        aria-expanded="false" aria-controls="multi-two">
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
                <div class="main p-3">
                    <div class="container-fluid">
                        <div class="row">

                            <!-- Main content -->
                            <div class="col-md-8 offset-md-1 center-parent-calendar">
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

                                        if (title) {
                                            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                                            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                                            $.ajax({
                                                url: "/full-calender/action",
                                                type: "POST",
                                                data: {
                                                    title: title,
                                                    start: start,
                                                    end: end,
                                                    type: 'add'
                                                },
                                                success: function (data) {
                                                    calendar.fullCalendar('refetchEvents');
                                                    alert("Event Created Successfully");
                                                }
                                            })
                                        }
                                    },
                                    editable: true,
                                    eventResize: function (event, delta) {
                                        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                                        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                                        var title = event.title;
                                        var id = event.id;
                                        $.ajax({
                                            url: "/full-calender/action",
                                            type: "POST",
                                            data: {
                                                title: title,
                                                start: start,
                                                end: end,
                                                id: id,
                                                type: 'update'
                                            },
                                            success: function (response) {
                                                calendar.fullCalendar('refetchEvents');
                                                alert("Event Updated Successfully");
                                            }
                                        })
                                    },
                                    eventDrop: function (event, delta) {
                                        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                                        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                                        var title = event.title;
                                        var id = event.id;
                                        $.ajax({
                                            url: "/full-calender/action",
                                            type: "POST",
                                            data: {
                                                title: title,
                                                start: start,
                                                end: end,
                                                id: id,
                                                type: 'update'
                                            },
                                            success: function (response) {
                                                calendar.fullCalendar('refetchEvents');
                                                alert("Event Updated Successfully");
                                            }
                                        })
                                    },

                                    eventClick: function (event) {
                                        if (confirm("Are you sure you want to remove it?")) {
                                            var id = event.id;
                                            $.ajax({
                                                url: "/full-calender/action",
                                                type: "POST",
                                                data: {
                                                    id: id,
                                                    type: "delete"
                                                },
                                                success: function (response) {
                                                    calendar.fullCalendar('refetchEvents');
                                                    alert("Event Deleted Successfully");
                                                }
                                            })
                                        }
                                    }
                                });

                            });

                        </script>
                    </div>

                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
                crossorigin="anonymous"></script>
            <script src="/js/admincalscript.js"></script>

            <!-- Sidebar End -->

</body>

</html>
