<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
<div class="card shadow rounded mb-1 fixed-size" style="width: 100%; background-color: transparent;">
    <div class="card-body fixed-card-body" style="position: relative; height: 200px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <div class="text-center">
            <i class="bi bi-calendar3" style="font-size: 44px;"></i>
            <hr class="my-1">
            <h5 id="eventTitle" class="card-title mt-2" style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 16px; word-wrap: break-word; max-width: 80%;">${eventTitle}</h5>
        </div>
        <div class="event-details text-center">
            <p class="card-text mb-1" style="font-family: 'Arial', sans-serif;">
                <i class="bi bi-calendar3"></i> Start: ${eventStart}
            </p>
            <p class="card-text mb-0" style="font-family: 'Arial', sans-serif;">
                <i class="bi bi-calendar-x"></i> End: ${eventEnd}
            </p>
        </div>
    </div>
   <div class="card-footer text-left" style="font-family: 'Arial', sans-serif; display: flex; align-items: center;">
    <i class="bi bi-clock" style="margin-right: 5px;"></i>
    <p class="card-text mb-2" style="margin: 0;">
        Time: ${eventstarttime} - ${eventendtime}
    </p>
</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
