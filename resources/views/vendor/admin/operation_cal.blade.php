@extends('vendor.admin.full-calender')

@section('content')
<div class="container">
    <h1>CRUD Operations</h1>
    <!-- Notifications content here -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Event Start Date</th>
                    <th>Event End Date</th>
                    <th>Event Start Time</th>
                    <th>Event End Time</th>
                    <th>Priority</th>
                    <th>Color</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->end)->format('d-m-Y') }}</td>
                        <td>{{ $event->event_start_time }}</td>
                        <td>{{ $event->event_end_time }}</td>
                        <td>{{ $event->event_priority }}</td>
                        <td style="background-color: {{ $event->event_color_coding }}">{{ $event->event_color_coding }}</td>

                        <td>
                            <a href="#" class="btn btn-primary btn-sm btn-custom-width" data-toggle="modal"
                                data-target="#Editeventmodal" data-id="{{ $event->id }}" data-title="{{ $event->title }}"
                                data-start="{{ $event->start }}" data-end="{{ $event->end }}"
                                data-start-time="{{ $event->event_start_time }}"
                                data-end-time="{{ $event->event_end_time }}" data-priority="{{ $event->event_priority }}"
                                data-color="{{ $event->event_color_coding }}">Edit </a>
                            <form method="POST" action="{{ route('events.destroy', $event->id) }}"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-custom-width">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div>
    <div class="modal fade" id="Editeventmodal" tabindex="-1" role="dialog" aria-labelledby="EditeventmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditeventmodalLabel">EDIT EVENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editEventForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputtitle1">Title</label>
                            <input type="text" class="form-control" name="title" aria-describedby="titleHelp"
                                placeholder="Enter title" required>
                        </div>


                        <div class="form-group">
                            <label for="startDate">Start date</label>
                            <input type="date" class="form-control" name="start" placeholder="Start Date" required
                                value="{{ \Carbon\Carbon::parse($event->start)->format('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="endDate">End date</label>
                            <input type="date" class="form-control" name="end" placeholder="End Date" required
                                value="{{ \Carbon\Carbon::parse($event->end)->format('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="startTime">Start time</label>
                            <input type="time" class="form-control" name="event_start_time" id="startTime"
                                placeholder="Start Time">
                        </div>
                        <div class="form-group">
                            <label for="endTime">End time</label>
                            <input type="time" class="form-control" name="event_end_time" id="endTime"
                                placeholder="End Time">
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="colorSelector" class="mr-2">Color Selector</label>
                            <input type="color" class="form-control" required name="event_color_coding"
                                onchange="updateColorCode(this.value)" style="width: 50px; padding:0px"
                                id="colorSelector">
                            <div class="dropdown">
                                <div id="colors" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"
                                    style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #ced4da; margin-left: 10px; cursor: pointer;">
                                    <span id="color-text"></span>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="colors">
                                    <!-- Dropdown items for color selection -->
                                    <a class="dropdown-item" href="#" style="background-color: #FF40FF; color: #000;"
                                        onclick="changeColor('#FF40FF', 'Magenta')">Magenta</a>
                                    <a class="dropdown-item" href="#" style="background-color: #4FEE00; color: #000;"
                                        onclick="changeColor('#4FEE00', 'Lime Green')">Lime Green</a>
                                    <!-- Add more colors as needed -->
                                    <a class="dropdown-item" href="#" style="background-color: #FFD700; color: #000;"
                                        onclick="changeColor('#FFD700', 'Gold')">Gold</a>
                                    <a class="dropdown-item" href="#" style="background-color: #FFFF00; color: #000;"
                                        onclick="changeColor('#FFFF00', 'Yellow')">Yellow</a>
                                    <a class="dropdown-item" href="#" style="background-color: #00FFFF; color: #000;"
                                        onclick="changeColor('#00FFFF', 'Cyan')">Cyan</a>
                                    <a class="dropdown-item" href="#" style="background-color: #ADD8E6; color: #000;"
                                        onclick="changeColor('#ADD8E6', 'Light Blue')">Light Blue</a>
                                </div>
                            </div>
                            <input type="hidden" id="hiddenColorInput" name="event_color_coding">
                            <script>
                                function changeColor(color, name) {
                                    document.getElementById('hiddenColorInput').value = color;
                                    document.getElementById('colorCode').textContent = `${name} (${color})`;
                                    // Prevent the dropdown from closing
                                    event.preventDefault();
                                }

                                function updateColorCode(color) {
                                    document.getElementById('hiddenColorInput').value = color;
                                    document.getElementById('colorCode').textContent = color;
                                }
                            </script>
                            <span id="colorCode" class="ml-2"></span>
                        </div>
                        <div class="custom-control custom-switch mb-4">
                            <input type="checkbox" class="custom-control-input" name="event_priority"
                                id="prioritySwitch" value="1">
                            <label class="custom-control-label" for="prioritySwitch"
                                style="font-size: 1rem">Priority</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.table').DataTable({
            "pageLength": 15
        });

        $(document).on('click', 'a[data-target="#Editeventmodal"]', function () {
            var eventId = $(this).data('id');
            var eventTitle = $(this).data('title');
            var eventStart = $(this).data('start');
            var eventEnd = $(this).data('end');
            var eventStartTime = $(this).data('start-time');
            var eventEndTime = $(this).data('end-time');
            var eventPriority = $(this).data('priority');
            var eventColor = $(this).data('color');

            $('#editEventForm').attr('action', '/events/update/' + eventId);
            $('#editEventForm').find('input[name="title"]').val(eventTitle);
            $('#editEventForm').find('input[name="start"]').val(eventStart);
            $('#editEventForm').find('input[name="end"]').val(eventEnd);
            $('#editEventForm').find('input[name="event_start_time"]').val(eventStartTime);
            $('#editEventForm').find('input[name="event_end_time"]').val(eventEndTime);
            $('#editEventForm').find('input[name="event_color_coding"]').val(eventColor);
            $('#editEventForm').find('input[name="event_priority"]').prop('checked', eventPriority);

            console.log("Loaded Event ID: ", eventId);
        });
    });
</script>

@endsection
