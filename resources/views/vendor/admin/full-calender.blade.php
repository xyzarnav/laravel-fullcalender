<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/admincalstyle.css') }}" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <!-- jQuery -->

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
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
                    <a href="{{ route('admin_view') }}" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="btn btn-primary sidebar-link" data-toggle="modal" data-target="#Addeventmodal">
                        <i class="lni lni-plus"></i>
                        <span>Add event</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Task</span>
                    </a>
                </li> -->
                <!-- <li class="sidebar-item">
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
                </li> -->
                <!-- <li class="sidebar-item">
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
                </li> -->
                <li class="sidebar-item">
                    <a href="{{ url('/cal_operation') }}" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>CURD OPERATION</span>
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
        <!-- Main Content -->
        <div class="main p-3">
            @yield('content')
        </div>
    </div>

    <!-- Event Modal -->
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
                            <input type="title" class="form-control" name="title" aria-describedby="titleHelp"
                                placeholder="Enter title" required>
                        </div>
                        <div class="form-group">
                            <label for="startDate">Start date</label>
                            <input type="date" class="form-control" name="start" placeholder="Start Date" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End date</label>
                            <input type="date" class="form-control" name="end" placeholder="End Date" required>
                        </div>
                        <div class="form-group">
                            <label for="startTime">Start time</label>
                            <input type="time" class="form-control" name="event_start_time" id="startTime"
                                placeholder="Start Time">
                        </div>
                        <div class="form-group">
                            <label for="endTime">End time</label>
                            <input type="time" class="form-control" name="event_end_time" id="startTime"
                                placeholder="Start Time">
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="colorSelector" class="mr-2">Color Selector</label>
                            <input type="color" class="form-control" required name="event_color_coding"
                                onchange="updateColorCode(this.value)" style="width: 50px; padding:0px">
                            <div class="dropdown">
                                <div id="colors" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"
                                    style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #ced4da; margin-left: 10px; cursor: pointer;">
                                    <span id="color-text"></span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="colors">
                                    <a class="dropdown-item" href="#" style="background-color: #FF40FF; color: #000;"
                                        onclick="changeColor('#FF40FF', 'Magenta')">Magenta</a>
                                    <a class="dropdown-item" href="#" style="background-color: #4FEE00; color: #000;"
                                        onclick="changeColor('#4FEE00', 'Lime Green')">Lime Green</a>
                                    <a class="dropdown-item" href="#" style="background-color: #FFC0CB; color: #000;"
                                        onclick="changeColor('#FFC0CB', 'Pink')">Pink</a>
                                    <a class="dropdown-item" href="#" style="background-color: #FFD700; color: #000;"
                                        onclick="changeColor('#FFD700', 'Gold')">Gold</a>
                                    <a class="dropdown-item" href="#" style="background-color: #00FFFF; color: #000;"
                                        onclick="changeColor('#00FFFF', 'Cyan')">Cyan</a>
                                    <a class="dropdown-item" href="#" style="background-color: #ADD8E6; color: #000;"
                                        onclick="changeColor('#ADD8E6', 'Light Blue')">Light Blue</a>
                                    <a class="dropdown-item" href="#" style="background-color: #008000; color: #FFF;"
                                        onclick="changeColor('#008000', 'Green')">Green</a>
                                    <a class="dropdown-item" href="#" style="background-color: #FFFF00; color: #000;"
                                        onclick="changeColor('#FFFF00', 'Yellow')">Yellow</a>
                                    <!-- Additional colors -->
                                    <a class="dropdown-item" href="#" style="background-color: #FFA500; color: #000;"
                                        onclick="changeColor('#FFA500', 'Orange')">Orange</a>

                                    <a class="dropdown-item" href="#" style="background-color: #D8BFD8; color: #000;"
                                        onclick="changeColor('#D8BFD8', 'Thistle')">Thistle</a>

                                </div>
                            </div>
                            <input type="hidden" id="hiddenColorInput" name="event_color_coding">
                            <script>
                                function changeColor(color, name) {
                                    // Update the hidden input value and display the selected color name and hex code
                                    document.getElementById('hiddenColorInput').value = color;
                                    document.getElementById('colorCode').textContent = `${name} (${color})`;
                                }

                                function updateColorCode(color) {
                                    // Update the hidden input value and display the selected color hex code only
                                    document.getElementById('hiddenColorInput').value = color;
                                    document.getElementById('colorCode').textContent = color;
                                }
                            </script>
                            <span id="colorCode" class="ml-2"></span>
                        </div>

                        <div class="custom-control custom-switch mb-4">
                            <!-- Hidden input to hold the default value of 0 -->
                            <input type="hidden" name="event_priority" value="0">
                            <!-- Checkbox input; when checked, it overrides the hidden input with a value of 1 -->
                            <input type="checkbox" class="custom-control-input" name="event_priority"
                                id="prioritySwitch" value="1">
                            <label class="custom-control-label" for="prioritySwitch"
                                style="font-size: 1rem">Priority</label>
                        </div>

                        <script>
                            function updatePriority(element) {
                                var priority = element.checked ? 1 : 0;
                                console.log("Priority set to:", priority);
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


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="/js/admincalscript.js"></script>
</body>

</html>
