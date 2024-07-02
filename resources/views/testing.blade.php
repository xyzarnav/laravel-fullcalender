<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>
    <div>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputtitle1">title</label>
                                <input type="title" class="form-control" id="exampleInputtitle1"
                                    aria-describedby="titleHelp" placeholder="Enter title">
                                <small id="titleHelp" class="form-text text-muted">We'll never share your title with
                                    anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="startDate">Start date</label>
                                <input type="date" class="form-control" id="startDate" placeholder="Start Date">
                            </div>

                            <div class="form-group">
                                <label for="endDate">End date</label>
                                <input type="date" class="form-control" id="endDate" placeholder="End Date">
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label for="colorSelector" class="mr-2">Color Selector</label>
                                <input type="color" class="form-control" id="colorSelector"
                                    style="width: 50px; padding:0px">
                                <div class="dropdown">
                                    <div id="colors" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"
                                        style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #ced4da; margin-left: 10px; cursor: pointer;">
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="colors">
                                        <a class="dropdown-item" href="#" onclick="changeColor('#FF0000')">Red</a>
                                        <a class="dropdown-item" href="#" onclick="changeColor('#0000FF')">Blue</a>
                                        <a class="dropdown-item" href="#" onclick="changeColor('#008000')">Green</a>
                                        <a class="dropdown-item" href="#" onclick="changeColor('#FFFF00')">Yellow</a>
                                    </div>
                                </div>

                                <script>
                                    function changeColor(color) {
                                        document.getElementById('colors').style.backgroundColor = color;
                                    }
                                </script>
                                <span id="colorCode" class="ml-2"></span>
                            </div>


                            <style>
                                .custom-control-input:checked~.custom-control-label::before {
                                    transform: scale(1.25);
                                    /* Increase the size of the switch */
                                }
                            </style>

                            <div class="custom-control custom-switch mb-4"> <!-- Add gap below with mb-4 -->
                                <input type="checkbox" class="custom-control-input" id="prioritySwitch"
                                    onchange="updatePriority(this)">
                                <label class="custom-control-label" for="prioritySwitch"
                                    style="font-size : 1rem ">Priority</label>
                            </div>

                            <script>
                                function updatePriority(element) {
                                    var priority = element.checked ? 1 : 0;
                                    console.log("Priority set to:", priority);
                                    // You can also perform other actions based on the priority value here
                                }
                            </script>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script>
            document.getElementById('colorSelector').addEventListener('input', function () {
                var selectedColor = this.value;
                document.getElementById('colors').style.backgroundColor = selectedColor;
                document.getElementById('colorCode').innerText = selectedColor;
            });
        </script>


        <script>
            $(document).ready(function () {
                // Assuming you're using jQuery and Bootstrap Datepicker
                $('#startDate, #endDate').datepicker({
                    format: 'mm/dd/yyyy',
                    todayHighlight: true,
                    autoclose: true,
                });
            });

        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>
